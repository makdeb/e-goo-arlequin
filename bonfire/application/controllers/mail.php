<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends Base_Controller {

	//--------------------------------------------------------------------
	public function __construct() 
	{
		parent::__construct();
	}	
	
	public function _remap($method) {
		if (method_exists($this, $method))
		{
			$this->$method();
		} else {
			show_404();
                }
	}
	
	public function index() 
	{	
		$data = array();
		$addr = 'support@easyvictory.com.ua';
		$sender = $_POST['email'];
		$text = $_POST['text'];
		$headers = 'From:' .$sender ."\r\n" .
				'Content-type: text/html; charset=utf-8';
		$theme = 'help';
		
		if (!isset($addr) or !isset($sender) or !isset($text)) {
			redirect('forecasts');
		} elseif (mail($addr, $theme, $text, $headers))		
		{	
			Template::set_message('Successfully send');
			$data['success']=TRUE;
		} else 
		{
			Template::set_message('There was an error while sending the message.', 'error');
			$data['success']=FALSE;
		}	
			
		Template::set('data', $data);
		Template::render();
	}
	
	
	//--------------------------------------------------------------------
	

}