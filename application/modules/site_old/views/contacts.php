<?php 
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$phone = $contacts['phone'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$address = $contacts['address'];
		$city = $contacts['city'];
		$post_code = $contacts['post_code'];
		$building = $contacts['building'];
		$floor = $contacts['floor'];
		$location = $contacts['location'];
		$working_weekend = $contacts['working_weekend'];
		$working_weekday = $contacts['working_weekday'];
		
		if(!empty($email))
		{
			$mail = '<div class="top-number"><p><i class="fa fa-envelope-o"></i> '.$email.'</p></div>';
		}
		
		if(!empty($facebook))
		{
			$facebook = '<li><a href="'.$facebook.'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
		}
		
		if(!empty($twitter))
		{
			$twitter = '<li><a href="'.$twitter.'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
		}
		
		if(!empty($linkedin))
		{
			$linkedin = '<li><a href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
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
	}
?>
<div id="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 page-content">
                    <div id="contact-page-map" class="white-container"></div>

                    <div class="white-container mb0">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="bottom-line mt10">Headquarters</h5>

                                <address>
                                    Total Petrol Station <br>
                                    Hurlinghum RD <br>
                                    Nairobi
                                </address>

                                <p>
                                    Phone: <a href="tel:+11234567890">+1 123-456-7890</a> <br>
                                    Email: <a href="mailto:email@example.com">email@example.com</a>
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <h5 class="bottom-line mt10">Secondary Office</h5>

                                <address>
                                    47 Street anywhere <br>
                                    Anywhere<br>
                                    Nairobi
                                </address>

                                <p>
                                    Phone: <a href="tel:+11234567890">+2547000023242</a> <br>
                                    Email: <a href="mailto:email@example.com">info@smallhustles.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 page-sidebar">
                    <aside>
                        <div class="widget sidebar-widget white-container contact-form-widget">
                            <h5 class="widget-title">Send Us a Message</h5>

                            <div class="widget-content">
                                <p>Please get in touch with any question you want to ask.</p>

                                <form class="mt30">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Website">
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" placeholder="How can we help you?"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-default"><i class="fa fa-envelope-o"></i> Send Message</button>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div> <!-- end .container -->
    </div> <!-- end #page-content -->