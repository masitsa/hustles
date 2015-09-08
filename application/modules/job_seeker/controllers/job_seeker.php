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
		$v_data['assigned'] = $this->job_seeker_model->get_jobs(0);
		$v_data['requested'] = $this->job_seeker_model->get_jobs(1);
		$v_data['completed'] = $this->job_seeker_model->get_jobs(2);
		$data['title'] = $v_data['title'] = $this->site_model->display_page_title();
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
}
?>