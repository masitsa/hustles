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
		$this->load->model('advertising_model');
	}
	
	public function get_client_profile($member_id)
	{
		$v_data['job_seeker_details'] = $this->profile_model->get_profile_details($member_id);

		$response['message'] = 'success';
		$v_data['member_id'] = $member_id;
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
			$response['job_seeker_id'] = $result[0]->job_seeker_id;
		}
		
		else
		{
			$response['message'] = 'fail';
			$response['result'] = 'You have entered incorrect details. Please try again';
		}
		
		//echo $_GET['callback'].'(' . json_encode($response) . ')';
		echo json_encode($response);
	}

	public function login_non_member() 
	{
		$result = $this->profile_model->validate_non_member();
	
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
			
			$response['job_seeker_id'] = $result[0]->job_seeker_id;
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
	public function register_seeker()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|valid_email|required|xss_clean');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fullname', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$return = $this->profile_model->register_member_details();
			//var_dump($return);
			if($return['status'] == TRUE)
			{
				$response['message'] = 'success';
			 	$response['result'] = 'Registration was successfull';
			 	$response['job_seeker_id'] = $return['job_seeker_id'];
			}
			else
			{
				$response['message'] = 'fail';
			 	$response['result'] = $return['message'];
			}

		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
	
	public function reset_password()
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|valid_email|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			if($this->profile_model->reset_password())
			{
				$response['message'] = 'success';
			 	$response['result'] = 'Password reset to 123456';
			}
			else
			{
				$response['message'] = 'fail';
			 	$response['result'] = 'Something went wrong. Please try again';
			}

		}
		else
		{
			$validation_errors = validation_errors();
			
			//repopulate form data if validation errors are present
			if(!empty($validation_errors))
			{
				$response['message'] = 'fail';
			 	$response['result'] = $validation_errors;
			}
			
			//populate form data on initial load of page
			else
			{
				$response['message'] = 'fail';
				$response['result'] = 'Ensure that you have entered all the values in the form provided';
			}
		}
		echo json_encode($response);
	}
}