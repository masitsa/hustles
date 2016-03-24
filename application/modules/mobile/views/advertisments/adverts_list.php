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
		$made_amount = $advert_amount/ $views;
		$result .= '
					<div class="col-40">
						<div class="pro-content">
							<h4>KES. '.number_format($advert_amount).' Available</h4>
							<h4 style="background-color:#EF7411;">KES. '.number_format($made_amount).' Made</h4>
					       	<p>('.$advert_views.' '.$title.') </p>
						</div>
					</div>
					
					<div class="col-60">
					    <a class="pb-video" href="advert-single.html" onclick="get_advert_description('.$advert_id.', \''.$advert_link.'\');">
					    <div class="video-box">                 
					        <img src="img/video/1.png" alt="">
					        <div class="pro-content">
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