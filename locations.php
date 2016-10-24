<div id='locations-section' class="row">
	<div class="col-xs-12">
		<span class='locations-header'><strong>Locations</strong></span>
		<ul class='locations'>
		<?php
			$args = array(
		        'post_type' => 'page',
		        'meta_key' => '_wp_page_template',
		        'meta_value' => 'page-templates/class-location.php',
				'orderby' => 'sort',
				'order'   => 'ASC'
		    ); 

		    $classLocations = new WP_Query($args);
		    $ct = 0;
		    $activeID = 'active-location';
		    while ($classLocations->have_posts()) : $classLocations->the_post();
		?>
				<li id='<?php echo $activeID ?>' 
					data-lat='<?php echo $post->latitude ?>'
					data-lng='<?php echo $post->longitude ?>'
					data-address='<?php echo $post->address ?>'
					data-class-list='<?php echo $post->class_days_list ?>'>
					<?php echo get_the_title(); ?>
				</li>
		      
				
		<?php 
			$ct++;
			if ($ct > 0) $activeID = ''; 
			endwhile;
			wp_reset_postdata();
		?>
		</ul>

				<div id="map"></div>

		<script>
		    
		    function initMap() {

			var activeLocListItem = document.getElementById('active-location'),
				activeAddress = activeLocListItem.getAttribute('data-address'),
				activeLocDays = activeLocListItem.getAttribute('data-class-list'),
				activeLat = Number(activeLocListItem.getAttribute('data-lat')), 
				activeLng = Number(activeLocListItem.getAttribute('data-lng')),
				activeLatLng = {lat: activeLat, lng: activeLng};

		        var mapDiv = document.getElementById('map');
		        var map = new google.maps.Map(mapDiv, {
					scrollwheel: false,
		            center: activeLatLng,
		            zoom: 14
		        });

		        var header = '<h1>' + activeLocListItem.textContent + '</h1>',
		        	classes = '<ul>' + activeLocDays + '</ul>',
		        	address = '<p>' + activeAddress + '</p>',
		        	beginners = '<span id="for-beginngers"><i>*great for beginners<br/>**always check to make sure<br/> class is not cancelled</i></span>',
		        	markerContent = header + address + classes + beginners;
		        	
		        var infowindow = new google.maps.InfoWindow({
		        	content: markerContent
		        });

		        var marker = new google.maps.Marker({
				    position: activeLatLng,
					animation: google.maps.Animation.DROP,
				    map: map
				});
				infowindow.open(map, marker);

				marker.addListener('click', function() {
					infowindow.open(map, marker);
				});
		    }
		</script>
		<script async defer
		    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVbiGGZfH4WlXE0Y8pl1HBVZcFe70TBTY&callback=initMap">
		</script>
	</div>
</div>