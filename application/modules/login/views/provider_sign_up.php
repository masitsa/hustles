<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Stylesheets -->
  <link href="<?php echo base_url()."assets/themes/bluish/";?>style/bootstrap.css" rel="stylesheet">
  <link rel="<?php echo base_url()."assets/themes/bluish/";?>stylesheet" href="style/font-awesome.css">
  <link href="<?php echo base_url()."assets/themes/bluish/";?>style/style.css" rel="stylesheet">
  
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

</head>

<body class="login">

<!-- Form area -->
<div class="register-form">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <!-- Widget starts -->
            <div class="logo"><a href="<?php echo base_url();?>provider-sign-up" class="navbar-brand"> <span class="bold">Job</span> Provider Sign Up</a></div>
            <div class="widget">
              <!-- Widget head -->
              <div class="widget-head">
                  Create an Account
              </div>

              <div class="widget-content">
                <div class="padd">
                	<!-- Login Errors -->
                    <?php
					if(isset($error)){
                    	echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
					}
					?>
                  <!-- Login form -->
                  <?php 
				  echo form_open($this->uri->uri_string(),"class='form-horizontal'"); 
				  ?>
				  <div class="row">
				  	<div class="col-md-12">
				  		<div class="col-md-6">
		                    <!-- Email -->
		                    <div class="form-group">
		                        <i class="icon-user"></i>
		                        <input type="text" class="form-control" id="" name="member_first_name" placeholder="First Name">
		                    </div>
		                    <!-- Password -->
		                    <div class="form-group">
		                        <i class="icon-lock"></i>
		                        <input type="text" class="form-control" name="member_other_name" placeholder="Other Names">
		                    </div>
		                    <!-- Remember me checkbox and sign in button -->
		                    <div class="form-group">
		                        <i class="icon-lock"></i>
		                        <input type="text" class="form-control" name="member_phone" placeholder="Phone Number">
		                    </div>
		                     <div class="form-group">
		                        <i class="icon-lock"></i>
		                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
		                    </div>
		                      
		                </div>
		                   <div class="col-md-6">
		                    <!-- Email -->
		                    <div class="form-group">
		                        <i class="icon-user"></i>
		                        <input type="text" class="form-control" id="inputUsername" name="member_username" placeholder="Username">
		                    </div>
		                    <!-- Password -->
		                    <div class="form-group">
		                        <i class="icon-lock"></i>
		                        <input type="password" class="form-control" id="inputPassword" name="member_password" placeholder="Password">
		                    </div>
		                    <div class="form-group">
		                        <i class="icon-lock"></i>
		                        <input type="password" class="form-control" id="inputConfirmPassword" name="member_confirm_password" placeholder="Confirm Password">
		                    </div>
		                    <!-- Remember me checkbox and sign in button -->
		                      <div class="form-actions">
		                         
		                          <button class="submit btn btn-primary pull-right" type="submit">
		                             Create Account
		                              <i class="icon-angle-right"></i>
		                          </button>
		                      </div>
		                   </div>
	                  
	                 </div>
	               </div>
	                   <br />
                  <?php echo form_close();?>
				  
				</div>
                </div>
              
                <div class="widget-foot">
                  Already have account ? <a href="<?php echo base_url();?>login-provider" class="reset_password">Click here to login</a>
                  <form class="form-horizontal hide_section" action="<?php echo site_url()."login/forgot_password/1";?>" id="forgot_password">
                    <!-- Email -->
                    <div class="form-group">
                        <i class="icon-user"></i>
                        <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                      <div class="form-actions">
                          <button class="submit btn btn-primary pull-right" type="submit">
                              Reset Password
                              <i class="icon-angle-right"></i>
                          </button>
                      </div>
                    <br />
                  </form>
                </div>
            </div>
      </div>
    </div>
  </div> 
</div>
	
		

<!-- JS -->
<script src="<?php echo base_url()."assets/themes/bluish/";?>js/jquery.js"></script>
<script src="<?php echo base_url()."assets/themes/bluish/";?>js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).on("click","a.reset_password",function(){
		
		$( "#forgot_password" ).removeClass( "hide_section" );
		$( "#forgot_password" ).addClass( "show_section" );
	});
</script>
</body>
</html>