<?php

class Jobs_model extends CI_Model 
{
	/*
	*	Get jobs
	*
	*/
	public function get_jobs($status)
	{
		// '.$this->session->userdata('job_seeker_id').'

		if($status == 3)
		{
			$this->db->where('job_category.job_category_id = jobs.job_category_id AND member.member_id = jobs.job_provider_id AND jobs.job_status = 0');
			$tables = 'jobs,job_category,member';
		}
		else
		{
			if($status == 0)
			{
				$where = '';
			}
			else
			{
				$where = 'AND job_seeker_request_status = '.$status;
			}
			$this->db->where('member.member_id = jobs.job_provider_id AND job_seeker_request.job_seeker_id = 1 AND job_seeker_request.job_id = jobs.job_id '.$where );
			$tables = 'job_seeker_request, jobs, member';
		}
		$this->db->order_by('jobs.job_title', 'DESC');
		$query = $this->db->get($tables);
		
		return $query;
	}

	public function get_job_detail($job_id,$job_status)
	{	
		$this->db->select('count');
		$this->db->where('job_id = '.$job_id );
		$tables = 'jobs';
		$query = $this->db->get($tables);
		$count = 0;
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$count = $key->count;
			}
			$count = $count+1;
		}
		// update the count
		$this->db->where('job_id = '.$job_id );
		$tables = 'jobs';
		$arrayName = array('count' => $count);
		$this->db->update('jobs',$arrayName);

		// select the job

		if($job_status == 3)
		{
			$this->db->where('job_category.job_category_id = jobs.job_category_id AND member.member_id = jobs.job_provider_id AND jobs.job_status = 0 AND jobs.job_id ='.$job_id);
			$tables = 'jobs,job_category,member';
		}
		else
		{
			if($job_status == 0)
			{
				$where = '';
			}
			else
			{
				$where = 'AND job_seeker_request_status = '.$job_status;
			}
			$this->db->where('member.member_id = jobs.job_provider_id AND job_seeker_request.job_seeker_id = 1 AND job_seeker_request.job_id = jobs.job_id AND jobs.job_id = '.$job_id.' '.$where );
			$tables = 'job_seeker_request, jobs, member';
		}
		$this->db->order_by('jobs.job_title', 'DESC');
		$job_query = $this->db->get($tables);

		return $job_query;
	}

	public function check_if_booked($job_id)
	{
		$this->db->where('job_seeker_id = 1 AND job_id ='.$job_id);
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
	public function book_job($job_id)
	{
		$data = array(
				'job_seeker_id'=>1,
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
	public function get_all_home_jobs()
	{
		$this->db->where('job_category.job_category_id = jobs.job_category_id AND member.member_id = jobs.job_provider_id AND jobs.job_status = 0');
		$query = $this->db->get('jobs,job_category,member');

		return $query;

	}
}