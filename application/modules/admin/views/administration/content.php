 <div class="row">
    <div class="col-md-12">
    		<div class="col-md-6">
    			<div class="widget boxed">
                    <div class="widget-head">
                        <h4 class="pull-left"><i class="icon-reorder"></i>New Job Providers</h4>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                            <a href="#" class="wclose"><i class="icon-remove"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="widget-content">
    			<?php
    					$result ='';
    					$count = 0;
						$providers = $this->reports_model->get_latest_job_providers();
						//if providers exist display them
						if ($providers->num_rows() > 0)
						{
							
							$result .= 
							'
								<table class="table table-hover table-bordered ">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Name</th>
									  <th>Phone Number</th>
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
									$button = '<a class="btn btn-info" href="'.site_url().'activate-member/'.$member_id.'" onclick="return confirm(\'Do you want to activate '.$fname.'?\');">Activate</a>';
								}
								//create activated status display
								else if($row->member_status == 1)
								{
									$status = '<span class="label label-success">Active</span>';
									$button = '<a class="btn btn-info" href="'.site_url().'deactivate-member/'.$member_id.'" onclick="return confirm(\'Do you want to deactivate '.$fname.'?\');">Deactivate</a>';
								}
								$count++;
								$result .= 
								'
									<tr>
										<td>'.$count.'</td>
										<td>'.$row->member_first_name.' '.$row->member_last_name.'</td>
										<td>'.$row->member_phone.'</td>
										<td><a href="'.site_url().'provider-profile/'.$member_id.'" class="btn btn-sm btn-success">View Profile</a></td>
										<td>'.$button.'</td>
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
							$result .= "There are no new signup(s) providers";
						}
						
						echo $result;
    			?>
    				</div>
    			</div>
    		</div>
    		<div class="col-md-6">
    				<div class="widget boxed">
                    <div class="widget-head">
                        <h4 class="pull-left"><i class="icon-reorder"></i>New Job Providers</h4>
                        <div class="widget-icons pull-right">
                            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                            <a href="#" class="wclose"><i class="icon-remove"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="widget-content">
    			<?php
    					$seeker_result ='';
    					$count = 0;
						$seekers = $this->reports_model->get_latest_job_seekers();
						//if seekers exist display them
						if ($seekers->num_rows() > 0)
						{
							
							$seeker_result .= 
							'
								<table class="table table-hover table-bordered ">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Name</th>
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
									$button = '<a class="btn btn-info" href="'.site_url().'activate-job-seeker/'.$job_seeker_id.'" onclick="return confirm(\'Do you want to activate '.$fname.'?\');">Activate</a>';
								}
								//create activated status display
								else if($row->job_seeker_status == 1)
								{
									$status = '<span class="label label-success">Active</span>';
									$button = '<a class="btn btn-info" href="'.site_url().'deactivate-job-seeker/'.$job_seeker_id.'" onclick="return confirm(\'Do you want to deactivate '.$fname.'?\');">Deactivate</a>';
								}
								$count++;
								$seeker_result .= 
								'
									<tr>
										<td>'.$count.'</td>
										<td>'.$row->job_seeker_first_name.' '.$row->job_seeker_last_name.'</td>
										<td>'.$row->job_seeker_phone.'</td>
										<td><a href="'.site_url().'seeker-profile/'.$job_seeker_id.'" class="btn btn-sm btn-success">View Profile</a></td>
										<td>'.$button.'</td>
									</tr> 
								';
							}
							
							$seeker_result .= 
							'
										  </tbody>
										</table>
							';
						}
						
						else
						{
							$seeker_result .= "There are no seekers";
						}
						
						echo $seeker_result;
    			?>
    				</div>
    			</div>
    		</div>
    </div>
</div>