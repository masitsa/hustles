<?php

class Ambassadeur_model extends CI_Model 
{	
	/*
	*	Retrieve all ambassadeur
	*
	*/
	public function all_ambassadeur()
	{
		$this->db->where('ambassadeur_status = 1');
		$query = $this->db->get('ambassadeur');
		
		return $query;
	}
	
	/*
	*	Retrieve all ambassadeur
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_ambassadeur($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('ambassadeur_fname');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new ambassadeur
	*	@param string $image_name
	*
	*/
	public function add_ambassadeur()
	{
		$data = array(
				'ambassadeur_fname'=>ucwords(strtolower($this->input->post('ambassadeur_fname'))),
				'ambassadeur_onames'=>$this->input->post('ambassadeur_onames'),
				'ambassadeur_email'=>strtolower($this->input->post('ambassadeur_email')),
				'ambassadeur_status'=>$this->input->post('ambassadeur_status'),
				'ambassadeur_phone'=>$this->input->post('ambassadeur_phone'),
				'referral_code'=>$this->input->post('referral_code')
			);
			
		if($this->db->insert('ambassadeur', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing ambassadeur
	*	@param string $image_name
	*	@param int $ambassadeur_id
	*
	*/
	public function update_ambassadeur($ambassadeur_id)
	{
		$data = array(
				'ambassadeur_fname'=>ucwords(strtolower($this->input->post('ambassadeur_fname'))),
				'ambassadeur_onames'=>$this->input->post('ambassadeur_onames'),
				'ambassadeur_email'=>strtolower($this->input->post('ambassadeur_email')),
				'ambassadeur_status'=>$this->input->post('ambassadeur_status'),
				'ambassadeur_phone'=>$this->input->post('ambassadeur_phone'),
				'referral_code'=>$this->input->post('referral_code')
			);
			
		$this->db->where('ambassadeur_id', $ambassadeur_id);
		if($this->db->update('ambassadeur', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single ambassadeur's details
	*	@param int $ambassadeur_id
	*
	*/
	public function get_ambassadeur($ambassadeur_id)
	{
		//retrieve all users
		$this->db->from('ambassadeur');
		$this->db->select('*');
		$this->db->where('ambassadeur_id = '.$ambassadeur_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function delete_ambassadeur($ambassadeur_id)
	{
		if($this->db->delete('ambassadeur', array('ambassadeur_id' => $ambassadeur_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function activate_ambassadeur($ambassadeur_id)
	{
		$data = array(
				'ambassadeur_status' => 1
			);
		$this->db->where('ambassadeur_id', $ambassadeur_id);
		
		if($this->db->update('ambassadeur', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated ambassadeur
	*	@param int $ambassadeur_id
	*
	*/
	public function deactivate_ambassadeur($ambassadeur_id)
	{
		$data = array(
				'ambassadeur_status' => 0
			);
		$this->db->where('ambassadeur_id', $ambassadeur_id);
		
		if($this->db->update('ambassadeur', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>