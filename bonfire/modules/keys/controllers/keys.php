<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class keys extends Front_Controller {

    //--------------------------------------------------------------------

    public function __construct() 
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->load->model('keys_model', null, true);
        $this->lang->load('keys');


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
        Template::set('records', $this->keys_model->find_all());
        Template::render();
    }

    //--------------------------------------------------------------------

    public function prepare_key_order () 
    {
        $this->load->module('users');
        if ($this->users->auth->is_logged_in()) {
            $this->load->library('session');
            $key_order_form_hash=$this->input->post('ik_form_hash');
            $submitted_key_order_form_hash=md5(strtoupper($this->session->userdata('session_id').$this->input->post('ik_url').$this->input->post('ik_shop_id').$this->input->post('ik_baggage_fields').$this->input->post('ik_payment_amount')));                        
            if ($key_order_form_hash&&$key_order_form_hash==$submitted_key_order_form_hash) { 
                if ($this->input->post('ik_payment_id')) {
                    $order=$this->keys_model->find_by('id',$this->input->post('ik_payment_id'));
                    if ($order&&(!(bool)$order->is_paid)) {
                        $json['success']=true;
                    }
                    else {
                        $json['success']=false;
                        $json['ik_payment_id']='';
                    }
                }
                else {            
                    $key_owner=$this->users->auth->user_id();
                    $order_date=date('YmdHis',time());                   
                    $payment_id=$this->keys_model->insert(array('key'=>$this->input->post('ik_baggage_fields'),
                                                                'key_owner'=>$this->users->auth->user_id(),
                                                                'ordered_on'=>$order_date  
                                                                )
                                                         );
                    if ($payment_id) {
                        $json['success']=true;
                        $json['ik_payment_id']=$payment_id;
                    }
                    else {
                        $json['success']=false;                      
                    }
                }
            }
            else {
                $json['success']=false;
            }            
        }
        else {
            $json['success']=false;
            $json['redirect']=site_url().'/login';                            
        }
        echo(json_encode($json)); 
    }

    //--------------------------------------------------------------------

    public function pay_key_order () {
        $ik_shop_id=$this->input->post('ik_shop_id');
        $ik_payment_amount=$this->input->post('ik_payment_amount');
        $ik_payment_id=$this->input->post('ik_payment_id');
        $ik_payment_desc=$this->input->post('ik_payment_desc');
        $ik_paysystem_alias=$this->input->post('ik_paysystem_alias');
        $ik_baggage_fields=$this->input->post('ik_baggage_fields');
        $ik_payment_timestamp=$this->input->post('ik_payment_timestamp');
        $ik_payment_state=$this->input->post('ik_payment_state');
        $ik_trans_id=$this->input->post('ik_trans_id');
        $ik_currency_exch=$this->input->post('ik_currency_exch');
        $ik_fees_payer=$this->input->post('ik_fees_payer');
        $ik_sign_hash=$this->input->post('ik_sign_hash');
        $this->load->helper('application_helper');
        $module_config=module_config('keys');
        $email_message="\n\nРеквизиты платежа \n".
                       "Сумма платежа:".$ik_payment_amount."\n".
                       "Идентификатор платежа:".$ik_payment_id."\n".
                       "Описание платежа:".$ik_payment_desc."\n".
                       "Способ оплаты:".$ik_paysystem_alias."\n".
                       "Дата и время выполнения платежа:".date('d.m.Y H:i:s',$ik_payment_timestamp)."\n".
                       "Внутренний номер платежа в системе «INTERKASSA»:".$ik_trans_id."\n".
                       "Курс валюты:".$ik_currency_exch."\n";
        $key_payment_form_hash=strtoupper(
                                md5(
                                    $ik_shop_id.':'.
                                    $ik_payment_amount.':'.
                                    $ik_payment_id.':'.
                                    $ik_paysystem_alias.':'.
                                    $ik_baggage_fields.':'.
                                    $ik_payment_state.':'.
                                    $ik_trans_id.':'.
                                    $ik_currency_exch.':'.
                                    $ik_fees_payer.':'.
                                    $module_config['ik_secretkey']                    
                                   )
                               );            
        if ($ik_sign_hash==$key_payment_form_hash) {
            $key_order=$this->keys_model->find_by('id',$ik_payment_id);
            if ($key_order) {
                $this->load->model('../../../application/core_modules/users/models/user_model',null,true);
                $key_owner_email=$this->user_model->get_field($key_order->key_owner,'email');                                
                if ((!(bool)$key_order->is_paid)&&($key_order->key==$ik_baggage_fields)) {
                    switch (substr($key_order->key,0,4)) {
                        case 'vips':
                            $key_valid_period=0;    
                            break;
                        case 'vipp':
                            $key_valid_period=(int)str_replace('vipp','',$key_order->key);
                            break;                    
                        default:
                            break; 
                    }
                    $key_payment_data['key_price']=$ik_payment_amount;
                    $key_payment_data['valid_untill']=$key_valid_period!=0 ? date('YmdHis',strtotime(date('Y-m-d H:i:s',$ik_payment_timestamp).'+'.$key_valid_period.' day')) : null;
                    $key_payment_data['bought_on']=date('YmdHis',$ik_payment_timestamp);
                    $key_payment_data['payment_details']='Сумма платежа:'.$ik_payment_amount.';'.
                                                         'Идентификатор платежа:'.$ik_payment_id.';'.
                                                         'Описание платежа:'.$ik_payment_desc.';'.
                                                         'Способ оплаты:'.$ik_paysystem_alias.';'.
                                                         'Пользовательское поле:'.$ik_baggage_fields.';'.
                                                         'Дата и время выполнения платежа:'.date('d.m.Y H:i:s',$ik_payment_timestamp).';'.
                                                         'Внутренний номер платежа в системе «INTERKASSA»:'.$ik_trans_id.';'.
                                                         'Курс валюты:'.$ik_currency_exch.';'.
                                                         'Плательщик комиссии:'.$ik_fees_payer.';'.
                                                         'Электронная подпись:'.$ik_sign_hash.';';

                    if ($ik_payment_state=='success') {
                        $key_payment_data['is_paid']=1;
                        $key_payment_data['payment_details'].='Состояние платежа:Успешно оплачен';
                        $email_message="Оплата по Вашему заказу совершена успешно. \n".$email_message;
                    }
                    else {
                        $key_payment_data['is_paid']=0;
                        $key_payment_data['payment_details'].='Состояние платежа:Не оплачен';
                        $email_message="Оплата по Вашему заказу не совершена. \n".$email_message;
                    }
                    $this->keys_model->update($ik_payment_id,$key_payment_data);
                }
                else {
                    $email_message="Оплата по Вашему заказу не совершена.Заказ найден, но не совпадают реквизиты. \n".$email_message;
                }
            }
            else {
                $email_message="Оплата по Вашему заказу не совершена. Не найден заказ. \n".$email_message;
            }
        }
        else {
            $email_message="Оплата по Вашему заказу не совершена. Ошибка в контрольной сумме заказа. \n".$email_message;
        }
        $this->load->library('email');
        $config['mailtype']='text';
        $config['charset']='utf-8';
        $this->email->initialize($config);
        $this->email->from($module_config['support_email'],'easyvictory.com.ua');
        //$key_owner_email='mail4yurik@gmail.com';
        $this->email->to($key_owner_email);
        $this->email->subject('Покупка прогноза');
        $email_message="Уважаемый, пользователь. \n".$email_message;
        $this->email->message($email_message); 
        $this->email->send();
    }

    public function testmail () {
        $message="test\ntest";
        $this->load->library('email');
        //$config['protocol'] = 'sendmail';
        //$config['mailpath'] = 'd:';
        //$config['charset'] = 'iso-8859-1';
        //$config['wordwrap'] = TRUE;
        $config['mailtype']='text';

        $this->email->initialize($config);            
        $this->email->from('support@easyvictory.com.ua','easyvictory.com.ua');
        $this->email->to('mail4yurik@gmail.com');
        $this->email->subject('zio');
        $this->email->message($message); 
        $this->email->send();
        //mail('xxx@localhost', 'My Subject', $message);
    }

}