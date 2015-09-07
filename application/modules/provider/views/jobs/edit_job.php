<div class="row">

	<div class="col-sm-12">	
		<a href="<?php echo base_url();?>my-jobs" class="btn btn-sm btn-info pull-right" >Go back to my Jobs</a>
	</div>
</div>
          <div class="padd">
            <?php
				$error2 = validation_errors(); 
				if(!empty($error2)){?>
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger">
								<strong>Error!</strong> <?php echo validation_errors(); ?>
							</div>
						</div>
					</div>
				<?php }
				
				$attributes = array('role' => 'form', 'class' => 'form-horizontal');
		
				echo form_open($this->uri->uri_string(), $attributes);
				
				?>
                <div class="row">
                	<div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="slideshow_name">Job title</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="job_title" placeholder="Enter job title" value="<?php echo $row->job_title;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="job_start_location">Job Start Location</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="job_start_location" placeholder="Enter job title" value="<?php echo $row->job_start_location;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="job_destination">Job Destination</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="job_destination" placeholder="Enter job title" value="<?php echo $row->job_destination;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-4 control-label">Activate job?</label>
                            <div class="col-lg-4">
                                <div class="radio" class="form-control">
                                    <label>
                                        <?php
                                        if($row->job_status == 1){
                                        	echo '<input id="optionsRadios1" type="radio" checked value="1" name="job_status">';
                                        }else{
                                        	echo '<input id="optionsRadios1" type="radio" value="1" name="job_status">';
                                        }
                                        ?>
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <?php
                                        if($row->job_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="job_status">';}
                                        else{echo '<input id="optionsRadios1" type="radio" value="0" name="job_status">';}
                                        ?>
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
					</div>
                	<div class="col-md-6">
                    	<!-- Activate checkbox -->
                    	<div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_name">Contact Person Name</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_name" placeholder="Enter job title" value="<?php echo $row->contact_person_name;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_phone">Contact Person Phone</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_phone" placeholder="Enter job title" value="<?php echo $row->contact_person_phone;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_email">Contact Person Email</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_email" placeholder="Enter job title" value="<?php echo $row->contact_person_email;?>">
                            </div>
                        </div>
                       
                	</div>
                </div>
                
                <div class="row">
                	<div class="col-md-12">
                            <label class="col-md-2 control-label" for="job_description">Job description</label>
                            <div class="col-md-10">
                            	<textarea class="cleditor" name="job_description"><?php echo $row->job_description;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Edit job" class="login_btn btn btn-success btn-lg">
				</div>
				<?php
					form_close();
				?>
		</div>