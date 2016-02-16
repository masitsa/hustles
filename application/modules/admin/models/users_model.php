<?php

class Users_model extends CI_Model 
{
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}
	
	/*
	*	Retrieve all users
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_users($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('users.first_name, users.other_names');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('users');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end users
	*
	*/
	public function get_all_front_end_users()
	{
		$this->db->from('users');
		$this->db->select('*');
		$this->db->where('user_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all users
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new user to the database
	*
	*/
	public function add_user()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'post_code'=>$this->input->post('post_code'),
				'city'=>$this->input->post('city'),
				'created'=>date('Y-m-d H:i:s'),
				'activated'=>$this->input->post('activated')
			);
			
		if($this->db->insert('users', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end user to the database
	*
	*/
	public function add_frontend_user()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'user_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('users', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing user
	*	@param int $user_id
	*
	*/
	public function edit_user($user_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'post_code'=>$this->input->post('post_code'),
				'city'=>$this->input->post('city'),
				'activated'=>$this->input->post('activated')
			);
		
		//check if user wants to update their password
		$pwd_update = $this->input->post('admin_user');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('user_id', $user_id);
		
		if($this->db->update('users', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing user
	*	@param int $user_id
	*
	*/
	public function edit_frontend_user($user_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if user wants to update their password
		$pwd_update = $this->input->post('admin_user');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('user_id', $user_id);
		
		if($this->db->update('users', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing user's password
	*	@param int $user_id
	*
	*/
	public function edit_password($user_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('user_id', $user_id);
				
				if($this->db->update('users', $data))
				{
					$return['result'] = TRUE;
				}
				else{
					$return['result'] = FALSE;
					$return['message'] = 'Oops something went wrong and your password could not be updated. Please try again';
				}
			}
			else{
					$return['result'] = FALSE;
					$return['message'] = 'New Password and Confirm Password don\'t match';
			}
		}
		
		else
		{
			$return['result'] = FALSE;
			$return['message'] = 'You current password is not correct. Please try again';
		}
		
		return $return;
	}
	
	/*
	*	Retrieve a single user
	*	@param int $user_id
	*
	*/
	public function get_user($user_id)
	{
		//retrieve all users
		$this->db->from('users');
		$this->db->select('*');
		$this->db->where('user_id = '.$user_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single user by their email
	*	@param int $email
	*
	*/
	public function get_user_by_email($email)
	{
		//retrieve all users
		$this->db->from('users');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing user
	*	@param int $user_id
	*
	*/
	public function delete_user($user_id)
	{
		if($this->db->delete('users', array('user_id' => $user_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated user
	*	@param int $user_id
	*
	*/
	public function activate_user($user_id)
	{
		$data = array(
				'activated' => 1
			);
		$this->db->where('user_id', $user_id);
		
		if($this->db->update('users', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated user
	*	@param int $user_id
	*
	*/
	public function deactivate_user($user_id)
	{
		$data = array(
				'activated' => 0
			);
		$this->db->where('user_id', $user_id);
		
		if($this->db->update('users', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a user's password
	*	@param string $email
	*
	*/
	public function reset_password($email)
	{
		//reset password
		$result = md5(date("Y-m-d H:i:s"));
		$pwd2 = substr($result, 0, 6);
		$pwd = md5($pwd2);
		
		$data = array(
				'password' => $pwd
			);
		$this->db->where('email', $email);
		
		if($this->db->update('users', $data))
		{
			//email the password to the user
			$user_details = $this->users_model->get_user_by_email($email);
			
			$user = $user_details->row();
			$user_name = $user->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$user_name.'. Your new password is '.$pwd;
			
			//send the user their new password
			if($this->email_model->send_mail($receiver, $sender, $message))
			{
				return TRUE;
			}
			
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", strtolower($field_name));
		
		return $web_name;
	}
	/*
	*	Add a new job_seeker to the database
	*
	*/
	public function add_new_job_seeker($image_name, $thumb_name)
	{
		$data = array(
				'job_seeker_first_name'=>ucwords(strtolower($this->input->post('job_seeker_first_name'))),
				'job_seeker_last_name'=>ucwords(strtolower($this->input->post('job_seeker_other_names'))),
				'job_seeker_email'=>$this->input->post('job_seeker_email'),
				'job_seeker_password'=>md5(123456),
				'job_seeker_phone'=>$this->input->post('job_seeker_phone'),
				'job_seeker_address'=>$this->input->post('job_seeker_address'),
				'job_seeker_post_code'=>$this->input->post('job_seeker_post_code'),
				'job_seeker_city'=>$this->input->post('job_seeker_city'),
				'job_seeker_next_of_kin_first_name'=>$this->input->post('job_seeker_next_of_kin_first_name'),
				'job_seeker_next_of_kin_last_name'=>$this->input->post('job_seeker_next_of_kin_last_name'),
				'job_seeker_next_of_kin_phone'=>$this->input->post('job_seeker_next_of_kin_phone'),
				'job_seeker_next_of_kin_email'=>$this->input->post('job_seeker_next_of_kin_email'),
				'job_seeker_national_id'=>$this->input->post('job_seeker_national_id'),
				'job_seeker_next_of_kin_identity'=>$this->input->post('job_seeker_next_of_kin_identity'),
				'created'=>date('Y-m-d H:i:s'),
				'job_seeker_type'=>2,
				'thumb_name'=>$thumb_name,
				'image_name'=>$image_name,
				'job_seeker_status'=>$this->input->post('job_seeker_status')
			);
			
		if($this->db->insert('job_seeker', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}


	public function get_no_of_requests($job_seeker_id)
	{

		$this->db->select('COUNT(job_seeker_request_id) AS total_requests');
		$this->db->where('job_seeker_id  ='.$job_seeker_id);
		$this->db->from('job_seeker_request');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_requests;
	}

	public function get_no_of_awarded_requests($job_seeker_id)
	{

		$this->db->select('COUNT(job_seeker_request_id) AS total_requests');
		$this->db->where('job_seeker_request_status = 1 AND job_seeker_id  ='.$job_seeker_id);
		$this->db->from('job_seeker_request');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_requests;
	}
	
	public function get_no_of_completed_jobs($job_seeker_id)
	{

		$this->db->select('COUNT(job_seeker_request_id) AS total_requests');
		$this->db->where('job_seeker_request_status = 1 AND completed = 1 AND job_seeker_id  ='.$job_seeker_id);
		$this->db->from('job_seeker_request');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_requests;
	}
	public function get_no_of_pending_jobs($job_seeker_id)
	{

		$this->db->select('COUNT(job_seeker_request_id) AS total_requests');
		$this->db->where('job_seeker_request_status = 1 AND completed = 0 AND job_seeker_id  ='.$job_seeker_id);
		$this->db->from('job_seeker_request');
		$query = $this->db->get();
		
		$result = $query->row();
		
		return $result->total_requests;
	}


	/*
	*	Activate a deactivated user
	*	@param int $user_id
	*
	*/
	public function activate_seeker($job_seeker_id)
	{
		$data = array(
				'job_seeker_status' => 1
			);
		$this->db->where('job_seeker_id', $job_seeker_id);
		
		if($this->db->update('job_seeker', $data))
		{
			$query = $this->seeker_details($job_seeker_id);

			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $key) {
					# code...
					$job_seeker_first_name = $key->job_seeker_first_name;
					$job_seeker_phone = $key->job_seeker_phone;
					$job_seeker_email = $key->job_seeker_email;
				}
				$message = "Hello $job_seeker_first_name, You account has been successfully activated. Your login credentials are username: $job_seeker_email, password: 123456";

				$this->sms($job_seeker_phone,$message);
			}
			else
			{

			}
			return TRUE;
		}
		else{
			return FALSE;
		}

		
	}
	public function seeker_details($job_seeker_id)
	{
		$this->db->from('job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker_id = '.$job_seeker_id);
		$query = $this->db->get();
		return $query;

	}
	
	/*
	*	Deactivate an job_seeker_status user
	*	@param int $job_seeker_id
	*
	*/
	public function deactivate_seeker($job_seeker_id)
	{
		$data = array(
				'job_seeker_status' => 0
			);
		$this->db->where('job_seeker_id', $job_seeker_id);
		
		if($this->db->update('job_seeker', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}


	/*
	*	Activate a deactivated user
	*	@param int $user_id
	*
	*/
	public function activate_provider($member_id)
	{
		$data = array(
				'member_status' => 1
			);
		$this->db->where('member_id', $member_id);
		
		if($this->db->update('member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an member_status user
	*	@param int $member_id
	*
	*/
	public function deactivate_provider($member_id)
	{
		$data = array(
				'member_status' => 0
			);
		$this->db->where('member_id', $member_id);
		
		if($this->db->update('member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function sms($phone,$message)
	{
        // This will override any configuration parameters set on the config file
		// max of 160 characters
		// to get a unique name make payment of 8700 to Africastalking/SMSLeopard
		// unique name should have a maximum of 11 characters
		$phone_number = '+'.$phone;
		// var_dump($phone_number) or die();
        $params = array('username' => 'alviem', 'apiKey' => '1f61510514421213f9566191a15caa94f3d930305c99dae2624dfb06ef54b703');  
        $this->load->library('AfricasTalkingGateway', $params);
		// var_dump($params)or die();
        // Send the message
		try 
		{
        	$results = $this->africastalkinggateway->sendMessage($phone_number, $message);
			
			//var_dump($results);die();
			foreach($results as $result) {
				// status is either "Success" or "error message"
				// echo " Number: " .$result->number;
				// echo " Status: " .$result->status;
				// echo " MessageId: " .$result->messageId;
				// echo " Cost: "   .$result->cost."\n";
			}
		}
		
		catch(AfricasTalkingGatewayException $e)
		{
			// echo "Encountered an error while sending: ".$e->getMessage();
		}
    }
}
?>