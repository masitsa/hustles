
<div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 page-sidebar">
					<aside>
						<div class="white-container mb0">
							<div class="widget sidebar-widget jobs-search-widget">
								<h5 class="widget-title">Search</h5>

								<div class="widget-content">
									<span>I'm looking for a ...</span>

									<select class="form-control mt10 mb10">
										<option value="0">Job</option>
										<option value="">Category</option>
										<option value="">Category</option>
										<option value="">Category</option>
										<option value="">Category</option>
									</select>

									<span>From :</span>

									<input type="text" class="form-control mt10" placeholder="Location">

									<span>To :</span>

									<input type="text" class="form-control mt15 mb15" placeholder="Destination">

									<input type="submit" class="btn btn-default" value="Search">
								</div>
							</div>

							
						</div>
					</aside>
				</div> <!-- end .page-sidebar -->
				

				<div class="col-sm-8 page-content">
					<!-- <div id="jobs-page-map" class="white-container"></div> -->

					<div class="title-lines">
						<h3 class="mt0">Available Jobs</h3>
					</div>

					<div class="clearfix mb30">
							<?php echo $links;?>
					</div>
					<?php
						//if users exist display them
						if ($jobs->num_rows() > 0)
						{
							$count = $page;
							
							$result = '';
							
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
								$result .=
								'
									<div class="jobs-item ">
								<div class="clearfix visible-xs"></div>
								<div class="date">'.$day.' <span>'.$month.'</span></div>
								<h6 class="title"><a href="">'.$job_title.'</a></h6>
								<span class="meta">From: '.$job_start_location.' To: '.$job_destination.'</span>

								

								<p class="description"> '.$button.'</p>

								<div class="content">
									<p>'.$job_description.'.</p>
									<div class="row">
										<div class="col-sm-12">
											<div class="col-sm-6">
												<h5>Job Provider Information</h5>

												<p><span>Name : </span>'.$member_first_name.' '.$member_last_name.'</p>
												<p><span>Phone No : </span>'.$member_phone.'</p>
												<p><span>Email : </span>'.$member_email.'</p>
												<p><span>From : </span> '.$job_start_location.'</p>
											</div>
											<div class="col-sm-6">
												<h5>Contact Person Information</h5>

												<p><span>Name : </span> '.$contact_person_name.'</p>
												<p><span>Name : </span> '.$contact_person_phone.'</p>
												<p><span>Destination : </span> '.$job_destination.'</p>
											</div>
										</div>
									</div>
									<hr>

									<div class="clearfix">
										<a href="" class="btn btn-default pull-left">Book job</a>

										<ul class="social-icons pull-right">
											<li><span>Share</span></li>
											<li><a href="" class="btn btn-gray fa fa-facebook"></a></li>
											<li><a href="" class="btn btn-gray fa fa-twitter"></a></li>
											<li><a href="" class="btn btn-gray fa fa-google-plus"></a></li>
										</ul>
									</div>
								</div>
							</div>
								';
							}
						}
						echo $result;
						?>
						

					<div class="clearfix">
						<?php echo $links;?>
					</div>
				</div> <!-- end .page-content -->
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->