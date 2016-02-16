<div class="row">

	<div class="col-sm-12">	
		<a href="<?php echo base_url();?>my-jobs" class="btn btn-sm btn-info pull-right" >Go back to my Jobs</a>
	</div>
</div>
          <div class="padd">
            <?php
				$error2 = validation_errors(); 
				if(!empty($error2)){?>
					<div class="row">
						<div class="col-md-6 col-md-offset-2">
							<div class="alert alert-danger">
								<strong>Error!</strong> <?php echo validation_errors(); ?>
							</div>
						</div>
					</div>
				<?php }
				
				$attributes = array('role' => 'form', 'class' => 'form-horizontal');
		
				echo form_open($this->uri->uri_string(), $attributes);
				
				?>
                <div class="row">
                	<div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="slideshow_name">Job title</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="job_title" placeholder="Enter job title" value="<?php echo $row->job_title;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="job_start_location">Job Start Location</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="job_start_location" placeholder="Enter job title" value="<?php echo $row->job_start_location;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="job_destination">Pick up Point Detail</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pick_up_location_detail" placeholder="i.e. Building name/ Floor" value="<?php echo $row->pick_up_location_detail;?>" >
                            </div>
                        </div>
					</div>
                	<div class="col-md-6">
                    	<!-- Activate checkbox -->
                    	<div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_name">Contact Person Name</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_name" placeholder="Enter job title" value="<?php echo $row->contact_person_name;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_phone">Contact Person Phone</label>
                            <div class="col-md-8">
                            	<input type="text" class="form-control" name="contact_person_phone" placeholder="Enter job title" value="<?php echo $row->contact_person_phone;?>">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label" for="contact_person_phone">Delivery Location Detail</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="delivery_location_detail" placeholder="i.e. Building name/ Floor" value="<?php echo $row->delivery_location_detail?>">
                            </div>
                        </div>
                       
                	</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                            <div id="map_3" style=" height:400px"></div>
                           <input type="hidden" id="location" name="location" class="span12" value="<?php echo $row->start_location_lat.','.$row->start_location_long;?>">
                           <input type="text" id="start_location_lat" value="<?php echo $row->start_location_lat?>">
                           <input type="text" id="start_location_long" value="<?php echo $row->start_location_long?>">
                    </div>
                     <div class="col-md-6">
                            <div id="map_2" style=" height:400px"></div>
                           <input type="text" id="location_destination" name="location_destination" class="span12" value="<?php echo $row->end_location_lat.','.$row->end_location_long;?>">
                    </div>
                </div>
                
                <div class="row">
                	<div class="col-md-12">
                            <label class="col-md-2 control-label" for="job_description">Job description</label>
                            <div class="col-md-10">
                            	<textarea class="cleditor" name="job_description"><?php echo $row->job_description;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Edit job" class="login_btn btn btn-success btn-lg">
				</div>
				<?php
					form_close();
				?>
		</div>
<script type="text/javascript">
    var map = new GMap2(document.getElementById("map_3"));
    //var start = new GLatLng(65,25);
    var start_location_lat = document.getElementById("start_location_lat").value;
    var start_location_long = document.getElementById("start_location_lat").value;
    start_location_long = parseFloat(start_location_long);
    start_location_lat = parseFloat(start_location_lat);
    alert(start_location_long);
    map.setCenter(new GLatLng(-1.265385,36.816444), 12);
    map.addControl(new GMapTypeControl(1));
    map.addControl(new GLargeMapControl());

    map.enableContinuousZoom();
    map.enableDoubleClickZoom();

    // "tiny" marker icon
    var icon = new GIcon();
    icon.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
    icon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
    icon.iconSize = new GSize(12, 20);
    icon.shadowSize = new GSize(22, 20);
    icon.iconAnchor = new GPoint(6, 20);
    icon.infoWindowAnchor = new GPoint(5, 1);

    /////Draggable markers
    var point = new GLatLng(start_location_lat,start_location_long);
    var markerD2 = new GMarker(point, {icon:G_DEFAULT_ICON, draggable: true}); 
    map.addOverlay(markerD2);

    markerD2.enableDragging();

    GEvent.addListener(markerD2, "drag", function(){
    document.getElementById("location").value=markerD2.getPoint().toUrlValue();
    });





    ////Mouse pointer

    GEvent.addListener(map, "mousemove", function(point){
    document.getElementById("mouse").value=point.toUrlValue();
    });

</script>