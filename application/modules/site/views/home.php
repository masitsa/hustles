 <style type="text/css">
 body { font: normal 10pt Helvetica, Arial; }
 #map { width: 100%; height: 500px; border: 0px; padding: 0px; }
 </style>
 <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript"></script>
 <script type="text/javascript">
 //Sample code written by August Li
 var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
 new google.maps.Size(32, 32), new google.maps.Point(0, 0),
 new google.maps.Point(16, 32));
 var center = null;
 var map = null;
 var currentPopup;
 var bounds = new google.maps.LatLngBounds();
 function addMarker(lat, lng, info) {
 var pt = new google.maps.LatLng(lat, lng);
 bounds.extend(pt);
 var marker = new google.maps.Marker({
 position: pt,
 icon: icon,
 map: map
 });
 var popup = new google.maps.InfoWindow({
 content: info,
 maxWidth: 300
 });
 google.maps.event.addListener(marker, "click", function() {
 if (currentPopup != null) {
 currentPopup.close();
 currentPopup = null;
 }
 popup.open(map, marker);
 currentPopup = popup;
 });
 google.maps.event.addListener(popup, "closeclick", function() {
 map.panTo(center);
 currentPopup = null;
 });
 }
 function initMap() {
 map = new google.maps.Map(document.getElementById("map"), {
 center: new google.maps.LatLng(0, 0),
 zoom: 14,
 mapTypeId: google.maps.MapTypeId.ROADMAP,
 mapTypeControl: false,
 mapTypeControlOptions: {
 style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
 },
 navigationControl: true,
 navigationControlOptions: {
 style: google.maps.NavigationControlStyle.SMALL
 }
 });
 <?php

if ($jobs->num_rows() > 0)
{    
    foreach ($jobs->result() as $row)
    {
        $start_location_lat = $row->start_location_lat;
        $start_location_long = $row->start_location_long;
        $job_title = $row->job_title;
        $job_status = $row->job_status;
        $job_description = $row->job_description;

         echo ("addMarker($start_location_lat, $start_location_long,'<b>$job_title</b><br/>$job_description');\n");
    }
}
 ?>
 center = bounds.getCenter();
 map.fitBounds(bounds);
 
 }
 </script>

    <div id="page-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 page-content">
                    <div class="title-lines">
                        <h3 class="mt0">Find a Job Per</h3>
                    </div>

                    <div class="find-job-tabs responsive-tabs">
                       <div id="map"></div>
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
