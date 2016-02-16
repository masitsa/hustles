<?php

class Jobs_model extends CI_Model 
{
	
	/*
	*	Retrieve all jobs
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_jobs($table, $where, $per_page, $page, $order, $order_method)
	{
		//retrieve all jobs
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

	/*
	*	Retrieve all jobs
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_job_applicants($table, $where, $per_page, $page, $order, $order_method)
	{
		//retrieve all jobs
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new job to the database
	*
	*/
	public function post_job()
	{

		$start_location = explode(',', $this->input->post('location')); 
		$destination = explode(',', $this->input->post('location_destination'));

		$start_location_lat = $start_location[0];
		$start_location_long = $start_location[1];

		$end_location_lat = $destination[0];
		$end_location_long = $destination[1];
		
		$data = array(
				'job_description'=>$this->input->post('job_description'),
				'job_title'=>$this->input->post('job_title'),
				'job_start_location'=>$this->input->post('job_start_location'),
				'job_destination'=>$this->input->post('job_destination'),
				'contact_person_name'=>$this->input->post('contact_person_name'),
				'contact_person_phone'=>$this->input->post('contact_person_phone'),
				'job_provider_id'=>$this->session->userdata('user_id'),
				'pick_up_location_detail'=>$this->input->post('pick_up_location_detail'),
				'delivery_location_detail'=>$this->input->post('delivery_location_detail'),
				'start_location_lat'=>$start_location_lat,
				'start_location_long'=>$start_location_long,
				'end_location_lat'=>$end_location_lat,
				'end_location_long'=>$end_location_long,

				'job_category_id'=>1,
				'job_status'=>0,
				'created'=>date('Y-m-d H:i:s')
			);
			
		if($this->db->insert('jobs', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing job
	*	@param int $job_id
	*
	*/
	public function edit_job($job_id)
	{
		$data = array(
				'job_description'=>$this->input->post('job_description'),
				'job_title'=>$this->input->post('job_title'),
				'contact_person_name'=>$this->input->post('contact_person_name'),
				'contact_person_phone'=>$this->input->post('contact_person_phone'),
				// 'contact_person_description'=>$this->input->post('contact_person_description'),
				'job_category_id'=>$this->input->post('job_category_id'),
				'last_modified'=>date('Y-m-d H:i:s')
			);
		
		$this->db->where('job_id', $job_id);
		
		if($this->db->update('jobs', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Retrieve a single job
	*	@param int $job_id
	*
	*/
	public function get_job($job_id)
	{
		//retrieve all jobs
		$this->db->from('jobs,job_category');
		$this->db->select('*');
		$this->db->where('job_category.job_category_id = jobs.job_category_id AND jobs.job_id = '.$job_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function get_job_details($job_id)
	{
		//retrieve all jobs
		$this->db->from('jobs,job_category,member');
		$this->db->select('*');
		$this->db->where('job_category.job_category_id = jobs.job_category_id AND member.member_id = jobs.job_provider_id AND jobs.job_id = '.$job_id);
		$query = $this->db->get();
		
		return $query;	
	}

	public function get_job_applicants($job_id)
	{
		$this->db->from('job_seeker_request,job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker.job_seeker_id = job_seeker_request.job_seeker_id  AND job_seeker_request.job_id = '.$job_id);
		$query = $this->db->get();
		
		return $query;
	}
	public function get_job_assigned_person($job_id)
	{
		$this->db->from('job_seeker_request,job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker.job_seeker_id = job_seeker_request.job_seeker_id AND (job_seeker_request_status = 1 OR job_seeker_request_status = 2) AND job_id = '.$job_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function get_job_requested_person($job_id,$job_seeker_id)
	{
		$this->db->from('job_seeker_request,job_seeker');
		$this->db->select('*');
		$this->db->where('job_seeker.job_seeker_id = job_seeker_request.job_seeker_id AND job_seeker_request.job_seeker_id = '.$job_seeker_id.' AND job_id = '.$job_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function get_all_provider_jobs($job_provider_id)
	{
		$this->db->from('jobs');
		$this->db->select('*');
		$this->db->where('job_provider_id = '.$job_provider_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing job
	*	@param int $job_id
	*
	*/
	public function delete_job($job_id)
	{
		if($this->db->delete('jobs', array('job_id' => $job_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated job
	*	@param int $job_id
	*
	*/
	public function activate_job($job_id)
	{
		$data = array(
				'job_status' => 1
			);
		$this->db->where('job_id', $job_id);
		
		if($this->db->update('jobs', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated job
	*	@param int $job_id
	*
	*/
	public function deactivate_job($job_id)
	{
		$data = array(
				'job_status' => 0
			);
		$this->db->where('job_id', $job_id);
		
		if($this->db->update('jobs', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>