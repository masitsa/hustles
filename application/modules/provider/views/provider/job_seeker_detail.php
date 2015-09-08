
<?php
// get the details for the delivery person
$delivery_person_query = $this->jobs_model->get_job_assigned_person($job_id);

if ($delivery_person_query->num_rows() > 0)
{
	foreach ($delivery_person_query->result() as $delivery_row)
	{

		$job_seeker_first_name =  $delivery_row->job_seeker_first_name;
		$job_seeker_last_name =  $delivery_row->job_seeker_last_name;
		$job_seeker_email =  $delivery_row->job_seeker_email;
		$job_seeker_phone =  $delivery_row->job_seeker_phone;
		$job_seeker_national_id =  $delivery_row->job_seeker_national_id;
		$job_seeker_membership_no =  $delivery_row->job_seeker_membership_no;

		$job_seeker_status =  $delivery_row->job_seeker_status;
		$completed =  $delivery_row->completed;
		$date_completed =  $delivery_row->date_completed;


	}
}
?>
<div class="col-sm-12">
	
	<div class="col-sm-8">
		<h4>Delivery Person Details</h4>
		
		
		<div class="col-sm-5">
   			 <div class="form-group">
            	<div class="col-md-12 col-sm-12 col-xs-12">
                	<div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                            <img src="">
                        </div>
                        
                    </div>
                </div>
	         </div>
	      </div>
	      <div class="col-sm-7">
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
	                <label class="col-lg-5 control-label">National Id</label>
	                <div class="col-lg-6">
	                	<?php echo $job_seeker_national_id;?>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="form-group">
	                <label class="col-lg-5 control-label">Member No</label>
	                <div class="col-lg-6">
	                	<span><?php echo $job_seeker_membership_no;?></span>
	                </div>
	            </div>
	        </div>

	     	<div class="row">
	            <div class="form-group">
	                <label class="col-lg-5 control-label">Account Status</label>
	                <div class="col-lg-6">
	                	<?php 
	                	if($job_seeker_status == 1)
	                	{
	                		?>
	                			<span class="label label-success">Active</span>
	                		<?php

	                	}
	                	else if($job_status)
	                	{
	                		?>
	                			<span class="label label-success">Not Active</span>
	                		<?php
	                	}
	                	?>
	                	
	                </div>
	            </div>
	        </div>
	      </div>
	</div>
	<div class="col-sm-4">
		<h4>Delivery Details</h4>
		
        <div class="row">
            <div class="form-group">
                <label class="col-lg-5 control-label">Delivery Status</label>
                <div class="col-lg-6">
                	<?php
                	if($completed == 0)
					{
						$status = '<span class="label label-info">Pending</span>';
					}
					else
					if($completed == 1)
					{
						$status = '<span class="label label-success">completed</span>';
					}
					else if($completed == 3)
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
        <div class="row">
            <div class="form-group">
                <label class="col-lg-5 control-label">Delivery Time</label>
                <div class="col-lg-6">
                	<?php 
                	if($completed == 1)
                	{
                		?>
                		<span class="label label-success"><?php echo date('jS M Y H:i a',strtotime($date_completed))?></span>
                		<?php
                	}
                	else
                	{
                		?>
                		<span class="label label-info">Still Pending</span>
                		<?php

                	}
                	?>
                	
                </div>
            </div>
        </div>
        
	</div>
</div>