<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class news extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();
				
		$this->load->library('form_validation');
		$this->load->model('news_model', null, true);
		$this->lang->load('news');
		$this->load->library('pagination');
		$this->load->helper('date');
		
		Template::set_block('sidebar', 'news_aside');
		
	//	Template::set_theme('sports');
		
	}
// Вспомогательная функция для проверки Modules::run в home/index - контроллере	
	public function rend_news() {
		
		$limit = 6;
		$offset = '';
		$cat = '';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$cat);
 
    	return $this->load->view('news/rend_news', $data, true);
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Даный метод используеться для отображения новости по её id в базе.
	*/
	public function index($slug='') 
	{
		
		$data = array();
				
		if ($slug === '') {

			Template::redirect('/news/pages');
 		
		}
		
		elseif (intval($slug)) {
		$data['records'] = $this->news_model->get_note($slug);
		
		}

		Template::set('data', $data);
		Template::render();
		
	}
	
	/*
		Method: pages()
		
		Даный метод используеться для отображения всех новостей, независимо от категории.
		*принимает номер страницы для отображения
	*/
	
	public function pages($page='') {
		
		$limit = 6;
		$offset = '';
		$cat = '';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$cat);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/pages/';
		$config['total_rows'] = $this->news_model->count_all();
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/pages/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 

		Template::set('data', $data);

		Template::render();
	}
	
	//--------------------------------------------------------------------
	
	/*
		Методы каждой категории, отображающие новости в каждой группе в отдельности 
		*идентичны методу pages()
	*/

	//------------CATEGORIES!!!------------------

	public function football($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'football';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/football/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/football/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}

	public function basketball($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'basketball';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/basketball/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/basketball/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}


	public function hockey($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'hockey';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/hockey/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/hockey/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}
		
	public function tennis($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'tennis';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/tennis/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/tennis/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}	
	
	public function box($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'box';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/box/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/box/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}
		
	public function auto($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'auto';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/auto/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/auto/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}	
		
		
	public function other($page='') {
		
		$limit = 6;
		$offset = '';
		$slug = 'other';
				
		$data = array();
			
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $limit*($page-1);
		}
			
		$data['records'] = $this->news_model->list_news($limit,$offset,$slug);
		
		$config['base_url'] = 'http://easyvictory.com.ua/news/other/';
		$config['total_rows'] = count($this->news_model->get_news($slug));
		$config['per_page'] = $limit;	
		$config['first_url'] = 'http://easyvictory.com.ua/news/other/1';
		
		$config['first_link'] = 'Первая';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;
		$config['cur_tag_open'] = '<b class="pags">';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config); 
		
		$data['pag_links'] = $this->pagination->create_links(); 
	
		Template::set('data', $data);
		Template::render();
	}

	//------------END--CATEGORIES!!!-------------------------------------
}