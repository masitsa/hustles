<?php
// var_dump($seekers);
foreach ($seekers_array as $seekers_row)
{

		$job_seeker_first_name =  $seekers_row->job_seeker_first_name;
		$job_seeker_last_name =  $seekers_row->job_seeker_last_name;
		$job_seeker_email =  $seekers_row->job_seeker_email;
		$job_seeker_phone =  $seekers_row->job_seeker_phone;
		$job_seeker_national_id =  $seekers_row->job_seeker_national_id;
		$job_seeker_membership_no =  $seekers_row->job_seeker_membership_no;
		$job_seeker_status =  $seekers_row->job_seeker_status;
		$job_seeker_id =  $seekers_row->job_seeker_id;

	
}

	
?>
  <style type="text/css">
  	.add-on{cursor:pointer;}
  </style>
  <link href="<?php echo base_url()."assets/themes/jasny/css/jasny-bootstrap.css"?>" rel="stylesheet"/>
  <div class="padd">
    <!-- Adding Errors -->
    <?php
    if(isset($error)){
        echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
    }
	
	//the post details
	$post_status = 1;
	
    ?>
    
   	<div class="row">
   		<div class="col-sm-8">
       		<div class="col-sm-4">
       			 <div class="form-group">
		                <div class="col-lg-4">
		                    <div class="row">
		                    	<div class="col-md-4 col-sm-4 col-xs-4">
		                        	<div class="fileinput fileinput-new" data-provides="fileinput">
		                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
		                                    <img src="">
		                                </div>
		                                
		                            </div>
		                        </div>
		                    </div>
		                    
		                </div>
		            </div>
		      </div>
		      <div class="col-sm-6">
		      	<div class="row">
		      		 <div class="form-group">
		                <label class="col-lg-5 control-label">Name</label>
		                <div class="col-lg-6">
		                	<?php echo $job_seeker_first_name.' '.$job_seeker_last_name;?>
		                </div>
		            </div>
		         </div>
		        <div class="row">
		            <div class="form-group">
		                <label class="col-lg-5 control-label">Phone Number</label>
		                <div class="col-lg-6">
		                	<?php echo $job_seeker_phone;?>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="form-group">
		                <label class="col-lg-5 control-label">Email Address</label>
		                <div class="col-lg-6">
		                	<?php echo $job_seeker_email;?>
		                </div>
		            </div>
		        </div>
		     	<div class="row">
		            <div class="form-group">
		                <label class="col-lg-5 control-label">Activation Status</label>
		                <div class="col-lg-6">
		                	<?php
		                	if($job_seeker_status == 1)
		                	{
		                		?>
		                		<span class="label label-success">Active</span>
		                		<?php
		                	}
		                	else if($job_seeker_status == 2)
		                	{
		                		?>
		                		<span class="label label-danger">Deactivated</span>
		                		<?php
		                	}
		                	else
		                	{
		                		?>
		                		<span class="label label-warning">Not Active</span>
		                		<?php
		                	}
		                	?>
		                	
		                </div>
		            </div>
		        </div>
		      </div>

   		</div>
   		<div class="col-sm-4">
   			<?php
   			$no_of_requests = number_format($this->users_model->get_no_of_requests($job_seeker_id), 0, '.', ',');
   			$no_of_awarded_requests = number_format($this->users_model->get_no_of_awarded_requests($job_seeker_id), 0, '.', ',');
   			$no_od_completed_jobs = number_format($this->users_model->get_no_of_completed_jobs($job_seeker_id), 0, '.', ',');
   			$no_of_pending_jobs = number_format($this->users_model->get_no_of_pending_jobs($job_seeker_id), 0, '.', ',');
   			?>
			       
            <table class="table table-striped table-hover table-condensed">
            	<thead>
                	<tr>
                    	<th>Item Title</th>
                        <th>Counts</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>No. of Requests</th>
                        <td><?php echo $no_of_requests?></td>
                    </tr>
                    <tr>
                        <th>No. of Request Awarded</th>
                        <td><?php echo $no_of_awarded_requests;?></td>
                    </tr>
                    <tr>
                        <th>No. of Completed Jobs</th>
                        <td><?php echo $no_od_completed_jobs;?></td>
                    </tr>
                    <tr>
                        <th>No. of Pending Jobs</th>
                        <td><?php echo $no_of_pending_jobs;?></td>
                    </tr>
                </tbody>
            </table>
            <!-- Text -->
            <div class="datas-text">
            	<!-- Total Visits <span class="bold"><?php echo number_format(4000, 0);?></span> -->
            </div>
            
            <div class="clearfix"></div>
			           
			  
       </div>
      </div>
    <br />
</div>