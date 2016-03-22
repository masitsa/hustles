<?php

class Profile_model extends CI_Model 
{
	/*
	*	Reset a user's password
	*
	*/
	public function get_profile_details()
	{
		// 9530
		$this->db->where('job_seeker_id = 1');
		$query = $this->db->get('job_seeker');
		
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
		$this->db->where(array('job_seeker_email' =>strtolower($this->input->post('email')),'job_seeker_password' => md5($this->input->post('password'))));
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
			return FALSE;
		}
		else
		{

			$insertarray = array(
				'job_seeker_first_name'=>$this->input->post('fullname'),
				'job_seeker_last_name'=>$this->input->post('fullname'),
				'job_seeker_type'=>3,
				'job_seeker_email'=>$this->input->post('email_address'),
				'job_seeker_phone'=>$this->input->post('phone_number')
				);
			if($this->db->insert('job_seeker',$insertarray))
			{
				$insertarray['job_seeker_id'] = $this->db->insert_id();
				$insertarray['job_seeker_login_status'] = TRUE;
				$this->session->set_userdata($insertarray);
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
}