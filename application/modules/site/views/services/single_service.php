<?php

$service_id = $row->service_id;
$service_name = $row->service_name;
$description = $row->service_description;
?>

     <div class="container">
    <!--About-us top-content-->

          <div class="row">

     
            <div class="col-md-12 col-xs-12 col-sm-12 pull-left full-content wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-offset="130">
            <div class="full-content-title about-top-pad"><?php echo $service_name;?></div>
                
            </div>
             <!-- Post info -->
            <div class="pm-single-post-article">
            	<p><?php echo $description;?></p>
            </div>
            
            <!-- Post info end -->
            
            
            

         </div>
         
    </div>