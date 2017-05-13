<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php include(get_template_directory() . '/nav.php'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
	$thumb_id = get_post_thumbnail_id();
 	$isDefined = is_int($thumb_id); 
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];	
?>

	<div id="subpage-hero" class="row cover center_vert_parent" style='background-image: url("<?php echo $thumb_url; ?>");'>
		<div class="tint"></div>
			<hgroup class="col-xs-12 col-xs-10 col-xs-offset-1 center_vert">
				<h1><?php echo get_the_title(); ?></h1>
				<p><?php echo $post->subpage_blurb; ?></p>
			</hgroup>
	</div>
	<?php include(get_template_directory() . '/subpage_subnav.php'); ?>
	<div id="content" class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			<?php the_content(); ?>

			<?php
				$args = array( 
		      'post_type' => 'post',
		      'posts_per_page' => 5,
		      'category_name' => 'About Page',
		      'orderby' => 'subpage_section_order',
		      'order'   => 'ASC',
		    );

		        $subpageFeatures = new WP_Query($args);
		        while ($subpageFeatures->have_posts()) : $subpageFeatures->the_post(); ?>
		        	<article id="<?php echo get_the_title(); ?>">
			        	<h2><?php echo get_the_title(); ?></h2>
			        	<?php echo the_content(); ?>
		        	</article>
		        <?php endwhile;
		        wp_reset_postdata();
			?>
		</div>
	</div>
<?php endwhile; endif; ?>


<?php get_footer(); ?>

