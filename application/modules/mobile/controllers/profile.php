<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller {
	
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
		
		$this->load->model('profile_model');
	}
	
	public function get_client_profile()
	{
		$v_data['job_seeker_details'] = $this->profile_model->get_profile_details();

		$response['message'] = 'success';
		$response['result'] = $this->load->view('job_seeker/seekers_profile', $v_data, true);

		echo json_encode($response);
	}

	public function login_seeker() 
	{
		$result = $this->profile_model->validate_member();
	
		if($result != FALSE)
		{
			//create user's login session
			$newdata = array(
                   'job_seeker_login_status'    => TRUE,
                   'job_seeker_email'     		=> $result[0]->job_seeker_email,
                   'job_seeker_first_name'     	=> $result[0]->job_seeker_first_name,
                   'job_seeker_id'  			=> $result[0]->job_seeker_id,
                   'job_seeker_phone'  			=> $result[0]->job_seeker_phone,
                   'job_seeker_no'  			=> $result[0]->job_seeker_email
               );
			$this->session->set_userdata($newdata);
			
			$response['message'] = 'success';
			$response['result'] = $newdata;
		}
		
		else
		{
			$response['message'] = 'fail';
			$response['result'] = 'You have entered incorrect details. Please try again';
		}
		
		//echo $_GET['callback'].'(' . json_encode($response) . ')';
		echo json_encode($response);
	}
}