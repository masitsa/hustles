<div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 page-content">
					<div class="white-container mb0">
						<div class="title-lines">
							<h3 class="mt15">Hello, nice to meet you!</h3>
						</div>

						<p><strong>2SMALLHUSTLES.COM is a business enterprise that has been established to bring people closer to small job opportunities that come once in a while in order for anyone to economically improve him or herself.</strong></p>

						<p>The business seeks to provide the people of Kenya with an opportunity to making small, but yet, much little money as they go on with their day to day errands. This means that the business operates on an open business space where every other person can engage themselves with other jobs that could bring an extra income during their normal day activities..</p>

						<div class="fitvidsjs">
							<iframe src="http://player.vimeo.com/video/24456787" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>

						<p>2SMALLHUSTLES.COM is a business that revolves around the use of current technologies to build a community encompassing small job holders and small job seekers in the current growing Kenyan economy</p>

						<h3 class="bottom-line">Our Team</h3>

						<div class="row">
							<div class="col-sm-6 col-md-4">
								<div class="our-team-item">
									<div class="img">
										<img src="img/content/face-0.png" alt="">
									</div>

									<h6>John Doe <span>CEO</span></h6>
								</div>
							</div>

							<div class="col-sm-6 col-md-4">
								<div class="our-team-item">
									<div class="img">
										<img src="img/content/face-2.png" alt="">
									</div>

									<h6>John Doe <span>CEO</span></h6>
								</div>
							</div>

							<div class="col-sm-6 col-md-4">
								<div class="our-team-item">
									<div class="img">
										<img src="img/content/face-4.png" alt="">
									</div>

									<h6>John Doe <span>CEO</span></h6>
								</div>
							</div>

							<div class="col-sm-6 col-md-4">
								<div class="our-team-item">
									<div class="img">
										<img src="img/content/face-6.png" alt="">
									</div>

									<h6>John Doe <span>CEO</span></h6>
								</div>
							</div>

							<div class="col-sm-6 col-md-4">
								<div class="our-team-item">
									<div class="img">
										<img src="img/content/face-8.png" alt="">
									</div>

									<h6>John Doe <span>CEO</span></h6>
								</div>
							</div>

							<div class="col-sm-6 col-md-4">
								<div class="our-team-item">
									<div class="img">
										<img src="img/content/face-9.png" alt="">
									</div>

									<h6>John Doe <span>CEO</span></h6>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-4 page-sidebar">
					<aside>
						<div class="widget sidebar-widget white-container links-widget">
							<ul>

								<?php
								$about_link = '';
								$privacy_link = '';
								$terms_link ='';
								if($var == 'about')
								{
									$about_link = 'active';
								}

								if($var == 'privacy')
								{
									$privacy_link  = 'active';
								}

								if($var == 'terms')
								{
									$terms_link  = 'active';
								}

								?>
								<li class="<?php echo $about_link;?>"><a href="<?php echo base_url();?>about">About Us</a></li>
								<li class="<?php echo $privacy_link;?>"><a href="<?php echo base_url();?>about/privacy">Privacy Policy</a></li>
								<li class="<?php echo $terms_link;?>"><a href="<?php echo base_url();?>about/terms">Terms &amp; Conditions</a></li>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		</div> <!-- end .container -->
	</div> <!-- end #page-content -->