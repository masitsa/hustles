<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Provider extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('provider_model');
		$this->load->model('admin/jobs_model');
	}
    
	/*
	*
	*	Default action is to show all the providers
	*
	*/
	public function index() 
	{
		$where = 'job_category.job_category_id = jobs.job_category_id AND job_provider_id ='.$this->session->userdata('user_id');
		$table = 'job_category,jobs';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'my-jobs';
		$config['total_rows'] = $this->provider_model->count_items($table, $where);
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
		
		if ($query->num_rows() > 0)
		{
			$v_data['jobs'] = $query;
			$v_data['page'] = $page;

			$data['content'] = $this->load->view('view_jobs', $v_data, true);
		}
		
		else
		{
			$data['content'] = ' There are no jobs created by you';
		}
		$data['title'] = 'My Jobs';
		
		$this->load->view('templates/general_admin', $data);
	}
	public function view_job_details($job_id)
	{

		$where = 'job_seeker.job_seeker_id = job_seeker_request.job_seeker_id  AND job_seeker_request.job_id = '.$job_id;
		$table = 'job_seeker_request,job_seeker';

		

		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'view-job/'.$job_id;
		$config['total_rows'] = $this->provider_model->count_items($table, $where);
		$config['uri_segment'] = 4;
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
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->jobs_model->get_all_job_applicants($table, $where, $config["per_page"], $page, 'job_seeker.job_seeker_first_name','job_seeker.job_seeker_last_name');
		
		if ($query->num_rows() > 0)
		{
			$v_data['job_applicants'] = $query;
			$v_data['job_id'] = $job_id;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('job_detail', $v_data, true);
		}
		
		else
		{

			$data['content'] = '<a href="'.base_url().'my-jobs" class="btn btn-sm btn-info pull-right" >Go back to my Jobs</a> <br>There are no administrators';
		}

		$data['title'] = 'Job detail and other information';
		$this->load->view('templates/general_admin', $data);
	}
	public function post_job()
	{
		$this->form_validation->set_rules('job_title', 'Job title', 'required|xss_clean');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|xss_clean');
		$this->form_validation->set_rules('job_start_location', 'Start location', 'required|xss_clean');
		$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required|xss_clean');
		$this->form_validation->set_rules('contact_person_phone', 'Contact Person Phone', 'required|xss_clean');
		$this->form_validation->set_rules('contact_person_email', 'Contact Person Email', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if job has valid login credentials
			if($this->jobs_model->post_job())
			{
				$this->session->set_userdata('success_message', 'Job added successfully');
				redirect('post-job');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Unable to add job. Please try again');
			}
		}
		
		//open the add new job page
		$data['title'] = 'Add job';
		$data['content'] = $this->load->view('jobs/add_new_job', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}

	public function edit_job($job_id)
	{
		$this->form_validation->set_rules('job_title', 'Job title', 'required|xss_clean');
		$this->form_validation->set_rules('job_description', 'Job Description', 'required|xss_clean');
		$this->form_validation->set_rules('job_start_location', 'Start location', 'required|xss_clean');
		$this->form_validation->set_rules('contact_person_name', 'Contact Person Name', 'required|xss_clean');
		$this->form_validation->set_rules('contact_person_phone', 'Contact Person Phone', 'required|xss_clean');
		$this->form_validation->set_rules('contact_person_email', 'Contact Person Email', 'required|xss_clean');
		
		//if form has been submitted
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if job has valid login credentials
			if($this->jobs_model->edit_job($job_id))
			{
				$this->session->set_userdata('success_message', 'Job edited successfully');
				// redirect('administration/all-jobs/'.$page);
			}
			
			else
			{
				$data['error'] = 'Unable to add job. Please try again';
			}
		}
		

		//open the add new job page
		$data['title'] = 'Edit job';
		
		//select the job from the database
		$query = $this->jobs_model->get_job($job_id);
		if ($query->num_rows() > 0)
		{
			$v_data['row'] = $query->row();
			$data['content'] = $this->load->view('jobs/edit_job', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'job does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}

    
	
}
?>