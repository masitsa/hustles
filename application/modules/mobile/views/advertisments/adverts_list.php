<?php
$result = '';

$result .= '<div style="margin-bottom:35px;">';
if($featured_advertisments->num_rows() > 0)
{
	foreach ($featured_advertisments->result() as $key_featured) {
		# code...
		
		$advert_id = $key_featured->advert_id;
		$advert_title = $key_featured->advert_title;
		$company_name = $key_featured->company_name;
		$balance = $key_featured->balance;
		$advert_amount = $key_featured->advert_amount;
		$company_name = $key_featured->company_name;
		$advert_link = $key_featured->advert_link;

		$balance = $key_featured->balance;
		$advert_amount = $key_featured->advert_amount;
		$advert_time = $key_featured->advert_time;
		$time_to_watch = ($advert_time/60000) * 60;
		$advert_views = $this->advertising_model->get_advert_views($advert_id);
		if($this->advertising_model->check_watched($job_seeker_id, $advert_id, $advert_time))
		{
			$watched = '<div class="pro-content">
						<h4 style="background-color:#c8e6c9; color:#424242;font-size: 1em; padding: 2px; text-align: center; border: thin solid #c8e6c9; border-radius: 10px; font-style:normal;">Watched</h4>
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
		$result .='
			<div class="card facebook-card">
				<div class="card-header" style="color: #ff7900; display: block; padding: 10px;">
					<div class="facebook-avatar" style="float: left;"><i class="fa fa-video-camera"></i></div>
					<div class="facebook-name" style="font-size: 14px; font-weight: 500; margin-left: 44px;">'.$advert_title.'</div>
					<div class="facebook-date" style="color: #8e8e93; font-size: 13px; margin-left: 44px;">KES. '.number_format($advert_amount).' Available</div>
				</div>
				<div class="card-content">
					<img src="http://img.youtube.com/vi/'.$advert_link.'/0.jpg" width="100%">
					<div class="card-content-inner" style="padding: 15px 10px; color:#000;">
						<div class="row">
							<div class="col-100">
								'.$watched.'
							</div>
						</div>
						
						<div class="row">
							<div class="col-50">
								<i class="fa fa-eye"></i> '.$advert_views.' '.$title.'
							</div>
							<div class="col-50">
								Kes. '.number_format($total_payable_amount).' Earned
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer" style="background:#ff7900;padding: 0;">
					<a href="dist/single-advert.html"  onclick="get_advert_description('.$advert_id.', \''.$advert_link.'\');" class="link" style="color: #fff !important; width: 100%; font-weight:bold; float:left;text-align:center; display:block;">Watch</a>
				</div>
			</div>';

	}
	
	
}
$result .= '</div>';


$result .= '<div style="margin-bottom:35px;">';
if($advertisments->num_rows() > 0)
{
	foreach ($advertisments->result() as $key) {
		# code...
		
		$advert_id = $key->advert_id;
		$advert_title = $key->advert_title;
		$company_name = $key->company_name;
		$balance = $key->balance;
		$advert_amount = $key->advert_amount;
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
						<h4 style="background-color:#c8e6c9; color:#424242;font-size: 1em; padding: 2px; text-align: center; border: thin solid #c8e6c9; border-radius: 10px; font-style:normal;">Watched</h4>
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
		$result .='
			<div class="card facebook-card">
				<div class="card-header" style="color: #ff7900; display: block; padding: 10px;">
					<div class="facebook-avatar" style="float: left;"><i class="fa fa-video-camera"></i></div>
					<div class="facebook-name" style="font-size: 14px; font-weight: 500; margin-left: 44px;">'.$advert_title.'</div>
					<div class="facebook-date" style="color: #8e8e93; font-size: 13px; margin-left: 44px;">KES. '.number_format($advert_amount).' Available</div>
				</div>
				<div class="card-content">
					<img src="http://img.youtube.com/vi/'.$advert_link.'/0.jpg" width="100%">
					<div class="card-content-inner" style="padding: 15px 10px; color:#000;">
						<div class="row">
							<div class="col-100">
								'.$watched.'
							</div>
						</div>
						
						<div class="row">
							<div class="col-50">
								<i class="fa fa-eye"></i> '.$advert_views.' '.$title.'
							</div>
							<div class="col-50">
								Kes. '.number_format($total_payable_amount).' Earned
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer" style="background:#ff7900;padding: 0;">
					<a href="dist/single-advert.html"  onclick="get_advert_description('.$advert_id.', \''.$advert_link.'\');" class="link" style="color: #fff !important; width: 100%; font-weight:bold; float:left;text-align:center; display:block;">Watch</a>
				</div>
			</div>';

	}
}
$result .= '</div>';
echo $result;
?>