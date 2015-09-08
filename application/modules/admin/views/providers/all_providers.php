<?php echo $this->load->view('search/search_providers', '', TRUE);?>
<?php	
		$result = '';
		$success = $this->session->userdata('success_message');
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
			$this->session->unset_userdata('success_message');
		}
		
		$error = $this->session->userdata('error_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
			$this->session->unset_userdata('error_message');
		}
		
		//if providers exist display them
		if ($providers->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Name</th>
					  <th>Phone Number</th>
					  <th>Email Address</th>
					  <th>Date Created</th>
					  <th>Last Login</th>
					  <th>Status</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			foreach ($providers->result() as $row)
			{
				$member_id = $row->member_id;
				$fname = $row->member_first_name;
				//create deactivated status display
				if($row->member_status == 0)
				{
					$status = '<span class="label label-important">Deactivated</span>';
					$button = '<a class="btn btn-danger activate_job_provider" href="'.site_url().'activate-job-provider/'.$member_id.'" onclick="return confirm(\'Do you want to activate '.$fname.'?\');">Activate</a>';
				}
				//create activated status display
				else if($row->member_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-info deactivate_job_provider" href="'.site_url().'deactivate-job-provider/'.$member_id.'" onclick="return confirm(\'Do you want to deactivate '.$fname.'?\');">Deactivate</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$row->member_first_name.' '.$row->member_last_name.'</td>
						<td>'.$row->member_phone.'</td>
						<td>'.$row->member_email.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->created)).'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->last_login)).'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'provider-profile/'.$member_id.'" class="btn btn-sm btn-success">View Profile</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'reset-member-password/'.$member_id.'" class="btn btn-sm btn-warning" onclick="return confirm(\'Do you want to reset '.$fname.'\'s password?\');">Reset Password</a></td>
						<td><a href="'.site_url().'delete-member/'.$member_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$fname.'?\');">Delete</a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no providers";
		}
		
		echo $result;
?>

