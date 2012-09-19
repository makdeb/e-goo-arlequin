<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Keys.Developer.View');
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
		Assets::add_js($this->load->view('developer/js', null, true), 'inline');
		
		Template::set('records', $this->keys_model->find_all());
		Template::set('toolbar_title', "Manage keys");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a keys object.
	*/
	public function create() 
	{
		$this->auth->restrict('Keys.Developer.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_keys())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('keys_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'keys');
					
				Template::set_message(lang("keys_create_success"), 'success');
				Template::redirect(SITE_AREA .'/developer/keys');
			}
			else 
			{
				Template::set_message(lang('keys_create_failure') . $this->keys_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('keys_create_new_button'));
		Template::set('toolbar_title', lang('keys_create') . ' keys');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of keys data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Keys.Developer.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('keys_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/keys');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_keys('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('keys_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'keys');
					
				Template::set_message(lang('keys_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('keys_edit_failure') . $this->keys_model->error, 'error');
			}
		}
		
		Template::set('keys', $this->keys_model->find($id));
	
		Template::set('toolbar_title', lang('keys_edit_heading'));
		Template::set('toolbar_title', lang('keys_edit') . ' keys');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of keys data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Keys.Developer.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->keys_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('keys_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'keys');
					
				Template::set_message(lang('keys_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('keys_delete_failure') . $this->keys_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/developer/keys');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_keys()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_keys($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('key','Key','max_length[32]');			
		$this->form_validation->set_rules('key_owner','Key Owner','max_length[1]');			
		$this->form_validation->set_rules('valid_untill','Valid Untill','max_length[1]');			
		$this->form_validation->set_rules('bought_on','Bought On','max_length[1]');			
		$this->form_validation->set_rules('payment_details','Payment Details','max_length[512]');			
		$this->form_validation->set_rules('is_paid','Is Paid','max_length[6]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['key']        = $this->input->post('key');
		$data['key_owner']        = $this->input->post('key_owner');
		$data['valid_untill']        = $this->input->post('valid_untill');
		$data['bought_on']        = $this->input->post('bought_on');
		$data['payment_details']        = $this->input->post('payment_details');
		$data['is_paid']        = $this->input->post('is_paid');
		
		if ($type == 'insert')
		{
			$id = $this->keys_model->insert($data);
			
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
			$return = $this->keys_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}