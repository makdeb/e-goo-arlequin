<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {

	//--------------------------------------------------------------------
	
	public function __construct() 
	{
		parent::__construct();
		
        $this->load->helper('url');
		
		$this->load->library('grocery_CRUD');
	}
		
	public function index() 
	{		
		Template::render();
	}
	
	//--------------------------------------------------------------------

}