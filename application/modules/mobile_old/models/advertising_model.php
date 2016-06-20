<?php

class Advertising_model extends CI_Model 
{
	public function calculate_amount_payable($advert_id, $job_seeker_id, $advert_time, $advert_amount)
	{
		$this->db->select('MAX(view_trail.session_time) AS total_time, member_id');
		$this->db->where('advert_id = '.$advert_id);
		$this->db->group_by('member_id');
		$amount_query = $this->db->get('view_trail');
		$session_time = $total_payable_amount = $total_time_watched = 0;
		
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_amount) 
			{
				# code...
				$member_id = $key_amount->member_id;
				$total_time = $key_amount->total_time;
				
				if($member_id == $job_seeker_id)
				{
					$session_time = $total_time;
				}

				if($total_time >= (0.75*$advert_time))
				{
					$total_time_watched += $total_time;
				}
			}

			if($session_time >= (0.75*$advert_time))
			{
				$total_payable_amount=($advert_amount * $session_time)/$total_time_watched;
			}
			
			return $total_payable_amount;	
		}
	}
	
	public function calculate_total_advert_amount()
	{
		$this->db->select('SUM(advert_amount) AS total_advert_amount');
		$this->db->where('advert_status = 1');
		$amount_query = $this->db->get('advertisments');
		
		$total_advert_amount = 0;
		if($amount_query->num_rows() > 0)
		{
			$row = $amount_query->row();
			$total_advert_amount = $row->total_advert_amount;
		}
		
		return $total_advert_amount;
	}
	
	public function calculate_amount_payable2($job_seeker_id)
	{
		$this->db->select('MAX(view_trail.session_time) AS max_time, view_trail.advert_id, advertisments.advert_time, advertisments.advert_amount');
		$this->db->where('view_trail.advert_id = advertisments.advert_id AND view_trail.member_id = '.$job_seeker_id);
		$this->db->group_by('advert_id');
		$amount_query = $this->db->get('view_trail, advertisments');
		$total_time = $total_payable_amount = 0;
		
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_amount) {
				# code...
				$member_id = $job_seeker_id;
				$session_time = $key_amount->max_time;
				$advert_time = $key_amount->advert_time;
				$advert_amount = $key_amount->advert_amount;
				$advert_id = $key_amount->advert_id;

				if($session_time >= (0.75*$advert_time))
				{
					//get total time watched by all members
					$total_time_watched = 0;
					$this->db->select('MAX(session_time) AS total_time_watched, member_id');
					$this->db->where('advert_id', $advert_id);
					$this->db->group_by('member_id');
					$query = $this->db->get('view_trail');
					
					if($query->num_rows() > 0)
					{
						foreach($query->result() as $res)
						{
							$watched = $res->total_time_watched;
							
							if($watched >= (0.75*$advert_time))
							{
								$total_time_watched += $watched;
							}
						}
					}
					
					//calculate amount payable for the advert
					$total_payable_amount += ($advert_amount * $session_time)/$total_time_watched;
				}
			}
			
			return $total_payable_amount;	
		}
	}
	
	public function get_adverts()
	{
		$this->db->where('advertisments.advert_status = 1 AND  company.company_id = advertisments.company_id');
		$query = $this->db->get('advertisments,company');
		
		return $query;
	}
	public function get_advert_detail($advert_id, $job_seeker_id)
	{	
		// calculate total amount of time spent and amount to be shared
		
		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id );
		$tables = 'advertisments';
		$query = $this->db->get($tables);
		$count = 0;
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$count = $key->advert_views;
				$advert_amount  = $key->advert_amount;
				$balance  = $key->balance;
			}
			$count = $count+1;
		}

		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id.' AND member_id = '.$job_seeker_id.'' );
		$tables = 'view_trail';
		$trail_query = $this->db->get('view_trail');

		if($trail_query->num_rows() > 0)
		{
			// update the count
		}
		else
		{
			// update the count
			$this->db->where('advert_id = '.$advert_id );
			$tables = 'advertisments';
			$arrayName = array('advert_views' => $count);
			$this->db->update('advertisments',$arrayName);
		}
		// select the job

		$this->db->where('advertisments.advert_status = 1 AND  company.company_id = advertisments.company_id AND advert_id = '.$advert_id);
		$advert_query = $this->db->get('advertisments,company');

		return $advert_query;
	}
	public function update_details($advert_id, $counter, $job_seeker_id)
	{
		//get advert time
		$this->db->where('advert_id', $advert_id);
		$query = $this->db->get('advertisments');
		$advert_time = 0;
		
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$advert_time = $row->advert_time;
		}
		$time_checked_out = 0;
		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id.' AND member_id = '.$job_seeker_id );
		$tables = 'view_trail';
		$this->db->order_by('trail_id','DESC');
		$trail_query = $this->db->get('view_trail');

		if($trail_query->num_rows() > 0)
		{
			$round = $trail_query->num_rows();
			foreach ($trail_query->result() as $key) {
				# code...
				$trail_id = $key->trail_id;
				$session_time = $key->session_time;
				// $session_time = 0;
				$time_checked_out += $session_time;
				$round = $round+1;
				$new_session_time = $session_time * $round;
				
				if($new_session_time > $advert_time)
				{
					$new_session_time = $advert_time;
				}
				
				// insert value
				$insertarray = array(
					'round'=>$round,
					'session_time'=>$new_session_time
					);
				$this->db->where('trail_id', $trail_id);
				if($this->db->update('view_trail',$insertarray))
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
		}
		else
		{
			$round = 0;
			$session_time = 2000;
			$round = $round+1;
			
			// insert value
			$insertarray = array(
				'advert_id'=>$advert_id,
				'member_id'=>$job_seeker_id,
				'round'=>$round,
				'session_time'=>$session_time
				);
			if($this->db->insert('view_trail',$insertarray))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

	}
	public function get_amount_to_be_shared()
	{
		$this->db->select('SUM(advert_amount) as amount');
		$this->db->where('advert_status = 1' );
		$amount_query = $this->db->get('advertisments');
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_value) {
				# code...
				$amount = $key_value->amount;
			}
		}
		else
		{
			$amount = 0;
		}

		return $amount;

	}
	
	public function get_advert_views($advert_id)
	{
		$this->db->select('MAX(view_trail.session_time) AS total_time, member_id');
		$this->db->where('advert_id = '.$advert_id);
		$this->db->group_by('member_id');
		$amount_query = $this->db->get('view_trail');
		
		$views = $amount_query->num_rows();
		
		return $views;
	}
	
	public function check_watched($job_seeker_id, $advert_id, $advert_time)
	{
		$this->db->select('MAX(view_trail.session_time) AS total_time');
		$this->db->where('member_id = '.$job_seeker_id.' AND advert_id = '.$advert_id);
		$amount_query = $this->db->get('view_trail');
		
		if(($amount_query->num_rows() == 1))
		{
			$row = $amount_query->row();
			
			$total_time = $row->total_time;
			
			if($total_time >= (0.75 * $advert_time))
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
}