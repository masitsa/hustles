<div id="page-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 page-content">
					<div class="white-container mb0">
						<div class="title-lines">
							<h3 class="mt15">Terms &amp; Conditions</h3>
						</div>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consectetur, neque, aliquid officia quibusdam quidem facere ipsum aperiam quod aliquam nemo totam. Sunt, nostrum adipisci dicta suscipit vitae perspiciatis repellat.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, animi iusto sit ipsum quae nobis nostrum fuga laboriosam ab nesciunt aliquam inventore odio alias accusantium maiores hic voluptate similique sed assumenda suscipit molestiae soluta necessitatibus ipsa non debitis excepturi eius.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, cumque, repudiandae, commodi accusamus laboriosam modi deleniti autem sunt corporis nemo eos reiciendis voluptatem asperiores doloremque sapiente iusto hic ex enim eum dolorum doloribus. Libero, dignissimos ut quidem ipsam atque assumenda molestias omnis quam. Rerum, fugiat, veniam cupiditate iste sint voluptatum sapiente nesciunt. Eius, aut, asperiores officia ea doloremque architecto maiores eaque. Nihil doloremque a porro asperiores architecto! Totam, quis nihil provident qui optio officia voluptate ipsa assumenda rerum fuga. Molestiae, similique optio omnis reiciendis tempore magnam deserunt voluptatem alias temporibus ut sunt necessitatibus veritatis odio saepe et. Rem, deserunt consequatur!</p>

						<h5>Sunt necessitatibus veritatis</h5>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, et mollitia dicta debitis veniam dolor est magni necessitatibus minus sit recusandae aut delectus officia. Quam, quidem suscipit aspernatur ullam totam.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, magni, fugit, deleniti beatae dicta animi fuga quis possimus minima adipisci obcaecati maxime hic blanditiis ipsa dolorem laboriosam totam in nostrum architecto recusandae odit placeat excepturi corporis sunt incidunt consequatur debitis eos distinctio quam reiciendis provident velit similique repudiandae iure eaque.</p>
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