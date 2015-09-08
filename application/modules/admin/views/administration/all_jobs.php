<?php echo $this->load->view('search/search_jobs', '', TRUE);?>

<div class="row">
	<div class="col-md-12">
		<div class="widget boxed">
		    <div class="widget-head">
		        <h4 class="pull-left"><i class="icon-reorder"></i>Job List</h4>
		        <div class="widget-icons pull-right">
		            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
		            <a href="#" class="wclose"><i class="icon-remove"></i></a>
		        </div>
		        <div class="clearfix"></div>
		    </div>
		    <div class="widget-content">
			<?php
				
				$result = '';
				
				//if users exist display them
				if ($jobs->num_rows() > 0)
				{
					$count = $page;
					
					$result .= 
					'
						<table class="table table-hover table-bordered ">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Created By</th>
							  <th>Date Created</th>
							  <th>From</th>
							  <th>To</th>
							  <th>Completed Status</th>
							  <th>Delivery Status</th>
							  <th colspan="5">Actions</th>
							</tr>
						  </thead>
						  <tbody>
					';
					
					foreach ($jobs->result() as $row)
					{
						$job_id = $row->job_id;
						$job_title = $row->job_title;
						$job_status = $row->job_status;
						$job_description = $row->job_description;
						$created = $row->created;
						$last_modified = $row->last_modified;
						$member_first_name = $row->member_first_name;
						$member_last_name = $row->member_last_name;
						$job_start_location = $row->job_start_location;
						$job_destination = $row->job_destination;
						$completed = $row->completed;
						
						//create deactivated status display
						if($job_status == 0)
						{
							$status = '<span class="label label-info">Not Assigned</span>';
							//$button = '<a class="btn btn-sm btn-info" href="'.site_url().'administration/activate-job/'.$job_id.'/'.$job_id.'" onclick="return confirm(\'Do you want to activate '.$job_title.'?\');">Activate</a>';
						}
						//create activated status display
						else if($job_status == 1)
						{
							$status = '<span class="label label-success">Assigned</span>';
							//$button = '<a class="btn btn-sm btn-default" href="'.site_url().'administration/deactivate-job/'.$job_id.'/'.$job_id.'" onclick="return confirm(\'Do you want to deactivate '.$job_title.'?\');">Deactivate</a>';
						}
						if($completed == 1)
						{
							$completed_status = '<span class="label label-success">Completed</span>';
						}
						else if($completed == 2)
						{
							$completed_status = '<span class="label label-danger">Canceled</span>';
						}
						else
						{
							$completed_status = '<span class="label label-info">On Going</span>';
						}
						$count++;
						$result .= 
						'
							<tr>
								<td>'.$count.'</td>
								<td>'.$member_first_name.' '.$member_last_name.'</td>
								<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
								<td>'.$job_start_location.'</td>
								<td>'.$job_destination.'</td>
								<td>'.$status.'</td>
								<td>'.$completed_status.'</td>
								<td>
								<a  class="btn btn-sm btn-success" id="open_job_detail'.$job_id.'" onclick="get_job_detail('.$job_id.');">View Job Details</a>
								<a  class="btn btn-sm btn-info" id="close_job_detail'.$job_id.'" style="display:none;" onclick="close_job_detail('.$job_id.');">Close Job Detail</a></td>
							</td>
								<td><a href="'.site_url().'administration/delete-job/'.$job_id.'/'.$job_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$job_title.'?\');">Delete</a></td>
							</tr>

						';
						$v_data['job_id'] = $job_id;
						$result .=
						'<tr id="job_detail'.$job_id.'" style="display:none;">

							<td colspan="10">'.$this->load->view("job_detail", $v_data, TRUE).'</td>
						</tr>';
					}
					
					$result .= 
					'
								  </tbody>
								</table>
					';
				}
				
				else
				{
					$result .= "There are no jobs";
				}
				
				echo $result;
			?>
			</div>
		</div>
	</div>
</div>
  <script type="text/javascript">

	function get_job_detail(job_id){

		var myTarget2 = document.getElementById("job_detail"+job_id);
		var button = document.getElementById("open_job_detail"+job_id);
		var button2 = document.getElementById("close_job_detail"+job_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		button2.style.display = '';
	}
	function close_job_detail(job_id){

		var myTarget2 = document.getElementById("job_detail"+job_id);
		var button = document.getElementById("open_job_detail"+job_id);
		var button2 = document.getElementById("close_job_detail"+job_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
	}
  </script>