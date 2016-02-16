	
<!-- start of dsiplay of profile details -->
<div class="row">

	<div class="col-sm-12">	
		<a href="<?php echo base_url();?>my-jobs" class="btn btn-sm btn-info pull-right" >Go back to my Jobs</a>

	</div>
</div>
<?php 
	$v_data['job_applicants'] = $job_applicants;
	$v_data['job_id'] = $job_id;

?>
	<input type="hidden" name="job_id" value="<?php echo $job_id?>" id="job_id">
<?php echo $this->load->view('provider/jobs/job_detail_header', $v_data, TRUE);?>
<!-- end of display of profile -->




<!-- start of search function of a job -->
<?php echo $this->load->view('provider/search/search_applicants', $v_data, TRUE);?>


<div class="row">
	<?php
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
	?>

	<div class="col-sm-12">	
	<h4>Job Seeker Applicants</h4>
		<?php
			$job_applicants = $this->jobs_model->get_job_applicants($job_id);

			//if providers exist display them
			// var_dump($job_applicants);
			$result_two = '';
			if ($job_applicants->num_rows() > 0)
			{
				$counter = 0;
				$result_two .= 
				'
					<table class="table table-hover table-bordered ">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Job Seeker ID</th>
						  <th>Job From</th>
						  <th>Destination</th>
						  <th>Destination Contact</th>	
						  <th>Assigned to</th>
						  <th colspan="3">Actions</th>
						</tr>
					  </thead>
					  <tbody>
				';

				foreach ($job_applicants->result() as $job_applicants_row)
				{

						$job_seeker_first_name =  $job_applicants_row->job_seeker_first_name;
						$job_seeker_last_name =  $job_applicants_row->job_seeker_last_name;
						$job_seeker_email =  $job_applicants_row->job_seeker_email;
						$job_seeker_phone =  $job_applicants_row->job_seeker_phone;
						$job_seeker_national_id =  $job_applicants_row->job_seeker_national_id;
						$job_seeker_membership_no =  $job_applicants_row->job_seeker_membership_no;
						$job_seeker_request_status =  $job_applicants_row->job_seeker_request_status;
						$job_seeker_status =  $job_applicants_row->job_seeker_status;
						$job_seeker_id =  $job_applicants_row->job_seeker_id;


						if($job_seeker_request_status == 1)
						{
							$assigned_status =  '<span class="label label-success">Assigned</span>';
							$button = '<a  class="unassign_job btn btn-sm btn-warning" onclick="return confirm(\'Do you really want to unasign this job from '.$job_seeker_first_name.'?\');" href="'.site_url().'un-assign-task/'.$job_id.'/'.$job_seeker_id.'">Unassign Job</a>';
							$dispatch_button = '<a href="'.site_url().'disptach-job/'.$job_id.'" class="btn btn-sm btn-info" onclick="return confirm(\'Do you really want to dispatch the deliver sugin '.$job_seeker_first_name.'?\');">Dispatch</a>';
						}
						else
						{
							$assigned_status =  '<span class="label label-danger">Not assigned</span>';
							$button = '<a href="'.site_url().'assign-task/'.$job_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$job_id.'?\');">Assign Job</a>';
							$dispatch_button  ='';

						}

						

						$counter++;
						$result_two .= 
							'
								<tr>
									<td>'.$counter.'</td>
									<td>'.$job_seeker_membership_no.' </td>
									<td>'.$job_seeker_first_name.' '.$job_seeker_last_name.' </td>
									<td>'.$job_seeker_phone.' </td>
									<td>'.$job_seeker_email.'</td>
									<td>'.$assigned_status.'</td>
									<td>
										<a  class="btn btn-sm btn-success" id="open_job_seeker_detail'.$job_seeker_id.'" onclick="get_job_seeker_detail('.$job_seeker_id.');">View Job Details</a>
										<a  class="btn btn-sm btn-info" id="close_job_seeker_detail'.$job_seeker_id.'" style="display:none;" onclick="close_job_seeker_detail('.$job_seeker_id.');">Close Job Detail</a></td>
									</td>
									<td>'.$button.'</td>
									<td>'.$dispatch_button.'</td>
								</tr> 
							';
							$v_data['job_seeker_id'] = $job_seeker_id;
							$v_data['job_id'] = $job_id;
							$result_two .= 
							'
								<tr id="job_seeker_detail'.$job_seeker_id.'" style="display:none;">
									<td colspan="9">'.$this->load->view("provider/job_seeker_detail", $v_data, TRUE).'</td>
								</tr>
							';
				
				}
				$result_two .= 
					'
						  </tbody>
						</table>
					';
				
				
			}
			else
			{
				$result_two .= "";
			}
			echo $result_two;
		?>        
	</div>		
</div>
 <script type="text/javascript">

	function get_job_seeker_detail(job_seeker_id){

		var myTarget2 = document.getElementById("job_seeker_detail"+job_seeker_id);
		var button = document.getElementById("open_job_seeker_detail"+job_seeker_id);
		var button2 = document.getElementById("close_job_seeker_detail"+job_seeker_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		button2.style.display = '';
	}
	function close_job_seeker_detail(job_seeker_id){

		var myTarget2 = document.getElementById("job_seeker_detail"+job_seeker_id);
		var button = document.getElementById("open_job_seeker_detail"+job_seeker_id);
		var button2 = document.getElementById("close_job_seeker_detail"+job_seeker_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
	}
  </script>