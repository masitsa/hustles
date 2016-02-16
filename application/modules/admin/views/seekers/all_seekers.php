<?php echo $this->load->view('search/search_seekers', '', TRUE);?>
<div class="row">
	<div class="col-md-12">
		<a class="btn btn-success pull-right" href="<?php echo base_url();?>add-new-seeker" >Add New Job Seeker</a>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- Widget -->
		<div class="widget boxed">
		    <!-- Widget head -->
		    <div class="widget-head">
		        <h4 class="pull-left"><i class="icon-reorder"></i>Job Seekers</h4>
		        <div class="widget-icons pull-right">
		            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
		            <a href="#" class="wclose"><i class="icon-remove"></i></a>
		        </div>
		    
		    	<div class="clearfix"></div>
		    
		    </div>             
		    
		    <!-- Widget content -->
		    <div class="widget-content">
		    	<div class="padd">
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
							
							//if seekers exist display them
							if ($seekers->num_rows() > 0)
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
								foreach ($seekers->result() as $row)
								{
									$job_seeker_id = $row->job_seeker_id;
									$fname = $row->job_seeker_first_name;
									//create deactivated status display
									if($row->job_seeker_status == 0)
									{
										$status = '<span class="label label-important">Deactivated</span>';
										$button = '<a class="btn btn-primary activate_job_seeker" href="'.site_url().'activate-job-seeker/'.$job_seeker_id.'"  onclick="return confirm(\'Do you want to activate '.$fname.'?\');">Activate</a>';
									}
									//create activated status display
									else if($row->job_seeker_status == 1)
									{
										$status = '<span class="label label-success">Active</span>';
										$button = '<a class="btn btn-info deactivate_job_seeker" href="'.site_url().'deactivate-job-seeker/'.$job_seeker_id.'" onclick="return confirm(\'Do you want to deactivate '.$fname.'?\');">Deactivate</a>';
									}
									$count++;
									$result .= 
									'
										<tr>
											<td>'.$count.'</td>
											<td>'.$row->job_seeker_first_name.' '.$row->job_seeker_last_name.'</td>
											<td>'.$row->job_seeker_phone.'</td>
											<td>'.$row->job_seeker_email.'</td>
											<td>'.date('jS M Y H:i a',strtotime($row->created)).'</td>
											<td>'.date('jS M Y H:i a',strtotime($row->last_login)).'</td>
											<td>'.$status.'</td>
											<td><a href="'.site_url().'seeker-profile/'.$job_seeker_id.'" class="btn btn-sm btn-success">View Profile</a></td>
											<td>'.$button.'</td>
											<td><a href="'.site_url().'reset-job-seeker-password/'.$job_seeker_id.'" class="btn btn-sm btn-warning" onclick="return confirm(\'Do you want to reset '.$fname.'\'s password?\');">Reset Password</a></td>
											<td><a href="'.site_url().'delete-job-seeker/'.$job_seeker_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$fname.'?\');">Delete</a></td>
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
								$result .= "There are no seekers";
							}
							
							echo $result;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
