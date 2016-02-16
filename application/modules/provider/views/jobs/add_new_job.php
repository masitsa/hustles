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
                            	<input type="text" class="form-control" name="job_title" placeholder="Job title" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="job_destination">Job Start Location</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="job_start_location" placeholder="Job title" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="job_destination">Pick up Point Detail</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="pick_up_location_detail" placeholder="i.e. Building name/ Floor" >
                            </div>
                        </div>
                         
					</div>
                	<div class="col-md-6">
                    	<!-- Activate checkbox -->
                    	<div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_name">Contact Person Name</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_name" placeholder="Contact Person Name" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_phone">Contact Person Phone</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_phone" placeholder="Contact Person Phone" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_phone">Delivery Location Detail</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="delivery_location_detail" placeholder="i.e. Building name/ Floor" >
                            </div>
                        </div>
                       
                	</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                            <div id="map_1" style=" height:400px"></div>
                           <input type="hidden" id="location" name="location" class="span12" >
                    </div>
                     <div class="col-md-6">
                            <div id="map_2" style=" height:400px"></div>
                           <input type="hidden" id="location_destination" name="location_destination" class="span12" >
                    </div>
                </div>
                
                <div class="row">
                	<div class="col-md-12">
                            <label class="col-md-2 control-label" for="job_description">Other Description</label>
                            <div class="col-md-10">
                            	<textarea class="cleditor" name="job_description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Post job" class="login_btn btn btn-success btn-lg">
				</div>
				<?php
					form_close();
				?>
		</div>