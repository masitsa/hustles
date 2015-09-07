<?php

class Seekers_model extends CI_Model 
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
	*	Retrieve all seekers
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_seekers($table, $where, $per_page, $page)
	{
		//retrieve all seekers
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('job_seeker.job_seeker_first_name, job_seeker.job_seeker_last_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('job_seeker');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end seekers
	*
	*/
	public function get_all_front_end_seekers()
	{
		$this->db->from('job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker_type = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all seekers
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new job_seeker to the database
	*
	*/
	public function add_job_seeker()
	{
		$data = array(
				'job_seeker_first_name'=>ucwords(strtolower($this->input->post('job_seeker_irst_name'))),
				'job_seeker__names'=>ucwords(strtolower($this->input->post('job_seeker_last_names'))),
				'job_seeker_email'=>$this->input->post('job_seeker_email'),
				'job_seeker_password'=>md5($this->input->post('job_seeker_password')),
				'job_seeker_phone'=>$this->input->post('job_seeker_phone'),
				'job_seeker_address'=>$this->input->post('job_seeker_address'),
				'job_seeker_post_code'=>$this->input->post('job_seeker_post_code'),
				'job_seeker_city'=>$this->input->post('job_seeker_city'),
				'created'=>date('Y-m-d H:i:s'),
				'job_seeker_type'=>2,
				'job_seeker_status'=>$this->input->post('job_seeker_status')
			);
			
		if($this->db->insert('seekers', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end job_seeker to the database
	*
	*/
	public function add_frontend_job_seeker()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'job_seeker_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('seekers', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing job_seeker
	*	@param int $job_seeker_id
	*
	*/
	public function edit_job_seeker($job_seeker_id)
	{
		$data = array(
				'job_seeker_first_name'=>ucwords(strtolower($this->input->post('job_seeker_irst_name'))),
				'job_seeker__names'=>ucwords(strtolower($this->input->post('job_seeker_last_names'))),
				'job_seeker_email'=>$this->input->post('job_seeker_email'),
				'job_seeker_password'=>md5($this->input->post('job_seeker_password')),
				'job_seeker_phone'=>$this->input->post('job_seeker_phone'),
				'job_seeker_address'=>$this->input->post('job_seeker_address'),
				'job_seeker_post_code'=>$this->input->post('job_seeker_post_code'),
				'job_seeker_city'=>$this->input->post('job_seeker_city'),
				'created'=>date('Y-m-d H:i:s'),
				'job_seeker_status'=>$this->input->post('job_seeker_status')
			);
		
		//check if job_seeker wants to update their password
		$pwd_update = $this->input->post('job_seeker');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_job_seekerdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
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
	*	Edit an existing job_seeker
	*	@param int $job_seeker_id
	*
	*/
	public function edit_frontend_job_seeker($job_seeker_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if job_seeker wants to update their password
		$pwd_update = $this->input->post('admin_job_seeker');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_job_seekerdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
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
	*	Edit an existing job_seeker's password
	*	@param int $job_seeker_id
	*
	*/
	public function edit_password($job_seeker_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('job_seeker_id', $job_seeker_id);
				
				if($this->db->update('job_seeker', $data))
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
	*	Retrieve a single job_seeker
	*	@param int $job_seeker_id
	*
	*/
	public function get_job_seeker($job_seeker_id)
	{
		//retrieve all seekers
		$this->db->from('job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker_id = '.$job_seeker_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single job_seeker by their email
	*	@param int $email
	*
	*/
	public function get_job_seeker_by_email($email)
	{
		//retrieve all seekers
		$this->db->from('job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker_email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing job_seeker
	*	@param int $job_seeker_id
	*
	*/
	public function delete_job_seeker($job_seeker_id)
	{
		if($this->db->delete('job_seeker', array('job_seeker_id' => $job_seeker_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated job_seeker
	*	@param int $job_seeker_id
	*
	*/
	public function activate_job_seeker($job_seeker_id)
	{
		$data = array(
				'job_seeker_status' => 1
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
	*	Deactivate an activated job_seeker
	*	@param int $job_seeker_id
	*
	*/
	public function deactivate_job_seeker($job_seeker_id)
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
	*	Reset a job_seeker's password
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
				'job_seeker_password' => $pwd
			);
		$this->db->where('job_seeker_email', $email);
		
		if($this->db->update('job_seeker', $data))
		{
			//email the password to the job_seeker
			$job_seeker_details = $this->seekers_model->get_job_seeker_by_email($email);
			
			$job_seeker = $job_seeker_details->row();
			$job_seeker_name = $job_seeker->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$job_seeker_name.'. Your new password is '.$pwd;
			
			//send the job_seeker their new password
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
}
?>