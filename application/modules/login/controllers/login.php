<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Login extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login_model');
	}
    
	/*
	*
	*	Login a user
	*
	*/
	public function login_admin() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_user())
			{
				//redirect('dashboard');
				
				redirect('admin');
			}
			
			else
			{
				$data['error'] = 'The email or password provided is incorrect. Please try again';
				$this->load->view('admin_login', $data);
			}
		}
		
		else
		{
			$this->load->view('admin_login');
		}
	}

	public function login_provider() 
	{
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[member.member_email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_provider())
			{
				//redirect('dashboard');
				redirect('my-jobs');
			}
			
			else
			{
				$data['error'] = 'The email or password provided is incorrect. Please try again';
				$this->load->view('provider_login', $data);
			}
		}
		
		else
		{
			$this->load->view('provider_login');
		}
	}

	public function provider_sign_up()
	{
		// $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[member.member_email]');
		$this->form_validation->set_rules('member_password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('member_first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('member_other_name', 'Other Name', 'required|xss_clean');
		$this->form_validation->set_rules('member_password', 'Password', 'required|xss_clean');
		$this->form_validation->set_rules('member_phone', 'Member Phone', 'required|xss_clean');
		// $this->form_validation->set_rules('member_username', 'Username', 'required|xss_clean|exists[member.member_username]');
		
		//if form has been submitted

		if ($this->form_validation->run())
		{
			
			//check if user has valid login credentials
			if($this->login_model->add_job_provider())
			{
				//redirect('dashboard');
				$newdata = array(
	               'account_status'     => TRUE,
	               'account_creation_message'     => 'You account has been successfully created, Please wait for your account to be activated',
	              
	           	);

				$this->session->set_userdata($newdata);
				redirect('login-provider');
			}
			
			else
			{
				$data['error'] = 'The email or password provided is incorrect. Please try again';
				$this->load->view('provider_sign_up', $data);
			}
		}
		
		else
		{
			$this->load->view('provider_sign_up');
		}
	}
	public function logout_provider()
	{
		$this->session->sess_destroy();
		redirect('login-provider');
	}



	public function logout_admin()
	{
		$this->session->sess_destroy();
		redirect('login-admin');
	}
	
	public function logout_user()
	{
		$this->session->sess_destroy();
		$this->session->set_userdata('front_success_message', 'Your have been signed out of your account');
		redirect('checkout');
	}

	// start of the airline login

	public function login_airline() 
	{
		$v_data['error2'] = '';
		//form validation rules
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|exists[airline.airline_user_email]');
		$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
		$this->form_validation->set_message('exists', 'This email has not been registered. Please sign up');
	
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if user has valid login credentials
			if($this->login_model->validate_airline())
			{
				//redirect('dashboard');
				
				redirect('airline/account');
			}
			
			else
			{
				$v_data['error2'] = 'The email or password provided is incorrect. Please try again';
			}
		}
		
		$data['content'] = $this->load->view('airline_login', $v_data, true);
		$data['title'] = 'Sign In';
		$this->load->view('site/templates/general_page', $data);
	}
	public function logout_airline()
	{
		$this->session->sess_destroy();
		redirect('airline-login');
	}
	
	
	// end of the airline login
}
?>