<?php
	$result = '';
	if($job_seeker_details->num_rows() > 0)
	{
		foreach ($job_seeker_details->result() as $key) {

			# code...
			$job_seeker_first_name = $key->job_seeker_first_name;
			$job_seeker_last_name = $key->job_seeker_last_name;
			$job_seeker_phone = $key->job_seeker_phone;
			$job_seeker_email = $key->job_seeker_email;
			$job_seeker_age = 28;
			$job_seeker_address = $key->job_seeker_address;
			$job_seeker_city = $key->job_seeker_city;
			$job_seeker_post_code = $key->job_seeker_post_code;
		}
		$result = 
		'
			<div class="aboutpage">
			    <div class="about-text-bottom">
			      <div class="row">
			      	<div class="row">
			      		<div class="col-50 tablet-33">
			      			<img src="img/about/about.jpg" alt="">
			      		</div>
			            <div class="col-50 tablet-33">
			              	<form >
								<strong>Name:</strong><br> '.$job_seeker_last_name.' '.$job_seeker_first_name.'<br>
								<strong>Phone:</strong><br> '.$job_seeker_phone.'<br>
								<strong>Email:</strong><br> '.$job_seeker_email.'<br>
								
							</form>
			            </div>
			         </div>
			        </div>
			      </div>
			    </div>

			    <div class="accordin-title"><h3> Watch as many advertisers as possible to earn more </h3></div>
			    <div class="row">
			    		<div class="col-100 tablet-50">
							<div class="total-revenue">
								<div class="row" style="padding-left:10px;padding-right:10px;">
								<!-- <div class="t-revenue-title"><h2>Total Revenue</h2></div> -->
									<div class="total-sale pull-left">
										<h4>Total Earnings</h4>
										<h2>KES. 700.00</h2>
									</div>
									<div class="total-sale pull-right">
										<h4>Total Withdrawals</h4>
										<h2>KES. 700.00</h2>
									</div>
								</div>
								<br>
								<div class="total-sale">
									<h4>Account Balance</h4>
									<h2>KES. 0.00</h2>
								</div>
								<div class="col-100 tablet-50">
									<div class="total-sale-list">
										<ul>
											<li>
												<h5>Advertisers</h5>
												<h4>KES. 200.00</h4>
											</li>
											<li>
												<h5>Jobs</h5>
												<h4>KES. 500.00</h4>
											</li>
											<li>
												<h5>Bonuses</h5>
												<h4>KES. 0.00</h4>
											</li>						
										</ul>
									</div>
								</div>
							</div>	
					</div>
			    </div>
				<div class="about-accordin">
				  	<div class="list-block">
					    <ul>
					      <li class="accordion-item"><a href="#" class="item-content item-link">
					          <div class="item-inner">
					            <div class="item-title">Request for Withdrawal</div>
					          </div></a>
					        <div class="accordion-item-content">
					          <div class="content-block">
					          		<div class="cart-contenttext">
					                   <form action="shopping-cart.html#">
											<div class="inputbox">
												Amount: <input type="text" name="amount" value="" placeholder="400" required>
											</div>
											<div class="inputbox">
												<button class="mybutton">SUBMIT REQUEST</button>
											</div>	
										</form>
									</div>
					          </div>
					        </div>
					      </li>
					    </ul>
					</div>
				</div>
		';
	}
echo $result;
?>
