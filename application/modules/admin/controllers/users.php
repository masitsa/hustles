<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Users extends admin {
	var $posts_path;
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
		// $this->load->model('blog_model');
		$this->load->model('file_model');
		$this->load->library('image_lib');
		//path to image directory
		$this->posts_path = realpath(APPPATH . '../assets/images/seekers');
	}
    
	/*
	*
	*	Default action is to show all the usersfadd
	*
	*/
	public function index() 
	{
		$where = 'user_id > 0';
		$table = 'users';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'all-users';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
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
		$query = $this->users_model->get_all_users($table, $where, $config["per_page"], $page);
		
		if ($query->num_rows() > 0)
		{
			$v_data['users'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('users/all_users', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<a href="'.site_url().'add-user" class="btn btn-success pull-right">Add Administrator</a> There are no administrators';
		}
		$data['title'] = 'All Administrators';
		
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
		$this->form_validation->set_rules('email', 'Email', 'required|xss_clean|is_unique[users.email]|valid_email');
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
			if($this->users_model->add_user())
			{
				redirect('all-users');
			}
			
			else
			{
				$data['error'] = 'Unable to add user. Please try again';
			}
		}
		
		//open the add new user page
		$data['title'] = 'Add New Administrator';
		$data['content'] = $this->load->view('users/add_user', '', TRUE);
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
			if($this->users_model->edit_user($user_id))
			{
				$this->session->set_userdata('success_message', 'User edited successfully');
				$pwd_update = $this->input->post('admin_user');
				if(!empty($pwd_update))
				{
					redirect('admin-profile/'.$user_id);
				}
				
				else
				{
					redirect('all-users');
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
		$query = $this->users_model->get_user($user_id);
		if ($query->num_rows() > 0)
		{
			$v_data['users'] = $query->result();
			$data['content'] = $this->load->view('users/edit_user', $v_data, true);
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
		if($this->users_model->delete_user($user_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be deleted');
		}
		
		redirect('all-users');
	}
    
	/*
	*
	*	Activate an existing user page
	*	@param int $user_id
	*
	*/
	public function activate_user($user_id) 
	{
		if($this->users_model->activate_user($user_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be activated');
		}
		
		redirect('all-users');
	}
    
	/*
	*
	*	Deactivate an existing user page
	*	@param int $user_id
	*
	*/
	public function deactivate_user($user_id) 
	{
		if($this->users_model->deactivate_user($user_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be disabled');
		}
		
		redirect('all-users');
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
		
		redirect('all-users');
	}
	
	/*
	*
	*	Show an administrator's profile
	*	@param int $user_id
	*
	*/
	public function admin_profile($user_id)
	{
		//open the add new user page
		$data['title'] = 'Edit User';
		
		//select the user from the database
		$query = $this->users_model->get_user($user_id);
		if ($query->num_rows() > 0)
		{
			$v_data['users'] = $query->result();
			$v_data['admin_user'] = 1;
			$tab_content[0] = $this->load->view('users/edit_user', $v_data, true);
		}
		
		else
		{
			$data['tab_content'][0] = 'user does not exist';
		}
		$tab_name[1] = 'Overview';
		$tab_name[0] = 'Edit Account';
		$tab_content[1] = 'Coming soon';//$this->load->view('account_overview', $v_data, true);
		$data['total_tabs'] = 2;
		$data['content'] = $tab_content;
		$data['tab_name'] = $tab_name;
		
		$this->load->view('templates/tabs', $data);
	}


	/*
	*
	*	Add a new user page
	*
	*/
	public function add_seeker() 
	{
		//form validation rules
		// $this->form_validation->set_rules('job_seeker_email', 'Email', 'required|xss_clean|is_unique[job_seeker.job_seeker_email]|valid_email');
		$this->form_validation->set_rules('job_seeker_other_names', 'Other Names', 'required|xss_clean');
		$this->form_validation->set_rules('job_seeker_first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('job_seeker_phone', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_address', 'Address', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_post_code', 'Post Code', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_city', 'City', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_national_id', 'Phone', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_gender_id', 'Address', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_next_of_kin_name', 'Next of Kin Name', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_next_of_kin_phone', 'Next of Kin phone', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_next_of_kin_email', 'Next of Kin email', 'xss_clean');
		$this->form_validation->set_rules('job_seeker_next_of_kin_identity', 'Next of Kin identity', 'xss_clean');

		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			// upload product's gallery images
			$resize['width'] = 600;
			$resize['height'] = 800;
			
			if(is_uploaded_file($_FILES['post_image']['tmp_name']))
			{
				$posts_path = $this->posts_path;
				/*
					-----------------------------------------------------------------------------------------
					Upload image
					-----------------------------------------------------------------------------------------
				*/
				$response = $this->file_model->upload_file($posts_path, 'post_image', $resize);
				if($response['check'])
				{
					$file_name = $response['file_name'];
					$thumb_name = $response['thumb_name'];
				}
			
				else
				{
					$this->session->set_userdata('error_message', $response['error']);
					
					$data['title'] = 'Add New Job Seeker';
					$data['content'] = $this->load->view('seekers/add_new_seeker', '', true);
					$this->load->view('templates/general_admin', $data);
					break;
				}
			}
			
			else{
				$file_name = '';
			}

			if($this->users_model->add_new_job_seeker($file_name, $thumb_name))
			{
				$this->session->set_userdata('success_message', 'Job Seeker added successfully');
				redirect('all-seekers');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add post. Please try again');
			}
			
		}
		
		//open the add new user page
		$data['title'] = 'Add New Job Seeker';
		$data['content'] = $this->load->view('seekers/add_new_seeker', '', TRUE);
		$this->load->view('templates/general_admin', $data);
	}
    
	/*
	*
	*	Edit an existing user page
	*	@param int $user_id
	*
	*/
	public function edit_seeker($user_id) 
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
			if($this->users_model->edit_user($user_id))
			{
				$this->session->set_userdata('success_message', 'User edited successfully');
				$pwd_update = $this->input->post('admin_user');
				if(!empty($pwd_update))
				{
					redirect('admin-profile/'.$user_id);
				}
				
				else
				{
					redirect('all-users');
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
		$query = $this->users_model->get_user($user_id);
		if ($query->num_rows() > 0)
		{
			$v_data['users'] = $query->result();
			$data['content'] = $this->load->view('users/edit_user', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'user does not exist';
		}
		
		$this->load->view('templates/general_admin', $data);
	}


	/*
	*
	*	Activate an existing user page
	*	@param int $user_id
	*
	*/
	public function activate_seeker($seeker_id) 
	{
		if($this->users_model->activate_seeker($seeker_id))
		{
			$this->session->set_userdata('success_message', 'Job seeker has been activated');
			$data['result'] = 'success';
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Job seeker could not be activated');
			$data['result'] = 'failure';
		}
		
		// echo json_encode($data);
		
		redirect('all-seekers');
	}
    
	/*
	*
	*	Deactivate an existing user page
	*	@param int $seeker_id
	*
	*/
	public function deactivate_seeker($seeker_id) 
	{
		if($this->users_model->deactivate_seeker($seeker_id))
		{
			$this->session->set_userdata('success_message', 'Job seeker has been disabled');
			$data['result'] = 'success';
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Job seeker could not be disabled');
		$data['result'] = 'failure';
		}
		
		// echo json_encode($data);
		
		redirect('all-seekers');
	}


	/*
	*
	*	Activate an existing user page
	*	@param int $user_id
	*
	*/
	public function activate_provider($provider_id) 
	{
		if($this->users_model->activate_provider($provider_id))
		{
			$this->session->set_userdata('success_message', 'Job provider has been activated');
			$data['result'] = 'success';
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Job provider could not be activated');
			$data['result'] = 'failure';
		}
		
		// echo json_encode($data);
		
		 redirect('all-providers');
	}
    
	/*
	*
	*	Deactivate an existing user page
	*	@param int $provider_id
	*
	*/
	public function deactivate_provider($provider_id) 
	{
		if($this->users_model->deactivate_provider($provider_id))
		{
			$this->session->set_userdata('success_message', 'Job provider has been disabled');
			$data['result'] = 'success';
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Job provider could not be disabled');
		$data['result'] = 'failure';
		}
		
		// echo json_encode($data);
		
		redirect('all-providers');
	}
	
}
?>