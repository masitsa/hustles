<?php
$member_details = $this->providers_model->get_member($member_id);

if($member_details->num_rows() > 0)
{
	foreach ($member_details->result() as $key ) {
		# code...
		$member_first_name = $key->member_first_name;
		$member_last_name = $key->member_last_name;
		$member_phone = $key->member_phone;
		$member_status = $key->member_status;
		$member_email = $key->member_email;
		$member_status = $key->member_status;
	}
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
		                	<?php echo $member_first_name.' '.$member_last_name;?>
		                </div>
		            </div>
		         </div>
		        <div class="row">
		            <div class="form-group">
		                <label class="col-lg-5 control-label">Phone Number</label>
		                <div class="col-lg-6">
		                	<?php echo '+'.$member_phone;?>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="form-group">
		                <label class="col-lg-5 control-label">Email Address</label>
		                <div class="col-lg-6">
		                	<?php echo $member_email;?>
		                </div>
		            </div>
		        </div>
		     	<div class="row">
		            <div class="form-group">
		                <label class="col-lg-5 control-label">Activation Status</label>
		                <div class="col-lg-6">
		                	<?php
		                	if($member_status == 1)
		                	{
		                		echo '<span class="label label-success">Active</span>';
		                	}
		                	else
		                	{
		                		echo '<span class="label label-danger">Not Active</span>';
		                	}
		                	?>
		                	
		                </div>
		            </div>
		        </div>
		      </div>

   		</div>
   		<div class="col-sm-4">
			<?php
			$total_jobs = $this->providers_model->get_jobs_no($member_id,9);
			$pending_jobs = $this->providers_model->get_jobs_no($member_id,1);
			$completed_jobs = $this->providers_model->get_jobs_no($member_id,2);
			?>
            <table class="table table-striped table-hover table-condensed">
            	<thead>
                	<tr>
                    	<th>Item Title</th>
                        <th>Counter</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Total Jobs</th>
                        <td><?php echo $total_jobs;?></td>
                    </tr>
                    <tr>
                        <th>Pending Jobs</th>
                        <td><?php echo $pending_jobs;?></td>
                    </tr>
                    <tr>
                        <th>Completed Jobs</th>
                        <td><?php echo $completed_jobs;?></td>
                    </tr>
                   
                </tbody>
            </table>
            <!-- Text -->
           
            
            
            <div class="clearfix"></div>
			           
			  
       </div>
      </div>
    <br />
</div>