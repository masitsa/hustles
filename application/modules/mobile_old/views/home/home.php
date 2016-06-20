
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRL4A7M9ZGM7GIPaZqbfv67xtcPFLc2xc&libraries=places"></script>-->
<script type="text/javascript">

	var latitude, longitude;
	latitude = -1.2920659;
	longitude = 36.82194619999996;
	// Try HTML5 geolocation.
	if (navigator.geolocation) 
	{
		navigator.geolocation.getCurrentPosition(function(position) 
		{
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
		}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
		});
	} 
	else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	}
	
	//set default location
	var default_location = new google.maps.LatLng(latitude, longitude);
	
	var markers = [];
	var map;
		
	var mapOptions = {
		zoom: 13,
		center: default_location,
		//mapTypeId: google.maps.MapTypeId.SATELLITE
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	function initialize() {
		
		/*marker = new google.maps.Marker({
			map:map,
			draggable:true,
			animation: google.maps.Animation.DROP,
			position: default_location,
			title: 'Hello World!'
		});
		google.maps.event.addListener(marker, 'click', toggleBounce);
		
		marker.setMap(map);*/
		drop();
	}
	function toggleBounce() {
	
		if (marker.getAnimation() != null) 
		{
			marker.setAnimation(null);
		} 
		else 
		{
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}
	
	//drop multiple markers one at a time
	function drop() {
		//clearMarkers();
		
		/*for (var i = 0; i < neighborhoods.length; i++) {//alert(i);
			addMarkerWithTimeout(neighborhoods[i], i * 200);
		}*/
		
		//get jobs
		$.ajax({
			type:'POST',
			url: 'http://localhost/hustles/mobile/jobs/all_jobs',
			cache:false,
			contentType: false,
			processData: false,
			dataType: 'json',
			statusCode: {
				302: function() {
					//window.location.href = '<?php echo site_url();?>error';
				}
			},
			success:function(data){
				
				if(data.message == "success")
				{
					var arr = $.map(data.result, function(el) { return el; });
					
					for (var i = 0; i < arr.length; i++)
					{
						var longitude = arr[i].start_location_long;
						var latitude = arr[i].start_location_lat;
						var job_id = arr[i].job_id;
						var job_title = arr[i].job_title;
						var job_description = arr[i].job_description;
						var delivery_location_detail = arr[i].delivery_location_detail;
						
						var after_service = '';
						var delivery_location_detail = 'Drop at '+delivery_location_detail;
						
						if(!longitude || longitude == '')
						{
						}
						
						else
						{
							longitude = parseFloat(longitude).toFixed(16);
							latitude = parseFloat(latitude).toFixed(16);
							
							addMarkerWithTimeout(new google.maps.LatLng(latitude, longitude), i * 200, job_title, job_id, job_description, delivery_location_detail);
							
						}
					}
					
					//alert(markers.length);
					//add event listener
					for (var r = 0; r < markers.length; r++) {
						//markers[i].setMap(null);
						google.maps.event.addListener(markers[r], 'click', function() { 
						   alert("I am marker " + markers.title); 
						});
					}
				}
				else
				{
					console.log(data);
				}
			},
			error: function(xhr, status, error) {
				console.log("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
			}
		});
	}
	
	//function addMarkerWithTimeout(position, timeout, job, job_id, after_service, job_location) {
		function addMarkerWithTimeout(position, timeout, job_title, job_id, job_description, delivery_location_detail) {
		window.setTimeout(function() {
			
			//create marker
			var marker = new google.maps.Marker({
								position: position,
								map: map,
								animation: google.maps.Animation.DROP,
								title: job_title
							});
			
			//add marker description
			var contentString = '<span itemprop="streetAddress">'+job_title+'</span><br/><span itemprop="addressLocality">'+delivery_location_detail+'</span><br/><span itemprop="addressLocality">'+job_description+'</span>';
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
			infowindow.open(map,marker);
			
			//on click listener;
			/*marker.addListener('click', function() 
			{
				infowindow.open(map,marker);
				var title = marker.getTitle();
				var conf = confirm('Are you sure you want to select '+title+'?');
				
				if(conf)
				{
					window.location.href = '<?php echo site_url();?>hire-user/'+job_id;
				}
			  });*/
			/*markers.push(new google.maps.Marker({
				position: position,
				map: map,
				animation: google.maps.Animation.DROP,
				title: job
			}));*/
		}, timeout);
	}
	
	//clear all markers
	function clearMarkers() {
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}
		markers = [];
	}
	
  google.maps.event.addDomListener(window, 'load', initialize);
  
  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
	searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
	var places = searchBox.getPlaces();

	if (places.length == 0) {
	  return;
	}

	// Clear out the old markers.
	markers.forEach(function(marker) {
	  marker.setMap(null);
	});
	markers = [];

	// For each place, get the icon, name and location.
	var bounds = new google.maps.LatLngBounds();
	places.forEach(function(place) {
	  var icon = {
		url: place.icon,
		size: new google.maps.Size(71, 71),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(17, 34),
		scaledSize: new google.maps.Size(25, 25)
	  };

	  // Create a marker for each place.
	  markers.push(new google.maps.Marker({
		map: map,
		icon: icon,
		title: place.name,
		position: place.geometry.location
	  }));

	  if (place.geometry.viewport) {
		// Only geocodes have viewport.
		bounds.union(place.geometry.viewport);
	  } else {
		bounds.extend(place.geometry.location);
	  }
	});
	map.fitBounds(bounds);
	drop();
  });


</script>

