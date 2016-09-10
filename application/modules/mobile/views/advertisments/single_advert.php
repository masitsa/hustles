<?php
$result = '';
if($advertisments->num_rows() > 0)
{
	foreach ($advertisments->result() as $key) {
		# code...
		$advert_id = $key->advert_id;
		$advert_title = $key->advert_title;
		$company_name = $key->company_name;
		$balance = $key->balance;
		$advert_amount = $key->advert_amount;
		$advert_views = $key->advert_views;
		$company_name = $key->company_name;
		$advert_link = $key->advert_link;
		$balance = $key->balance;
		$advert_amount = $key->advert_amount;
		$advert_time = $key->advert_time;
		$advert_views = $this->advertising_model->get_advert_views($advert_id);
		if($advert_views == NULL)
		{
			$advert_views = 0;
			$views = 1;
		}
		else
		{
			$views = $advert_views;
		}
		
		if($advert_views == 1)
		{
			$title = 'view';
		}
		else
		{
			$title = 'views';
		}
		
		$total_amount  =0;
		$total_payable_amount = $this->advertising_model->calculate_amount_payable($advert_id, $job_seeker_id, $advert_time, $advert_amount);
		$total_time_watched  =0;
		$session_time  =0;
	}
	$time_to_watch = (0.75*$advert_time)/60000;
	
	$ad_amount = '';
	$pay_amount = '';
	if($advert_amount > 0)
	{
		$ad_amount = '<div class="col-50" padding: 2%;">
							<h4 style="background-color:#b39ddb; color:#424242; font-size: 1em; text-align: center; border-radius: 10px;">KES. '.number_format($advert_amount).' <br/>Available  </h4>
						</div>';
		$pay_amount = '<div class="col-50" padding: 2%;">
							<h4 style="background-color:#ffcc80; color:#424242; font-size: 1em; text-align: center; border-radius: 10px;">KES. '.number_format($total_payable_amount).'<br/>  Earning</h4>
						</div>';
	}
	
	$result .='
		        <div class="content-block-inner">
		          <p style="text-align:center;">'.ucwords($advert_title).'</p>
		          	<div class="row">
		          		<h3 style="color: grey;font-size: 1em;font-style: italic;padding: 2%;text-align:center;">** You have to watch the entire video to be rewarded </h3>
						'.$ad_amount.' 
						'.$pay_amount.'
					</div>
		          	<!--<h3 style="background-color:#EF7411;color:#ffffff;font-size: 0.8em; padding: 2%;">You have to watch at least  '.$time_to_watch.' minutes to make your money </h3>-->
					
		        </div>
		      
			  ';
}


echo $result;


?>