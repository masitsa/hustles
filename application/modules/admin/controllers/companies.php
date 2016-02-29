<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Companies extends admin 
{
	function __construct()
	{
		parent:: __construct();
	    $this->load->model('users_model');
	    $this->load->model('companies_model');
	}
    
	/*
	*
	*	Default action is to show all the companies
	*
	*/
	public function index($order = 'company_name', $order_method = 'ASC') 
	{
		$where = 'company_id > 0';
		$table = 'company';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'admin/companies/'.$order.'/'.$order_method;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
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
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->companies_model->get_all_companies($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'Companies';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['all_companies'] = $this->companies_model->all_companies();
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('companies/all_companies', $v_data, true);
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new company
	*
	*/
	public function add_company() 
	{
		//form validation rules
		$this->form_validation->set_rules('company_name', 'Company Name', 'required|xss_clean');
		$this->form_validation->set_rules('company_contact_person_name', 'Contact name', 'xss_clean');
		$this->form_validation->set_rules('company_contact_person_phone1', 'Contact phone 1', 'xss_clean');
		$this->form_validation->set_rules('company_contact_person_phone2', 'Contact phone 2', 'xss_clean');
		$this->form_validation->set_rules('company_contact_person_email1', 'Contact email 1', 'valid_email|xss_clean');
		$this->form_validation->set_rules('company_contact_person_email2', 'Contact email 2', 'valid_email|xss_clean');
		$this->form_validation->set_rules('company_description', 'Company description', 'xss_clean');
		$this->form_validation->set_rules('company_status', 'Company Status', 'xss_clean');
		$this->form_validation->set_rules('pricing_rate', 'Pricing Rate', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			$pricing_rate = $this->input->post('pricing_rate');
			// var_dump($pricing_rate); die();
			if($this->companies_model->add_company())
			{
				$this->session->set_userdata('success_message', 'Company added successfully');
				redirect('all-companies');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add Company. Please try again');
			}
		}
		
		$data['title'] = 'Add Company';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('companies/add_company', $v_data, true);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing company
	*	@param int $company_id
	*
	*/
	public function edit_company($company_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('company_name', 'Company Name', 'required|xss_clean');
		$this->form_validation->set_rules('company_contact_person_name', 'Contact name', 'xss_clean');
		$this->form_validation->set_rules('company_contact_person_phone1', 'Contact phone 1', 'xss_clean');
		$this->form_validation->set_rules('company_contact_person_phone2', 'Contact phone 2', 'xss_clean');
		$this->form_validation->set_rules('company_contact_person_email1', 'Contact email 1', 'valid_email|xss_clean');
		$this->form_validation->set_rules('company_contact_person_email2', 'Contact email 2', 'valid_email|xss_clean');
		$this->form_validation->set_rules('company_description', 'Company description', 'xss_clean');
		$this->form_validation->set_rules('company_status', 'Company Status', 'xss_clean');
		$this->form_validation->set_rules('pricing_rate', 'Pricing Rate', 'xss_clean');
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update company
			if($this->companies_model->update_company($company_id))
			{
				$this->session->set_userdata('success_message', 'Company updated successfully');
				redirect('all-companies');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update company. Please try again');
			}
		}
		
		//open the add new company
		$data['title'] = 'Edit company';
		$v_data['title'] = $data['title'];
		
		//select the company from the database
		$query = $this->companies_model->get_company($company_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['company_array'] = $query->row();
			
			$data['content'] = $this->load->view('companies/edit_company', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Company does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing company
	*	@param int $company_id
	*
	*/
	public function delete_company($company_id)
	{
		$this->companies_model->delete_company($company_id);
		$this->session->set_userdata('success_message', 'Company has been deleted');
		redirect('all-companies');
	}
    
	/*
	*
	*	Activate an existing company
	*	@param int $company_id
	*
	*/
	public function activate_company($company_id)
	{
		$this->companies_model->activate_company($company_id);
		$this->session->set_userdata('success_message', 'Company activated successfully');
		redirect('all-companies');
	}
    
	/*
	*
	*	Deactivate an existing company
	*	@param int $company_id
	*
	*/
	public function deactivate_company($company_id)
	{
		$this->companies_model->deactivate_company($company_id);
		$this->session->set_userdata('success_message', 'Company disabled successfully');
		redirect('all-companies');
	}
}
?>