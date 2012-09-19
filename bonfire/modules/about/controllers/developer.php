<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('About.Developer.View');
		$this->load->model('about_model', null, true);
		$this->lang->load('about');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		$data = array();
		$data['records'] = $this->about_model->find_all();

		Assets::add_js($this->load->view('developer/js', null, true), 'inline');
		
		Template::set('data', $data);
		Template::set('toolbar_title', "Manage About");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a About object.
	*/
	public function create() 
	{
		$this->auth->restrict('About.Developer.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_about())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('about_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'about');
					
				Template::set_message(lang("about_create_success"), 'success');
				Template::redirect(SITE_AREA .'/developer/about');
			}
			else 
			{
				Template::set_message(lang('about_create_failure') . $this->about_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('about_create_new_button'));
		Template::set('toolbar_title', lang('about_create') . ' About');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of About data.
	*/
	public function edit() 
	{
		$this->auth->restrict('About.Developer.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('about_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/about');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_about('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('about_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'about');
					
				Template::set_message(lang('about_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('about_edit_failure') . $this->about_model->error, 'error');
			}
		}
		
		Template::set('about', $this->about_model->find($id));
	
		Template::set('toolbar_title', lang('about_edit_heading'));
		Template::set('toolbar_title', lang('about_edit') . ' About');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of About data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('About.Developer.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->about_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('about_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'about');
					
				Template::set_message(lang('about_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('about_delete_failure') . $this->about_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/developer/about');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_about()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_about($type='insert', $id=0) 
	{	
		

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		
		if ($type == 'insert')
		{
			$id = $this->about_model->insert($data);
			
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
			$return = $this->about_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}