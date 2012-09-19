<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class about extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->lang->load('about');

	//	Template::set_theme('sports');
	}
	
	//--------------------------------------------------------------------

	public function _remap($method) {
		if (method_exists($this, $method))
		{
			$this->$method();
		} else {
			show_404();
                }
	}

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{

		Template::render();
	}
	
	//--------------------------------------------------------------------

	public function service(){
		
		Template::set_block('sidebar', 'service_aside');
		Template::render();
	
	}

	public function bets() {
		
		
		Template::render();
	}
	
	public function yandex_money(){
		
		Template::set_block('sidebar', 'service_aside');
		Template::render();
	
	}
	
	public function qiwi(){
		
		Template::set_block('sidebar', 'service_aside');
		Template::render();
	
	}
	
	public function liqpay(){
		
		Template::set_block('sidebar', 'service_aside');
		Template::render();
	
	}
	
	public function mobile(){
		
		Template::set_block('sidebar', 'service_aside');
		Template::render();
	
	}
	
	public function telemoney(){
		
		Template::set_block('sidebar', 'service_aside');
		Template::render();
	
	}
	
}