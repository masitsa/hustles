<?php

class Advertising_model extends CI_Model 
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
	*	Retrieve all advert
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_advert($table, $where, $per_page, $page)
	{
		//retrieve all advert
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('created','DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

	/*
	*	Retrieve a single user
	*	@param int $user_id
	*
	*/
	public function get_advert($advert_id)
	{
		//retrieve all adverts
		$this->db->from('advertisments');
		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing advert
	*	@param int $advert_id
	*
	*/
	public function delete_advert($advert_id)
	{
		if($this->db->delete('advertisments', array('advert_id' => $advert_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deadvert_status advert
	*	@param int $advert_id
	*
	*/
	public function activate_advert($advert_id)
	{
		$data = array(
				'advert_status' => 1
			);
		$this->db->where('advert_id', $advert_id);
		
		if($this->db->update('advertisments', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an advert_status advert
	*	@param int $advert_id
	*
	*/
	public function deactivate_advert($advert_id)
	{
		$data = array(
				'advert_status' => 0
			);
		$this->db->where('advert_id', $advert_id);
		
		if($this->db->update('advertisments', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	/*
	*	Add a new user to the database
	*
	*/
	public function add_advert()
	{
		$advert_time = $this->input->post('advert_time');
		$advert_time = $advert_time * 3600;
		$data = array(
				'company_id'=>$this->input->post('company_id'),
				'advert_link'=>$this->input->post('advert_link'),
				'advert_status'=>$this->input->post('advert_status'),
				'advert_amount'=>$this->input->post('advert_amount'),
				'advert_title'=>$this->input->post('advert_title'),
				'advert_time'=>$advert_time,
				'advert_status'=>$this->input->post('advert_status'),
				'created'=>date('Y-m-d H:i:s')
			);
			
		if($this->db->insert('advertisments', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	function close_activate_advert($advert_id)
	{
		$this->db->from('advertisments');
		$this->db->select('*');
		$this->db->where('advert_id = '.$advert_id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code..
				$advert_id = $key->advert_id;
				$advert_amount = $key->advert_amount;

				// get all people who have watched an advert
				$advert_views = $this->advert_views($advert_id);
				$total_views = $advert_views->num_rows();

				$shared_amount = $advert_amount / $total_views;
				// var_dump($total_views);die();
				if($total_views > 0)
				{
					foreach ($advert_views->result() as $value) {
						# code...
						$member_id = $value->member_id;

						$data_insert = array(
								'invoice_number' => 1,
								'member_id' => $member_id,
								'advert_id' => $advert_id,
								'amount_made' => $shared_amount,
								'created_by' => $this->session->userdata('user_id'),
								'date_invoiced' => date('Y-m-d'),
							);
						$this->db->insert('invoice', $data_insert);

						$delivery_message = "Hello $job_seeker_first_name, You have been assigned Job JOB0023 to deliver to $contact_person_name, Phone number $contact_person_phone";

						$this->provider_model->sms($job_seeker_phone,$delivery_message);
						
						
					}
					$data = array(
							'advert_status' => 2
						);
					$this->db->where('advert_id', $advert_id);
					
					if($this->db->update('advertisments', $data))
					{
						return TRUE;
					}
					else{
						return FALSE;
					}
				}
				else
				{

				}
			}

		}

		
	}

	public function advert_views($advert_id)
	{
		$this->db->from('advertisments,view_trail,job_seeker');
		$this->db->select('*');
		$this->db->where('view_trail.member_id = job_seeker.job_seeker_id AND view_trail.advert_id = advertisments.advert_id AND view_trail.advert_id = '.$advert_id);
		$query = $this->db->get();

		return $query;
	}
	/*
	*	Add a new user to the database
	*
	*/
	public function edit_advert($advert_id)
	{
		$advert_time = $this->input->post('advert_time');
		$advert_time = $advert_time * 3600;
		$data = array(
					'company_id'=>$this->input->post('company_id'),
					'advert_link'=>$this->input->post('advert_link'),
					'advert_status'=>$this->input->post('advert_status'),
					'advert_amount'=>$this->input->post('advert_amount'),
					'advert_title'=>$this->input->post('advert_title'),
					'advert_time'=>$advert_time,
					'advert_status'=>$this->input->post('advert_status')
				);
			
		$this->db->where('advert_id', $advert_id);
		
		if($this->db->update('advertisments', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_companies()
	{
		$this->db->order_by('company_name');
		return $this->db->get('company');
	}
}
?>