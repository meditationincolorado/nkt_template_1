<?php
/**
 * Template Name: Homepage Feature Page
 *
 * @package WordPress
 * @subpackage NKT_Template_1
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php include(get_template_directory() . '/nav.php'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
	$thumb_id = get_post_thumbnail_id();
 	$isDefined = is_int($thumb_id); 
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];	
	$right = $post->feature_align == 'right';
?>

	<div id="subpage_hero" class="row cover center_vert_parent" style='background-image: url("<?php echo $thumb_url; ?>");'>
		<div class="tint"></div>
			<hgroup class="col-xs-12 col-xs-10 col-xs-offset-1 center_vert">
				<h1><?php echo get_the_title()?></h1>
				<p><?php echo $post->subpage_blurb; ?></p>
			</hgroup>
	</div>

	<!-- Subnav -->
	<?php include(get_template_directory() . '/subpage_subnav.php'); ?>

	
	<!-- Content -->
	<?php include(get_template_directory() . '/custom-content.php'); ?>
	<p id="timer"></p>
	
	<a name="try"></a>
	<div id="meditations_slider" class="multiple_items">
		<div class="slide center_vert_parent start-meditation" data-bkg-color="#015d82">
			<hgroup class="center_vert"><h3>Taking & Giving</h3></hgroup>
		</div>
		<div class="slide center_vert_parent start-meditation" data-bkg-color="#3e3e3e">
			<hgroup class="center_vert"><h3>Black & White</h3></hgroup>
		</div>
		<div class="slide center_vert_parent start-meditation" data-bkg-color="#009fb2">
			<hgroup class="center_vert"><h3>Body of Light</h3></hgroup>
		</div>
		<div class="slide center_vert_parent start-meditation" data-bkg-color="#3a4a61">
			<hgroup class="center_vert"><h3>Emptiness of the Mind</h3></hgroup>
		</div>
		<div class="slide center_vert_parent start-meditation" data-bkg-color="#2f4f4f">
			<hgroup class="center_vert"><h3>Universal Compassion</h3></hgroup>
		</div>
	</div>
	<script type="text/javascript">
	    $(document).ready(function(){
	      	$('.multiple_items').slick({
				autoplay: true,
				autoplaySpeed: 2000,
			  	infinite: true,
			  	slidesToShow: 4,
			  	slidesToScroll: 1
	      	});
	    });
	</script>

<?php endwhile; endif; ?>


<?php get_footer(); ?>

