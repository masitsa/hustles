<?php
$old_job_status = $jobs_status;

if($jobs_status == 3)
{
	$page_title = 'Available Jobs';

}
else if ($jobs_status == 2)
{
	$page_title = 'Completed Jobs';
}
else if ($jobs_status == 0)
{
	$page_title = 'Requested Jobs';
}
else if ($jobs_status == 1)
{
	$page_title = ' Assigned Jobs';
}

$items = '';
//if users exist display them

$total_rows = $jobs->num_rows();
if ($jobs->num_rows() > 0)
{	
	foreach ($jobs->result() as $row)
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

		if($this->session->userdata('job_seeker_login_status') == TRUE)
		{
			$button = '<a href="" class="read-more">Open detail</a>';
		}
		else
		{
			$button = '<a href="" class="btn btn-default">Log in to view job detail</a>';
		}

		$items .='
			<!-- single content  start-->
	  		<div class="col-100 tablet-50">
	  			<div class="single-product">
					<div class="row">
						<div class="col-70">
							<div class="pro-content">
								<h3><a href="single-product.html">'.$job_title.'</a></h3>
								<p>FROM: '.$job_start_location.' TO: '.$job_destination.'</p>
								<p>('.$count.' Customer Rivew)</p>
								<h4>KES. '.number_format($amount,2).'</h4>			
							</div>
						</div>
						<div class="col-30 view-detail">
							<a href="single-job.html" class="btn btn-sm btn-primary" onclick="get_job_description('.$job_id.','.$old_job_status.')">View Detail</a>
						</div>
					</div>
				</div>
	  		</div>
	  		<!-- single content  end-->
		';
	}
}
else
{
	$items = '
	  		<div class="col-100 tablet-50">
	  			<div class="single-product">
					<div class="row">
						<div class="col-70">
							<div class="pro-content">
								There are currently no jobs
							</div>
						</div>
					</div>
				</div>
	  		</div>

							';
}
$result = '<div class="dashboard-area">
				<div class="dashboard-title">
					
					<div class="row">
						<h3 class="pull-left">'.$page_title.'</h3>	
						<p class="pull-right"><strong>Total jobs:</strong> '.$total_rows.'</p>	
					</div>	
				</div>
				<div class="row">
					'.$items.'
			  		<hr>
				</div>	
			</div>';
echo $result;
?>