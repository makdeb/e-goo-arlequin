<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class prices extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('prices_model', null, true);
		$this->lang->load('prices');
		
	//	Template::set_theme('sports');
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
      //        Assets::add_module_js('prices','order_key.js');
            
		$data = array();
		$data['records'] = $this->prices_model->find_all();
                
                $this->load->library('session');
                $this->load->helper('application_helper');
                $keys_module_config=module_config('keys');
                                
                foreach ($data['records'] as $price) {
                    if ($price->prices_key_type=='vipp') {
                        $key=$price->prices_key_type.$price->prices_key_valid_period;
                        $key_order_form_hash=md5(strtoupper($this->session->userdata('session_id').
                                                 $keys_module_config['ik_url'].
                                                 $keys_module_config['ik_shop_id'].
                                                 $key.
                                                 $price->prices_usd));
                        $forms_data[]=array('key'=>$key,
											'prices_name'=>$price->prices_name,
                                            'key_price'=>$price->prices_usd,                                            
                                            'form_hash'=>$key_order_form_hash);
                    }
                }
                
                $data['forms_data']=$forms_data;
                $data['keys_config']=$keys_module_config;

		Template::set('data', $data);
		Template::render();
	}
	
	//--------------------------------------------------------------------



}