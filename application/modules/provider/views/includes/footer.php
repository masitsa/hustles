<script type="text/javascript">
	$(document).on("click","a.unassign_job",function()
    {
    	var config_url = '<?php echo site_url();?>';
        // var job_seeker_id = $(this).attr('job_seeker_id');
        var job_id = $(this).attr('job_id');
  		alert($(this).attr('href'));
        $.ajax({
            type:'POST',
            url: $(this).attr('href'),
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                
                if(data.result == "success")
                {
                   
                	window.alert("Job seeker has been succesfully activated");
                  	window.location.href = config_url+'view-job'+job_id;
                }
                else
                {
                	window.alert("Job seekers account has not been deactivated please try again"
                }
            },
            error: function(xhr, status, error) {
                alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
            }
        });
        
        return false;
    });
    $(document).on("click","a.assign_job",function()
    {
    	var config_url = '<?php echo site_url();?>';
        var job_id = $(this).attr('job_id');
  	// alert($(this).attr('href'));
        $.ajax({
            type:'POST',
            url: $(this).attr('href'),
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                
                if(data.result == "success")
                {
                   
                	window.alert("Job seeker has been succesfully activated");
                  	window.location.href = config_url+'view-job/'+job_id;
                }
                else
                {
                	window.alert("Job seekers account has not been deactivated please try again"
                }
            },
            error: function(xhr, status, error) {
                alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
            }
        });
        
        return false;
    });

    $(document).on("click","a.record_disptach_time",function()
    {
    	var config_url = '<?php echo site_url();?>';
    	 var job_id = $(this).attr('job_id');
        // var job_seeker_id = $(this).attr('job_seeker_id');
  	// alert($(this).attr('href'));
        $.ajax({
            type:'POST',
            url: $(this).attr('href'),
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                
                if(data.result == "success")
                {
                   
                	window.alert("Job seeker has been succesfully activated");
                  	window.location.href = config_url+'view-job/'+job_id;
                }
                else
                {
                	window.alert("Job seekers account has not been deactivated please try again"
                }
            },
            error: function(xhr, status, error) {
                alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
            }
        });
        
        return false;
    });
   $(document).on("click","a.mark_job_as_completed",function()
    {
    	var config_url = '<?php echo site_url();?>';
    	 // var job_id = $(this).attr('job_id');
        // var job_seeker_id = $(this).attr('job_seeker_id');
  	// alert($(this).attr('href'));
        $.ajax({
            type:'POST',
            url: $(this).attr('href'),
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success:function(data){
                
                if(data.result == "success")
                {
                   
                	window.alert("The job has been marked as complete");
                  	window.location.href = config_url+'my-jobs';
                }
                else
                {
                	window.alert("Job seekers account has not been deactivated please try again"
                }
            },
            error: function(xhr, status, error) {
                alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
            }
        });
        
        return false;
    });
</script>
<script type="text/javascript">
    var map = new GMap2(document.getElementById("map_1"));
    //var start = new GLatLng(65,25);
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




    var point = new GLatLng(-1.265385,36.816444);
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

    // second map items

    var map_destination = new GMap2(document.getElementById("map_2"));
    //var start = new GLatLng(65,25);
    map_destination.setCenter(new GLatLng(-1.265385,36.816444), 12);
    map_destination.addControl(new GMapTypeControl(1));
    map_destination.addControl(new GLargeMapControl());

    map_destination.enableContinuousZoom();
    map_destination.enableDoubleClickZoom();



    // "tiny" marker icon
    var icon = new GIcon();
    icon.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
    icon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
    icon.iconSize = new GSize(12, 20);
    icon.shadowSize = new GSize(22, 20);
    icon.iconAnchor = new GPoint(6, 20);
    icon.infoWindowAnchor = new GPoint(5, 1);



    /////Draggable markers




    var point = new GLatLng(-1.265385,36.816444);
    var markerD2 = new GMarker(point, {icon:G_DEFAULT_ICON, draggable: true}); 
    map_destination.addOverlay(markerD2);

    markerD2.enableDragging();

    GEvent.addListener(markerD2, "drag", function(){
    document.getElementById("location_destination").value=markerD2.getPoint().toUrlValue();
    });





    ////Mouse pointer

    GEvent.addListener(map, "mousemove", function(point){
    document.getElementById("mouse").value=point.toUrlValue();
    });


    //]]>
    </script>

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 

<!-- JS -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery-ui-1.10.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo base_url()."assets/themes/jasny/js/jasny-bootstrap.js"?>" type="text/javascript"/></script>
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/excanvas.min.js"></script>
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.flot.js"></script>
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.flot.resize.js"></script>
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.flot.stack.js"></script>

<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.gritter.min.js"></script> <!-- jQuery Gritter -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/custom.js"></script> <!-- Custom codes -->
 <!--<script src="<?php echo base_url()."assets/themes/bluish";?>/js/charts.js"></script> Custom chart codes -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.mousewheel.js"></script> <!-- Mouse Wheel -->
<script src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.horizontal.scroll.js"></script> <!-- horizontall scroll with mouse wheel -->
<script type="text/javascript" src="<?php echo base_url()."assets/themes/bluish";?>/js/jquery.slimscroll.min.js"></script> <!-- vertical scroll with mouse wheel -->
