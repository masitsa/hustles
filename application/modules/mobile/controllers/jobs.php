<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
	
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	
			exit(0);
		}
		
		$this->load->model('login_model');
		$this->load->model('jobs_model');
		// $this->load->model('email_model');
		
		// $this->load->library('Mandrill', $this->config->item('mandrill_key'));
	}

	public function get_jobs($status)
	{
	
		$v_data['jobs'] = $this->jobs_model->get_jobs($status);
		
		
		$v_data['jobs_status'] = $status;

		$response['message'] = 'success';
		$response['result'] = $this->load->view('jobs/jobs_list', $v_data, true);

		
		echo json_encode($response);
	}


	public function get_job_detail($job_id,$job_status)
	{
		$v_data['job_detail'] = $this->jobs_model->get_job_detail($job_id,$job_status);
		
		
		$v_data['jobs_status'] = $job_status;
		$v_data['job_id'] = $job_id;

		$response['message'] = 'success';
		$response['result'] = $this->load->view('jobs/single_job', $v_data, true);

		echo json_encode($response);
	}

	public function book_job($job_id)
	{
		// check if you have already booker#

		if($this->jobs_model->check_if_booked($job_id))
		{
			if($this->jobs_model->book_job($job_id))
			{
				$response['message'] = 'success';
				$response['result'] = 'You have successfully placed a request for the job';
			}
			else
			{
				$response['message'] = 'failure';
				$response['result'] = 'Sorry something has gone wrong. Please try again';
			}
		}
		else
		{
			    $response['message'] = 'failure';
			    $response['result'] = 'Sorry something has gone wrong. Please try again';
		}
		
		echo json_encode($response);
	}
	public function all_jobs()
	{
		$query = $this->jobs_model->get_all_home_jobs();
		
		if($query->num_rows() > 0)
		{
			$result['message'] = 'success';
			$result['result'] = $query->result();
		}
		
		else
		{
			$result['message'] = 'error';
		}
		
		echo json_encode($result);
	}

	public function get_map()
	{
		$response['message'] = 'success';
		$response['result'] = $this->load->view('home/home', '', true);

		echo json_encode($response);
	}

}