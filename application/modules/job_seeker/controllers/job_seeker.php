<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_seeker extends MX_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('job_seeker_model');
		$this->load->model('site/site_model');
		
		if(!$this->job_seeker_model->check_login())
		{
			$this->session->set_userdata('error_message', 'Please sign in to continue');
			redirect('job-seeker-login');
		}
	}
	
	public function dashboard()
	{
		$v_data['assigned'] = $this->job_seeker_model->get_jobs(1);
		$v_data['requested'] = $this->job_seeker_model->get_jobs(0);
		$v_data['completed'] = $this->job_seeker_model->get_jobs(2);
		$data['title'] = $v_data['title'] = $this->site_model->display_page_title();

		$where = 'job_category.job_category_id = jobs.job_category_id AND member.member_id = jobs.job_provider_id AND jobs.job_status = 0';
		$segment = 2;
		$base_url = base_url().'jobs';
		
		$table = 'jobs,job_category,member';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->site_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<div class="wp-pagenavi">';
		$config['full_tag_close'] = '</div>';
		
		$config['next_link'] = 'Next';
		
		$config['prev_link'] = 'Prev';
		
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$jobs = $this->site_model->get_all_jobs($table, $where, $config["per_page"], $page);

		if ($jobs->num_rows() > 0)
		{
			$v_data['jobs'] = $jobs;
			$v_data['page'] = $page;
			$v_data['title'] = 'Dashboard';
		}
		
		else
		{
			$v_data['jobs'] = $jobs;
			$v_data['page'] = $page;
			$v_data['title'] = 'Dashboard ';
		}
		$data['content'] = $this->load->view("dashboard", $v_data, TRUE);
		
		$this->load->view("site/includes/templates/general", $data);
	}
	
	public function complete_job($job_seeker_request_id)
	{
		$data['job_seeker_request_status'] = 3;
		$this->db->where('job_seeker_request_id', $job_seeker_request_id);
		if($this->db->update('job_seeker_request', $data))
		{
			$this->session->set_userdata('success_message', 'Job delivered successfully');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Unable to deliver job. Please try again');
		}
		redirect('job-seeker-dashboard');
	}
	public function book_job($job_id)
	{
		// check if you have already booker#

		if($this->job_seeker_model->check_if_booked($job_id))
		{
			if($this->job_seeker_model->book_job($job_id))
			{
				$this->session->set_userdata('success_message', 'You have successfully requested for the job');
				$data['success'] = 'success';
			}
			else
			{
				$this->session->set_userdata('error_message', 'Something went wrong, please try again');
				$data['failure'] = 'failure';
			}
		}
		else
		{
			$this->session->set_userdata('error_message', 'You have already booked this job');
		}
		
		redirect('job-seeker-dashboard');
		// echo json_encode($data);
	}
	public function account_details()
	{

		$v_data['count_assigned'] = $this->job_seeker_model->get_total_jobs(1);
		$v_data['count_requested'] = $this->job_seeker_model->get_total_jobs(0);
		$v_data['count_completed'] = $this->job_seeker_model->get_total_jobs(2);
		$v_data['job_seeker_details'] = $this->job_seeker_model->get_my_details();
		$v_data['title'] = 'My account';
		$data['content'] = $this->load->view("job_seeker_details", $v_data, TRUE);
		
		$this->load->view("site/includes/templates/general", $data);	
	}
	public function change_password()
	{
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|xss_clean');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|xss_clean');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->input->post('new_password') == $this->input->post('confirm_new_password'))
			{
				if($this->job_seeker_model->change_password())
				{
					$this->session->set_userdata('success_message', 'Your password has been changed successfully');
				}
				else
				{
					$this->session->set_userdata('error_message', 'Something went wrong, please try again');
				}
			}
			else
			{
				$this->session->set_userdata('error_message', 'Ensure that the new password match with the confirm password');
			}
		}
		else
		{
			$this->session->set_userdata('error_message', 'Please check that all the fields have values');
		}
		redirect('my-account');
	}
	public function logout_seeker()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}
?>