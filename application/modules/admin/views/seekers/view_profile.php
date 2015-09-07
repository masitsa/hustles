<!-- start of dsiplay of profile details -->
<?php 
	$v_data['seekers_array'] = $seekers;
	$v_data['seeker_id'] = $seeker_id;
?>

<?php echo $this->load->view('profile_details', $v_data, TRUE);?>
<!-- end of display of profile -->




<!-- start of search function of a job -->
<?php echo $this->load->view('search/search_jobs', $v_data, TRUE);?>

<!-- end of search -->


<?php //echo $this->load->view('notifications_tab', $v_data, TRUE);?>

<!-- start display of jobs created by provider -->

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
		if ($jobs->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Job Category</th>
					  <th>Job From</th>
					  <th>Destination</th>
					  <th>Destination Contact</th>
					  <th>Date Created</th>	
					  <th>Completed</th>					  
					  <th>Status</th>
					  <th colspan="2">Actions</th>
					</tr>
				  </thead>
				  <tbody>
			';
			foreach ($jobs->result() as $row)
			{
				$job_id = $row->job_id;
				$job_title = $row->job_title;
				//create deactivated status display
				if($row->job_status == 0)
				{
					$status = '<span class="label label-important">Not Assigned</span>';
				}
				else
				if($row->job_status == 1)
				{
					$status = '<span class="label label-info">Pending</span>';
				}
				//create activated status display
				else if($row->job_status == 2)
				{
					$status = '<span class="label label-success">Completed</span>';
				}
				else if($row->job_status == 3)
				{
					$status = '<span class="label label-danger">Canceled</span>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$row->job_category_name.' </td>
						<td>'.$row->job_start_location.' </td>
						<td>'.$row->job_destination.'</td>
						<td>'.$row->contact_person_name.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->created)).'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->completed)).'</td>
						<td>'.$status.'</td>
						<td>
							<a  class="btn btn-sm btn-success" id="open_job_detail'.$job_id.'" onclick="get_job_detail('.$job_id.');">View Job Details</a>
							<a  class="btn btn-sm btn-info" id="close_job_detail'.$job_id.'" style="display:none;" onclick="close_job_detail('.$job_id.');">Close Job Detail</a></td>
						</td>
						<td><a href="'.site_url().'delete-member/'.$job_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$job_title.'?\');">Delete</a></td>
					</tr> 
				';
				$v_data['job_id'] = $job_id;
				$result .=
						'<tr id="job_detail'.$job_id.'" style="display:none;">

							<td colspan="10">'.$this->load->view("jobs/seeker_job_details", $v_data, TRUE).'</td>
						</tr>';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no jobs created by the job provider";
		}
		
		echo $result;
?>
<!-- end of job_created by the provider-->

  <script type="text/javascript">

	function get_job_detail(job_id){

		var myTarget2 = document.getElementById("job_detail"+job_id);
		var button = document.getElementById("open_job_detail"+job_id);
		var button2 = document.getElementById("close_job_detail"+job_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		button2.style.display = '';
	}
	function close_job_detail(job_id){

		var myTarget2 = document.getElementById("job_detail"+job_id);
		var button = document.getElementById("open_job_detail"+job_id);
		var button2 = document.getElementById("close_job_detail"+job_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
	}
  </script>