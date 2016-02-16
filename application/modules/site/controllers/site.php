<?php session_start();
/*
	This module loads the head, header, footer &/or Social media sections.
*/
class Site extends CI_Controller 
{	
	var $slideshow_location;
	var $service_location;
	var $gallery_location;
	
	function __construct() 
	{
		parent:: __construct();
		
		$this->load->model('site_model');
		// $this->load->model('admin/blog_model');
		// $this->load->model('admin/gallery_model');
		// $this->load->model('admin/users_model');
		// $this->load->model('site/departments_model');
		
		// $this->slideshow_location = base_url().'assets/slideshow/';
		// $this->service_location = base_url().'assets/service/';
		// $this->gallery_location = base_url().'assets/gallery/';
  	}
	
	public function index()
	{
		redirect('home');
	}
	
	function home_page()
	{
		//Retrieve active slides
		// $data['company_details'] = $this->site_model->get_contacts();
		// $data['slides'] = $this->site_model->get_slides();
		// $data['latest_posts'] = $this->blog_model->get_recent_posts(3);
		// $data['departments'] = $this->site_model->get_departments();
		
		// $data['slideshow_location'] = $this->slideshow_location;
		// $data['service_location'] = $this->service_location;
		$data['home'] =  array('item one' => 1, );
		$v_data['title'] = 'Home';
		$v_data['content'] = $this->load->view("home", $data, TRUE);
		
		$this->load->view("includes/templates/general", $v_data);
	}
	
	public function all_jobs()
	{
		$query = $this->site_model->get_all_home_jobs();
		
		if($query->num_rows() > 0)
		{
			$result['message'] = 'success';
			$result['result'] = $query->result();
		}
		
		else
		{
			$result['message'] = 'error';
		}
		
		echo json_encode($result);
	}
	
	public function about($item = NULL)
	{
		if($item == NULL)
		{
			$v_data['var'] = 'about';
			$item = 'about';
		}
		else
		{
			$v_data['var'] = $item;
			$item = $v_data['var'];
		}
		$data['title'] = 'About us';
		$v_data['title'] = 'About us';

		$data['content'] = $this->load->view($item, $v_data, true);
		
		$this->load->view("includes/templates/general", $data);
	}
	public function specialists()
	{
		$data['title'] = 'Our Specialists ';
		$v_data['title'] = 'Our Specialists';
		$data['company_details'] = $this->site_model->get_contacts();
		$v_data['content'] = $this->load->view('specialists/specialists', $data, true);
		
		$this->load->view("specialists/templates/specialists", $v_data);
	}
	public function testimonials()
	{
		$data['title'] = 'Testimonials ';
		$v_data['title'] = 'Testimonials';
		$data['company_details'] = $this->site_model->get_contacts();
		$v_data['content'] = $this->load->view('testimonials/testimonials', $data, true);
		
		$this->load->view("testimonials/templates/testimonials", $v_data);
	}
	public function faq()
	{
		$data['title'] = "FAQ's";
		$v_data['title'] = "FAQ's";
		$data['company_details'] = $this->site_model->get_contacts();
		$v_data['content'] = $this->load->view('faq/faq', $data, true);
		
		$this->load->view("faq/templates/faq", $v_data);
	}
	
	public function services($department_web_name = NULL)
	{
  		$table = "service, department";
		$where = "service.service_status = 1 AND service.department_id = department.department_id";
		
		if($department_web_name != NULL)
		{
			$department_name = $this->site_model->decode_web_name($department_web_name);
			$where .= ' AND department.department_name = \''.$department_name.'\'';
			$data['services'] = $this->site_model->get_services($table, $where, NULL);
			$data['title'] = $department_name;
			$v_data['title'] = $department_name;
		}
		
		else
		{
			$data['title'] = 'Our Services';
			$v_data['title'] = 'Our Services';
			$data['services'] = $this->site_model->get_services($table, $where, 12);
		}
		$data['service_location'] = $this->service_location;
		
	
		$v_data['class'] = '';
		$v_data['content'] = $this->load->view("services", $data, TRUE);
		
		$this->load->view("services/templates/services", $v_data);
	}


	
	public function view_service($web_name)
	{
		$service_name = $this->site_model->decode_web_name($web_name);
		
		if($service_name)
		{
			$query = $this->site_model->get_service($service_name);
	
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$service_name = $row->service_name;
				}
				$data['title'] = $service_name;
				$v_data['title'] = $service_name;
				$v_data['row'] = $query->row();
				$data['content'] = $this->load->view('services/single_service', $v_data, true);
			}
			
