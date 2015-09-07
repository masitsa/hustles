 <div class="container">
                <div class="row">
                <div class="no-pad icon-boxes-1"> 
                    
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
                                $mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
                                $created = $row->created;
                                $day = date('j',strtotime($created));
                                $month = date('M Y',strtotime($created));
                                $created_on = date('jS M Y H:i a',strtotime($row->created));
                                
                                $categories = '';
                                $count = 0;
                                $result .= ' <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3">
                                             <div class="icon-box-3 wow fadeInUp" data-wow-delay="0.6s" data-wow-offset="150">
                                                <div class="icon-boxwrap2"><i class="fa fa-medkit icon-box-back2"></i></div>
                                                <div class="icon-box2-title">'.$department_name.'</div>
                                                <p>'.$mini_desc.'..</p>
                                                <!--<section class="color-10">
                                                    <nav class="cl-effect-10">
                                                    <a href="'.site_url().'departments/'.$web_name.'" data-hover="Read More"><span>Read More</span></a>
                                                    </nav>
                                                </section>-->
                                                <div class="iconbox-readmore"><a href="'.site_url().'departments/'.$web_name.'">Read More</a></div>
                                             </div>   
                                            </div>';


                            }
                        }
                        echo $result;
                        ?>
                    <!--Icon-box-start-->
                   
                    
                   
                    
                    <!--Icon-box-start-->
                    <div class="col-sm-6 col-xs-12 col-md-3 col-lg-3">
                     <div class="icon-box-3 notViewed wow fadeInUp" data-wow-delay="1.5s" data-wow-offset="150">
                        <div class="icon-boxwrap2"><i class="fa fa-clock-o icon-box-back2"></i></div>
                         <div class="icon-box2-title">Opening Hours</div>
                        <ul>
                        <li>Monday - Friday <span class="ibox-right-span">8.00  - 18.00</span></li>
                        <li>Saturday <span class="ibox-right-span">8.00  - 16.00</span></li>
                        <li>Sunday <span class="ibox-right-span">8.00 - 13.00</span></li>
                        </ul>
                     </div>   
                    </div>
                
                </div>
                </div>
            </div>