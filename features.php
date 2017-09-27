<!-- https://stackoverflow.com/questions/21539375/get-json-from-a-public-google-calendar -->
<?php 
    $google_calendar_apikey = 'AIzaSyDKwlYvY8MyAiFQUb7GMZWW1vMzYWIKlFo';
    $glenarm_classes = 'https://www.googleapis.com/calendar/v3/calendars/media@meditationincolorado.org/events?key=AIzaSyDKwlYvY8MyAiFQUb7GMZWW1vMzYWIKlFo';    
    $special_events = 'https://www.googleapis.com/calendar/v3/calendars/meditationincolorado.org_l19o5o3uhcb4r7stv9affdjdg0%40group.calendar.google.com/events?key=AIzaSyDKwlYvY8MyAiFQUb7GMZWW1vMzYWIKlFo';    
?>

<!-- GA -->
<script src="<?php echo get_template_directory_uri(); ?>/js/google_cal.js" async></script>

<section class="feature-section">
	
	<article id="upcoming" class="row" data-cta-destination="upcoming">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <ul id="todays-classes">
	            <li id='heading'><h6>today</h6> <span>or</span> <a href='./classes#calendar' class=''>see full calendar</a></li>
            </ul>

            <section id="special-events"></section>
            <!-- <p>Our purpose is to help people discover the benefits of meditation and to solve their daily problems through a special presentation of Buddha’s teachings that we call “modern Buddhism”.</p>
            <p>Our teachings are clear, practical and very accessible to modern people. You will find that with modern Buddhism you will be able to reduce stress, improve relationships and find more meaning in life.</p>
            <p>Everyone is welcome to join our activities, including those who are just curious about meditation or Buddhism. No special clothing is necessary, and we usually meditate in chairs, making it accessible and comfortable for everyone.</p> -->
		</div>
	</article>

	<?php
		$args = array(
	        'post_type' => 'page',
	        'meta_key' => '_wp_page_template',
	        'meta_value' => 'page-templates/homepage-feature.php',
			'posts_per_page' => -1,
			'orderby' => 'sort',
			'order'   => 'ASC'
	    );

		$ct = 0;
    	$myPages = new WP_Query($args);
    	while ($myPages->have_posts()) : $myPages->the_post(); ?>
	        <?php 
	         	$thumb_id = get_post_thumbnail_id();
	         	$isDefined = is_int($thumb_id); 
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				$thumb_url = ($post->feature_section_background_image != 'false') ? $thumb_url_array[0] : '';
				$bkgColor = $post->feature_section_background_color;
				$hasVimeo = $post->vimeo;
				$hasMedia = $hasVimeo || false; //youtube, wistia, etc
				$mediaID = ($hasVimeo) ? 'vimeo_video' : 'youtube_video';
				$leftSettings = 'col-sm-6';
				$rightSettings = ($hasMedia) ? 
					'col-sm-6': 
                    'col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4';
			?>

	        <article 
	        	id="<?php echo $post->anchor_tag ?>" 
	        	class="row"
	        	style="
	        		color: <?php echo $post->font_color ?>;
	        		<?php 
                            echo 'background-color: ' . $post->feature_section_background_color . '; ';
                            if($bkgColor == '#fff' || $bkgColor == '#ffffff' || $bkgColor == '') {
                                echo 'border-top: 1px solid rgba(0,0,0,.1); ';
                            }
	        		?>
					<?php 
						if ($thumb_url != '' && $bkgColor == '') {
							echo ' background-image: url( '. $thumb_url .');';
						} 
						if ($post->feature_align == 'right') {
							echo ' background-position: left top';
						}
					?>

				"
			>
				<?php if (isset($post_id) && has_post_thumbnail($post_id) && $post->feature_section_background_image != 'false') {
					if($post->tint_level || $post->tint_level == 0) {
						$tint = 'background-color: rgba(0, 0, 0, ' . $post->tint_level . ');';
					}
					echo '<div class="tint" style="' . $tint . ';"></div>';
				} ?>
				<div class="col-xs-12 col-sm-10 col-sm-offset-1 <?php echo $post->feature_align ?>">	

					<!-- MEDIA -->
					<?php if ($post->feature_align == 'right' && $hasMedia) { echo
						'<div class="col-xs-12 col-sm-6 ' . $mediaID . '">'
							. $post->vimeo .
						'</div>';
					} ?>

					<!-- TEXT/COPY -->
					<?php $settings = ($post->feature_align != 'right') ? 
						$leftSettings : $rightSettings; 
					?>
					<?php if ($post->feature_align === 'center') { 
						$settings = 'col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2'; 
					} ?>
					<?php
						$blackClass = ($post->font_color == '#000000' || $post->font_color == 'black') ? ' black' : '';
					?>
					<div class="col-xs-12 <?php echo $settings ?>">
						<h2><?php echo $post->feature_title ?></h2>
						<p class='subheader'><?php echo $post->feature_subheader ?></p>
						<p><?php echo $post->feature_blurb ?></p>
						<?php if ($post->feature_cta_text) { 
							echo '<div class="cta_wrapper"><a class="cta' . $blackClass. '" href="' . get_permalink() . '">' . $post->feature_cta_text .'</a></div>';
						} ?>
					</div>

					<!-- MEDIA -->
					<?php if ($post->feature_align != 'right' && $hasMedia) { echo
						'<div class="col-xs-12 col-sm-6 ' . $mediaID . '">'
							. $post->vimeo .
						'</div>';
					} ?>
				</div>
			</article>

        	<!--<?php if ($ct < 1) {
        		include('locations.php');
        	} ?>-->

		<?php $ct++ ?>

    <?php 
        endwhile;
        wp_reset_postdata();
	?>
</section>