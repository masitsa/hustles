<?php

class Advertising_model extends CI_Model 
{
	public function calculate_amount_payable($advert_id, $job_seeker_id, $advert_time, $advert_amount)
	{
		$this->db->where('advert_id = '.$advert_id.' AND round = 1');
		$amount_query = $this->db->get('view_trail');
		$watched = $total_payable_amount = $total_time_watched = 0;
		$total_views = $amount_query->num_rows();
		
		if($total_views > 0)
		{
			foreach ($amount_query->result() as $key_amount) 
			{
				# code...
				$member_id = $key_amount->member_id;
				
				if($member_id == $job_seeker_id)
				{
					$watched = 1;
				}
			}
		}
		
		if($watched == 1)
		{
			$total_payable_amount = $advert_amount/$total_views;
			
			/*if($total_payable_amount > $this->config->item('disbursment_cost'))
			{
				return ($total_payable_amount - $this->config->item('disbursment_cost'));	
			}
			
			else
			{
				return 0;
			}*/
			return $total_payable_amount;
		}
			
		else
		{
			return 0;
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
		$this->db->where('view_trail.advert_id = advertisments.advert_id AND view_trail.member_id = '.$job_seeker_id.' AND round = 1');
		$amount_query = $this->db->get('view_trail, advertisments');
		$total_time = $total_payable_amount = 0;
		
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_amount) 
			{
				# code...
				$member_id = $job_seeker_id;
				$advert_amount = $key_amount->advert_amount;
				$advert_id = $key_amount->advert_id;

				//get total time watched by all members
				$total_time_watched = 0;
				$this->db->where('advert_id', $advert_id);
				$query = $this->db->get('view_trail');
				$total_views = $query->num_rows();
				if($total_views > 0)
				{
					//calculate amount payable for the advert
					$total_payable_amount += $advert_amount/$total_views;
				}
			}
		}
		
		return $total_payable_amount - $this->config->item('disbursment_cost');	
	}
	public function calculate_amount_invoices($job_seeker_id)
	{
		$this->db->where('member_id = '.$job_seeker_id.'');
		$this->db->select('SUM(amount_made) AS amount');
		$amount_query = $this->db->get('invoice');
		$total_payable_amount = 0;
		
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_amount) 
			{
				# code...
				$amount = $key_amount->amount;
				//get total time watched by all members
				if($amount == NULL)
				{
					$amount = 0;
				}
				
			}
		}
		
		return $amount;	
	}
	public function check_for_requested($job_seeker_id)
	{
		$this->db->where('member_invoice_status = 1 AND member_id = '.$job_seeker_id.'');
		$this->db->select('*');
		$amount_query = $this->db->get('member_invoice');
		
		
		return $amount_query->num_rows();	
	}
	public function calculate_amount_receipted($job_seeker_id)
	{
		$this->db->where('member_id = '.$job_seeker_id.'');
		$this->db->select('SUM(amount_paid) AS amount');
		$amount_query = $this->db->get('receipt');
		$total_payable_amount = 0;
		
		if($amount_query->num_rows() > 0)
		{
			foreach ($amount_query->result() as $key_amount) 
			{
				# code...
				$amount = $key_amount->amount;
				//get total time watched by all members
				if($amount == NULL)
				{
					$amount = 0;
				}
				
			}
		}
		
		return $amount;	
	}
	
	
	public function get_adverts()
	{
		$this->db->where('advertisments.advert_status = 1 AND  company.company_id = advertisments.company_id');
		$this->db->order_by('advertisments.created', 'DESC');
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
	public function update_details($advert_id, $job_seeker_id)
	{
		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id.' AND member_id = '.$job_seeker_id );
		$tables = 'view_trail';
		$this->db->order_by('trail_id','DESC');
		$trail_query = $this->db->get('view_trail');

		if($trail_query->num_rows() == 0)
		{
			$round = 1;
		}
		else
		{
			$round = 0;
		}
		// insert value
		$insertarray = array(
				'advert_id'=>$advert_id,
				'created'=>date('Y-m-d H:i:s'),
				'member_id'=>$job_seeker_id,
				'round'=>$round
			);
		if($this->db->insert('view_trail', $insertarray))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
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
		$this->db->where('advert_id = '.$advert_id.' AND round = 1');
		$amount_query = $this->db->get('view_trail');
		
		$views = $amount_query->num_rows();
		
		return $views;
	}
	
	public function check_watched($job_seeker_id, $advert_id, $advert_time)
	{
		$this->db->where('member_id = '.$job_seeker_id.' AND advert_id = '.$advert_id.' AND round = 1');
		$amount_query = $this->db->get('view_trail');
		
		if(($amount_query->num_rows() == 1))
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	public function sms($phone,$message)
	{
        // This will override any configuration parameters set on the config file
		// max of 160 characters
		// to get a unique name make payment of 8700 to Africastalking/SMSLeopard
		// unique name should have a maximum of 11 characters
		$phone_number = $phone;
		// var_dump($phone_number) or die();
        $params = array('username' => 'alviem', 'apiKey' => '1f61510514421213f9566191a15caa94f3d930305c99dae2624dfb06ef54b703');  
        $this->load->library('AfricasTalkingGateway', $params);
		// var_dump($params)or die();
        // Send the message
		try 
		{
			// 22384
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