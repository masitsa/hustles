<?php

$post_id = $row->post_id;
$blog_category_name = $row->blog_category_name;
$blog_category_id = $row->blog_category_id;
$post_title = $row->post_title;
$post_status = $row->post_status;
$post_views = $row->post_views;
$image = base_url().'assets/images/posts/'.$row->post_image;
$created_by = $row->created_by;
$modified_by = $row->modified_by;
$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
$description = $row->post_content;
$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
$created = $row->created;
$day = date('j',strtotime($created));
$month = date('M Y',strtotime($created));
$created_on = date('jS M Y H:i a',strtotime($row->created));

$categories = '';
$count = 0;
//get all administrators
	$administrators = $this->users_model->get_all_administrators();
	if ($administrators->num_rows() > 0)
	{
		$admins = $administrators->result();
		
		if($admins != NULL)
		{
			foreach($admins as $adm)
			{
				$user_id = $adm->user_id;
				
				if($user_id == $created_by)
				{
					$created_by = $adm->first_name;
				}
			}
		}
	}
	
	else
	{
		$admins = NULL;
	}

	foreach($categories_query->result() as $res)
	{
		$count++;
		$category_name = $res->blog_category_name;
		$category_id = $res->blog_category_id;
		
		if($count == $categories_query->num_rows())
		{
			$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
		}
		
		else
		{
			$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
		}
	}
	$comments_query = $this->blog_model->get_post_comments($post_id);
	//comments
	$comments = 'No Comments';
	$total_comments = $comments_query->num_rows();
	if($total_comments == 1)
	{
		$title = 'comment';
	}
	else
	{
		$title = 'comments';
	}
	
	if($comments_query->num_rows() > 0)
	{
		$comments = '';
		foreach ($comments_query->result() as $row)
		{
			$post_comment_user = $row->post_comment_user;
			$post_comment_description = $row->post_comment_description;
			$date = date('jS M Y H:i a',strtotime($row->comment_created));
			
			$comments .= 
			'
				<div class="user_comment">
					<h5>'.$post_comment_user.' - '.$date.'</h5>
					<p>'.$post_comment_description.'</p>
				</div>
			';
		}
	}
	



?>
<div class="container">
         	

            
            <!--About-us top-content-->
			  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			  <div id="blog-single-image-post">
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        	<div class="col-md-12 col-xs-12 col-sm-12 pull-left subtitle no-pad ibg-transparent"></div>
            
           
            <div class="col-xs-12 col-sm-12 col-md-12 pull-left gallery-page-wrap no-pad">
            
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                          <!-- Indicators -->
                          <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"><span class="paginate-gal"></span></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"><span class="paginate-gal"></span></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"><span class="paginate-gal"></span></li>
                          </ol>
                        
                          <!-- Wrapper for slides -->
                          <div class="carousel-inner">
                          
                            <div class="item active">
                              <img src="<?php echo $image;?>" alt="">
                              <div class="img-info-carousel">
                                <div class="carousel-name">Abacterial Endocarditis</div><span class="icarousel-inn">Pediatric Clinic</span>
                              </div>
                            </div>
                     
                          </div>
                        
                        </div>
            
            
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad">
         <div class="blog-box-title"><?php echo $post_title;?></div>
						<div class="post-meta">By 
                        <span class="post-author ipost-author">admin</span> | 
                        <span class="post-date"><?php echo $created;?> </span>|
						<span class="post-author ipost-author"><?php echo $blog_category_name;?>  </span>|
						<span class="post-author ipost-author"> <?php echo $total_comments;?> Comments</span>
                        </div>
                        	<?php echo $description;?>
                       </div>
				
                     <div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 no-pad social-section social1-section">
							 <div class="col-lg-6 col-md-6  col-sm-12  col-xs-12 no-pad social-section1 pull-left">
							 	<p class="para-color">Share This Story, Choose Your Platform!</p>
							 </div>
							 <div class="col-lg-6 col-md-6  col-sm-12  col-xs-12 no-pad social-section2 pull-right">
							 <div class="social-wrap-head col-md-12 no-pad ">
                                <ul>
                                <li><a href=""><i class="icon-facebook head-social-icon" id="face-head" data-original-title="" title=""></i></a></li>
                                <li><a href=""><i class="icon-social-twitter head-social-icon" id="tweet-head" data-original-title="" title=""></i></a></li>
                                <li><a href=""><i class="icon-google-plus head-social-icon" id="gplus-head" data-original-title="" title=""></i></a></li>
                                <li><a href=""><i class="icon-linkedin head-social-icon" id="link-head" data-original-title="" title=""></i></a></li>
                                <li><a href=""><i class="icon-rss head-social-icon" id="rss-head" data-original-title="" title=""></i></a></li>
								<li><a href=""><i class="icon-twitter head-social-icon" id="twitter-head" data-original-title="" title=""></i></a></li>
                                </ul>
                            </div>
							 </div>
					 </div>
					 <div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 no-pad post-authors">
					 <h2>About the Author: admin</h2>
					 <div class="post-item-wrap pull-left col-sm-6 col-lg-1 col-md-1 col-xs-12">
                            <img src="images/news-2.jpg" class="img-responsive post-author-img" alt="">
                            </div>
                                <div class=" col-lg-11 col-md-11 col-sm-12 col-xs-12 pull-right">                   
                                	<p>Mauris sem lectus, tempor vitae augue a, posuere ultrices lacus. Suspendisse iaculis lacinia elit ac venenatis. Suspend isse in orci risus. Vivamus dictum et massa vitae feugiat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec nunc sapien, suscipit non placerat molestie, varius non est. Praesent nec augue vitae augue auctor lobortis non quis nunc.
                                	</p>
                         		</div>
                         
					 </div>
					  <div class="col-lg-12 col-md-12  col-sm-12  col-xs-12 no-pad contact-form-full">
					  <h2>Leave A Comment</h2>
					  <form class="contact2-page-form col-lg-12 col-sm-12 col-md-12 col-xs-12 no-pad contact-v1" id="contactForm" novalidate="novalidate">
                        	
                        
                        	<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 no-pad control-group">
                        	<input type="text" class="contact2-textbox" placeholder="Name*" name="name" id="name">
                            
                            </div>    
                        
                            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 control-group">
                            <input type="email" class="contact2-textbox" placeholder="Email*" name="email" id="email">
                            </div> 

                            <div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 no-pad control-group">
                                
                                <input type="text" placeholder="Subject*" class="contact2-textbox" name="subject" id="subject">
                            </div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12 no-pad col-xs-12">
                            <textarea class="contact2-textarea" placeholder="Comment..." name="message" id="message"></textarea>
                            </div>
                            
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pull-left no-pad">
                            
                            <section class="color-7" id="btn-click">
                <button class=" btn2-st2 btn-7 btn-7b" data-loading-text="Loading..." type="submit">Post Comment</button>
                
                </section></div>
                
                 </form>
					  </div>
         </div>
		 </div>
		 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 side-bar-blog-bottom">
                    <?php echo $this->load->view('blog/includes/side_bar', '', TRUE);?>             
                    
          </div>
	</div>
</div><!--end-container-->
