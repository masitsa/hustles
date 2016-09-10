<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Ambassadeur extends admin {
	var $ambassadeur_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('ambassadeur_model');
		
		$this->load->library('image_lib');
		
		//path to image directory
		$this->ambassadeur_path = realpath(APPPATH . '../assets/images/ambassadeur');
	}
    
	/*
	*
	*	Default action is to show all the ambassadeur
	*
	*/
	public function index() 
	{
		$where = 'ambassadeur_id > 0';
		$table = 'ambassadeur';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'ambassadeur/index';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 3;
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
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->ambassadeur_model->get_all_ambassadeur($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('all_ambassadeurs', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'ambassadeur/add_ambassadeur" class="btn btn-success pull-right">Add Ambassadeur</a>There are no ambassadeur';
		}
		$data['title'] = 'All Ambassadeur';
		
		$this->load->view('admin/templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new ambassadeur
	*
	*/
	public function add_ambassadeur() 
	{
		//form validation rules
		$this->form_validation->set_rules('ambassadeur_fname', 'Ambassadeur First Name', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_onames', 'Ambassadeur Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_status', 'Ambassadeur Status', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_email', 'Ambassadeur Email', 'required|is_unique[ambassadeur.ambassadeur_email]|xss_clean');
		$this->form_validation->set_rules('ambassadeur_phone', 'Ambassadeur Phone', 'required|is_unique[ambassadeur.ambassadeur_phone]|xss_clean');
		$this->form_validation->set_rules('referral_code', 'Referral Code', 'required|is_unique[ambassadeur.referral_code]|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{	
			if($this->ambassadeur_model->add_ambassadeur())
			{
				$this->session->set_userdata('success_message', 'Ambassadeur added successfully');
				redirect('ambassadeur/index');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add ambassadeur. Please try again');
			}
		}
		
		//open the add new ambassadeur
		$data['title'] = 'Add New Ambassadeur';
		$data['content'] = $this->load->view('add_ambassadeur', '', true);
		$this->load->view('admin/templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function edit_ambassadeur($ambassadeur_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('ambassadeur_fname', 'Ambassadeur First Name', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_onames', 'Ambassadeur Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_status', 'Ambassadeur Status', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_email', 'Ambassadeur Email', 'required|xss_clean');
		$this->form_validation->set_rules('ambassadeur_phone', 'Ambassadeur Phone', 'required|xss_clean');
		$this->form_validation->set_rules('referral_code', 'Referral Code', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update ambassadeur
			if($this->ambassadeur_model->update_ambassadeur($ambassadeur_id))
			{
				$this->session->set_userdata('success_message', 'Ambassadeur updated successfully');
				redirect('ambassadeur/index');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update ambassadeur. Please try again');
			}
		}
		
		//open the add new ambassadeur
		$data['title'] = 'Edit Ambassadeur';
		
		//select the ambassadeur from the database
		$query = $this->ambassadeur_model->get_ambassadeur($ambassadeur_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['ambassadeur'] = $query->result();
			
			$data['content'] = $this->load->view('edit_ambassadeur', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Ambassadeur does not exist';
		}
		
		$this->load->view('admin/templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function delete_ambassadeur($ambassadeur_id)
	{
		$this->ambassadeur_model->delete_ambassadeur($ambassadeur_id);
		$this->session->set_userdata('success_message', 'Ambassadeur has been deleted');
		redirect('ambassadeur/index');
	}
    
	/*
	*
	*	Activate an existing ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function activate_ambassadeur($ambassadeur_id)
	{
		$this->ambassadeur_model->activate_ambassadeur($ambassadeur_id);
		$this->session->set_userdata('success_message', 'Ambassadeur activated successfully');
		redirect('ambassadeur/index');
	}
    
	/*
	*
	*	Deactivate an existing ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function deactivate_ambassadeur($ambassadeur_id)
	{
		$this->ambassadeur_model->deactivate_ambassadeur($ambassadeur_id);
		$this->session->set_userdata('success_message', 'Ambassadeur disabled successfully');
		redirect('ambassadeur/index');
	}
}
?>