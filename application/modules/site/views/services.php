      
		
     <div class="container">
    <!--About-us top-content-->

          <div class="row">

     
            <div class="col-md-12 col-xs-12 col-sm-12 pull-left full-content wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-offset="130">
            <div class="full-content-title about-top-pad"><?php echo $title;?></div>
            <p>At Absolute Wellness and Nutrition clinic we offer various services that encompases the general well being of an individual. The following are various services we offer at the clinic</p>
            </div>
            
            
            
             <div class="mid-widgets-serices col-xs-12 col-sm-12 col-md-12 col-lg-12 no-pad pull-left services-page">

                <?php
                if($services->num_rows() > 0)
                {
                    foreach($services->result() as $serv)
                    {
                        $service_name = $serv->service_name;
                        $service_web_name = $this->site_model->create_web_name($service_name);
                        $department_name = $serv->department_name;
                        $department_web_name = $this->site_model->create_web_name($department_name);
                        $description = $serv->service_description;
                        $service_image = $serv->service_image_name;
                        
                        //$description = implode(' ', array_slice(explode(' ', strip_tags($description)), 0, 20));
                        $description = substr(strip_tags($description), 0, 200);

                        
                        ?>
         
                        <!--service box-->
                        <div class="col-sm-5 col-xs-12 col-md-3 col-lg-3 service-box no-pad wow fadeInLeft animated" data-wow-delay="1s" data-wow-offset="150">
                            <div class="service-title"><div class="service-icon-container rot-y"><i class="icon-heart panel-icon"></i></div><?php echo $service_name;?></div>
                            <p><?php echo $description;?>...</p>
                            <a href="<?php echo site_url().'services/'.$department_web_name.'/'.$service_web_name;?>">read more >></a>
                        </div>
                    <?php
                }
            }
                    ?>
            
         
                        

         </div> <!--Mid Services End-->

         </div>
         
         </div>