			else
			{
				$data['title'] = 'Services';
				$v_data['title'] = 'Services';
				$data['content'] = 'Service not found';
			}
		}
		
		else
		{
			$data['title'] = 'Services';
			$v_data['title'] = 'Services';
			$data['content'] = 'Service not found';
		}
		
		$this->load->view("services/templates/single_service", $data);
	}
	
	public function contact()
	{
		$data['contacts'] = $this->site_model->get_contacts();
		
		$v_data['title'] = 'Contact us';
		$v_data['class'] = '';
		$v_data['content'] = $this->load->view("contacts", $data, TRUE);
		
		$this->load->view("includes/templates/general", $v_data);
	}
    
	public function gallery() 
	{
		$where = 'gallery.department_id = department.department_id AND gallery_status = 1';
		$segment = 2;
		$base_url = site_url().'gallery';
		
		$table = 'department, gallery';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 24;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<div class="wp-pagenavi">';
		$config['full_tag_close'] = '</div>';
		
		$config['next_link'] = 'Next';
		
		$config['prev_link'] = 'Prev';
		
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->site_model->get_all_gallerys($table, $where);
		
		if ($query->num_rows() > 0)
		{
			$v_data['gallery'] = $query;
			$v_data['page'] = $page;
			$v_data['title'] = 'Gallery';
			$v_data['gallery_departments'] = $this->site_model->get_gallery_departments($table, $where, $config["per_page"], $page);
			$v_data['gallery_location'] = $this->gallery_location;
			$data['content'] = $this->load->view('gallery/gallery_list', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<p>There are no pictures posted yet</p>';
		}
		$data['title'] = 'Gallery';
		$this->load->view("gallery/templates/gallery", $data);
	}
	
	public function jobs() 
	{
		$where = 'job_category.job_category_id = jobs.job_category_id AND member.member_id = jobs.job_provider_id AND jobs.job_status = 0';
		$segment = 2;
		$base_url = base_url().'jobs';
		
		$table = 'jobs,job_category,member';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->site_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<div class="wp-pagenavi">';
		$config['full_tag_close'] = '</div>';
		
		$config['next_link'] = 'Next';
		
		$config['prev_link'] = 'Prev';
		
		$config['cur_tag_open'] = '<span class="current">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$jobs = $this->site_model->get_all_jobs($table, $where, $config["per_page"], $page);
		
		if ($jobs->num_rows() > 0)
		{
			$v_data['jobs'] = $jobs;
			$v_data['page'] = $page;
			$v_data['title'] = 'Jobs';
			$data['content'] = $this->load->view('jobs/jobs_list', $v_data, true);
		}
		
		else
		{
			$data['content'] = '<p>There are no departments posted yet</p>';
		}
		$data['title'] = 'Jobs';
		$this->load->view("includes/templates/general", $data);
	}

	public function view_department($web_name)
	{
		$department_name = $this->site_model->decode_web_name($web_name);
		
		if($department_name)
		{
			$query = $this->site_model->get_department($department_name);
	
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$department_name = $row->department_name;
				}
				$data['title'] = $department_name;
				$v_data['title'] = $department_name;
				$v_data['row'] = $query->row();
				$data['content'] = $this->load->view('departments/single_department', $v_data, true);
			}
			
			else
			{
				$data['title'] = 'Departments';
				$v_data['title'] = 'Departments';
				$data['content'] = 'Service not found';
			}
		}
		
		else
		{
			$data['title'] = 'Departments';
			$v_data['title'] = 'Departments';
			$data['content'] = 'Service not found';
		}
		
		$this->load->view("departments/templates/single_department", $data);
	}
	
	function purity()
	{
		for($i=0; $i<10;$i++)
		{
			echo $i;
		}
	}
	
	function purity2()
	{
		$i = 1;
		while($i < 11)
		{
			echo $i;
			$i++;
		}
	}
	
}