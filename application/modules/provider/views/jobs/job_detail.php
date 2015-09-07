	
<?php
	$job_details = $this->jobs_model->get_job_details($job_id);

	//if providers exist display them
	if ($job_details->num_rows() > 0)
	{
		foreach ($job_details->result() as $job_detail_row)
		{

			$job_id = $job_detail_row->job_id;
			$job_category_name = $job_detail_row->job_category_name;
			$job_start_location = $job_detail_row->job_start_location;
			$job_destination = $job_detail_row->job_destination;

			$contact_person_name = $job_detail_row->contact_person_name;
			$contact_person_email = $job_detail_row->contact_person_email;
			$contact_person_phone = $job_detail_row->contact_person_phone;
			$completed = $job_detail_row->completed;
			$created = $job_detail_row->created;
			$job_status = $job_detail_row->job_status;
			$job_description = $job_detail_row->job_description;
			$job_title = $job_detail_row->job_title;

			$last_modified = $job_detail_row->last_modified;

			
		}

	}

	$job_applicants = $this->jobs_model->get_job_applicants($job_id);

	//if providers exist display them
	if ($job_applicants->num_rows() > 0)
	{
		foreach ($job_applicants->result() as $job_applicants_row)
		{

				$job_seeker_first_name =  $job_applicants_row->job_seeker_first_name;
				$job_seeker_last_name =  $job_applicants_row->job_seeker_last_name;
				$job_seeker_email =  $job_applicants_row->job_seeker_email;
				$job_seeker_phone =  $job_applicants_row->job_seeker_phone;
				$identification_card =  $job_applicants_row->identification_card;
				$job_seeker_membership_no =  $job_applicants_row->job_seeker_membership_no;

				$job_seeker_status =  $job_applicants_row->job_seeker_status;

			
		}

	}




?>
	<div class="row">
		<div class="col-sm-12">
			
	   		<div class="col-sm-6">
	   			<h4>Job Details</h4>
	       		<div class="col-sm-12">
	       			 <div class="row">
			      		 <div class="form-group">
			                <label class="col-lg-5 control-label">Job Category</label>
			                <div class="col-lg-6">
			                	<?php echo $job_category_name;?>
			                </div>
			            </div>

			         </div>
			         <div class="row">
			         	  <div class="form-group">
			                <label class="col-lg-5 control-label">Job Title</label>
			                <div class="col-lg-6">
			                	<?php echo $job_title;?>
			                </div>
			            </div>
			            		         	
			         </div>
			         <div class="row">
			         	<div class="form-group">
			                <label class="col-lg-5 control-label">Job Description</label>
			                <div class="col-lg-6">
			                	<?php echo $job_description;?>
			                </div>
			            </div>
			            
			         </div>
			         <div class="row">
			         	<div class="form-group">
			                <label class="col-lg-5 control-label">From:</label>
			                <div class="col-lg-6">
			                	<?php echo $job_start_location;?>
			                </div>
			            </div>
			         </div>
			         
			         <div class="row">
			         	<div class="form-group">
			                <label class="col-lg-5 control-label">Job Status:</label>
			                <div class="col-lg-6">
			                	<?php
			                	if($job_status == 0)
								{
									$status = '<span class="label label-important">Not Assigned</span>';
								}
								else
								if($job_status == 1)
								{
									$status = '<span class="label label-info">Pending</span>';
								}
								//create activated status display
								else if($job_status == 2)
								{
									$status = '<span class="label label-success">Completed</span>';
								}
								else if($job_status == 3)
								{
									$status = '<span class="label label-danger">Canceled</span>';
								}
								else
								{
									$status = '<span class="label label-important">Not Assigned</span>';
								}
								echo $status;
			                	?>
			                	
			                </div>
			            </div>
			         </div>
			         
			    </div>

			    


	   		</div>
	   		<div class="col-sm-6">
	   			
	   			<h4>Contact Person Details</h4>
				 <div class="row">
			      		 <div class="form-group">
			                <label class="col-lg-5 control-label">Contact Person Name</label>
			                <div class="col-lg-6">
			                	<?php echo $contact_person_name;?>
			                </div>
			            </div>
			        </div>
			        <div class="row">
			            <div class="form-group">
			                <label class="col-lg-5 control-label">Phone Number</label>
			                <div class="col-lg-6">
			                	<?php echo $contact_person_phone;?>
			                </div>
			            </div>
			        </div>
			        <div class="row">
			            <div class="form-group">
			                <label class="col-lg-5 control-label">Email Address</label>
			                <div class="col-lg-6">
			                	<?php echo $contact_person_email;?>
			                </div>
			            </div>
			        </div>
			         <div class="row">
			         	<div class="form-group">
			                <label class="col-lg-5 control-label">Destination:</label>
			                <div class="col-lg-6">
			                	<?php echo $job_destination;?>
			                </div>
			            </div>
			         </div>
			        
			     	
	            
				           
				  
	       </div>
	      </div>
	    <br />
	</div>
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
							  <th>Job Category</th>
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
							}
							else
							{
								$assigned_status =  '<span class="label label-info">Not assigned to</span>';
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
									<td><a href="'.site_url().'assign-task/'.$job_id.'" class="btn btn-sm btn-success" onclick="return confirm(\'Do you really want to delete '.$job_title.'?\');">Assign Job</a></td>
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