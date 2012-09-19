<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class reports extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Eventscategories.Reports.View');
		$this->load->model('eventscategories_model', null, true);
		$this->lang->load('eventscategories');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('reports/js', null, true), 'inline');
		
		Template::set('records', $this->eventscategories_model->find_all());
		Template::set('toolbar_title', "Manage eventscategories");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a eventscategories object.
	*/
	public function create() 
	{
		$this->auth->restrict('Eventscategories.Reports.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_eventscategories())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('eventscategories_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'eventscategories');
					
				Template::set_message(lang("eventscategories_create_success"), 'success');
				Template::redirect(SITE_AREA .'/reports/eventscategories');
			}
			else 
			{
				Template::set_message(lang('eventscategories_create_failure') . $this->eventscategories_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('eventscategories_create_new_button'));
		Template::set('toolbar_title', lang('eventscategories_create') . ' eventscategories');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of eventscategories data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Eventscategories.Reports.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('eventscategories_invalid_id'), 'error');
			redirect(SITE_AREA .'/reports/eventscategories');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_eventscategories('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('eventscategories_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'eventscategories');
					
				Template::set_message(lang('eventscategories_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('eventscategories_edit_failure') . $this->eventscategories_model->error, 'error');
			}
		}
		
		Template::set('eventscategories', $this->eventscategories_model->find($id));
	
		Template::set('toolbar_title', lang('eventscategories_edit_heading'));
		Template::set('toolbar_title', lang('eventscategories_edit') . ' eventscategories');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of eventscategories data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Eventscategories.Reports.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->eventscategories_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('eventscategories_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'eventscategories');
					
				Template::set_message(lang('eventscategories_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('eventscategories_delete_failure') . $this->eventscategories_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/reports/eventscategories');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_eventscategories()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_eventscategories($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('event_category_name','Event Category Name','required|max_length[45]');			
		$this->form_validation->set_rules('event_category_img','Event Category Img','max_length[100]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['event_category_name']        = $this->input->post('event_category_name');
		$data['event_category_img']        = $this->input->post('event_category_img');
		
		if ($type == 'insert')
		{
			$id = $this->eventscategories_model->insert($data);
			
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
			$return = $this->eventscategories_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}