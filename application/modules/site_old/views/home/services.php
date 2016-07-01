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
           <div class="post-item-wrap pull-left col-sm-6 col-md-12 col-xs-12">
                <img src="'.$image.'" class="img-responsive post-author-img" alt="" />
                    <div class="post-content1 pull-left col-md-9 col-sm-9 col-xs-8">
                        <div class="post-title pull-left"><a href="index.html#">'.$post_title.'</a></div>
                        <div class="post-meta-top pull-left">
                            <ul>
                            <li><i class="icon-calendar"></i>'.$created.'</li>
                            <li><a href="index.html#"><i class="icon-comments"></i>'.$comments.'</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="post-content2 pull-left">                   
                        '.$mini_desc.'<br/>
                        <span class="post-meta-bottom"><a href="index.html#">Continue Reading...</a></span>
                    </div>
             </div>
        
    ';

}

else
{
    $recent_posts = 'No posts yet';
}
?>  


  <div class="container">
             <div class="row">
             
             
             <!--Latest Post Start-->
             
                 <div class="col-xs-12 col-sm-12 col-md-6 pull-left">
                 
                    <div class="latest-post-wrap pull-left wow fadeInLeft" data-wow-delay="0.5s" data-wow-offset="100">
                        <div class="subtitle col-xs-12 no-pad col-sm-11 col-md-12 pull-left news-sub">latest news</div>
                        
                        <!--Post item-->
                        
                         <?php echo $recent_posts;?>
                        
                         
                         <a href="<?php echo base_url();?>blog" class="dept-details-butt posts-showall">Show All</a>
                            
                        </div>
                    </div>
                   
                 
                 
                 
                 <!--Latest Post End-->
             
                 <!--Departments Start-->
                 
                    <div class="col-xs-12 col-sm-12 col-md-6 pull-right department-wrap wow fadeInRight" data-wow-delay="0.5s" data-wow-offset="100">
                    
                    <div class="subtitle pull-left">Departments</div>
                        
                        <div id="imedica-dep-accordion">


                          <?php

                        $result = '';

                        //if users exist display them

                        if ($departments->num_rows() > 0)
                        {
                            foreach ($departments->result() as $row)
                            {
                                $department_id = $row->department_id;
                                $department_name = $row->department_name;
                                $department_status = $row->department_status;
                                $image = base_url().'assets/department/'.$row->department_image_name;
                                $web_name = $this->site_model->create_web_name($department_name);
                                $created_by = $row->created_by;
                                $modified_by = $row->modified_by;
                                $description = $row->department_description;
                                $mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
                                $created = $row->created;
                                $day = date('j',strtotime($created));
                                $month = date('M Y',strtotime($created));
                                $created_on = date('jS M Y H:i a',strtotime($row->created));
                                
                                $categories = '';
                                $count = 0;
                                
                                $result .= '

                                    
                                     <!-- Accordion Item -->
                                    <h3 class="last-child-ac ilast-child-acc"><i class="icon-heart dept-icon"></i><span class="dep-txt">'.$department_name.'</span></h3>
                                    <div>
                                       <img src="'.$image.'" class="img-responsive dept-author-img-desk col-md-4" alt="" />
                                        <div class="dept-content pull-left col-md-7 col-lg-8">
                                        <div class="dept-title pull-left">'.$department_name.'</div> 
                                        <p>'.$mini_desc.'</p>
                                        
                                        <a href="'.site_url().'departments/'.$web_name.'" class="dept-details-butt">Details</a>
                                        <div class="purchase-strip-blue dept-apponit-butt"><div class="color-4">
                                            <p class="ipurchase-paragraph">
                                                
                                            </p>
                                        </div></div>
                                        <div class="vspacer"></div>
                                        </div>                
                                    </div>


                                    ';
                                }
                            }
                            else
                            {
                                $result .= "There are no departments :-(";
                            }
                           echo $result;
                          ?>          
                            
                           
                            
                           
                           
                            
                        </div>
                        
                        
                    </div>
             
                 <!--Departments End-->
                 </div>
                 </div>