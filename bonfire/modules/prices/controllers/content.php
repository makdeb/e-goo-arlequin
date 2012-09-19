<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('Prices.Content.View');
		$this->load->model('prices_model', null, true);
		$this->lang->load('prices','russian');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		$data = array();
		$data['records'] = $this->prices_model->find_all();

		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		
		Template::set('data', $data);
		Template::set('toolbar_title', "Управление Тарифами");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a Prices object.
	*/
	public function create() 
	{
		$this->auth->restrict('Prices.Content.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_prices())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('prices_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'prices');
					
				Template::set_message(lang("prices_create_success"), 'success');
				Template::redirect(SITE_AREA .'/content/prices');
			}
			else 
			{
				Template::set_message(lang('prices_create_failure') . $this->prices_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('prices_create_new_button'));
		Template::set('toolbar_title', lang('prices_create') . ' Prices');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of Prices data.
	*/
	public function edit() 
	{
		$this->auth->restrict('Prices.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('prices_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/prices');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_prices('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('prices_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'prices');
					
				Template::set_message(lang('prices_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('prices_edit_failure') . $this->prices_model->error, 'error');
			}
		}
		
		Template::set('prices', $this->prices_model->find($id));
	
		Template::set('toolbar_title', lang('prices_edit_heading'));
		Template::set('toolbar_title', lang('prices_edit') . ' Prices');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of Prices data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('Prices.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->prices_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('prices_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'prices');
					
				Template::set_message(lang('prices_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('prices_delete_failure') . $this->prices_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/content/prices');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_prices()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_prices($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('prices_name','lang:prices_name','required|max_length[45]');			
		$this->form_validation->set_rules('prices_uah','lang:prices_uah','required|is_decimal|');			
		$this->form_validation->set_rules('prices_rur','lang:prices_rur','required|is_decimal|');			
		$this->form_validation->set_rules('prices_usd','lang:prices_usd','required|is_decimal|');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['prices_name']        = $this->input->post('prices_name');
		$data['prices_uah']        = $this->input->post('prices_uah');
		$data['prices_rur']        = $this->input->post('prices_rur');
		$data['prices_usd']        = $this->input->post('prices_usd');
		
		if ($type == 'insert')
		{
			$id = $this->prices_model->insert($data);
			
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
			$return = $this->prices_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}