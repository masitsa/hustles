<?php
$recent_query = $this->blog_model->get_recent_posts();
$recent_posts  ='';
if($recent_query->num_rows() > 0)
{
	$row = $recent_query->row();
	
	$post_id = $row->post_id;
	$post_title = $row->post_title;
	$web_name = $this->site_model->create_web_name($post_title);
	$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
	$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
	$description = $row->post_content;
	$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
	$created = date('jS M Y',strtotime($row->created));
	$recent_posts .= '
	 		<div class="popular-post-box">
                <img alt="" src="'.$image.'" class="img-responsive pull-left" />
                <div class="post-title-side">'.$post_title.'</div>
                <div class="post-date-side">'.$created.'</div>
            </div>
		
	';

}

else
{
	$recent_posts = 'No posts yet';
}
$categories_query = $this->blog_model->get_all_active_category_parents();
if($categories_query->num_rows() > 0)
{
	$categories = '';
	foreach($categories_query->result() as $res)
	{
		$category_id = $res->blog_category_id;
		$category_name = $res->blog_category_name;
		$web_name = $this->site_model->create_web_name($category_name);
		
		$children_query = $this->blog_model->get_all_active_category_children($category_id);
		
		//if there are children
		$categories .= '<li><a href="'.site_url().'blog/category/'.$web_name.'"><i class="fa fa-angle-right about-list-arrows"></i>'.$category_name.'</a></li>';
	}
}

else
{
	$categories = 'No Categories';
}
$popular_query = $this->blog_model->get_popular_posts();

if($popular_query->num_rows() > 0)
{
	$popular_posts = '';
	
	foreach ($popular_query->result() as $row)
	{
		$post_id = $row->post_id;
		$post_title = $row->post_title;
		$web_name = $this->site_model->create_web_name($post_title);
		$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
		$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
		$description = $row->post_content;
		$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
		$created = date('jS M Y',strtotime($row->created));
		
		$popular_posts .= '
			<div class="popular-post-box">
                <img alt="" src="'.$image.'" class="img-responsive pull-left" />
                <div class="post-title-side">'.$post_title.'</div>
                <div class="post-date-side">'.$created.'</div>
            </div>
			
				
		';
	}
}

else
{
	$popular_posts = 'No posts views yet';
}
?>

<!--Sidebar-item-->
    	<div class="catagory-list">
        
        	<div class="side-blog-title">Catagories</div>
        	<ul>
           		<?php echo $categories;?>
            </ul>
        
     	</div>
        
        <!--Sidebar-item-->
        <div class="post-tabs">
        	
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="blog-medium-right-sidebar.html#popular1" data-toggle="tab">Popular</a></li>
              <li><a href="blog-medium-right-sidebar.html#recent1" data-toggle="tab">Recent</a></li>
              <li><a href="blog-medium-right-sidebar.html#comment1" data-toggle="tab"><i class="icon-comments post-icon"></i>&nbsp;</a></li>
              
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
            	
               <!--popular posts--> 
              <div class="tab-pane fade in active" id="popular1">
              	
                <?php echo $popular_posts;?>
                
              </div><!--popular posts end--> 
              
              <!--Recent posts-->
              <div class="tab-pane fade" id="recent1">
              
              	<?php echo $recent_posts;?>
              
              </div><!--Recent posts End-->
              
              <!--Comments-->
              <div class="tab-pane fade" id="comment1">
              
              	<div class="popular-post-box">
                    
                    <div class="post-title-side">Etiam tristique niba</div>
                    <div class="post-date-side">April, 7th, 2014</div>
                </div>
                <div class="popular-post-box">
                    
                    <div class="post-title-side">Etiam tristique niba</div>
                    <div class="post-date-side">April, 7th, 2014</div>
                </div>
                <div class="popular-post-box">
                    
                    <div class="post-title-side">Etiam tristique niba</div>
                    <div class="post-date-side">April, 7th, 2014</div>
                </div>
              
              </div><!--Comments end-->
              
            </div><!-- Tab panes end-->
            
        </div><!-- side item-end -->
        
        <!--Sidebar-item-->
        <div class="form-widget">
        
        	<div class="appointment-form-title"><i class="icon-hospital2 appointment-form-icon"></i>Book An Appointment</div>
            <form class="appt-form">
            <select class="appt-form-select">
            <option>Select Department</option>
            <option>Select Department</option>
            <option>Select Department</option>
            <option>Select Department</option>
            </select>
            <input type="text" class="appt-form-txt" placeholder="First Name(required)" />
            <input type="text" class="appt-form-txt" placeholder="Last Name" />
            <input type="text" class="appt-form-txt" placeholder="Phone(required)" />
            <input type="email" class="appt-form-txt" placeholder="Email(required)" />
            <input type="date" class="appt-form-txt" />
             <section class="color-7" id="btn-click1">
    <button class="icon-mail btn2-st2 btn-7 btn-7b iform-button-60">Submit</button>
    </section>
            </form>
        
        </div><!--Sidebar-item end-->