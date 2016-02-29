<?php

class Job_seeker_model extends CI_Model 
{
	/*
	*	Check if user has logged in
	*
	*/
	public function check_login()
	{
		if($this->session->userdata('job_seeker_login_status'))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Validate a user's login request
	*
	*/
	public function validate_user()
	{
		//select the user by email from the database
		$where = array('job_seeker_email' => $this->input->post('job_seeker_email'), 'job_seeker_status' => 1, 'job_seeker_password' => md5($this->input->post('job_seeker_password')));
		// var_dump($where); die();
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get('job_seeker');
		
		//if users exists
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			//create user's login session
			$newdata = array(
                   'job_seeker_login_status'     => TRUE,
                   'first_name'     => $result[0]->job_seeker_first_name,
                   'email'     => $result[0]->job_seeker_email,
                   'job_seeker_id'  => $result[0]->job_seeker_id
               );

			$this->session->set_userdata($newdata);
			
			//update user's last login date time
			$this->update_job_seeker_login($result[0]->job_seeker_id);
			return TRUE;
		}
		
		//if user doesn't exist
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Update user's last login date
	*
	*/
	private function update_job_seeker_login($job_seeker_id)
	{
		$data['last_login'] = date('Y-m-d H:i:s');
		$this->db->where('job_seeker_id', $job_seeker_id);
		$this->db->update('job_seeker', $data); 
	}
	
	/*
	*	Reset a user's password
	*
	*/
	public function reset_password($job_seeker_id)
	{
		$new_password = substr(md5(date('Y-m-d H:i:s')), 0, 6);
		
		$data['password'] = md5($new_password);
		$this->db->where('job_seeker_id', $job_seeker_id);
		$this->db->update('job_seeker', $data); 
		
		return $new_password;
	}
	
	/*
	*	Add a new user to the database
	*
	*/
	public function add_job_seeker()
	{
		$data = array(
				'job_seeker_first_name'=>ucwords(strtolower($this->input->post('job_seeker_first_name'))),
				'job_seeker_last_name'=>ucwords(strtolower($this->input->post('job_seeker_other_name'))),
				'job_seeker_email'=>$this->input->post('email'),
				'job_seeker_password'=>md5($this->input->post('job_seeker_password')),
				'job_seeker_phone'=>$this->input->post('job_seeker_phone'),
				'job_seeker_post_code'=>$this->input->post('job_seeker_post_code'),
				'job_seeker_address'=>$this->input->post('job_seeker_address'),
				'job_seeker_city'=>$this->input->post('job_seeker_city'),
				'created'=>date('Y-m-d H:i:s'),
				'job_seeker_status'=>0
			);
			
		if($this->db->insert('job_seeker', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Get jobs
	*
	*/
	public function get_jobs($status)
	{
		if($status == 0)
		{
			$where = '';
		}
		else
		{
			$where = 'AND job_seeker_request_status = '.$status;
		}
		$this->db->where('member.member_id = jobs.job_provider_id AND job_seeker_request.job_seeker_id = '.$this->session->userdata('job_seeker_id').' AND job_seeker_request.job_id = jobs.job_id '.$where );
		$this->db->order_by('assigned', 'DESC');
		$query = $this->db->get('job_seeker_request, jobs, member');
		
		return $query;
	}
	public function book_job($job_id)
	{
		$data = array(
				'job_seeker_id'=>$this->session->userdata('job_seeker_id'),
				'job_id'=>$job_id,
				'job_seeker_request_status'=>0,
				'date_of_request'=>date('Y-m-d H:i:s')
			);
			
		if($this->db->insert('job_seeker_request', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function check_if_booked($job_id)
	{
		$this->db->where('job_seeker_id ='.$this->session->userdata('job_seeker_id').' AND job_id ='.$job_id);
		$query = $this->db->get('job_seeker_request');
		
		if($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function get_my_details()
	{
		$this->db->where('job_seeker_id ='.$this->session->userdata('job_seeker_id'));
		$query = $this->db->get('job_seeker');

		return $query;
	}

	public function get_total_jobs($status)
	{
		if($status == 0)
		{
			$where = '';
		}
		else
		{
			$where = 'AND job_seeker_request_status = '.$status;
		}
		$this->db->select('COUNT(jobs.job_id) AS total_jobs');
		$this->db->where('member.member_id = jobs.job_provider_id AND job_seeker_request.job_seeker_id = '.$this->session->userdata('job_seeker_id').' AND job_seeker_request.job_id = jobs.job_id '.$where );

		$query = $this->db->get('job_seeker_request, jobs, member');
		
		foreach ($query->result() as $key ) {
			# code...
			$total_jobs = $key->total_jobs;
		}
		
		return $total_jobs;
	}
	public function change_password()
	{
		
		$data = array(
				'job_seeker_password' => md5($this->input->post('new_password'))
			);
		$this->db->where('job_seeker_password = "'.md5($this->input->post('current_password')).'" AND job_seeker_id ='.$this->session->userdata('job_seeker_id'));
		
		if($this->db->update('job_seeker', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}