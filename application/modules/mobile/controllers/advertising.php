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
		$v_data['advertisments'] = $this->advertising_model->get_adverts();
		$v_data['total_amount'] = $this->advertising_model->get_amount_to_be_shared();
		
		$v_data['job_seeker_id'] = $job_seeker_id;
		$response['message'] = 'success';
		$response['result'] = $this->load->view('advertisments/adverts_list', $v_data, true);

		
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
	public function update_link_details($advert_id,$counter, $job_seeker_id)
	{
		if($this->advertising_model->update_details($advert_id,$counter, $job_seeker_id))
		{
			$response['message'] = 'success';
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


}
