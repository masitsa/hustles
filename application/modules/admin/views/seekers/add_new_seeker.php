          
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
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
            ?>
            
           <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
            	<div class="col-md-12">
            		<div class="col-md-6">
            			  <div class="form-group">
	                        <label class="col-lg-4 control-label">Post Image</label>
	                        <div class="col-lg-8">
	                            
	                            <div class="row">
	                            
	                            	<div class="col-md-8 col-sm-8 col-xs-8">
	                                	<div class="fileinput fileinput-new" data-provides="fileinput">
	                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:150px; height:150px;">
	                                            <img src="http://placehold.it/150x150">
	                                        </div>
	                                        <div>
	                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="post_image"></span>
	                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            
	                        </div>
	                    </div>
            			
			           
			            
            		</div>
            		<div class="col-md-6">
            			 <!-- First Name -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">First Name</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_first_name" placeholder="First Name" value="<?php echo set_value('job_seeker_first_name');?>">
			                </div>
			            </div>
			            <!-- Other Names -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Other Names</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_other_names" placeholder="Other Names" value="<?php echo set_value('job_seeker_other_names');?>">
			                </div>
			            </div>

			            <div class="form-group">
			                <label class="col-lg-3 control-label">National Identity</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_national_id" placeholder="National id Number" value="<?php echo set_value('job_seeker_national_id');?>">
			                </div>
			            </div>
			            
            			
            		</div>
            	</div>
            </div>
            <div class="row">
            	<div class="col-md-12">

            		<div class="col-md-6">
            			<h4>Account details</h4>
            			<div class="form-group">
			                <label class="col-lg-3 control-label">Username</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_username" placeholder="Username" value="<?php echo set_value('job_seeker_username');?>">
			                </div>
			            </div>
            			<!-- Email -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Email</label>
			                <div class="col-lg-9">
			                	<input type="email" class="form-control" name="job_seeker_email" placeholder="Email Address" value="<?php echo set_value('job_seeker_email');?>">
			                </div>
			            </div>
			           <div class="form-group">
			                <label class="col-lg-3 control-label">Phone</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_phone" placeholder="Phone Number" value="<?php echo set_value('job_seeker_phone');?>">
			                </div>
			            </div>
			            
            		</div>
            		<div class="col-md-6">
            			<h4>Postal address information</h4>
            			 <!-- Address -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Address</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_address" placeholder="Postal Address" value="<?php echo set_value('job_seeker_address');?>">
			                </div>
			            </div>
			            <!-- Postal Code -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Postal Code</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_post_code" placeholder="Postal Code" value="<?php echo set_value('job_seeker_post_code');?>">
			                </div>
			            </div>
			            <!-- City -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">City</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_city" placeholder="City" value="<?php echo set_value('job_seeker_city');?>">
			                </div>
			            </div>
            		</div>
            	</div>

            </div>
            <div class="row">
            	<div class="col-md-12">
            	<h4>Next of Kin Information</h4>
            		<div class="col-md-6">
            			<h4>Personal information</h4>
            			<div class="form-group">
			                <label class="col-lg-3 control-label">First Name</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_kin_first_name" placeholder="Next of Kin Name" value="<?php echo set_value('job_seeker_next_of_kin_first_name');?>">
			                </div>
			            </div>
            			<!-- Email -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Other Names</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_last_name" placeholder="Next of Kin Other names" value="<?php echo set_value('job_seeker_next_of_last_name');?>">
			                </div>
			            </div>
			            <!-- Password -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">National Identity</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_kin_identity" placeholder="Identity Number" value="<?php echo set_value('job_seeker_next_of_kin_identity');?>">
			                </div>                
			            </div>
			            
            		</div>
            		<div class="col-md-6">
            			<h4>Contact Information</h4>
            			<div class="form-group">
			                <label class="col-lg-3 control-label">Phone Number</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_kin_phone" placeholder="Next of Kin Phone" value="<?php echo set_value('next_of_kin_phone');?>">
			                </div>
			            </div>
            			 <!-- Address -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Address</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_kin_address" placeholder="Next of Kin Address" value="<?php echo set_value('next_of_kin_address');?>">
			                </div>
			            </div>
			            <!-- Postal Code -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Postal Code</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_kin_postal_code" placeholder="Next of Kin Postal Code" value="<?php echo set_value('next_of_kin_postal_code');?>">
			                </div>
			            </div>
			            <!-- City -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">City</label>
			                <div class="col-lg-9">
			                	<input type="text" class="form-control" name="job_seeker_next_of_kin_city" placeholder="Next of Kin City" value="<?php echo set_value('next_of_kin_city');?>">
			                </div>
			            </div>
            		</div>
            	</div>

            </div>
            <div class="row">
            	<div class="form-actions center-align">
	                <button class="submit btn btn-primary" type="submit">
	                    Add new job seeker
	                </button>
	            </div>
            </div>

					          
					            
					          
            <br />
            <?php echo form_close();?>
		</div>