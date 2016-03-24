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
	}
	$result .= '
	<div class="row">
		<div class="col-100">
			<div class="pull-left">
				<div class="pro-content">
				<h4>KES. '.number_format($advert_amount).' Available</h4>
				<h4 style="background-color:#EF7411;">KES. '.number_format($made_amount).' Made</h4>
				</div>
			</div>
			<div class="pull-right">
				<div class="pro-content">
				<p>('.$advert_views.' '.$title.') </p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-100">
			<iframe id = "player_youtube" type = "text / html" width = "100%" height = "250"
	  src = "http://www.youtube.com/embed/'.$advert_link.'?enablejsapi=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=1&autohide=1&controls=0&autoplay=1;"
	  frameborder = "0"> </ iframe>
	  </div>
  </div>
	
	';
}

echo $result;


?>