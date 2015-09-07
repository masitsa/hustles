<?php

class providers_model extends CI_Model 
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
	*	Retrieve all providers
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_providers($table, $where, $per_page, $page)
	{
		//retrieve all providers
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('member.member_first_name, member.member_last_name');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_all_administrators()
	{
		$this->db->from('member');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end providers
	*
	*/
	public function get_all_front_end_providers()
	{
		$this->db->from('member');
		$this->db->select('*');
		$this->db->where('member_type = 2');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_all_countries()
	{
		//retrieve all providers
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new member to the database
	*
	*/
	public function add_member()
	{
		$data = array(
				'member_first_name'=>ucwords(strtolower($this->input->post('member_irst_name'))),
				'member__names'=>ucwords(strtolower($this->input->post('member_last_names'))),
				'member_email'=>$this->input->post('member_email'),
				'member_password'=>md5($this->input->post('member_password')),
				'member_phone'=>$this->input->post('member_phone'),
				'member_address'=>$this->input->post('member_address'),
				'member_post_code'=>$this->input->post('member_post_code'),
				'member_city'=>$this->input->post('member_city'),
				'created'=>date('Y-m-d H:i:s'),
				'member_type'=>2,
				'member_status'=>$this->input->post('member_status')
			);
			
		if($this->db->insert('providers', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Add a new front end member to the database
	*
	*/
	public function add_frontend_member()
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('other_names'))),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'phone'=>$this->input->post('phone'),
				'created'=>date('Y-m-d H:i:s'),
				'member_level_id'=>2,
				'activated'=>1
			);
			
		if($this->db->insert('providers', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing member
	*	@param int $member_id
	*
	*/
	public function edit_member($member_id)
	{
		$data = array(
				'member_first_name'=>ucwords(strtolower($this->input->post('member_irst_name'))),
				'member__names'=>ucwords(strtolower($this->input->post('member_last_names'))),
				'member_email'=>$this->input->post('member_email'),
				'member_password'=>md5($this->input->post('member_password')),
				'member_phone'=>$this->input->post('member_phone'),
				'member_address'=>$this->input->post('member_address'),
				'member_post_code'=>$this->input->post('member_post_code'),
				'member_city'=>$this->input->post('member_city'),
				'created'=>date('Y-m-d H:i:s'),
				'member_status'=>$this->input->post('member_status')
			);
		
		//check if member wants to update their password
		$pwd_update = $this->input->post('member');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_memberdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
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
	*	Edit an existing member
	*	@param int $member_id
	*
	*/
	public function edit_frontend_member($member_id)
	{
		$data = array(
				'first_name'=>ucwords(strtolower($this->input->post('first_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if member wants to update their password
		$pwd_update = $this->input->post('admin_member');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_memberdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
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
	*	Edit an existing member's password
	*	@param int $member_id
	*
	*/
	public function edit_password($member_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('member_id', $member_id);
				
				if($this->db->update('member', $data))
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
	*	Retrieve a single member
	*	@param int $member_id
	*
	*/
	public function get_member($member_id)
	{
		//retrieve all providers
		$this->db->from('member');
		$this->db->select('*');
		$this->db->where('member_id = '.$member_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single member by their email
	*	@param int $email
	*
	*/
	public function get_member_by_email($email)
	{
		//retrieve all providers
		$this->db->from('member');
		$this->db->select('*');
		$this->db->where('member_email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing member
	*	@param int $member_id
	*
	*/
	public function delete_member($member_id)
	{
		if($this->db->delete('member', array('member_id' => $member_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated member
	*	@param int $member_id
	*
	*/
	public function activate_member($member_id)
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
	*	Deactivate an activated member
	*	@param int $member_id
	*
	*/
	public function deactivate_member($member_id)
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
	
	/*
	*	Reset a member's password
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
				'member_password' => $pwd
			);
		$this->db->where('member_email', $email);
		
		if($this->db->update('member', $data))
		{
			//email the password to the member
			$member_details = $this->providers_model->get_member_by_email($email);
			
			$member = $member_details->row();
			$member_name = $member->first_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$member_name.'. Your new password is '.$pwd;
			
			//send the member their new password
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