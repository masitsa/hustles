<!-- Widget -->
<div class="widget boxed">
    <!-- Widget head -->
    <div class="widget-head">
        <h4 class="pull-left"><i class="icon-reorder"></i>Search Client One Jobs</h4>
        <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="icon-remove"></i></a>
        </div>
    
    	<div class="clearfix"></div>
    
    </div>             
    
    <!-- Widget content -->
    <div class="widget-content">
    	<div class="padd">
			
			<?php echo form_open("", array("class" => "form-horizontal"));?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Job Status : </label>
                        <div class="col-lg-8">
                          	<select class="form-control" name="job_status">
                        		<option>Select a Job status</option>
                        		<option>Completed</option>
                        		<option>Pending</option>
                        		<option>Canceled</option>
                        	</select>
                        </div>
                    </div>
                    <div class="row">
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Job Provider Name: </label>
	                        <div class="col-lg-8">
	                        	<input type="text" class="form-control" name="job_provider_name" placeholder="Name of Job Provider">
	                        </div>
	                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="row">
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">From: </label>
	                        <div class="col-lg-8">
	                        	<input type="text" class="form-control" name="job_start_locaiton" placeholder="From">
	                        </div>
	                    </div>
                    </div>
                    <div class="row">
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">To: </label>
	                        <div class="col-lg-8">
	                        	<input type="text" class="form-control" name="job_destination" placeholder="To">
	                        </div>
	                    </div>
                    </div>
                </div>
            </div>
            
            <div class="center-align">
            	<button type="submit" class="btn btn-info btn-lg">Search</button>
            </div>
            <?php
            echo form_close();
            ?>
    	</div>
    </div>
</div>