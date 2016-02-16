	<div id="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 page-content">
                    <div class="title-lines">
                        <h3 class="mt0">Find a Job Per</h3>
                    </div>

                    <div class="find-job-tabs responsive-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="<?php echo base_url()?>home#find-job-tabs-map-check">Map</a></li>
                            <li><a href="<?php echo base_url()?>#find-job-tabs-industry">Industry</a></li>
                            <li><a href="<?php echo base_url()?>#find-job-tabs-role">Type</a></li>
                            <li><a href="<?php echo base_url()?>#find-job-tabs-country">Country</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="find-job-tabs-map-check">
                                <?php /* === THIS IS WHERE WE WILL ADD OUR MAP USING JS ==== */ ?>
                <div class="google-map-wrap" itemscope itemprop="hasMap" itemtype="http://schema.org/Map">
                    <div id="google-map" class="google-map">
                    </div><!-- #google-map -->
                </div>

                <?php /* === MAP DATA === */ ?>
                <?php
                $locations = array();

                if ($jobs->num_rows() > 0)
                {
                    
                    $result = '';
                    
                    foreach ($jobs->result() as $row)
                    {
                        $job_id = $row->job_id;
                        $job_title = $row->job_title;
                        $job_status = $row->job_status;
                        $job_description = $row->job_description;
                        $job_start_location = $row->job_start_location;
                        $job_destination = $row->job_destination;
                        $created = $row->created;
                        $last_modified = $row->last_modified;

                        $contact_person_name = $row->contact_person_name;
                        $contact_person_phone = $row->contact_person_phone;

                        $member_first_name = $row->member_first_name;
                        $member_last_name = $row->member_last_name;
                        $member_email = $row->member_email;
                        $member_phone = $row->member_phone;

                        $start_location_lat = $row->start_location_lat;
                        $start_location_long = $row->start_location_long;
                        $end_location_lat = $row->end_location_lat;
                        $end_location_long = $row->end_location_long;

                        $pick_up_location_detail = $row->pick_up_location_detail;
                        $delivery_location_detail = $row->delivery_location_detail;

                        $day = date('j',strtotime($created));
                        $month = date('M Y',strtotime($created));


                        /* Marker #1 */
                        $locations[] = array(
                            'google_map' => array(
                                'lat' => $start_location_lat,
                                'lng' => $start_location_long,
                            ),
                            'location_address' => $pick_up_location_detail,
                            'location_name'    => $pick_up_location_detail,
                        );


                    }
                }
                
                // var_dump($locations) or die();
                ?>


                <?php /* === PRINT THE JAVASCRIPT === */ ?>

                <?php
                /* Set Default Map Area Using First Location */
                $map_area_lat = isset( $locations[0]['google_map']['lat'] ) ? $locations[0]['google_map']['lat'] : '';
                $map_area_lng = isset( $locations[0]['google_map']['lng'] ) ? $locations[0]['google_map']['lng'] : '';
                ?>

                <script>
                jQuery( document ).ready( function($) {

                    /* Do not drag on mobile. */
                    var is_touch_device = 'ontouchstart' in document.documentElement;

                    var map = new GMaps({
                        el: '#google-map',
                        lat: '<?php echo $map_area_lat; ?>',
                        lng: '<?php echo $map_area_lng; ?>',
                        scrollwheel: false,
                        draggable: ! is_touch_device
                    });

                    /* Map Bound */
                    var bounds = [];

                    <?php /* For Each Location Create a Marker. */
                    foreach( $locations as $location ){
                        $name = $location['location_name'];
                        $addr = $location['location_address'];
                        $map_lat = $location['google_map']['lat'];
                        $map_lng = $location['google_map']['lng'];
                        ?>
                        /* Set Bound Marker */
                        var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>);
                        bounds.push(latlng);
                        /* Add Marker */
                        map.addMarker({
                            lat: <?php echo $map_lat; ?>,
                            lng: <?php echo $map_lng; ?>,
                            title: '<?php echo $name; ?>',
                            infoWindow: {
                                content: '<p><?php echo $name; ?></p>'
                            }
                        });
                    <?php } //end foreach locations ?>

                    /* Fit All Marker to map */
                    map.fitLatLngBounds(bounds);

                    /* Make Map Responsive */
                    var $window = $(window);
                    function mapWidth() {
                        var size = $('.google-map-wrap').width();
                        $('.google-map').css({width: size + 'px', height: (size/2) + 'px'});
                    }
                    mapWidth();
                    $(window).resize(mapWidth);

                });
                </script>

                                <hr class="m0 primary">

                                <div class="row p30">
                                    <div class="col-sm-6">
                                        <ul class="filter-list">
                                            <li><a href="index.html#">Asia <span>(1234)</span></a></li>
                                            <li><a href="index.html#">Africa <span>(5678)</span></a></li>
                                            <li><a href="index.html#">Europe <span>(910)</span></a></li>
                                            <li><a href="index.html#">North America <span>(347)</span></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">
                                        <ul class="filter-list">
                                            <li><a href="index.html#">Central America <span>(52)</span></a></li>
                                            <li><a href="index.html#">South America <span>(117)</span></a></li>
                                            <li><a href="index.html#">Oceania <span>(736)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="find-job-tabs-industry">
                                <div class="row p30">
                                    <div class="col-sm-6">
                                        <h6 class="mt0">Administrative and Support Services</h6>

                                        <ul class="filter-list">
                                            <li><a href="index.html#">Support Services <span>(34)</span></a></li>
                                            <li><a href="index.html#">Consulting Services <span>(142)</span></a></li>
                                            <li><a href="index.html#">Customer Service <span>(67)</span></a></li>
                                            <li><a href="index.html#">Employment Placement <span>(24)</span></a></li>
                                            <li><a href="index.html#">Agencies/Recruiting <span>(113)</span></a></li>
                                            <li><a href="index.html#">Human Resources <span>(27)</span></a></li>
                                            <li><a href="index.html#">Administration <span>(57)</span></a></li>
                                            <li><a href="index.html#">Contracts/Purchasing <span>(29)</span></a></li>
                                            <li><a href="index.html#">Secretarial <span>(22)</span></a></li>
                                            <li><a href="index.html#">Security <span>(26)</span></a></li>
                                            <li><a href="index.html#">Telemarketing <span>(4)</span></a></li>
                                            <li><a href="index.html#">Translation <span>(12)</span></a></li>
                                            <li><a href="index.html#">Management <span>(70)</span></a></li>
                                            <li><a href="index.html#">Business Support <span>(29)</span></a></li>
                                        </ul>

                                        <h6>Healthcare and Science</h6>

                                        <ul class="filter-list">
                                            <li><a href="index.html#">Pharmaceutical <span>(42)</span></a></li>
                                            <li><a href="index.html#">Manufacturing <span>(149)</span></a></li>
                                            <li><a href="index.html#">Mechanical <span>(28)</span></a></li>
                                            <li><a href="index.html#">Technical/Maintenance <span>(40)</span></a></li>
                                            <li><a href="index.html#">Lubricants/Greases Blending <span>(10)</span></a></li>
                                            <li><a href="index.html#">Textiles <span>(10)</span></a></li>
                                            <li><a href="index.html#">Aerospace and Defense <span>(14)</span></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">
                                        <h6 class="mt0">Manufacturing and Industrial</h6>

                                        <ul class="filter-list">
                                            <li><a href="index.html#">Agriculture/Forestry/Fishing <span>(42)</span></a></li>
                                            <li><a href="index.html#">Installation/Maintenance <span>(37)</span></a></li>
                                            <li><a href="index.html#">Manufacturing and Production <span>(96)</span></a></li>
                                            <li><a href="index.html#">Mining <span>(9)</span></a></li>
                                            <li><a href="index.html#">Safety/Environment <span>(21)</span></a></li>
                                            <li><a href="index.html#">Industrial <span>(184)</span></a></li>
                                            <li><a href="index.html#">Manufacturing <span>(149)</span></a></li>
                                            <li><a href="index.html#">Mechanical <span>(28)</span></a></li>
                                            <li><a href="index.html#">Technical/Maintenance <span>(40)</span></a></li>
                                            <li><a href="index.html#">Lubricants/Greases Blending <span>(10)</span></a></li>
                                            <li><a href="index.html#">Textiles <span>(10)</span></a></li>
                                            <li><a href="index.html#">Aerospace and Defense <span>(14)</span></a></li>
                                        </ul>

                                        <h6>Healthcare and Science</h6>

                                        <ul class="filter-list">
                                            <li><a href="index.html#">Pharmaceutical <span>(42)</span></a></li>
                                            <li><a href="index.html#">Manufacturing <span>(149)</span></a></li>
                                            <li><a href="index.html#">Mechanical <span>(28)</span></a></li>
                                            <li><a href="index.html#">Technical/Maintenance <span>(40)</span></a></li>
                                            <li><a href="index.html#">Lubricants/Greases Blending <span>(10)</span></a></li>
                                            <li><a href="index.html#">Textiles <span>(10)</span></a></li>
                                            <li><a href="index.html#">Aerospace and Defense <span>(14)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="find-job-tabs-role">
                                <div class="p30">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum, harum, optio, repudiandae voluptatum illum et ipsam quisquam at dolore illo eaque odio inventore quos esse reiciendis laudantium nobis aperiam iure!</p>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <ul class="filter-list">
                                                <li><a href="index.html#">Accounting/Banking/Finance Jobs <span>(581)</span></a></li>
                                                <li><a href="index.html#">Administration Jobs <span>(406)</span></a></li>
                                                <li><a href="index.html#">Art/Design/Creative Jobs <span>(176)</span></a></li>
                                                <li><a href="index.html#">Customer Service Jobs <span>(334)</span></a></li>
                                                <li><a href="index.html#">Education/Training Jobs <span>(180)</span></a></li>
                                                <li><a href="index.html#">Engineering Jobs <span>(978)</span></a></li>
                                                <li><a href="index.html#">Healthcare/Medical Jobs <span>(131)</span></a></li>
                                                <li><a href="index.html#">Human Resources/Personnel Jobs <span>(318)</span></a></li>
                                                <li><a href="index.html#">Law/Legal Jobs <span>(61)</span></a></li>
                                                <li><a href="index.html#">Logistics Jobs <span>(144)</span></a></li>
                                                <li><a href="index.html#">Management Jobs <span>(743)</span></a></li>
                                                <li><a href="index.html#">Law/Legal Jobs <span>(61)</span></a></li>
                                                <li><a href="index.html#">Logistics Jobs <span>(144)</span></a></li>
                                                <li><a href="index.html#">Management Jobs <span>(743)</span></a></li>
                                            </ul>
                                        </div>

                                        <div class="col-sm-6">
                                            <ul class="filter-list">
                                                <li><a href="index.html#">Marketing/PR Jobs <span>(329)</span></a></li>
                                                <li><a href="index.html#">Other Jobs <span>(326)</span></a></li>
                                                <li><a href="index.html#">Purchasing/Procurement Jobs <span>(130)</span></a></li>
                                                <li><a href="index.html#">Quality Control Jobs <span>(93)</span></a></li>
                                                <li><a href="index.html#">Research Jobs <span>(33)</span></a></li>
                                                <li><a href="index.html#">Safety Jobs <span>(72)</span></a></li>
                                                <li><a href="index.html#">Sales Jobs <span>(1061)</span></a></li>
                                                <li><a href="index.html#">Secretarial Jobs <span>(155)</span></a></li>
                                                <li><a href="index.html#">Support Services Jobs <span>(744)</span></a></li>
                                                <li><a href="index.html#">Technology/IT Jobs <span>(546)</span></a></li>
                                                <li><a href="index.html#">Writing/Editing Jobs <span>(19)</span></a></li>
                                                <li><a href="index.html#">Support Services Jobs <span>(744)</span></a></li>
                                                <li><a href="index.html#">Technology/IT Jobs <span>(546)</span></a></li>
                                                <li><a href="index.html#">Writing/Editing Jobs <span>(19)</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="find-job-tabs-country">
                                <div class="row p30">
                                    <div class="col-sm-6">
                                        <ul class="country-list">
                                            <li><a href="index.html#"><img src="img/flag-icons/Afghanistan.png" alt=""> Afghanistan <span>(7)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/African Union.png" alt=""> African Union <span>(6)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Aland.png" alt=""> Aland <span>(2)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Albania.png" alt=""> Albania <span>(7)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Alderney.png" alt=""> Alderney <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Algeria.png" alt=""> Algeria <span>(4)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/American Samoa.png" alt=""> American Samoa <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Andorra.png" alt=""> Andorra <span>(5)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Angola.png" alt=""> Angola <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Anguilla.png" alt=""> Anguilla <span>(8)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Antarctica.png" alt=""> Antarctica <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Antigua Barbuda.png" alt=""> Antigua &amp; Barbuda <span>(6)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Arab League.png" alt=""> Arab League <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Argentina.png" alt=""> Argentina <span>(2)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Armenia.png" alt=""> Armenia <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Aruba.png" alt=""> Aruba <span>(8)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/ASEAN.png" alt=""> ASEAN <span>(3)</span></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">
                                        <ul class="country-list">
                                            <li><a href="index.html#"><img src="img/flag-icons/Kenya.png" alt=""> Kenya <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Kiribati.png" alt=""> Kiribati <span>(4)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Kosovo.png" alt=""> Kosovo <span>(2)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Kuwait.png" alt=""> Kuwait <span>(6)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Kyrgyzstan.png" alt=""> Kyrgyzstan <span>(1)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Laos.png" alt=""> Laos <span>(3)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Latvia.png" alt=""> Latvia <span>(4)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Lebanon.png" alt=""> Lebanon <span>(2)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Lesotho.png" alt=""> Lesotho <span>(5)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Liberia.png" alt=""> Liberia <span>(7)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Libya.png" alt=""> Libya <span>(1)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Liechtenstein.png" alt=""> Liechtenstein <span>(6)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Lithuania.png" alt=""> Lithuania <span>(2)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Luxembourg.png" alt=""> Luxembourg <span>(8)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Macao.png" alt=""> Macao <span>(5)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Macedonia.png" alt=""> Macedonia <span>(2)</span></a></li>
                                            <li><a href="index.html#"><img src="img/flag-icons/Madagascar.png" alt=""> Madagascar <span>(1)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end .find-job-tabs -->



                    
                  
                </div> <!-- end .page-content -->

                <div class="col-sm-4 page-sidebar">
                    <aside>
                        <div class="widget sidebar-widget white-container social-widget">
                            <h5 class="widget-title">Share Us</h5>

                            <div class="widget-content">
                                <div class="row row-p5">
                                    <div class="col-xs-6 col-md-3 share-box facebook">
                                        <div class="count">86</div>
                                        <a href="index.html#">Facebook</a>
                                    </div>

                                    <div class="col-xs-6 col-md-3 share-box twitter">
                                        <div class="count">2.2k</div>
                                        <a href="index.html#">Twitter</a>
                                    </div>

                                    <div class="col-xs-6 col-md-3 share-box google">
                                        <div class="count">324</div>
                                        <a href="index.html#">Google +</a>
                                    </div>

                                    <div class="col-xs-6 col-md-3 share-box linkedin">
                                        <div class="count">1.5k</div>
                                        <a href="index.html#">LinkedIn</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget sidebar-widget text-center">
                            <a href="index.html#"><img src="img/content/sidebar-ad.png" alt=""></a>
                        </div>

                        <div class="white-container">
                            <div class="widget sidebar-widget">
                                <h5 class="widget-title">5 Tips To Pass Your Interview!</h5>

                                <div class="widget-content">
                                    <div class="fitvidsjs">
                                        <iframe src="http://www.youtube.com/embed/A6XUVjK9W4o?rel=0&amp;controls=2&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="widget sidebar-widget">
                                <h5 class="widget-title">The Poll</h5>

                                <div class="widget-content">
                                    <p>Are you satisfied with your current employer?</p>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sidebarpoll" value="" checked>
                                            Definitely Yes
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sidebarpoll" value="">
                                            Rather Yes
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sidebarpoll" value="">
                                            I'm not sure
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sidebarpoll" value="">
                                            Rather Not
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sidebarpoll" value="">
                                            Not at all
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div> <!-- end .page-sidebar -->
            </div>
        </div> <!-- end .container -->

        
    </div> <!-- end #page-content -->

