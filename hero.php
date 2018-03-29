<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage NKT_Template_1
 * @since Twenty Fourteen 1.0
 */
?>

<div id='hero' class='hero_slider row'>
	<?php 
		$wpb_all_query = new WP_Query(
			array(
				'post_type' => 'post', 
				'category_name' => 'Hero Slide',
				'post_status' =>' publish', 
				'posts_per_page' => -1,
				'orderby' => 'hero_sort_order',
				'order' => 'ASC'
			)
		); 
	?>

	<?php if ( $wpb_all_query->have_posts() ) : ?>
		<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
			<?php 
	         	$thumb_id = get_post_thumbnail_id();
	         	$isDefined = is_int($thumb_id); 
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				$thumb_url = $thumb_url_array[0];
				$tint = ($post->tint_level) ? 'background-color: rgba(0,0,0,' . $post->tint_level . ')' : '';
				$permalink = (!$post->hero_slide_cta_jump) ? 'href="' . get_permalink() . '"' : '';
				$jumplink = ($post->hero_slide_cta_jump) ? 'data-cta="' . $post->hero_slide_cta_jump . '"' : '';
				$bkgPosition = ($post->background_position) ? $post->background_position . 'y' : '';
				$vimeo_id = ($post->hero_vimeo_id) ? $post->hero_vimeo_id : false;
			?>
			<?php if(!$vimeo_id) { ?>
				<div class='hero_slide col-xs-12 <?php echo $bkgPosition; ?>' style='background-image: url("<?php echo $thumb_url; ?>");'>
					<div class="tint" style='<?php echo $tint; ?>'></div>
					<hgroup>
						<h3><?php echo $post->hero_slide_h3; ?></h3>
						<h1><?php echo $post->hero_slide_h1; ?></h1>
						<!--<h2><?php echo $post->hero_slide_h2; ?></h2>-->
						<a class="cta" <?php echo $jumplink . " " . $permalink; ?>>
							<?php echo $post->hero_slide_cta_text; ?>
						</a>

						<div class="scroll-cta">
							<svg enable-background="new 0 0 32 32" viewBox="0 0 32 32" width="32px"><g id="Chevron_Down_Circle"><path d="M16,0C7.164,0,0,7.163,0,16c0,8.836,7.164,16,16,16c8.837,0,16-7.164,16-16C32,7.163,24.837,0,16,0z M16,30   C8.28,30,2,23.72,2,16C2,8.28,8.28,2,16,2c7.72,0,14.031,6.28,14.031,14C30.031,23.72,23.72,30,16,30z" fill="#121313"/><path d="M22.3,12.393l-6.285,6.195l-6.285-6.196c-0.394-0.391-1.034-0.391-1.429,0   c-0.394,0.391-0.394,1.024,0,1.414l6.999,6.9c0.384,0.38,1.044,0.381,1.429,0l6.999-6.899c0.394-0.391,0.394-1.024,0-1.414   C23.334,12.003,22.695,12.003,22.3,12.393z" fill="#121313"/></g><g/><g/><g/><g/><g/><g/></svg>
						</div>
					</hgroup>

					<!--<div id="play">
						<svg class="video-overlay-play-button" viewBox="0 0 200 200" alt="Play video">
							<circle cx="100" cy="100" r="90" fill="none" stroke-width="15" stroke="#fff"></circle>
							<polygon points="70, 55 70, 145 145, 100" fill="#fff"></polygon>
						</svg>
					</div>-->
				</div>
			<?php } else { ?>
				<div class='hero_slide col-xs-12 vimeo-video-container'>
					<div class="video">    
						<iframe src="//player.vimeo.com/video/<?php echo $vimeo_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=3a6774&amp;autoplay=1&amp;loop=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						<div class="overlay"></div>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<div class='hero_slide'>
			<div class="tint"></div>
			<hgroup>
				<h1>Beg<span>in</span> With<span>in</span></h1>
				<h2>Modern Buddhism for Everyone</h2>
				<a class='cta' data-cta='signup'>Get Started - Free Meditations!</a>
			</hgroup>
		</div>
	<?php endif; ?>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        var fadeMe = ($(window).width() > 1024) ? true : false;

      	$('.hero_slider').slick({
			autoplay: true,
			autoplaySpeed: 3000,
			dots: true,
			infinite: true,
			fade: fadeMe,
			speed: 1000
			//cssEase: 'linear'
      	});
    });
</script>