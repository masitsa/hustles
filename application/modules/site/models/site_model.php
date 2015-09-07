<?php

class Site_model extends CI_Model 
{
	public function get_slides()
	{
  		$table = "slideshow";
		$where = "slideshow_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
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
	public function get_all_jobs($table, $where, $per_page, $page)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('job_id', 'DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	public function get_services($table, $where, $limit = NULL)
	{
		$this->db->where($where);
		$this->db->select('service.*, department.department_name');
		if($limit != NULL)
		{
			$this->db->order_by('last_modified', 'RANDOM');
			$query = $this->db->get($table, $limit);
		}
		
		else
		{
			$this->db->order_by('service_name', 'ASC');
			$query = $this->db->get($table);
		}
		
		return $query;
	}
	
	public function get_departments()
	{
  		$table = "department";
		$where = "department_status = 1";
		
		$this->db->where($where);
		$this->db->order_by('department_name');
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_gallery_departments()
	{
  		$table = "department, gallery";
		$where = "department.department_status = 1 AND gallery.department_id = department.department_id";
		
		$this->db->where($where);
		$this->db->group_by('department_name');
		$this->db->order_by('department_name');
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_all_gallerys($table, $where)
	{
		//retrieve all gallerys
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('department.department_name');
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_gallery_services()
	{
  		$table = "service, gallery";
		$where = "gallery.gallery_status = 1 AND service.service_status = 1 AND gallery.service_id = service.service_id";
		
		$this->db->select('DISTINCT(service.service_name), service.service_id');
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_service($service_name)
	{
  		$table = "service";
		$where = array('service_name' => $service_name);
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	public function get_department($department_name)
	{
  		$table = "department";
		$where = array('department_name' => $department_name);
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_jobs()
	{
  		$table = "jobs";
		$where = "job_status = 1";
		
		$this->db->where($where);
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_loans()
	{
  		$table = "loans";
		
		$query = $this->db->get($table);
		
		return $query;
	}
	
	public function get_contacts()
	{
  		$table = "contacts";
		
		$query = $this->db->get($table);
		$contacts = array();
		if($query->num_rows() > 0)
		{
			$row = $query->row();
			$contacts['email'] = $row->email;
			$contacts['phone'] = $row->phone;
			$contacts['facebook'] = $row->facebook;
			$contacts['twitter'] = $row->twitter;
			$contacts['linkedin'] = $row->pintrest;
			$contacts['company_name'] = $row->company_name;
			$contacts['logo'] = $row->logo;
			$contacts['address'] = $row->address;
			$contacts['city'] = $row->city;
			$contacts['post_code'] = $row->post_code;
			$contacts['building'] = $row->building;
			$contacts['floor'] = $row->floor;
			$contacts['location'] = $row->location;
			$contacts['working_weekend'] = $row->working_weekend;
			$contacts['working_weekday'] = $row->working_weekday;
			$contacts['mission'] = $row->mission;
			$contacts['vision'] = $row->vision;
			$contacts['motto'] = $row->motto;
			$contacts['about'] = $row->about;
			$contacts['objectives'] = $row->objectives;
			$contacts['core_values'] = $row->core_values;
		}
		return $contacts;
	}
	
	public function limit_text($text, $limit) 
	{
		$pieces = explode(" ", $text);
		$total_words = count($pieces);
		
		if ($total_words > $limit) 
		{
			$return = "<i>";
			$count = 0;
			for($r = 0; $r < $total_words; $r++)
			{
				$count++;
				if(($count%$limit) == 0)
				{
					$return .= $pieces[$r]."</i><br/><i>";
				}
				else{
					$return .= $pieces[$r]." ";
				}
			}
		}
		
		else{
			$return = "<i>".$text;
		}
		return $return.'</i><br/>';
    }
	
	public function get_navigation()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = strtolower($page[0]);
		
		$home = '';
		$about = '';
		$jobs = '';
		$register = '';
		$contact = '';
		$gallery = '';
		
		if($name == 'home')
		{
			$home = 'active';
		}
		
		if($name == 'about')
		{
			$about = 'active';
		}
		
		if($name == 'register')
		{
			$register = 'active';
		}
		
		if($name == 'jobs')
		{
			$jobs = 'active';
		}
		
		
		if($name == 'contact-us')
		{
			$contact = 'active';
		}
		
		
		
		
		$navigation = 
		'
                        <li class="'.$home.'"> <a href="'.base_url().'home">Home</a> </li>
                        <li class="'.$jobs.'"><a href="'.base_url().'jobs">Jobs</a></li>
                        <li class="has-submenu '.$about.'">
                        	<a href="'.base_url().'about">About Us</a>
                            <ul>
                                <li><a href="'.base_url().'partners">Partners</a></li>
                                <li><a href="'.base_url().'contact">Contact Us</a></li>
                            </ul>
                        </li>
                        <li class="'.$register.'"><a href="'.base_url().'register">Register</a></li>
			
		';
		
		return $navigation;
	}
	
	public function get_navigation_footer()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		
		$name = strtolower($page[0]);
		
		$home = '';
		$about = '';
		$services = '';
		$departments = '';
		$blog = '';
		$contact = '';
		$gallery = '';
		
		if($name == 'home')
		{
			$home = 'active';
		}
		
		if($name == 'about')
		{
			$about = 'active';
		}
		
		if($name == 'services')
		{
			$services = 'active';
		}
		
		if($name == 'departments')
		{
			$departments = 'active';
		}
		
		if($name == 'blog')
		{
			$blog = 'active';
		}
		
		if($name == 'contact-us')
		{
			$contact = 'active';
		}
		
		if($name == 'gallery')
		{
			$gallery = 'active';
		}
		
		$navigation = 
		'
			<li><a href="'.site_url().'home" class="'.$home.'">Home</a></li>
			<li><a href="'.site_url().'departments" class="'.$departments.'">Departments</a></li>
			<li><a href="'.site_url().'services" class="'.$services.'">Services</a></li>
			<li><a href="'.site_url().'gallery" class="'.$gallery.'">Gallery</a></li>
			<li><a href="'.site_url().'blog" class="'.$blog.'">Blog</a></li>
			<li><a href="'.site_url().'about-us" class="'.$about.'">About us</a></li>
			<li><a href="'.site_url().'contact-us" class="'.$contact.'">Contact</a></li>
			
		';
		
		return $navigation;
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", $field_name);
		
		return $web_name;
	}
	
	public function decode_web_name($web_name)
	{
		$field_name = str_replace("-", " ", $web_name);
		
		return $field_name;
	}
	
	public function get_breadcrumbs()
	{
		$page = explode("/",uri_string());
		$total = count($page);
		$last = $total - 1;
		$crumbs = '<li><a href="'.site_url().'home">HOME </a></li>';
		
		for($r = 0; $r < $total; $r++)
		{
			$name = $this->decode_web_name($page[$r]);
			if($r == $last)
			{
				$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
                        <li>'.strtoupper($name).'</li>';
			}
			else
			{
				if($total == 3)
				{
					if($r == 1)
					{
						$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.site_url().$page[$r-1].'/'.strtolower($name).'">'.strtoupper($name).'</a></li>';
					}
					else
					{
						$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
							<li><a href="'.site_url().strtolower($name).'">'.strtoupper($name).'</a></li>';
					}
				}
				else
				{
					$crumbs .= '<li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.site_url().strtolower($name).'">'.strtoupper($name).'</a></li>';
				}
			}
		}
		
		return $crumbs;
	}
	
	public function get_active_departments()
	{
  		$table = "service, department";
		$where = "department.department_status = 1 AND service.department_id = department.department_id";
		
		$this->db->select('department.*');
		$this->db->where($where);
		$this->db->group_by('department_name');
		$this->db->order_by('department_name', 'ASC');
		$query = $this->db->get($table);
		
		return $query;
	}
}
?>