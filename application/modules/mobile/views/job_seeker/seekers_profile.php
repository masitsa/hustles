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
			$job_seeker_id = $key->job_seeker_id;
		}
		
		$total_amount_payable = $this->advertising_model->calculate_amount_payable2($job_seeker_id);
		$total_advert_amount = $this->advertising_model->calculate_total_advert_amount();

		$result = 
		'
			<div class="aboutpage">
			    <div class="about-text-bottom">
			      <div class="row">
			      	<div class="row">
			      		
			            <div class="col-60">
					<strong>Name:</strong><br> '.$job_seeker_last_name.' <br>
					<strong>Phone:</strong><br> '.$job_seeker_phone.'<br>
					
			            </div>
			             <div class="col-40">
			             	<strong>Email:</strong><br> '.$job_seeker_email.'
			             </div>
			         </div>
			        </div>
			      </div>
			    </div>
			    
			    <div class="row">
		    		<div class="col-100 tablet-50">
					<div class="total-revenue">
						<div class="row" style="padding-left:10px;padding-right:10px;">
						<!-- <div class="t-revenue-title"><h2>Total Revenue</h2></div> -->
							<div class="total-sale pull-left">
								<h4 style="font-size:1em;">Total Earnings</h4>
								<h2 style="font-size:0.8em;">KES. '.number_format($total_amount_payable,0).'</h2>
							</div>
							<div class="total-sale pull-right">
								<h4 style="font-size:1em;">Total Payments</h4>
								<h2 style="font-size:0.8em;">KES. 0</h2>
							</div>
						</div>
					</div>	
				</div>
			    </div>
			    <a class="back link" onClick="myStopFunction();get_adverts();" href="#">
			    <!--<div class="accordin-title" ><h3>Money will be remitted after two weeks</h3></div>-->
			   </a>
		';
	}
echo $result;
?>