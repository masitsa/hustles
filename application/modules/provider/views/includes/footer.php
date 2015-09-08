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