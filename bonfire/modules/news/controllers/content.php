<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('News.Content.View');
		$this->load->model('news_model', null, true);
		$this->lang->load('news','russian');
		$this->load->library('image_lib');
		$this->load->helper(array('form', 'url','date'));
		Assets::add_css('xinha_fix.css');
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		$data = array();
		
	// Сортируем новости на главной в порядке "от свежее"
	
		$data['records'] = $this->news_model->order_by('news_date','desc')->find_all();
		
	// Очищаем изображение во вспомогательной таблице, для предотвращения
	// дублирования изображения в новостях	
	
		$image['img_path']='';
		
		$this->db->where('id', 1)->update('bf_image',$image);
		
	//--------------------
		
		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		
		Template::set('data', $data);
		Template::set('toolbar_title', "Управление новостями");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: do_upload()
		
		Uploading an image object.
		(*запись названия изображения при этом происходит во 
		  вспомогательную таблицу bf_image (вместе с расширением) )
		
	*/

	private function do_upload()
	{
		
		//используем CI- Класс Upload
		
		$config['upload_path'] = './bonfire/themes/sports/images/uploads/';
		$config['allowed_types'] = "gif|jpg|png";
		$config['max_size']	= '100';
		$config['max_width']  = '700';
		$config['max_height']  = '700';
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$return = array('error' => $this->upload->display_errors(),'img' => '');
			return $return;		
		}
		else
		{	
			
			$up_data = $this->upload->data();
			$data['img_path']        = $up_data['file_name'];
			$this->db->where('id', 1)->update('bf_image',$data);
			
			/*
				вызов функции do_resize для изменения размера загруженого изображения, а также для
				подготовки tumbnail-а 
			*/
			$resize = $this->do_resize($up_data['file_name']);
			
			
			if ($resize === TRUE)
			{
				$resize = $this->do_resize($up_data['file_name'],TRUE);
				if ($resize === TRUE) {
					return $return = array('error'=>'Изображение успешно загружено!','img'=>$up_data['file_name']);
				} else {
					return $return = array('error'=>'Ошибка при создании миниатюры','img'=>$up_data['file_name']);
				}
			 				
			} else return $return = array('error'=>'Ошибка при создании миниатюры','img'=>$up_data['file_name']);
		
		}
	}
	
	/*	
		вспомогательная функция do_resize()
		меняет размер изображения до необходимого, а также готовит tumbnail
		*использует CI-Клас Image Manipulation
	*/
	private function do_resize($pic,$par=FALSE) 
	{
		$errors = TRUE;
	
		
		if(!$par) {
			$config['image_library'] = 'gd2';
			$config['source_image']	= './bonfire/themes/sports/images/uploads/' .$pic;
			$config['new_image'] = './bonfire/themes/sports/images/uploads/thumb_' .$pic;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['master_dim'] = 'width';
			$config['width']	 = 180;
			$config['height']	= 130;
			
			$this->image_lib->initialize($config);
			
			
			if ( ! $this->image_lib->resize())
			{
	  			  $errors = $this->image_lib->display_errors();
			} else $errors=$errors;
		} else {
			$config['image_library'] = 'gd2';
			$config['source_image']	= './bonfire/themes/sports/images/uploads/' .$pic;
			$config['new_image'] = './bonfire/themes/sports/images/uploads/' .$pic;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['master_dim'] = 'width';
			$config['width']	 = 400;
			$config['height']	= 300;
			
			$this->image_lib->initialize($config);
			
			if ( ! $this->image_lib->resize())
			{
	  			  $errors = $this->image_lib->display_errors();
			} else $errors=$errors;
			
		}
			return $errors;
	}	
		
		
		
	/*
		Method: create()
		
		Creates a news object.
	*/
	public function create() 
	{		    
		$this->auth->restrict('News.Content.Create');
		$data=array('error'=>'','img'=>'');
		
		/*
			в случае отправки формы загрузки изображения,
			запускаем функцию do_upload()
		*/
		
		if ($this->input->post('submitted'))
		{
				
		$data = $this->do_upload();
		Template::set('data', $data);
			
		}
		
		
			
		if ($this->input->post('submit'))
		{
		
		// передаем функции сохранения save_news() тип вставки , id и название изображения
			if ($insert_id = $this->save_news('insert', 0,$this->news_model->get_img()))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('news_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'news');
					
				Template::set_message(lang("news_create_success"), 'success');
				Template::redirect(SITE_AREA .'/content/news');
			}
			else 
			{
				Template::set_message(lang('news_create_failure') . $this->news_model->error, 'error');
			}
		}
//		Template::set('error', $error);
		Template::set('toolbar_title', lang('news_create_new_button'));
		Template::set('toolbar_title', lang('news_create') . ' news');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of news data.
	*/
	public function edit() 
	{
		$this->auth->restrict('News.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('news_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/news');
		}
		
		if ($this->input->post('submitted'))
		{
				
		$data = $this->do_upload();

		Template::set('data', $data);
			
		}		
	
		if ($this->input->post('submit'))
		{
			
			/*
				в случае непустой таблицы bf_image извлекаем значение из нее и записываем в 
				переменную $img.
				Если bf_image пустая, то берем значение для изображения из таблцы bf_news
			*/
		
			if ($this->news_model->get_img() != '') { 
			$img = $this->news_model->get_img(); 
			} 
			else {
			 $img = $this->news_model->edit_img($id); 
			 }
			
			
			
		// передаем функции сохранения save_news() тип вставки , id и название изображения
			if ($this->save_news('update', $id, $img))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('news_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'news');
					
				Template::set_message(lang('news_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('news_edit_failure') . $this->news_model->error, 'error');
			}
		}
		
		Template::set('news', $this->news_model->find($id));
	
		Template::set('toolbar_title', lang('news_edit_heading'));
		Template::set('toolbar_title', lang('news_edit') . ' news');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of news data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('News.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->news_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('news_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'news');
					
				Template::set_message(lang('news_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('news_delete_failure') . $this->news_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/content/news');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_news()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_news($type='insert', $id=0, $img) 
	{	
		$return='';
		$this->form_validation->set_rules('news_category','lang:news_category','required|max_length[30]');			
		$this->form_validation->set_rules('news_title','lang:news_title','required|max_length[255]');			
//		$this->form_validation->set_rules('news_img_path','Path to img','');			
		$this->form_validation->set_rules('news_short','lang:news_short','required|max_length[800]');
		
		$this->form_validation->set_rules('news_text','lang:news_text','required|max_length[10000]');

		$this->form_validation->set_rules('news_author','lang:news_author','');
		
		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
				

		// make sure we only pass in the fields we want


		$data = array();


//		$data['news_date']  = time();
		$data['news_category']        = $this->input->post('news_category');
		$data['news_title']        = $this->input->post('news_title');
//		$data['news_img_path']        = $this->input->post('news_img_path');
		$data['news_img_path']        =  strval($img);
		$data['news_short']        = $this->input->post('news_short');
		$data['news_text']        = $this->input->post('news_text');
		$data['news_author']        = $this->input->post('news_author');
	
	
		if ($type == 'insert')
		{
			$id = $this->news_model->insert($data);
			
	
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->news_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}