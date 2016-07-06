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
		$this->form_validation->set_rules('over_age', 'Age', 'trim|required|xss_clean');
		$this->form_validation->set_rules('terms', 'Terms & Conditions', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$return = $this->profile_model->register_member_details();
			//var_dump($return);
			if($return['status'] == TRUE)
			{
				$response['message'] = 'success';
			 	$response['result'] = 'Registration was successfull';
			 	
			 	$job_seeker_phone = $this->input->post('phone_number');
			 	$fullname = $this->input->post('fullname');
			 	
			 	$delivery_message = "Hello $fullname, Thank you for registering to Choto. Please watch as many ads as possible to be reward. Note that all transactions shall be made to $job_seeker_phone. Enjoy";

				$this->advertising_model->sms($job_seeker_phone,$delivery_message);

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
	public function request_for_payment($job_seeker_id)
	{
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('accept', 'Check box', 'trim|required|xss_clean');
		$this->form_validation->set_rules('amount_to_withdraw', 'Phone Number', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			// check the current balance 
			$total_invoiced = $this->advertising_model->calculate_amount_invoices($job_seeker_id);
		  	$total_receipted = $this->advertising_model->calculate_amount_receipted($job_seeker_id);
		  	$account_balance = $total_invoiced - $total_receipted;

		  	$amount_to_withdraw = $this->input->post('amount_to_withdraw');
		  	$actual_balance = $account_balance - $amount_to_withdraw;
		  	$response['items'] = $amount_to_withdraw;
		  	$checker = $this->advertising_model->check_for_requested($job_seeker_id);
		  	$response['actual_balance'] = $account_balance;
		  	$profile_rs = $this->profile_model->get_profile_details($job_seeker_id);
		  	if($profile_rs->num_rows() > 0)
		  	{
		  		foreach ($profile_rs->result() as $key) {
		  			# code...
		  			$job_seeker_id = $key->job_seeker_id;
		  			$job_seeker_last_name = $key->job_seeker_last_name;
		  			$job_seeker_phone = $key->job_seeker_phone;
		  		}
		  	}
		  	if($checker > 0)
		  	{
		  		$response['message'] = 'fail';
				 $response['result'] = 'Sorry there is a pending transaction. Please wait for it to be serviced then do the request';

				 $delivery_message = "Hello $job_seeker_last_name, Sorry there is a pending transaction. Please wait for it to be serviced then do the request";

				$this->advertising_model->sms($job_seeker_phone,$delivery_message);
		  	}
		  	else
		  	{
			  	if($actual_balance < 0)
			  	{
			  		$response['message'] = 'success';
				 	$response['result'] = 'Insufficient money in your account. Please watch as many ads as possible';
				 	$delivery_message = "You have insufficient money in your account. Please watch as more ads to get rewarded";

					$this->advertising_model->sms($job_seeker_phone,$delivery_message);
			  	}
			  	else
			  	{
					$return = $this->profile_model->update_request_detail($job_seeker_id);
					//var_dump($return);
					if($return == TRUE)
					{
						$response['message'] = 'success';
					 	$response['result'] = 'Your transaction is being processed. Please wait for your reward shortly';

					 	$delivery_message = "Your transaction is being processed. Please wait for your reward shortly";

						$this->advertising_model->sms($job_seeker_phone,$delivery_message);
					}
					else
					{
						$response['message'] = 'fail';
					 	$response['result'] = $return['message'];
					}
				}
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
	public function get_terms()
	{
		$response['message'] = 'success';
		$response['result'] = $this->load->view('job_seeker/terms', '', true);

		echo json_encode($response);
	}
}