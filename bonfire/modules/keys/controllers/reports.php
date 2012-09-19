<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Keys.Reports.View');
		$this->load->model('keys_model', null, true);
		$this->lang->load('keys','russian');
		
		$this->load->model('../../application/core_modules/users/models/user_model',null,true); 
                
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_css('jquery-ui-timepicker.css');
		Assets::add_js('jquery-ui-timepicker-addon.js');
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('records', $this->keys_model->find_all());
		Template::set('toolbar_title', "Управление ключами доступа");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a keys object.
	*/
	public function create() 
	{
		$this->auth->restrict('Keys.Reports.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_keys())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('keys_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'keys');
					
				Template::set_message(lang("keys_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/keys');
			}
			else 
			{
				Template::set_message(lang('keys_create_failure') . $this->keys_model->error, 'error');
			}
		}
                $users=$this->user_model->find_all();
                foreach ($users as $user) {
                    $userdata[$user->id]=$user->first_name.' '.$user->last_name;
                }                
                Template::set('userdata',$userdata);                 
	
		Template::set('toolbar_title', lang('keys_create_new_button'));
		Template::set('toolbar_title', lang('keys_create') . ' ключ доступа');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of keys data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Keys.Reports.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('keys_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/keys');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_keys('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('keys_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'keys');
					
				Template::set_message(lang('keys_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('keys_edit_failure') . $this->keys_model->error, 'error');
			}
		}
                $users=$this->user_model->find_all();
                foreach ($users as $user) {
                    $userdata[$user->id]=$user->first_name.' '.$user->last_name;
                }                
                Template::set('userdata',$userdata); 
		
		Template::set('keys', $this->keys_model->find($id));
	
		Template::set('toolbar_title', lang('keys_edit_heading'));
		Template::set('toolbar_title', lang('keys_edit') . ' ключ доступа');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of keys data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Keys.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->keys_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('keys_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'keys');
					
				Template::set_message(lang('keys_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('keys_delete_failure') . $this->keys_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/keys');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_keys()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_keys($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('key','Key','max_length[7]|min_length[5]');			
		$this->form_validation->set_rules('key_owner','Key Owner','integer');
                $this->form_validation->set_rules('key_price','Key Price','decimal');
		$this->form_validation->set_rules('valid_untill','Valid Untill','max_length[20]');			
                $this->form_validation->set_rules('ordered_on','Ordered On','max_length[20]');
		$this->form_validation->set_rules('bought_on','Bought On','max_length[20]');			
		$this->form_validation->set_rules('payment_details','Payment Details','max_length[512]');                

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
                $valid_untill=$this->input->post('valid_untill');
                if (!empty($valid_untill)) {
                    $valid_untill=str_replace(array(":",".")," ",$valid_untill);
                    list($day,$month,$year,$hour,$min,$sec)=explode(" ",$valid_untill);
                    $valid_untill_mysql=$year.$month.$day.$hour.$min.$sec;
                }
                
                $ordered_on=$this->input->post('ordered_on');
                if (!empty($ordered_on)) {
                    $ordered_on=str_replace(array(":",".")," ",$ordered_on);
                    list($day,$month,$year,$hour,$min,$sec)=explode(" ",$ordered_on);                
                    $ordered_on_mysql=$year.$month.$day.$hour.$min.$sec;
                }
                
                $bought_on=$this->input->post('bought_on');
                if (!empty($bought_on)) {
                    $bought_on=str_replace(array(":",".")," ",$bought_on);
                    list($day,$month,$year,$hour,$min,$sec)=explode(" ",$bought_on);                
                    $bought_on_mysql=$year.$month.$day.$hour.$min.$sec; 
                }
                
		$data['key']        = $this->input->post('key');
		$data['key_owner']        = $this->input->post('key_owner');
                $data['key_price']        = $this->input->post('key_price')=='' ? null : $this->input->post('key_price');
		$data['valid_untill']        = empty($valid_untill_mysql) ? null : $valid_untill_mysql;
                $data['ordered_on']        = empty($ordered_on_mysql) ? null : $ordered_on_mysql;
		$data['bought_on']        = empty($bought_on_mysql) ? null : $bought_on_mysql;                
		$data['payment_details']        = $this->input->post('payment_details');
                $data['is_paid']    = $this->input->post('is_paid');
		
		if ($type == 'insert')
		{
			$id = $this->keys_model->insert($data);
			
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
			$return = $this->keys_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}