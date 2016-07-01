<!DOCTYPE HTML>
<!--[if gt IE 8]> <html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
   <?php echo $this->load->view('includes/header', '', TRUE);?>
<body>
 <?php echo $this->load->view('includes/navigation', '', TRUE);?>

    <section class="complete-content content-footer-space">
    
          <div class="about-intro-wrap pull-left">
     
                <?php echo $this->load->view('contact_us/includes/sub_header', '', TRUE);?>
     
     <!--map-->
                <?php echo $content;?>
         
         </div>
         

    <!--Mid Content End-->
    
    
               <!--Footer Start-->
    
    </section>


    
    <section class="complete-footer">
    <?php echo $this->load->view('includes/footer', '', TRUE);?>

    </section>

    
    <!--JS Inclution-->
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/jquery-ui-1.10.3.custom.min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>bootstrap-new/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/jquery.scrollUp.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/jquery.sticky.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/wow.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/jquery.flexisel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/jquery.imedica.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/custom-imedicajs.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url().'assets/themes/iMedica/'?>js/imedica-js/view.contact.js"></script>
    
    <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <script type="text/javascript">
        
        $("#map-canvas").gMap({
            
            styles:[{stylers:[
        {
            featureType: 'water', // set the water color
            elementType: 'geometry.fill', // apply the color only to the fill
            stylers: [
                { color: '#adc9b8' }
            ]
        },{
            featureType: 'landscape.natural', // set the natural landscape
            elementType: 'all',
            stylers: [
                { hue: '#809f80' },
                { lightness: -35 }
            ]
        }
        ,{
            featureType: 'poi', // set the point of interest
            elementType: 'geometry',
            stylers: [
                { hue: '#f9e0b7' },
                { lightness: 30 }
            ]
        },{
            featureType: 'road', // set the road
            elementType: 'geometry',
            stylers: [
                { hue: '#d5c18c' },
                { lightness: 14 }
            ]
        },{
            featureType: 'road.local', // set the local road
            elementType: 'all',
            stylers: [
                { hue: '#ffd7a6' },
                { saturation: 100 },
                { lightness: -12 }
            ]
        }
    ]}],
            controls: false,
            scrollwheel: false,
            maptype: 'ROADMAP',
            markers: [
                {
                    latitude: 40.753317,
                    longitude: -73.968905,
                    icon: {
                        image: "images/location.png",
                        iconsize: [85, 121],
                        iconanchor: [85, 121]
                    }
                },

            ],
            icon: {
                image: "images/location.png", 
                iconsize: [85, 121],
                iconanchor: [85, 121]
            },
            latitude: 40.753317,
            longitude: -73.968905,
            
            zoom: 12,
            mapTypeId: 'Styled'
            
            
        });
        
        </script>
    
</body>
</html>