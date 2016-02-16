<?php
// var_dump($job_seeker_details);
	if($job_seeker_details->num_rows() > 0)
	{
		foreach ($job_seeker_details->result() as $key) {

			# code...
			$job_seeker_first_name = $key->job_seeker_first_name;
			$job_seeker_last_name = $key->job_seeker_last_name;
			$job_seeker_phone = $key->job_seeker_phone;
			$job_seeker_email = $key->job_seeker_email;
			$job_seeker_age = 28;
			$job_seeker_address = $key->job_seeker_address;
			$job_seeker_city = $key->job_seeker_city;
			$job_seeker_post_code = $key->job_seeker_post_code;
		}
	}
?>
<div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 page-sidebar">
					<aside>
						<div class="widget sidebar-widget white-container candidates-single-widget">
							<div class="widget-content">
								<div class="thumb">
									<img src="img/content/face-6.png" alt="">
								</div>

								<h5 class="bottom-line">Candidate Details</h5>

								<table>
									<tbody>
										<tr>
											<td>Name</td>
											<td><?php echo $job_seeker_first_name. ' '.$job_seeker_last_name;?></td>
										</tr>

										<tr>
											<td>Age</td>
											<td><?php echo $job_seeker_age;?> Years Old</td>
										</tr>

										<tr>
											<td>Location</td>
											<td><?php echo $job_seeker_city?></td>
										</tr>



										<tr>
											<td>Phone</td>
											<td>+ <?php echo $job_seeker_phone;?></td>
										</tr>


										<tr>
											<td>E-mail</td>
											<td><a href="mailto:<?php echo $job_seeker_email;?>"><?php echo $job_seeker_email;?></a></td>
										</tr>

									</tbody>
								</table>

								<h5 class="bottom-line">Jobs Tally</h5>

								<table>
									<tbody>
										<tr>
											<td>Jobs Requested</td>
											<td><?php echo $count_requested?></td>
										</tr>
										<tr>
											<td>Jobs Assigned</td>
											<td><?php echo $count_assigned?></td>
										</tr>
										<tr>
											<td>Jobs Completed</td>
											<td><?php echo $count_completed?></td>
										</tr>
									</tbody>
								</table>
								<h5 class="bottom-line">Advertisments Points Tally</h5>

								<table>
									<tbody>
										<tr>
											<td>Point Tally</td>
											<td><?php echo $count_requested?></td>
										</tr>
										
									</tbody>
								</table>
								<h5 class="bottom-line">Account Earnings</h5>

								<table>
									<tbody>
										<tr>
											<td>Amount</td>
											<td><?php echo 'KES.'.number_format($count_requested,2);?></td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
					</aside>
				</div> <!-- end .page-sidebar -->

				<div class="col-sm-8 page-content">
					<div class="clearfix mb30 hidden-xs">
						<a href="<?php echo base_url();?>job-seeker-dashboard" class="btn btn-gray pull-right">Back to dashboard</a>
						<!-- <div class="pull-right">
							<a href="candidates-single.html#" class="btn btn-gray">Previous</a>
							<a href="candidates-single.html#" class="btn btn-gray">Next</a>
						</div> -->
					</div>

					<div class="candidates-item candidates-single-item">
						<h6 class="title"><a href="candidates-single.html#"><?php echo $job_seeker_first_name.' '.$job_seeker_last_name;?></a></h6>
						<span class="meta"><?php echo $job_seeker_age;?> Years Old - <?php echo $job_seeker_city?>, Kenya</span>

						<ul class="top-btns">
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-star"></a></li>
						</ul>

						<ul class="social-icons clearfix">
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-facebook"></a></li>
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-twitter"></a></li>
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-google-plus"></a></li>
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-dribbble"></a></li>
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-pinterest"></a></li>
							<li><a href="candidates-single.html#" class="btn btn-gray fa fa-linkedin"></a></li>
						</ul>

	                    <?php
							$success = $this->session->userdata('success_message');
							$this->session->unset_userdata('success_message');
							
							$error = $this->session->userdata('error_message');
							$this->session->unset_userdata('error_message');
							
							if(!empty($error)){
								echo '<div class="alert alert-danger"> Oh snap! '.$error.'</div>';
							}
							
							if(!empty($success)){
								echo '<div class="alert alert-success">'.$success.'</div>';
							}
						?>
					
						<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, maxime, excepturi, mollitia, voluptatibus similique aliquid a dolores autem laudantium sapiente ad enim ipsa modi laborum accusantium deleniti neque architecto vitae.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, nihil, dolores, culpa ullam vero ipsum placeat accusamus nemo ipsa cupiditate id molestiae consectetur quae pariatur repudiandae vel ex quaerat nam iusto aliquid laborum quia adipisci aut ut impedit obcaecati nisi deleniti tempore maxime sequi fugit reiciendis libero quo. Rerum, assumenda.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, at nemo inventore temporibus corporis suscipit.</p>
							 -->
						


						<h5>Change Password</h5>
						<form enctype="multipart/form-data" action="<?php echo base_url();?>change-password"  id = "change_password" method="post">


						<div class="row">
							<div class="col-sm-10">
								<div class="row">
									<div class="form-group">
			                            <label class="col-md-4 control-label" for="slideshow_name">Current Password</label>
			                            <div class="col-md-8">
			                            	<input type="password" class="form-control" name="current_password" placeholder="Current Password" >
			                            </div>
			                        </div>
			                    </div>
			                    <br>
			                    <div class="row">
			                        <div class="form-group">
			                            <label class="col-md-4 control-label" for="slideshow_name">New Password</label>
			                            <div class="col-md-8">
			                            	<input type="password" class="form-control" name="new_password" placeholder="New Password" >
			                            </div>
			                        </div>
			                    </div>
			                    <br>
			                    <div class="row">
			                        <div class="form-group">
			                            <label class="col-md-4 control-label" for="slideshow_name">Confirm New Password</label>
			                            <div class="col-md-8">
			                            	<input type="password" class="form-control" name="confirm_new_password" placeholder="Confirm new password" >
			                            </div>
			                        </div>
			                    </div>
			                    <br>
			                    <div class="row">
				                    	<div class="form-group">
				                    		<button type="submit" class="btn btn-sm btn-default pull-right" name="submit" >Change Password</button>
				                    	</div>
				                    
			                    </div>
									
							</div>
							
						</div>
						</form>
						
					</div>


				</div> <!-- end .page-content -->
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->