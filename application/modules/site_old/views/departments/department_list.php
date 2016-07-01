<?php

$result = '';

//if users exist display them

if ($query->num_rows() > 0)
{
    foreach ($query->result() as $row)
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

             <div class="col-sm-5 col-xs-12 col-md-3 col-lg-3 service-box no-pad wow fadeInLeft animated" data-wow-delay="1s" data-wow-offset="150">
                <div class="service-title"><div class="service-icon-container rot-y"><i class="icon-heart panel-icon"></i></div>'.$department_name.'</div>
                <p>'.$mini_desc.'..</p>
                <a href="'.site_url().'departments/'.$web_name.'">read more >></a>
            </div>


            ';
        }
    }
    else
    {
        $result .= "There are no departments :-(";
    }
   
  ?>          
 <div class="container">
    <!--About-us top-content-->

          <div class="row">

             <?php echo $result;?>
                        
            <?php if(isset($links)){echo $links;}?>
         </div> <!--Mid Services End-->

</div>

