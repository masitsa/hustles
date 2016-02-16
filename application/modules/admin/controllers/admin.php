<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/auth/controllers/admin_auth.php";

class Admin extends admin_auth {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('login/login_model');
		$this->load->model('admin/reports_model');
		$this->load->model('admin/jobs_model');
		$this->load->model('admin/users_model');
	}
    
	/*
	*
	*	Default action is to show the dashboard
	*
	*/
	public function index() 
	{
		$data['title'] = 'Dashboard';
		
		$this->load->view('dashboard', $data);
	}
    
	/*
	*
	*	Login an administrator
	*
	*/
	public function admin_login() 
	{
		redirect('login/login_admin');
	}
	public function all_jobs()
	{
		$order ='jobs.job_id';
		$order_method = 'DESC';
		$where = 'job_category.job_category_id = jobs.job_category_id AND jobs.job_provider_id = member.member_id';
		$table = 'job_category,jobs,member';
		//pagination
		$this->load->library('pagination');
		$segment = 3;
		$config['base_url'] = base_url().'all-jobs';
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->jobs_model->get_all_jobs($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		if ($query->num_rows() > 0)
		{
			$v_data['jobs'] = $query;
			$v_data['page'] = $page;
			$data['content'] = $this->load->view('administration/all_jobs', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'There are no created jobs';
		}
		$data['title'] = 'All jobs';
		
		$this->load->view('templates/general_admin', $data);
	
	}
	
}
?>