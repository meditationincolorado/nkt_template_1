<section class="feature-section">
	
	<article class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			<?php include('google_cal_upcoming.php'); ?>
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