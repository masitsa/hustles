<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Advertising extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('advertising_model');
		$this->load->model('users_model');
	}
    
	/*
	*
	*	Default action is to show all the advert
	*
	*/
	public function index() 
	{
		$where = 'advert_id > 0';
		$table = 'advertisments';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-advertisments';
		$config['total_rows'] = $this->advertising_model->count_items($table, $where);
		$config['uri_segment'] = 2;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->advertising_model->get_all_advert($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['advert'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('advertising/all_advert', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-advert" class="btn btn-success pull-right">Add advert</a> There are no adverts';
		}
		$data['title'] = 'All adverts';
		
		$this->load->view('templates/general_admin', $data);
	}
    
    
	/*
	*
	*	Delete an existing advert page
	*	@param int $advert_id
	*
	*/
	public function delete_advert($advert_id) 
	{
		if($this->advertising_model->delete_advert($advert_id))
		{
			$this->session->set_userdata('success_message', 'advert has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'advert could not be deleted');
		}
		
		redirect('all-advertisments');
	}
    
	/*
	*
	*	Activate an existing advert page
	*	@param int $advert_id
	*
	*/
	public function activate_advert($advert_id) 
	{
		if($this->advertising_model->activate_advert($advert_id))
		{
			$this->session->set_userdata('success_message', 'advert has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'advert could not be activated');
		}
		
		redirect('all-advertisments');
	}
    
	/*
	*
	*	Deactivate an existing advert page
	*	@param int $advert_id
	*
	*/
	public function deactivate_advert($advert_id) 
	{
		if($this->advertising_model->deactivate_advert($advert_id))
		{
			$this->session->set_userdata('success_message', 'advert has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'advert could not be disabled');
		}
		
		redirect('all-advertisments');
	}

	/*
	*
	*	Add a new user page
	*
	*/
	public function add_advert() 
	{
		//form validation rules
		$this->form_validation->set_rules('company_id', 'Company', 'required|xss_clean');
		$this->form_validation->set_rules('advert_link', 'Link', 'required|xss_clean');
		$this->form_validation->set_rules('advert_status', 'Status', 'required|xss_clean');
		$this->form_validation->set_rules('advert_title', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('advert_amount', 'Advert Amount', 'required|xss_clean');
		$this->form_validation->set_rules('advert_time', 'Advert Length', 'required|xss_clean');
		$this->form_validation->set_rules('advert_status', 'Status', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if advert has valid login credentials
			if($this->advertising_model->add_advert())
			{
				redirect('all-advertisments');
			}
			
			else
			{
				$data['error'] = 'Unable to add advert. Please try again';
			}
		}
		
		//open the add new advert page
		$data['title'] = 'Add New advert';
		$v_data['companies'] = $this->advertising_model->get_companies();
		$data['content'] = $this->load->view('advertising/add_advert', $v_data, TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing advert page
	*	@param int $advert_id
	*
	*/
	public function edit_advert($advert_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('company_id', 'Company', 'required|xss_clean');
		$this->form_validation->set_rules('advert_link', 'Link', 'required|xss_clean');
		$this->form_validation->set_rules('advert_status', 'Status', 'required|xss_clean');
		$this->form_validation->set_rules('advert_title', 'Title', 'required|xss_clean');
		$this->form_validation->set_rules('advert_amount', 'Advert Amount', 'required|xss_clean');
		$this->form_validation->set_rules('advert_time', 'Advert Length', 'required|xss_clean');
		$this->form_validation->set_rules('advert_status', 'Status', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if advert has valid login credentials
			if($this->advertising_model->edit_advert($advert_id))
			{
				$this->session->set_userdata('success_message', 'advert edited successfully');
				redirect('all-advertisments');
			}
			
			else
			{
				$data['error'] = 'Unable to add advert. Please try again';
			}
		}
		
		//open the add new advert page
		$data['title'] = 'Edit advert';
		
		//select the advert from the database
		$query = $this->advertising_model->get_advert($advert_id);
		$v_data['companies'] = $this->advertising_model->get_companies();
		if ($query->num_rows() > 0)
		{
			$v_data['advert'] = $query;
			$data['content'] = $this->load->view('advertising/edit_advert', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'advert does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
	
}
?>