<!doctype html>
<html lang="en">
 <?php echo $this->load->view('site/includes/header', '', TRUE);?>

<body>
<div id="main-wrapper">

   <?php echo $this->load->view('site/includes/navigation', '', TRUE);?>

    
   <?php echo $content;?>
   
   <?php echo $this->load->view('site/includes/footer', '', TRUE);?>

</div> <!-- end #main-wrapper -->

<!-- Scripts -->
<script src="<?php echo base_url().'assets/themes/jquery/'?>jquery-2.1.1.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/maplace.min.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/jquery.ba-outside-events.min.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/jquery.responsive-tabs.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/jquery.flexslider-min.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/jquery.fitvids.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/jquery.inview.min.js"></script>
<script src="<?php echo base_url().'assets/themes/careers/'?>js/script.js"></script>

</body>
</html>