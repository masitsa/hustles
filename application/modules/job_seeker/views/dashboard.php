	<div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 page-content">
					<div class="title-lines">
						<h3 class="mt0"><?php echo $title;?></h3>
					</div>
                    
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
					
                    <div class="find-job-tabs responsive-tabs">
                    
                    	<a href="<?php echo site_url().'jobs';?>" class="pull-right">Browse all jobs</a>
                        
						<ul class="nav nav-tabs">
							<li class="active"><a href="#find-job-tabs-jobs">Available Jobs</a></li>
							<li ><a href="#find-job-tabs-industry">Requested jobs</a></li>
							<li ><a href="#find-job-tabs-map">Assigned jobs</a></li>
							<li><a href="#find-job-tabs-role">Completed jobs</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="find-job-tabs-jobs">

                                <div class="title-lines">
                                    <h3>Available Jobs</h3>
                                </div>
								
                                <?php 
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
												
										?>
                                         <div class="jobs-item with-thumb">
                                            <div class="thumb"><img alt="" src="<?php echo base_url().'assets/img/avatar.jpg';?>"></div>
                                            <div class="clearfix visible-xs"></div>
                                            <div class="date"><?php echo $day;?> <span><?php echo $month;?></span></div>
                                            <h6 class="title"><a href="#"><?php echo $job_title;?></a></h6>
                                            <span class="meta"><?php echo $job_start_location;?> to <?php echo $job_destination;?></span>
                    
                                            <ul class="top-btns">
                                                <li><a class="btn btn-gray fa fa-plus toggle" href="#"></a></li>
                                            </ul>
                    
                                            <p class="description"> <a class="read-more" href="#">Read More</a></p> 
                                            <br>
                                            <div class="content">
                                                <div class="row">
                                                    	<?php echo $job_description;?>
                                                </div>
                    
                                                <hr>
                    
                                                <div class="clearfix">
                                                <?php
                                                if($this->job_seeker_model->check_if_booked($job_id))
                                                {
                                                	?>
                                                	<form enctype="multipart/form-data" job_id="<?php echo $job_id;?>" action="<?php echo base_url();?>book-job/<?php echo $job_id;?>"  id = "book_form" method="post">
	            										 <button class="btn btn-default btn-sm" type="submit" onclick="">Request job</button>
	                                                </form>
                                                	<?php
                                                }
                                                else
                                                {
                                                	
                                                }
                                                ?>
                                                
                                                    <ul class="social-icons pull-right">
                                                        <li><span>Share</span></li>
                                                        <li><a class="btn btn-gray fa fa-facebook" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-twitter" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-google-plus" href="jobs.html#"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> <!-- end .job -->
                                        <?php
									}
								}
								
								else
								{
									?>
                                    <p>You have not requested any jobs. Please apply for some here. <a href="<?php echo site_url().'jobs';?>">Browse all jobs</a></p>
                                    <?php
								}
								?>
                                
                                
							</div>
							<div class="tab-pane" id="find-job-tabs-industry">

                                <div class="title-lines">
                                    <h3>Requested Jobs</h3>
                                </div>
								
                                <?php 
								if($requested->num_rows() > 0)
								{
									foreach($requested->result() as $row)
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
										
										?>
                                         <div class="jobs-item with-thumb">
                                            <div class="thumb"><img alt="" src="<?php echo base_url().'assets/img/avatar.jpg';?>"></div>
                                            <div class="clearfix visible-xs"></div>
                                            <div class="date"><?php echo $day;?> <span><?php echo $month;?></span></div>
                                            <h6 class="title"><a href="#"><?php echo $job_title;?></a></h6>
                                            <span class="meta"><?php echo $job_start_location;?> to <?php echo $job_destination;?></span>
                    
                                            <ul class="top-btns">
                                                <li><a class="btn btn-gray fa fa-plus toggle" href="#"></a></li>
                                            </ul>
                    
                                            <p class="description"><?php echo $job_description;?> <a class="read-more" href="#">Read More</a></p> 
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <h5>Job Provider Information</h5>
            
                                                            <p><span><a class="btn btn-gray fa fa-user" href="#"></a> Name : </span> <?php echo $member_first_name;?> <?php echo $member_last_name;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-phone" href="#"></a> Phone No : </span> <?php echo $member_phone;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-envelope" href="#"></a> Email : </span> <?php echo $member_email;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-map-marker" href="#"></a> From : </span> <?php echo $job_start_location;?></p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h5>Contact Person Information</h5>
                                                            <p><span><a class="btn btn-gray fa fa-user" href="#"></a> Name : </span> <?php echo $contact_person_name;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-phone" href="#"></a> Phone No : </span> <?php echo $contact_person_phone;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-map-marker" href="#"></a> Destination : </span> <?php echo $job_destination;?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
	                                                <div class="col-sm-6">
	                                                	<div class="col-sm-6">
	                                                		<?php

	                                                		$locations = array();
	 
																/* Marker #1 */
																$locations[] = array(
																    'google_map' => array(
																        'lat' => '-6.976622',
																        'lng' => '110.39068959999997',
																    ),
																    'location_address' => 'Puri Anjasmoro B1/22 Semarang',
																    'location_name'    => 'Loc A',
																);
																 
																/* Marker #2 */
																$locations[] = array(
																    'google_map' => array(
																        'lat' => '-6.974426',
																        'lng' => '110.38498099999993',
																    ),
																    'location_address' => 'Puri Anjasmoro P5/20 Semarang',
																    'location_name'    => 'Loc B',
																);
																 
																/* Marker #3 */
																$locations[] = array(
																    'google_map' => array(
																        'lat' => '-7.002475',
																        'lng' => '110.30163800000003',
																    ),
																    'location_address' => 'Ngaliyan Semarang',
																    'location_name'    => 'Loc C',
																);
	                                                		?>

	                                                		<?php
															/* Set Default Map Area Using First Location */
															$map_area_lat = isset( $locations[0]['google_map']['lat'] ) ? $locations[0]['google_map']['lat'] : '';
															$map_area_lng = isset( $locations[0]['google_map']['lng'] ) ? $locations[0]['google_map']['lng'] : '';
															?>

															<script>
															jQuery( document ).ready( function($) {

																/* Do not drag on mobile. */
																var is_touch_device = 'ontouchstart' in document.documentElement;

																var map = new GMaps({
																	el: '#google-map',
																	lat: '<?php echo $map_area_lat; ?>',
																	lng: '<?php echo $map_area_lng; ?>',
																	scrollwheel: false,
																	draggable: ! is_touch_device
																});

																/* Map Bound */
																var bounds = [];

																<?php /* For Each Location Create a Marker. */
																foreach( $locations as $location ){
																	$name = $location['location_name'];
																	$addr = $location['location_address'];
																	$map_lat = $location['google_map']['lat'];
																	$map_lng = $location['google_map']['lng'];
																	?>
																	/* Set Bound Marker */
																	var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>);
																	bounds.push(latlng);
																	/* Add Marker */
																	map.addMarker({
																		lat: <?php echo $map_lat; ?>,
																		lng: <?php echo $map_lng; ?>,
																		title: '<?php echo $name; ?>',
																		infoWindow: {
																			content: '<p><?php echo $name; ?></p>'
																		}
																	});
																<?php } //end foreach locations ?>

																/* Fit All Marker to map */
																map.fitLatLngBounds(bounds);

																/* Make Map Responsive */
																var $window = $(window);
																function mapWidth() {
																	var size = $('.google-map-wrap').width();
																	$('.google-map').css({width: size + 'px', height: (size/2) + 'px'});
																}
																mapWidth();
																$(window).resize(mapWidth);

															});
															</script>
	                                                		<div id="google-map" class="google-map"></div><!-- #google-map -->
	                                                	</div>
                                                	</div>
                                                </div>
                    
                                                <hr>
                    
                                                <div class="clearfix">
                                                    <ul class="social-icons pull-right">
                                                        <li><span>Share</span></li>
                                                        <li><a class="btn btn-gray fa fa-facebook" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-twitter" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-google-plus" href="jobs.html#"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> <!-- end .job -->
                                        <?php
									}
								}
								
								else
								{
									?>
                                    <p>You have not requested any jobs. Please apply for some here. <a href="<?php echo site_url().'jobs';?>">Browse all jobs</a></p>
                                    <?php
								}
								?>
                                
                                
							</div>
							<div class="tab-pane " id="find-job-tabs-map">

                                <div class="title-lines">
                                    <h3>Assigned Jobs</h3>
                                </div>
								
                                <?php 
								if($assigned->num_rows() > 0)
								{
									foreach($assigned->result() as $row)
									{
										$job_seeker_request_id = $row->job_seeker_request_id;
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
										
										?>
                                         <div class="jobs-item with-thumb">
                                            <div class="thumb"><img alt="" src="<?php echo base_url().'assets/img/avatar.jpg';?>"></div>
                                            <div class="clearfix visible-xs"></div>
                                            <div class="date"><?php echo $day;?> <span><?php echo $month;?></span></div>
                                            <h6 class="title"><a href="#"><?php echo $job_title;?></a></h6>
                                            <span class="meta"><?php echo $job_start_location;?> to <?php echo $job_destination;?></span>
                    
                                            <ul class="top-btns">
                                                <li><a class="btn btn-gray fa fa-plus toggle" href="#"></a></li>
                                            </ul>
                    
                                            <p class="description"><?php echo $job_description;?> <a class="read-more" href="#">Read More</a></p> 
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <h5>Job Provider Information</h5>
            
                                                            <p><span><a class="btn btn-gray fa fa-user" href="#"></a> Name : </span> <?php echo $member_first_name;?> <?php echo $member_last_name;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-phone" href="#"></a> Phone No : </span> <?php echo $member_phone;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-envelope" href="#"></a> Email : </span> <?php echo $member_email;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-map-marker" href="#"></a> From : </span> <?php echo $job_start_location;?></p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h5>Contact Person Information</h5>
                                                            <p><span><a class="btn btn-gray fa fa-user" href="#"></a> Name : </span> <?php echo $contact_person_name;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-phone" href="#"></a> Phone No : </span> <?php echo $contact_person_phone;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-map-marker" href="#"></a> Destination : </span> <?php echo $job_destination;?></p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <hr>
                    
                                                <div class="clearfix">
                                                    <a class="btn btn-default pull-right" href="<?php echo site_url().'complete-job/'.$job_seeker_request_id;?>" onClick="return confirm('Are you sure you want to mark this job as completed');">Mark as delivered</a>
                    
                                                    <ul class="social-icons pull-left">
                                                        <li><span>Share</span></li>
                                                        <li><a class="btn btn-gray fa fa-facebook" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-twitter" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-google-plus" href="jobs.html#"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> <!-- end .job -->
                                        <?php
									}
								}
								
								else
								{
									?>
                                    <p>You have no jobs assigned. Please apply for some here. <a href="<?php echo site_url().'jobs';?>">Browse all jobs</a></p>
                                    <?php
								}
								?>
                                
							</div>

							

							<div class="tab-pane" id="find-job-tabs-role">

                                <div class="title-lines">
                                    <h3>Completed Jobs</h3>
                                </div>
								
                                <?php 
								if($completed->num_rows() > 0)
								{
									foreach($completed->result() as $row)
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
										
										?>
                                         <div class="jobs-item with-thumb">
                                            <div class="thumb"><img alt="" src="<?php echo base_url().'assets/img/avatar.jpg';?>"></div>
                                            <div class="clearfix visible-xs"></div>
                                            <div class="date"><?php echo $day;?> <span><?php echo $month;?></span></div>
                                            <h6 class="title"><a href="#"><?php echo $job_title;?></a></h6>
                                            <span class="meta"><?php echo $job_start_location;?> to <?php echo $job_destination;?></span>
                    
                                            <ul class="top-btns">
                                                <li><a class="btn btn-gray fa fa-plus toggle" href="#"></a></li>
                                            </ul>
                    
                                            <p class="description"><?php echo $job_description;?> <a class="read-more" href="#">Read More</a></p> 
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <h5>Job Provider Information</h5>
            
                                                            <p><span><a class="btn btn-gray fa fa-user" href="#"></a> Name : </span> <?php echo $member_first_name;?> <?php echo $member_last_name;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-phone" href="#"></a> Phone No : </span> <?php echo $member_phone;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-envelope" href="#"></a> Email : </span> <?php echo $member_email;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-map-marker" href="#"></a> From : </span> <?php echo $job_start_location;?></p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h5>Contact Person Information</h5>
                                                            <p><span><a class="btn btn-gray fa fa-user" href="#"></a> Name : </span> <?php echo $contact_person_name;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-phone" href="#"></a> Phone No : </span> <?php echo $contact_person_phone;?></p>
                                                            <p><span><a class="btn btn-gray fa fa-map-marker" href="#"></a> Destination : </span> <?php echo $job_destination;?></p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <hr>
                    
                                                <div class="clearfix">
                    
                                                    <ul class="social-icons pull-right">
                                                        <li><span>Share</span></li>
                                                        <li><a class="btn btn-gray fa fa-facebook" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-twitter" href="jobs.html#"></a></li>
                                                        <li><a class="btn btn-gray fa fa-google-plus" href="jobs.html#"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> <!-- end .job -->
                                        <?php
									}
								}
								
								else
								{
									?>
                                    <p>You have not completed any jobs. Please complete any assigned jobs or apply for some more here. <a href="<?php echo site_url().'jobs';?>">Browse all jobs</a></p>
                                    <?php
								}
								?>
                                
							</div>
						</div>
					</div> <!-- end .find-job-tabs -->
                    
				</div> <!-- end .page-content -->
            </div>
            <div class="row">
            	<div class="success-stories-section">
		            <div class="container">
		                <h5 class="mt10">Advertisments</h5>

		                <div>
		                    <div class="flexslider">
		                        <ul class="slides">
		                            <li style="width: 310px !important;">
		                                <a href="index.html#">
                                       	 	<iframe src="http://www.youtube.com/embed/A6XUVjK9W4o?rel=0&amp;controls=2&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>

		                                </a>
		                            </li>

		                           
		                        </ul>
		                    </div>
		                </div>
		            </div>
		        </div>
            </div>
        </div>
    </div>
 <script type="text/javascript">
  jQuery( document ).ready( function($) {
 
    /* Create Map. */
    var map = new GMaps({
        el: '#google-map',
        lat: '',
        lng: '',
        scrollwheel: false
    });
 
    /* Create Marker Here... */
});
</script>