<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('About.Reports.View');
		$this->lang->load('about');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{

		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('toolbar_title', "О проекте");
		Template::render();
	}
	
	//--------------------------------------------------------------------




}