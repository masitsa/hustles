

    <div class="header-page-title">
        <div class="container">
            <h1>Sign In</h1>

            <ul class="breadcrumbs">
                <li><a href="<?php echo site_url().'home';?>">Home</a></li>
                <li><a href="#">Sign In</a></li>
            </ul>
        </div>
    </div>
    
    <div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 page-content">
					<div class="white-container sign-up-form">
                    	<?php
						$success = $this->session->userdata('success_message');
						$this->session->unset_userdata('success_message');
						
						$error = $this->session->userdata('error_message');
						$this->session->unset_userdata('error_message');
						
						if(!empty($error)){
							echo '<div class="alert alert-danger"> Oh snap! '.$error.'</div>';
						}
						
						if(!empty($success)){
							echo '<div class="alert alert-success">'.$success.'</div>';
						}
						?>
                        <div class="title-lines">
                            <h3 class="mt0"><?php echo $title;?></h3>
                        </div>
                    	<?php echo form_open($this->uri->uri_string());?>

                        <div class="row">
                            <div class="col-sm-6">
                        		<h6 class="label">Email</h6>
                                <input type="email" class="form-control" placeholder="Email" name="job_seeker_email">
                            </div>

                            <div class="col-sm-6">
                        		<h6 class="label">Password</h6>
                                <input type="password" class="form-control" placeholder="Password" name="job_seeker_password">
                            </div>
                        </div>
                        <div class="row" style="margin-top:2%;">
                            <div class="col-sm-6 col-sm-offset-6">
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-default btn-large pull-right">Sign In</button>
                                </div>
                            </div>
                        </div>
                    	<?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>