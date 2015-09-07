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
				                	Martin Tarus
				                </div>
				            </div>
				         </div>
				        <div class="row">
				            <div class="form-group">
				                <label class="col-lg-5 control-label">Phone Number</label>
				                <div class="col-lg-6">
				                	0770827872
				                </div>
				            </div>
				        </div>
				        <div class="row">
				            <div class="form-group">
				                <label class="col-lg-5 control-label">Email Address</label>
				                <div class="col-lg-6">
				                	marttkip@gmail.com
				                </div>
				            </div>
				        </div>
				     	<div class="row">
				            <div class="form-group">
				                <label class="col-lg-5 control-label">Activation Status</label>
				                <div class="col-lg-6">
				                	<span class="label label-success">Active</span>
				                </div>
				            </div>
				        </div>
				      </div>

           		</div>
           		<div class="col-sm-4">
					       
	                <table class="table table-striped table-hover table-condensed">
	                	<thead>
	                    	<tr>
	                        	<th>Type</th>
	                            <th>Visits</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <th>Staff</th>
	                            <td><?php echo '1'?></td>
	                        </tr>
	                        <tr>
	                            <th>Students</th>
	                            <td><?php echo '1';?></td>
	                        </tr>
	                        <tr>
	                            <th>Insurance</th>
	                            <td><?php echo '1';?></td>
	                        </tr>
	                        <tr>
	                            <th>Other</th>
	                            <td><?php echo '1';?></td>
	                        </tr>
	                    </tbody>
	                </table>
	                <!-- Text -->
	                <div class="datas-text">
	                	Total Visits <span class="bold"><?php echo number_format(4000, 0);?></span>
	                </div>
	                
	                <div class="clearfix"></div>
					           
					  
		       </div>
		      </div>
            <br />
		</div>