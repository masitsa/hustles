<?php
$result = '';
if($advertisments->num_rows() > 0)
{
	foreach ($advertisments->result() as $key) {
		# code...
		$advert_id = $key->advert_id;
		$advert_title = $key->advert_title;
		$company_name = $key->company_name;
		$advert_amount = $key->advert_amount;
		$advert_views = $key->advert_views;
		$company_name = $key->company_name;
		$advert_link = $key->advert_link;
		if($advert_views == NULL)
		{
			$advert_views = 0;
		}
	}
	$result .= '
				<div class="col-100 tablet-50">
		  			<div class="single-product">
						<div class="row">
							<iframe width="100%" height="300" src="http://www.youtube.com/embed/'.$advert_link.'" frameborder="0"></iframe>
							<div class="pro-content pull-left">
					        	<h4>KES. '.number_format($advert_amount,2).'</h4>
					        </div>
					        <div class="pro-content pull-right">
					        	<p>('.$advert_views.' views) </p>
					        </div>
						</div>
					</div>
		  		</div>';
}

echo $result;


?>