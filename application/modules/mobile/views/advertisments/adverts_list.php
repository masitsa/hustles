<?php
$result = '
<div class="total-revenue">
	<div class="t-revenue-title"><h2>Advertisment Totals</h2></div>
	<div class="total-sale">
		<h2>KES. '.number_format($total_amount,2).'</h2>
	</div>
</div>
<div class="row">
';

if($advertisments->num_rows() > 0)
{
	foreach ($advertisments->result() as $key) {
		# code...
		$advert_id = $key->advert_id;
		$advert_title = $key->advert_title;
		$company_name = $key->company_name;
		$balance = $key->balance;
		$advert_views = $key->advert_views;
		$company_name = $key->company_name;
		if($advert_views == NULL)
		{
			$advert_views = 0;
		}
		$result .= '
					<div class="col-50">
					    <a class="pb-video" href="advert-single.html" onclick="get_advert_description('.$advert_id.');">
					    <div class="video-box">                 
					        <img src="img/video/1.png" alt="">
					        <div class="pro-content pull-left">
					        	<h4>KES. '.number_format($balance).'</h4>
					        </div>
					        <div class="pro-content pull-right">
					        	<p>('.$advert_views.' views) </p>
					        </div>
					    </div>
					    </a>
					  </div>';

	}
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