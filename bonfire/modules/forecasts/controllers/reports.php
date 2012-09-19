<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Forecasts.Reports.View');
		$this->load->model('forecasts_model', null, true);
                $this->load->model('../../eventscategories/models/eventscategories_model',null,true);
		$this->lang->load('forecasts','russian');
		
		
		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_css('jquery-ui-timepicker.css');
                Assets::add_css('xinha_fix.css');
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
                
                $eventscategories=$this->eventscategories_model->find_all();
                foreach ($eventscategories as $eventcategory) {
                    $ecdata[$eventcategory->id]=$eventcategory->event_category_name;
                }
	
                Template::set('ecdata',$ecdata); 

        Template::set('ecdata',$ecdata);                 				
		
		Template::set('records', $this->forecasts_model->find_all());
		Template::set('toolbar_title', "Управление прогнозами");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a forecasts object.
	*/
	public function create() 
	{
		$this->auth->restrict('Forecasts.Reports.Create');
                
                Assets::add_js('editors/xinha_conf.js');
                Assets::add_js('editors/xinha/XinhaCore.js');                
                Assets::add_js('editors/xinha/forecasts_xinha_conf.js');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_forecasts())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('forecasts_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'forecasts');
					
				Template::set_message(lang("forecasts_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/forecasts');
			}
			else 
			{
				Template::set_message(lang('forecasts_create_failure') . $this->forecasts_model->error, 'error');
			}
		}
                
                $eventscategories=$this->eventscategories_model->find_all();
                foreach ($eventscategories as $eventcategory) {
                    $ecdata[$eventcategory->id]=$eventcategory->event_category_name;
                }
                Template::set('ecdata',$ecdata);
				
		$frdata[0]='Не определено';
		$frdata[1]='Сбылся';
		$frdata[2]='Не сбылся';
		Template::set('frdata',$frdata); 				
	
		Template::set('toolbar_title', lang('forecasts_create_new_button'));
		Template::set('toolbar_title', lang('forecasts_create') . ' прогноз');
                
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of forecasts data.
	*/
	public function edit() 
	{            
		$this->auth->restrict('Forecasts.Reports.Edit');
                
                Assets::add_js('editors/xinha_conf.js');
                Assets::add_js('editors/xinha/XinhaCore.js');                
                Assets::add_js('editors/xinha/forecasts_xinha_conf.js');                

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('forecasts_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/forecasts');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_forecasts('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('forecasts_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'forecasts');
					
				Template::set_message(lang('forecasts_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('forecasts_edit_failure') . $this->forecasts_model->error, 'error');
			}
		}
                
                $eventscategories=$this->eventscategories_model->find_all();
                foreach ($eventscategories as $eventcategory) {
                    $ecdata[$eventcategory->id]=$eventcategory->event_category_name;
                }
	        Template::set('ecdata',$ecdata);      

		$frdata[0]='Не определено';
		$frdata[1]='Сбылся';
		$frdata[2]='Не сбылся';
		Template::set('frdata',$frdata); 			
		
		Template::set('forecasts', $this->forecasts_model->find($id));
	
		Template::set('toolbar_title', lang('forecasts_edit_heading'));
		Template::set('toolbar_title', lang('forecasts_edit') . ' прогноз');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of forecasts data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Forecasts.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->forecasts_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('forecasts_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'forecasts');
					
				Template::set_message(lang('forecasts_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('forecasts_delete_failure') . $this->forecasts_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/forecasts');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_forecasts()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_forecasts($type='insert', $id=0) 
	{	
                $this->load->helper('date');
					
		$this->form_validation->set_rules('event_date','Event Date','max_length[20]|required');			
		$this->form_validation->set_rules('event_name','Event Name','max_length[50]|required');			
		$this->form_validation->set_rules('event_category','Event Category','max_length[11]|required');			
		$this->form_validation->set_rules('event_description','Event Description','');			
		$this->form_validation->set_rules('event_coeff','Event Coeff','max_length[5]|decimal|required');			
		$this->form_validation->set_rules('event_result','Event Result','max_length[10]|required');			
		//$this->form_validation->set_rules('is_vip','Is Vip','max_length[4]|required');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
                $event_date=$this->input->post('event_date');
                $event_date=str_replace(array(":",".")," ",$event_date);
                list($day,$month,$year,$hour,$min,$sec)=explode(" ",$event_date);
                $event_date_mysql=$year.$month.$day.$hour.$min.$sec;
		$data['event_date']        = $event_date_mysql;
		$data['event_name']        = $this->input->post('event_name');
		$data['event_category']        = $this->input->post('event_category');
		$data['event_description']        = str_replace('"','\'',$this->input->post('event_description'));
		$data['event_coeff']        = $this->input->post('event_coeff');
		$data['event_result']        = $this->input->post('event_result');
		$data['is_vip']        = $this->input->post('is_vip');
                $data['forecast_result']        = $this->input->post('forecast_result');
		
		if ($type == 'insert')
		{
			$id = $this->forecasts_model->insert($data);
			
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
			$return = $this->forecasts_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}