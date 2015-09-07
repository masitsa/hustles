<?php

$result = '';

//if users exist display them

if ($query->num_rows() > 0)
{   
    //get all administrators
    $administrators = $this->users_model->get_all_administrators();
    if ($administrators->num_rows() > 0)
    {
        $admins = $administrators->result();
    }
    
    else
    {
        $admins = NULL;
    }
    
    foreach ($query->result() as $row)
    {
        $post_id = $row->post_id;
        $blog_category_name = $row->blog_category_name;
        $blog_category_id = $row->blog_category_id;
        $post_title = $row->post_title;
        $web_name = $this->site_model->create_web_name($post_title);
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
        $result .= '
           <div class="row  margin-top border-bottom">
                
                
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <!-- Blog box -->
                    <div class="blog-box wow fadeInDown" data-wow-delay="0.5s" data-wow-offset="0">
                        <img alt="" src="'.$image.'" class="img-responsive" />
                        
                    </div>
                </div> 
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fadeInDown wow">
                
                        <div class="blog-box-title">'.$post_title.'</div>
                        <div class="post-meta">By 
                        <span class="post-author ipost-author">'.$created_by.'</span> | 
                        <span class="post-date">'.$created_on.' </span>|
                        <span class="post-author ipost-author">'.$blog_category_name.'</span>|
                        <span class="post-author ipost-author">'.$total_comments.'</span>
                        </div>
                        <div class="post-para">
                            '.$mini_desc.'
                        </div><!--end-post-para-->
                        <div class="r-more">
                        <a href="'.site_url().'blog/view-single/'.$web_name.'">Read More ></a>
                        </div>
                    </div>
                        
                        
        
                </div><!--end-row-->
            ';
        }
    }
    else
    {
        $result .= "There are no posts :-(";
    }
   
  ?>          

 <div class="container">
         	
           
            
            <!--About-us top-content-->

            
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-left blgo-full-wrap no-pad">
				<div id="blog-medium-left">
				
			   <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div id="blog-medium-left"><!--blog-medium-left-->
				
				    <?php echo $result;?>
				</div><!--end-blog-medium-->
                </div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left side-bar-blog-bottom">
                	
                     <?php echo $this->load->view('blog/includes/side_bar', '', TRUE);?>
                    
                  
                    
                    
               </div>
				</div><!--end-blog-medium-left-->
                
                </div>
                       
         </div>