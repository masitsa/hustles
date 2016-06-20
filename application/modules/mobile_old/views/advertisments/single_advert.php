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
	$result .= '
	<div class="row">
		<div class="col-100">
			<div >
				<div class="pro-content">
				<h4 style="background-color:#b39ddb; color:#424242;">KES. '.number_format($advert_amount).' <br/>Available</h4>
				<h4 style="background-color:#ffcc80; color:#424242;">KES. '.number_format($total_payable_amount).'<br/> Made</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-100">
			<div class="pro-content">
				<p>('.$advert_views.' '.$title.') </p>
			</div>
		</div>
	</div>
  <div class="row">
  	<div class="col-100">
  		<h3 style="background-color:#EF7411;color:#ffffff;font-size: 0.8em;
    padding: 2%;">You have to watch at least  '.$time_to_watch.' minutes to make your money </h3>
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
<script type="text/javascript">
	function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 5,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>