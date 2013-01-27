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
	
	//--------------------------------------------------------------------	
	/*
		функция stats() используется для генерации стартовой страницы статистики.
		Она определяет отображение статистики для текущего месяца текущего года.	
	*/
	public function stats() 
    {	
		$month = date('m');//текущий месяц
		$year= date('Y');//текущий год
		// массив соответствий названий месяцев и их порядковых номеров
		$monthes = array(
			'1' => 'Январь','2' => 'Февраль','3' => 'Март','4' => 'Апрель','5' => 'Май','6' => 'Июнь','7' => 'Июль','8' => 'Август','9' => 'Сентябрь','10' => 'Октябрь','11' => 'Ноябрь','12' => 'Декабрь'
		);
		
        $forecasts=$this->forecasts_model->find_all_ready(0,$month,$year);//все прогнозы
		$won_forecsts = count($this->forecasts_model->find_all_ready(1,$month,$year));// количество выиграных
		$overall_forecasts = count($forecasts);//общее кол-во
        //Assets::add_module_css('forecasts','forecasts.css');
        //Assets::add_module_js('forecasts','forecasts.js');
		Template::set('year', $year);
		Template::set('month', $month);
		Template::set('monthes', $monthes);
		Template::set('overall', $overall_forecasts);
		Template::set('won', $won_forecsts);
        Template::set('records', $forecasts);
        Template::render();
    }
	
	/*
		функция get_stats() используется для генерации любой порции статистики.
		Она определяет отображение статистики для выбранного месяца текущего года.	
	*/
	
	public function get_stats()
	{	
		$month=(int)$this->input->post('month');//прием месяца
		$year=(int)$this->input->post('year');//прием года
		
		$data = array();
		$data['records'] = $this->forecasts_model->find_all_ready(FALSE,$month,$year);//все прогнозы
		$data['records'] = array_reverse($data['records']);
		$data['all'] = count($data['records']);//общее кол-во
		$data['won'] = count($this->forecasts_model->find_all_ready(1,$month,$year));//кол-во выигранных
		
		// генерируем результирующую json-строку всех прогнозов и количеств для javascript-а. 
		$result = '{"success":true,"stats":[';
		foreach ($data['records'] as $record) {
		 	foreach ($record as $field => $value) {
				if (($field=='is_vip')||($field=='event_name')||($field=='event_coeff')||($field=='event_result')||($field=='forecast_result')) {
					$json[$field]= $value;
				} elseif ($field=='event_date') {
					$json[$field] = date('d.m',strtotime($value));
				}
			}
		$result .= json_encode($json) .",";
		$error = json_last_error();//если ошибка при кодировании
			if ($error !== JSON_ERROR_NONE) {
				$result = '{"success":false,"stats":[]}';
				echo $result;
				return;
			}
		}
		$result=preg_replace('/\,$/', '', $result);//удаляем лишнюю последнюю запятую в строке
		$result .= '],"all":"' .$data['all'] .'","won":"'.$data['won'] .'"}';
		echo $result;
	}
}