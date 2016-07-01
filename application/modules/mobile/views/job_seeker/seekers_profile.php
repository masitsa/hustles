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
		// $total_amount_payable = $this->advertising_model->calculate_amount_receipted($job_seeker_id);
		$total_invoiced = $this->advertising_model->calculate_amount_invoices($job_seeker_id);
		$total_receipted = $this->advertising_model->calculate_amount_receipted($job_seeker_id);

		$total_advert_amount = $this->advertising_model->calculate_total_advert_amount();
		$account_balance = $total_invoiced - $total_receipted;
		$result = 
		'	<div class="content-block-inner" id="total_earnings">
	        	<h3 class="center"> '.ucwords($job_seeker_last_name).' </h3>
	        	<div class="row">
	        		<div class="col-50">
	        			<h6>LIKELY EARNINGS</h6>
	        			<p>KES  '.number_format($total_amount_payable,2).'</p>
	        		</div>
	        		<div class="col-50">
	        			<h6>WITHDRAWABLE</h6>
	        			<p>KES  '.number_format($account_balance,2).'</p>
	        		</div>
	        	</div>
	        </div>
	        <div class="content-block">
				<div class="list-block">
				  <ul>
				    <li>
				    	<a href="dist/transactions.html" class="item-link item-content">
				        <div class="item-media"><i class="fa fa-money"></i></div>
				        <div class="item-inner">
				          <div class="item-title">MY TRANSACTIONS</div>
				        </div>
				        
				      </a>
				     </li>
				</ul>
		      </div>
		    </div>
	        <div class="content-block-inner">
	        	 <!-- Buttons row as tabs controller -->
			    <div class="buttons-row">
			      <!-- Link to 1st tab, active -->
			      <a href="#tab1" class="tab-link active button tab">REQUEST TO WITHDRAW</a>
			     
			    </div>
			  <!-- Tabs, tabs wrapper -->
			  <div class="tabs">
			    <!-- Tab 1, active by default -->
			    <div id="tab1" class="tab active">

			      <div class="content-block" id="profile_div">
			       <form id="request_form" method="post">
				        <div class="list-block">
						  <ul>
						    <!-- Text inputs -->
						    <li>
						      <div class="item-content">
						        <div class="item-inner">
						          <div class="item-title label">Amount (KES)</div>
						          <div class="item-input">
						            <input type="text" name="amount_to_withdraw" id="amount_to_withdraw" placeholder="e.g 1000" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
						          </div>
						        </div>
						      </div>
						    </li>
						    </ul>
						</div>
						 <p> KES. 33 transaction is applicable. Click to accept <input type="checkbox" name="accept" id="accept"> </p>
						<div class="row" style="margin-top:5px;">
							<div class="col-33"></div>
							<div class="col-33">
								<input type="submit" class="button active button-small" value="SUBMIT">
							</div>
							<div class="col-33"></div>
						</div>
					</form>
				</div>
				
			  </div>
	        </div>

	    </div>


		';
	}
echo $result;
?>