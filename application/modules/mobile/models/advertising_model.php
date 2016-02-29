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
		$this->db->select('advert_views');
		$this->db->where('advert_id = '.$advert_id );
		$tables = 'advertisments';
		$query = $this->db->get($tables);
		$count = 0;
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$count = $key->advert_views;
			}
			$count = $count+1;
		}
		// update the count
		$this->db->where('advert_id = '.$advert_id );
		$tables = 'advertisments';
		$arrayName = array('advert_views' => $count);
		$this->db->update('advertisments',$arrayName);

		// select the job

		$this->db->where('advertisments.advert_status = 1 AND  company.company_id = advertisments.company_id AND advert_id = '.$advert_id);
		$advert_query = $this->db->get('advertisments,company');

		return $advert_query;
	}

}