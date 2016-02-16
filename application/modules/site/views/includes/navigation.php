<?php
	$contacts = $this->site_model->get_contacts();
	
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$email2 = $contacts['email'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$phone = $contacts['phone'];
		
		if(!empty($email))
		{
			$email = '<div class="top-number"><p><i class="fa fa-envelope-o"></i> '.$email.'</p></div>';
		}
		
		if(!empty($facebook))
		{
			$twitter = '<li class="pm_tip_static_bottom" title="Twitter"><a href="#" class="fa fa-twitter" target="_blank"></a></li>';
		}
		
		if(!empty($facebook))
		{
			$linkedin = '<li class="pm_tip_static_bottom" title="Linkedin"><a href="#" class="fa fa-linkedin" target="_blank"></a></li>';
		}
		
		if(!empty($facebook))
		{
			$google = '<li class="pm_tip_static_bottom" title="Google Plus"><a href="#" class="fa fa-google-plus" target="_blank"></a></li>';
		}
		
		if(!empty($facebook))
		{
			$facebook = '<li class="pm_tip_static_bottom" title="Facebook"><a href="#" class="fa fa-facebook" target="_blank"></a></li>';
		}
	}
	else
	{
		$email = '';
		$facebook = '';
		$twitter = '';
		$linkedin = '';
		$logo = '';
		$company_name = '';
		$google = '';
	}
?>
  <header id="header" class="header-style-1">
        <div class="header-top-bar">
            <div class="container">

                <!-- Header Language -->
                <div class="header-language clearfix">
                    <ul>
                        <li class="active"><a href="">En</a></li>
                     
                    </ul>
                </div> <!-- end .header-language -->

                <!-- Bookmarks -->

                <!-- Header Register -->
                <?php
                if($this->session->userdata('job_seeker_login_status'))
                {
                    ?>
                     <a href="<?php echo site_url().'logout-seeker';?>" class="btn btn-link pull-right">Log out </a>
                    <a href="<?php echo site_url().'job-seeker-dashboard';?>" class="btn btn-link pull-right">Go to Dashboard</a>

                    <?php
                }
                else
                {
                ?>
                <div class="header-register">
                    <a href="<?php echo base_url();?>login-provider" class="btn btn-link">Job Seeker Login</a>
                    <div>
                            <?php 
                              echo form_open('job-seeker-login', "class='form-horizontal'"); 
                              ?>
                            <input type="email" class="form-control" placeholder="Email" name="job_seeker_email">
                            <input type="password" class="form-control" placeholder="Password" name="job_seeker_password">
                            <input type="submit" class="btn btn-default" value="Login">
                            <?php echo form_close();?>
                    </div>
                </div> <!-- end .header-register -->
                <?php
                }
                ?>

                <!-- Header Login -->
                <div class="header-login">
                    
                </div> <!-- end .header-login -->
                <a href="<?php echo site_url().'login-provider';?>" class="btn btn-link pull-right">Provider Login</a>

            </div> <!-- end .container -->
        </div> <!-- end .header-top-bar -->

        <div class="header-nav-bar">
            <div class="container">

                <!-- Logo -->
                <div class="css-table logo">
                    <div class="css-table-cell">
                        <a href="index.html">
                            <img src="img/header-logo.png" alt="">
                        </a> <!-- end .logo -->
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <a href="index.html#" id="mobile-menu-toggle"><span></span></a>

                <!-- Primary Nav -->
                <nav>
                    <ul class="primary-nav">
                        <?php echo $this->site_model->get_navigation();?>
                    </ul>
                </nav>
            </div> <!-- end .container -->

            <div id="mobile-menu-container" class="container">
                <div class="login-register"></div>
                <div class="menu"></div>
            </div>
        </div> <!-- end .header-nav-bar -->

        <div class="header-search-bar">
            <div class="container">
                <form>
                    <div class="basic-form clearfix">
                        <a href="index.html#" class="toggle"><span></span></a>

                        <div class="hsb-input-1">
                            <input type="text" class="form-control" placeholder="I'm looking for a ...">
                        </div>

                        <div class="hsb-text-1">in</div>

                        <div class="hsb-container">
                            <div class="hsb-input-2">
                                <input type="text" class="form-control" placeholder="Location">
                            </div>

                            <div class="hsb-select">
                                <select class="form-control">
                                    <option value="0">Select Category</option>
                                    <option value="">Category</option>
                                    <option value="">Category</option>
                                    <option value="">Category</option>
                                    <option value="">Category</option>
                                </select>
                            </div>
                        </div>

                        <div class="hsb-submit">
                            <input type="submit" class="btn btn-default btn-block" value="Search">
                        </div>
                    </div>

                    <div class="advanced-form">
                        <div class="container">
                            <div class="row">
                                <label class="col-md-3">Distance</label>

                                <div class="col-md-9">
                                    <div class="range-slider">
                                        <div class="slider" data-min="1" data-max="200" data-current="100"></div>
                                        <div class="last-value"><span>100</span> km</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Rating</label>

                                <div class="col-md-9">
                                    <div class="range-slider">
                                        <div class="slider" data-min="1" data-max="100" data-current="20"></div>
                                        <div class="last-value">&gt; <span>20</span> %</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Days Published</label>

                                <div class="col-md-9">
                                    <div class="range-slider">
                                        <div class="slider" data-min="1" data-max="60" data-current="30"></div>
                                        <div class="last-value">&lt; <span>30</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Location</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Switzerland">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3">Industry</label>

                                <div class="col-md-9">
                                    <select class="form-control">
                                        <option value="">Select Industry</option>
                                        <option value="">Option 1</option>
                                        <option value="">Option 2</option>
                                        <option value="">Option 3</option>
                                        <option value="">Option 4</option>
                                        <option value="">Option 5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- end .header-search-bar -->

        
    </header> <!-- end #header -->