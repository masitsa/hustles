<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertising extends MX_Controller {
	
	function __construct()
	{
		parent:: __construct();
		
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
	
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	
			exit(0);
		}
		
		$this->load->model('advertising_model');
		// $this->load->model('email_model');
		
		// $this->load->library('Mandrill', $this->config->item('mandrill_key'));
	}

	public function get_adverts($job_seeker_id)
	{
		$v_data['advertisments'] = $this->advertising_model->get_adverts(0);
		$v_data['featured_advertisments'] = $this->advertising_model->get_adverts(1);
		$v_data['total_amount'] = $this->advertising_model->get_amount_to_be_shared();
		$total_ads = $v_data['advertisments']->num_rows();
		$total_featured_ads = $v_data['featured_advertisments']->num_rows();
		
		$v_data['job_seeker_id'] = $job_seeker_id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('advertisments/adverts_list', $v_data, true);
		$response['total_ads'] = $total_ads + $total_featured_ads;
		
		echo json_encode($response);

	}
	public function get_advert_detail($advert_id, $job_seeker_id)
	{
		# code...
		$v_data['advertisments'] = $this->advertising_model->get_advert_detail($advert_id, $job_seeker_id);
		
		$v_data['job_seeker_id'] = $job_seeker_id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('advertisments/single_advert', $v_data, true);

		echo json_encode($response);
	}
	public function update_link_details($advert_id, $job_seeker_id, $latitude = NULL, $longitude = NULL)
	{
		if($this->advertising_model->update_details($advert_id, $job_seeker_id, $latitude, $longitude))
		{
			$response['message'] = 'success';
		}
		else
		{
			$response['message'] = 'fail';
		}
		echo json_encode($response);
	}
	public function submit_advert_rating($advert_id,$rating,$job_seeker_id)
	{
		if($this->advertising_model->update_ratings($advert_id,$rating,$job_seeker_id))
		{
			$advert_query = $this->advertising_model->get_advert_message($advert_id);
			if($advert_query->num_rows() > 0)
			{
				foreach ($advert_query->result() as $key) {
					# code...
					$advert_message_title = $key->advert_message_title;
					$advert_response_title = $key->advert_response_title;
					if($advert_message_title == NULL)
					{
						$advert_message_title = 'Thank you for watching the advertisment';
						$advert_response_title = 'You have made some money!';
					}

				}
			}
			$response['message'] = 'success';
			$response['result'] = $advert_message_title;
			$response['title'] = $advert_response_title;
		}
		else
		{
			$response['message'] = 'fail';
		}
		echo json_encode($response);
	}
	public function time_to_leave($advert_id)
	{
		$response['stop_time'] = 1500;

		$response['message'] = 'success';
		echo json_encode($response);
	}
	public function get_coupons($job_seeker_id)
	{
		$coupons = $v_data['coupons'] = $this->advertising_model->get_job_seeker_coupons($job_seeker_id);
		
		$v_data['job_seeker_id'] = $job_seeker_id;
		if($coupons->num_rows() > 0)
		{
			$response['message'] = 'success';
			$response['result'] = $this->load->view('job_seeker/coupons', $v_data, true);
		}
		else
		{
			$response['message'] = 'fail';
			$response['result'] = 'Sorry no coupons';
		}
		

		echo json_encode($response);
	}
	
	public function check_new_adverts($job_seeker_id, $to = NULL)
	{
		if($to != NULL)
		{
			//save if not exists
			$this->db->where('job_seeker_id', $job_seeker_id);
			$this->db->update('job_seeker', array('registration_id' => $to));
			
			/*$this->db->select('advertisments.*, a.member_id');
			$this->db->where('advertisments.advert_status = 1');
			$this->db->join('view_trail AS a', 'a.advert_id = advertisments.advert_id AND a.member_id = '.$job_seeker_id, 'INNER');
			$query = $this->db->get('advertisments');
			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $res)
				{
					$member_id = $res->member_id;
					
					$advert_id = $res->advert_id;
					$advert_title = $res->advert_title;
					$message_title = 'Choto New Advert';
					$title = $message_title;
					$message = $advert_title;
					$result = $this->advertising_model->send_push_notification($to, $title, $message);
					
					echo $result;
				}
			}*/
		}
	}
	
	public function send_advert_notifications($advert_id)
	{
		$advert_title = $this->input->post('advert_title');
		$this->db->select('job_seeker.registration_id');
		$this->db->where('job_seeker.registration_id IS NOT NULL AND job_seeker.job_seeker_id NOT IN (SELECT DISTINCT(member_id) FROM view_trail WHERE view_trail.advert_id = '.$advert_id.')');
		$query = $this->db->get('job_seeker');
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $res)
			{
				$to = $res->registration_id;
				$message_title = 'Choto New Advert';
				$title = $message_title;
				$message = $advert_title;
				$result = $this->advertising_model->send_push_notification($to, $title, $message);
				
				echo $result;
			}
		}
		
		$this->session->set_userdata('success_message', 'Advert notification has been successfully sent to '.$query->num_rows().' viewers');
		
		redirect('all-advertisments');
	}
}
