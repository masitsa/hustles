<?php
$result = '';

if($advertisments->num_rows() > 0)
{
	$result .= '<ul>';
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
						<h4 style="background-color:#c8e6c9; color:#424242;font-size: 1em; padding: 2px; text-align: center; border: thin solid #c8e6c9; border-radius: 10px;">Watched</h4>
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
					 <li>
					      <a href="dist/single-advert.html"  onclick="get_advert_description('.$advert_id.', \''.$advert_link.'\');" class="item-link item-content">
					        <div class="item-media"><img src="http://img.youtube.com/vi/'.$advert_link.'/0.jpg" width="80"></div>
					        <div class="item-inner">
					          <div class="item-title-row">
					            <div class="item-title">'.$advert_title.'</div>
					          </div>
					          <div class="item-after">KES. '.number_format($advert_amount).'</div>
					          <div class="item-subtitle">KES. '.number_format($total_payable_amount).' Made</div>
					          <div class="row item-text-footer">
					          	<div class="col-50">
					          		('.$advert_views.' '.$title.')
					          	</div>
					          	<div class="col-50 right">
					          	    '.$watched.'
					          	</div>
					          	</div>
					        </div>
					      </a>
					    </li>
					';

	}
	
	$result .= '</ul>';
}
else
{
	$result = '';
}
$result .='</div>';
echo $result;
?>