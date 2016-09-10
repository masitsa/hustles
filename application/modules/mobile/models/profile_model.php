<?php

class Profile_model extends CI_Model 
{
	/*
	*	Reset a user's password
	*
	*/
	public function get_profile_details($member_id)
	{
		// 9530
		$this->db->where('job_seeker_id = '.$member_id);
		$query = $this->db->get('job_seeker');
		
		return $query;
	}
	public function get_client_transactions($seeker_id)
	{
		$this->db->where('member_id = '.$seeker_id);
		$query = $this->db->get('member_invoice');
		
		return $query;
	
	}
	/*
	*	Validate a member's login request
	*
	*/
	public function validate_member()
	{
		//select the user by email from the database
		$this->db->select('*');
		$this->db->where(array('job_seeker_email' =>strtolower($this->input->post('email_address')),'job_seeker_password' => md5($this->input->post('password'))));
		$query = $this->db->get('job_seeker');
		
		//if users exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			
			return $result;
		}
		
		//if user doesn't exist
		else
		{
			return FALSE;
		}
	}
	public function validate_non_member()
	{
		//select the user by email from the database
		$this->db->select('*');
		$this->db->where(array('job_seeker_email' =>strtolower($this->input->post('email_address')),'job_seeker_password' => md5($this->input->post('password'))));
		$query = $this->db->get('job_seeker');
		
		//if users exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			
			return $result;
		}
		
		//if user doesn't exist
		else
		{
			return FALSE;
		}
	}
	public function register_member_details()
	{
		//select the user by email from the database

		$this->db->select('*');
		$this->db->where('job_seeker_email = "'.$this->input->post('email_address').'" OR job_seeker_phone = "'.$this->input->post('phone_number').'"');
		$query = $this->db->get('job_seeker');
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$db_email = $row->job_seeker_email;
			$db_phone = $row->job_seeker_phone;
			$return['status'] = FALSE;
			if($db_email == $this->input->post('email_address'))
			{
				$return['message'] = 'That email address exists. Please enter a different one';
			}
			
			else if($db_phone == $this->input->post('phone_number'))
			{
				$return['message'] = 'That phone number exists. Please enter a different one';
			}
			
			else
			{
				$return['message'] = 'Either your email or phone number has been registered. Please change them and try again';
			}
		}
		else
		{

			$insertarray = array(
				'referral_code'=>$this->input->post('referral_code'),
				'job_seeker_dob'=>$this->input->post('dob'),
				'job_seeker_first_name'=>$this->input->post('fullname'),
				'job_seeker_last_name'=>$this->input->post('fullname'),
				'job_seeker_type'=>3,
				'job_seeker_email'=>strtolower($this->input->post('email_address')),
				'job_seeker_password'=>md5($this->input->post('password')),
				'job_seeker_phone'=>$this->input->post('phone_number'),
				'over_age'=>$this->input->post('over_age')
				);
			if($this->db->insert('job_seeker',$insertarray))
			{
				$insertarray['job_seeker_id'] = $this->db->insert_id();
				$insertarray['job_seeker_login_status'] = TRUE;
				$this->session->set_userdata($insertarray);
				$return['status'] = TRUE;
				$return['job_seeker_id'] = $insertarray['job_seeker_id'];
			}
			else
			{
				$return['status'] = FALSE;
				$return['message'] = 'Unable to register. Please try again.';
			}
		}
		return $return;
	}
	public function reset_password()
	{
		//select the user by email from the database

		$this->db->select('*');
		$this->db->where('job_seeker_email = "'.$this->input->post('email_address').'"');
		$query = $this->db->get('job_seeker');
		if($query->num_rows() == 0)
		{
			return FALSE;
		}
		else
		{

			$insertarray = array(
				'job_seeker_password'=>md5(123456)
				);
			$this->db->where('job_seeker_email = "'.$this->input->post('email_address').'"');
			if($this->db->update('job_seeker',$insertarray))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	public function update_request_detail($job_seeker_id)
	{
		$data  = array(
						'member_id' => $job_seeker_id, 
						'amount_requested' => $this->input->post('amount_to_withdraw'), 
						'date_requested' => date('Y-m-d'), 
					  );

		if($this->db->insert('member_invoice',$data))
		{
			return TRUE;
			// send sms to the member detail
		}
		else
		{
			return FALSE;
		}

	}
}