	
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
<?php echo $this->load->view('provider/jobs/job_detail_header', $v_data, TRUE);?>
<!-- end of display of profile -->




<!-- start of search function of a job -->
<?php echo $this->load->view('provider/search/search_applicants', $v_data, TRUE);?>


<div class="row">

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
						  <th colspan="1">Actions</th>
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
						$identification_card =  $job_applicants_row->identification_card;
						$job_seeker_membership_no =  $job_applicants_row->job_seeker_membership_no;
						$job_seeker_request_status =  $job_applicants_row->job_seeker_request_status;
						$job_seeker_status =  $job_applicants_row->job_seeker_status;

						if($job_seeker_request_status == 1)
						{
							$assigned_status =  '<span class="label label-success">Assigned</span>';
							$button = '<a href="'.site_url().'un-assign-task/'.$job_id.'" class="btn btn-sm btn-warning" onclick="return confirm(\'Do you really want to unasign this job from '.$job_seeker_first_name.'?\');">Unassign Job</a>';
						}
						else
						{
							$assigned_status =  '<span class="label label-info">Not assigned to</span>';
							$button = '<a href="'.site_url().'assign-task/'.$job_id.'" class="btn btn-sm btn-success" onclick="return confirm(\'Do you really want to delete '.$job_id.'?\');">Assign Job</a>';

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
								<td>'.$button.'</td>
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