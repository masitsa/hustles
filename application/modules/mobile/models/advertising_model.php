<?php

class Advertising_model extends CI_Model 
{
	public function get_adverts()
	{
		$this->db->where('advertisments.advert_status = 1 AND  company.company_id = advertisments.company_id');
		$query = $this->db->get('advertisments,company');
		
		return $query;
	}
	public function get_advert_detail($advert_id)
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
		$this->db->where('advert_id = '.$advert_id.' AND member_id = 1' );
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
	public function update_details($advert_id,$counter)
	{
		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id.' AND member_id = 1' );
		$tables = 'view_trail';
		$this->db->order_by('trail_id','DESC');
		$this->db->limit(1);
		$trail_query = $this->db->get('view_trail');

		if($trail_query->num_rows() == 1)
		{
			foreach ($trail_query->result() as $key) {
				# code...
				$round = $key->round;
				$trail_id = $key->trail_id;
				$session_time = $key->session_time;

			}
		}
		else
		{
			$round = 0;
			$session_time = 0;
		}
		$round = $round+1;
		

		$session_time = $session_time+2000;

		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id );
		$advert_query = $this->db->get('advertisments');

		if($advert_query->num_rows() > 0)
		{
			foreach ($advert_query->result() as $key_advert) {
				# code...
				$balance = $key_advert->balance;
				$advert_amount = $key_advert->advert_amount;
				$advert_time = $key_advert->advert_time;
				$advert_views = $key_advert->advert_views;
			}

		}

		$this->db->select('SUM(session_time) as total_time');
		$this->db->where('advert_id = '.$advert_id.' AND member_id = 1' );
		$amount_query = $this->db->get('view_trail');
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_value) {
				# code...
				$time_checked_out = $key_value->total_time;
			}
		}

		$amount_per_view = ($advert_amount/$advert_time);
		if($session_time > $time_checked_out)
		{
			$less_amount = $session_time - $time_checked_out;
			$amount_to_reduce = $less_amount*$amount_per_view;
			// $amount_reduced = $amount_per_view*2000;
		}
		else
		{
			$amount_to_reduce = 0;
		}
		

		$balance = $balance - $amount_to_reduce;
	    
	    if($balance > 0)
	    {

				if($counter == 0 )
				{				
					// insert value
					$insertarray = array(
						'advert_id'=>$advert_id,
						'member_id'=>1,
						'round'=>$round,
						'session_time'=>$session_time
						);
					if($this->db->insert('view_trail',$insertarray))
					{
							// insert value
						$addupdate_array = array(
							'balance'=>$balance
							);
						$this->db->where('advert_id ='.$advert_id);
						$this->db->update('advertisments',$addupdate_array);
					
						return TRUE;
					}
					else
					{
						return FALSE;
					}
				}
				else if($counter == 1)
				{
					
					// insert value
					$update_array = array(
						'advert_id'=>$advert_id,
						'member_id'=>1,
						'round'=>$round,
						'session_time'=>$session_time
						);
					$this->db->where('trail_id ='.$trail_id);
					if($this->db->update('view_trail',$update_array))
					{
						$addupdate_array = array(
							'balance'=>$balance
							);
						$this->db->where('advert_id ='.$advert_id);
						$this->db->update('advertisments',$addupdate_array);
						return TRUE;
					}
					else
					{
						return FALSE;
					}

				}
				else if($counter == 2)
				{
					// insert value
					$insertarray = array(
						'advert_id'=>$advert_id,
						'member_id'=>1,
						'round'=>$round,
						'session_time'=>$session_time
						);
					if($this->db->insert('view_trail',$insertarray))
					{
						$addupdate_array = array(
							'balance'=>$balance
							);
						$this->db->where('advert_id ='.$advert_id);
						$this->db->update('advertisments',$addupdate_array);
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
			return FALSE;
		}

	}
	public function get_amount_to_be_shared()
	{
		$this->db->select('SUM(balance) as amount');
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

}