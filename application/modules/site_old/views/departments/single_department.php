<?php

$department_id = $row->department_id;
$department_name = $row->department_name;
$department_status = $row->department_status;
$image = base_url().'assets/department/'.$row->department_image_name;

$created_by = $row->created_by;
$modified_by = $row->modified_by;
$description = $row->department_description;
$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
$created = $row->created;
$day = date('j',strtotime($created));
$month = date('M Y',strtotime($created));
$created_on = date('jS M Y H:i a',strtotime($row->created));
	



?>

      
        
     <div class="container">
    <!--About-us top-content-->

          <div class="row">

     
            <div class="col-md-12 col-xs-12 col-sm-12 pull-left full-content wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-offset="130">
            <div class="full-content-title about-top-pad"><?php echo $department_name;?></div>
             
            </div>
             <!-- Post info -->
            <div class="pm-single-post-article">
                <p><?php echo $description;?></p>
            </div>
            
            <!-- Post info end -->
            
            
            

         </div>
         
         </div>
