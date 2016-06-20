<?php
$result = '
<div class="row">
	<div class="col-80">
		<div class="total-revenue">
			<div class="t-revenue-title"><h2>Advertisment Kitty</h2></div>
			<div class="total-sale">
				<h2>KES. '.number_format($total_amount).'</h2>
			</div>
		</div>
	</div>
	<div class="col-20">
		<img src="img/kitty.gif">
	</div>
</div>
<div class="row">
';

if($advertisments->num_rows() > 0)
{
	$result .= '<table class="table table-bordered">';
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
		$time_to_watch = ($advert_time/60000) * 60;
		$advert_views = $this->advertising_model->get_advert_views($advert_id);
		if($this->advertising_model->check_watched($job_seeker_id, $advert_id, $advert_time))
		{
			$watched = '<div class="pro-content">
						<h4 style="background-color:#c8e6c9; color:#424242;">Watched</h4>
					</div>';
		}
		
		else
		{
			$watched = '';
		}
		//var_dump($watched);
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
		$total_payable_amount  = $this->advertising_model->calculate_amount_payable($advert_id, $job_seeker_id, $advert_time, $advert_amount);
		
		$result .= '
		<tr>
			<td colspan="2">'.$advert_title.'</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<!--<a class="pb-video" href="advert-single.html" onclick="get_advert_description('.$advert_id.', \''.$advert_link.'\');">-->
					<div class="video-box">                 
						<!--<img src="img/video/1.png" alt="">-->
						'.$watched.'
						<div class="youtube" id="'.$advert_link.'" advert_id="'.$advert_id.'"></div>
						<div class="pro-content"></div>
					</div>
				<!--</a>-->
				<div style="float:right; width:50%">
					<p>'.$time_to_watch.' seconds</p>
				</div>
				<div style="width:50%">
					<p>('.$advert_views.' '.$title.')</p>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				<div class="col-100">
					<div class="pro-content">
						<h4 style="background-color:#b39ddb; color:#424242;">KES. '.number_format($advert_amount).' <br/>Available</h4>
					</div>
				</div>
			</td>
			
			<td>
				<div class="col-100">
					<div class="pro-content">
						<h4 style="background-color:#ffcc80; color:#424242;">KES. '.number_format($total_payable_amount).'<br/> Made</h4>
					</div>
				</div>
			</td>
		</tr>';

	}
	
	$result .= '</table>';
}
else
{
	$result = '
			<div class="col-100">
			  	<p>No Adverts yet</p>
			  </div>';
}
$result .='</div>';
echo $result;
?>