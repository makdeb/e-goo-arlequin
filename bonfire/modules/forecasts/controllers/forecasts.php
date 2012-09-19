<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class forecasts extends Front_Controller {

//--------------------------------------------------------------------

    public function __construct() 
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->load->model('forecasts_model', null, true);
        $this->load->model('../../keys/models/keys_model', null, true);
        $this->lang->load('forecasts');

        $this->load->module('users');


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
        $forecasts=$this->forecasts_model->get_forecasts();
        //Assets::add_module_css('forecasts','forecasts.css');
        //Assets::add_module_js('forecasts','forecasts.js');
        Template::set('records', $forecasts);
        Template::render();
    }

    //--------------------------------------------------------------------

    public function buy() 
    {
        Template::render();            
    }

    //--------------------------------------------------------------------

    public function get_forecast()
    {            
        $forecast_id=(int)$this->input->post('forecast_id');
        if ($this->forecasts_model->is_vip($forecast_id)) {
            if ($this->users->auth->is_logged_in()) {
                $user_keys=$this->keys_model->get_keys($this->users->auth->user_id());
                if ($this->forecasts_model->check_keys($forecast_id,$user_keys)) {
                    $forecast_desc=$this->forecasts_model->get_forecast_description($forecast_id);
                    $json['success']=true;
                    $json['forecast_desc']=$forecast_desc['event_description'];
                    $json['forecast_result']=$forecast_desc['event_result'];
                    echo(json_encode($json));
                }
                else { 
                    $event_name=$this->forecasts_model->get_field($forecast_id,'event_name');
                    $key='vips'.$forecast_id;
                    $this->load->model('../../prices/models/prices_model', null, true);
                    $this->load->helper('application_helper');
                    $prices_module_config=module_config('prices');
                    $keys_module_config=module_config('keys');
                    $key_price=$this->prices_model->get_vip_price('vips',$prices_module_config['currency']);
                    $this->load->library('session');
                    $key_order_form_hash=md5(strtoupper($this->session->userdata('session_id').
                                             $keys_module_config['ik_url'].
                                             $keys_module_config['ik_shop_id'].
                                             $key.
                                             $key_price));
                    //$this->session->set_userdata('key_order_form_hash',$key_order_form_hash);                        
                    $json['success']=false;
                    $json['buy_text']='<p class="fc-buy-forecast">Вы выбрали доступ к прогнозу <b>'.
                                      $event_name.
                                      '</b> стоимостю '.$key_price.
                                      $prices_module_config['currency'].'.</br>'.
                                      'Сразу же после осуществления платежа '.
                                      'Вы получите доступ к выбранному прогнозу.</br>'.
                                      '<a href="#" class="fc-buy-forecast-submit" id="'.$forecast_id.'">Прейти к оплате</a></p>';
                    $json['buy_form']='<form name="payment" action="'.$keys_module_config['ik_url'].'" method="post" target="_blank">'.
                                      '<input type="hidden" name="ik_shop_id" value="'.$keys_module_config['ik_shop_id'].'">'.
                                      '<input type="hidden" name="ik_payment_amount" value="'.$key_price.'">'.
                                      '<input type="hidden" name="ik_payment_id" value="">'.
                                      '<input type="hidden" name="ik_payment_desc" value="Ключ доступа к прогнозу '.$event_name.'">'.
                                      '<input type="hidden" name="ik_paysystem_alias" value="">'.
                                      '<input type="hidden" name="ik_baggage_fields" value="'.$key.'">'.
                                      '<input type="hidden" name="ik_form_hash" value="'.$key_order_form_hash.'">'.
                                      '</form>';
                    echo(json_encode($json));                        
                }
            }
            else
            {
                $json['success']=false;
                $json['redirect']=site_url().'login';
                echo(json_encode($json));  
            }
        }
        else {
            $forecast_desc=$this->forecasts_model->get_forecast_description($forecast_id);
            $json['success']=true;
            $json['forecast_desc']=$forecast_desc['event_description'];
            $json['forecast_result']=$forecast_desc['event_result'];
            echo(json_encode($json));                
        }
    }        

}