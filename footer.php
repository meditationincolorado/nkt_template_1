<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage NKT_Template_1
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->


		<div id='scroll-to-top' class='retracted'>
			<svg enable-background="new 0 0 32 32" height="40px" version="1.1" viewBox="0 0 32 32" width="40px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Chevron_Down_Circle"><path d="M16,0C7.164,0,0,7.163,0,16c0,8.836,7.164,16,16,16c8.837,0,16-7.164,16-16C32,7.163,24.837,0,16,0z M16,30   C8.28,30,2,23.72,2,16C2,8.28,8.28,2,16,2c7.72,0,14.031,6.28,14.031,14C30.031,23.72,23.72,30,16,30z" fill="#121313"/><path d="M22.3,12.393l-6.285,6.195l-6.285-6.196c-0.394-0.391-1.034-0.391-1.429,0   c-0.394,0.391-0.394,1.024,0,1.414l6.999,6.9c0.384,0.38,1.044,0.381,1.429,0l6.999-6.899c0.394-0.391,0.394-1.024,0-1.414   C23.334,12.003,22.695,12.003,22.3,12.393z" fill="#121313"/></g><g/><g/><g/><g/><g/><g/></svg>
		</div>
		<?php 
			$wpb_all_query = new WP_Query(
			array(
				'post_status' =>' publish', 
				'posts_per_page' => 1,
				'post_type'		=> 'post',
				'meta_key'		=> 'sticky_ad',
				'meta_value'	=> 'true'
			)
		); 
		?>
		<?php if ( is_home() && $wpb_all_query->have_posts() ) : ?>
			<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

				<?php 
		         	$thumb_id = get_post_thumbnail_id();
		         	$isDefined = is_int($thumb_id); 
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
					$thumb_url = $thumb_url_array[0];
					$bkgStyle = 'style="background-image: url(' . $thumb_url. ')";';
					$fontStyle = 'style="color: #ffffff;"';
				?>

				<section id="sticky-blurb" data-name="<?php echo $post->post_name; ?>">
					<div id='background' <?php echo $bkgStyle ?>></div>
					<div id="tint"></div>
					<div id="close" <?php echo $fontStyle ?>>X</div>
					<hgroup id="sticky-copy" <?php echo $fontStyle ?>>
						<h3><?php echo $post->hero_slide_h1 ?></h3>
						<p><?php echo $post->hero_slide_h2 ?></p>
						<a class="sticky-cta" href="<?php echo get_permalink(); ?>"><?php echo $post->hero_slide_cta_text ?></a>
					</hgroup>
				</section>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<footer class="row">
			<section class="col-xs-12 col-sm-10 col-sm-offset-1">
				<ul class="col-xs-12 col-sm-3">
					<li class="heading">KMC Colorado</li>
					<li><a href="/">Home</a></li>
					<li><a href="/classes">Classes</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="/buddhism">Kadampa Buddhism</a></li>
					<li><a href="/contact">Contact</a></li>
					<li>&nbsp;</li>
					<li class="heading">Helpful Links</li>
					<li><a href="http://kadampa.org/" target="_blank">Kadampa Tradition</a></li>
					<li><a href="http://www.tharpa.com/us/" target="_blank">Tharpa Publications</a></li>
					<li><a href="http://emodernbuddhism.com/" target="_blank">Free EBook: Modern Buddhism</a></li>
					<!-- <li>&nbsp;</li>
					<li class="heading">Upcoming Events</li>
					<li><a href="" target="_blank">Refuge Retreat</a></li> -->
				</ul>

				<ul class="col-xs-12 col-sm-3">
					
					<!-- FOLLOW -->
					<li class="heading">Follow</li>

					<?php
						$args = array( 
				      'post_type' => 'post',
				      'posts_per_page' => 1,
				      'category_name' => 'Social Media'
				    );

				        $socialMediaInfo = new WP_Query($args);
				        while ($socialMediaInfo->have_posts()) : $socialMediaInfo->the_post(); ?>
						
						<li><a href="<?php echo $post->facebook_link ?>" target="_blank">Facebook</a></li>
						<!-- <li><a href="<?php echo $post->twitter_link ?>" target="_blank">Twitter</a></li> -->
						<li><a href="<?php echo $post->instagram_link ?>"" target="_blank">Instagram</a></li>
                        <li><a href="<?php echo $post->youtube_link ?>"" target="_blank">Youtube</a></li>
					<?php  
						endwhile;
						wp_reset_postdata();
					?>
					<li>&nbsp;</li>

					<!-- CLASS LOCATIONS -->
					<li class="heading">Class Locations</li>
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
					<li>
						<!-- <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a><br/> -->
						<strong><?php echo get_the_title(); ?></strong><br/>
                        <?php echo $post->address ?><br/><br/>
					</li>
					<? 
						endwhile;
						wp_reset_postdata();
					?>
					<li>&nbsp;</li>
				</ul>
				<ul class="col-xs-12 col-sm-4">
					<li id="addresses">
						<?php include('kmcco_full_svg.php'); ?>
					</li>
					<li class="heading">Contact</li>
					<li><a href="mailto:info@meditationincolorado.org">e: info@meditationincolorado.org</a></li>
					<li><a href="">p: 303.813.9551</a></li>
					<li><br/><strong>Everyone is Welcome</strong></li>
					<li id="addresses">
						<?php include('nkt_svg.php'); ?>
					</li>
				</ul>
			</section>
			<section class="col-xs-12 col-sm-10 col-sm-offset-1">
				<center><p class="non-profit">KMC Colorado is a 501(c)(3) non-profit organization.</p></center>
			</section>
		</footer>

	</div><!-- #page -->

	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>
	<?php wp_footer(); ?>
</body>
</html>