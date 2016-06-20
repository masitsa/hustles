<?php
$result = '';
if ($job_detail->num_rows() > 0)
{	
	foreach ($job_detail->result() as $row)
	{
		$job_id = $row->job_id;
		$job_title = $row->job_title;
		$job_status = $row->job_status;
		$job_description = $row->job_description;
		$job_start_location = $row->job_start_location;
		$job_destination = $row->job_destination;
		$created = $row->created;
		$last_modified = $row->last_modified;

		$contact_person_name = $row->contact_person_name;
		$contact_person_phone = $row->contact_person_phone;
		$count = $row->count;
		$amount = $row->amount;

		$member_first_name = $row->member_first_name;
		$member_last_name = $row->member_last_name;
		$member_email = $row->member_email;
		$member_phone = $row->member_phone;
		$day = date('j',strtotime($created));
		$month = date('M Y',strtotime($created));
	}
	// get level of item
	if($jobs_status == 3)
	{

        if($this->jobs_model->check_if_booked($job_id))
        {
        	$button = '<div class="mybutton"> <a href="single-job.html" onclick="request_job('.$job_id.','.$jobs_status.')">Request Job</a></div>';
        }
        else
        {
        	$button = '';
        }
	}
	else
	{
		$button  = '';
	}

	$result =
	'
		<div class="mens-product">
		<div class="row">
			<div class="col-100 tablet-60">
				<div class="product-text">
					<h4>'.$job_title.'</h4>
					<p>FROM: '.$job_start_location.' TO: '.$job_destination.' ('.$count.' Views)</p>
					<h4>KES. '.number_format($amount,2).'</h4>
					<hr>
					<div class="row">
						<div class="col-50 tablet-33">
							<h4>JOB PROVIDER</h4>
							<table >
								<tr>
									<th>Title</th>
									<th>Info</th>
								</tr>
								<tr>
									<td>NAME:</td>
									<td>'.$member_first_name.' '.$member_last_name.'</td>
								</tr>
								<tr>
									<td>PHONE:</td>
									<td>'.$member_phone.'</td>
								</tr>
								<tr>
									<td>EMAIL:</td>
									<td>'.$member_email.'</td>
								</tr>
							
							</table>
						</div>
						<div class="col-50 tablet-33">
							<h4>CONTACT PERSON</h4>
							<table>
								<tr>
									<th>Title</th>
									<th>Info</th>
								</tr>
								<tr>
									<td>NAME:</td>
									<td> '.$contact_person_name.'</td>
								</tr>
								<tr>
									<td>PHONE:</td>
									<td>'.$contact_person_phone.'</td>
								</tr>
							
							</table>
						</div>
					</div>
					<hr>
					<h4>DESCRIPTION</h4>
					<p>'.$job_description.'</p>
					<hr>
					<div class="row">
						<div class="col-40">
							<div class="back link mybackbutton"> <a href="single-job.html">Back to Jobs</a></div>
						</div>
						<div class="col-60">
							'.$button.'
						</div>
					</div>
					
				</div>
			</div>
			<!-- single content end-->
			<!-- single content start -->
		
			<!-- single content start -->
		</div>
	</div>
	';
}
else
{
	$result = 
	'
	<div class="col-100 tablet-50">
  			<div class="single-product">
				<div class="row">
					<div class="col-70">
						<div class="pro-content">
							Sorry something went wrong. Please try again
						</div>
					</div>
				</div>
			</div>
  		</div>
	';
}

echo $result;
?>
<!-- <div class="col-100 tablet-40">
	<div class="content-box">
		<h4>Map</h4>
		<div class="ks-slider-custom">
			<div data-pagination=".swiper-pagination" data-space-between="0" data-next-button=".swiper-button-next" data-prev-button=".swiper-button-prev" data-pagination-clickable="true" class="swiper-init">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
			        	<img src="img/product/1.jpg" alt="">					        	
			        </div> 
			        <div class="swiper-slide">
			        	<img src="img/product/2.jpg" alt="">					        	
			        </div>
			        <div class="swiper-slide">
			        	<img src="img/product/3.jpg" alt="">					        	
			        </div> 
			        <div class="swiper-slide">
			        	<img src="img/product/4.jpg" alt="">					        	
			        </div> 
			        <div class="swiper-slide">
			        	<img src="img/product/5.jpg" alt="">					        	
			        </div> 
				</div>
			</div>
		</div>				
	</div>
</div> -->