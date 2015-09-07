<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Seekers extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('seekers_model');
		$this->load->model('jobs_model');
		$this->load->model('providers_model');

	}
    
	/*
	*
	*	Default action is to show all the seekers
	*
	*/
	public function index() 
	{
		$where = 'job_seeker_id > 0';
		$table = 'job_seeker';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-seekers';
		$config['total_rows'] = $this->seekers_model->count_items($table, $where);
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
		$query = $this->seekers_model->get_all_seekers($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['seekers'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('seekers/all_seekers', $v_data, true);
		}
		
		else
		{
			$data['content'] = ' There are no administrators';
		}
		$data['title'] = 'All Job seekers';
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Add a new user page
	*
	*/
	public function add_user() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|is_unique[seekers.email]|valid_email');
		$this->form_validation->set_rules('other_names', 'Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'xss_clean');
		$this->form_validation->set_rules('post_code', 'Post Code', 'xss_clean');
		$this->form_validation->set_rules('city', 'City', 'xss_clean');
		$this->form_validation->set_rules('activated', 'Activate User', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->seekers_model->add_user())
			{
				redirect('all-seekers');
			}
			
			else
			{
				$data['error'] = 'Unable to add user. Please try again';
			}
		}
		
		//open the add new user page
		$data['title'] = 'Add New Administrator';
		$data['content'] = $this->load->view('seekers/add_user', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing user page
	*	@param int $user_id
	*
	*/
	public function edit_user($user_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
		$this->form_validation->set_rules('other_names', 'Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'xss_clean');
		$this->form_validation->set_rules('post_code', 'Post Code', 'xss_clean');
		$this->form_validation->set_rules('city', 'City', 'xss_clean');
		$this->form_validation->set_rules('activated', 'Activate User', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->seekers_model->edit_user($user_id))
			{
				$this->session->set_userdata('success_message', 'User edited successfully');
				$pwd_update = $this->input->post('admin_user');
				if(!empty($pwd_update))
				{
					redirect('admin-profile/'.$user_id);
				}
				
				else
				{
					redirect('all-seekers');
				}
			}
			
			else
			{
				$data['error'] = 'Unable to add user. Please try again';
			}
		}
		
		//open the add new user page
		$data['title'] = 'Edit Administrator';
		
		//select the user from the database
		$query = $this->seekers_model->get_user($user_id);
		if ($query->num_rows() > 0)
		{
			$v_data['seekers'] = $query->result();
			$data['content'] = $this->load->view('seekers/edit_user', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'user does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Delete an existing user page
	*	@param int $user_id
	*
	*/
	public function delete_user($user_id) 
	{
		if($this->seekers_model->delete_user($user_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be deleted');
		}
		
		redirect('all-seekers');
	}
    
	/*
	*
	*	Activate an existing user page
	*	@param int $user_id
	*
	*/
	public function activate_user($user_id) 
	{
		if($this->seekers_model->activate_user($user_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be activated');
		}
		
		redirect('all-seekers');
	}
    
	/*
	*
	*	Deactivate an existing user page
	*	@param int $user_id
	*
	*/
	public function deactivate_user($user_id) 
	{
		if($this->seekers_model->deactivate_user($user_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be disabled');
		}
		
		redirect('all-seekers');
	}
	
	/*
	*
	*	Reset a user's password
	*	@param int $user_id
	*
	*/
	public function reset_password($user_id)
	{
		$new_password = $this->login_model->reset_password($user_id);
		$this->session->set_userdata('success_message', 'New password is <br/><strong>'.$new_password.'</strong>');
		
		redirect('all-seekers');
	}
	
	/*
	*
	*	Show an administrator's profile
	*	@param int $user_id
	*
	*/
	public function seeker_profile($user_id)
	{
		//open the add new user page
		$data['title'] = 'Profile';
		
		//select the user from the database
		$query = $this->seekers_model->get_job_seeker($user_id);
		if ($query->num_rows() > 0)
		{
			$v_data['seekers'] = $query->result();
			$v_data['seeker_id'] = $user_id;

			$where = 'job_category.job_category_id = jobs.job_category_id AND job_seeker_request.job_id = jobs.job_id AND job_seeker_request.job_seeker_id = job_seeker.job_seeker_id AND job_seeker_request.job_seeker_id ='.$user_id;
			$table = 'job_category,jobs,job_seeker_request,job_seeker';
			//pagination
			$this->load->library('pagination');
			$config['base_url'] = base_url().'seeker-profile/'.$user_id;
			$config['total_rows'] = $this->providers_model->count_items($table, $where);
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
			
			$config['cur_tag_open'] = '<li class="active">';
			$config['cur_tag_close'] = '</li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
	        $data["links"] = $this->pagination->create_links();
			$query = $this->jobs_model->get_all_jobs($table, $where, $config["per_page"], $page, 'jobs.created','jobs.completed');
			$v_data['jobs'] = $query;
			$v_data['page'] = $page;
		}
		
		else
		{
			$v_data['title'] = 'Profile';
			$v_data['seekers'] = 0;
			$v_data['jobs'] = 0;
			$v_data['page'] = 0;
		}
		$data['content'] = $this->load->view('seekers/view_profile', $v_data, TRUE);
		$this->load->view('templates/general_admin', $data);
	}
}
?>