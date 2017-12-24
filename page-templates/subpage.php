<?php
/**
 * Template Name: Subpage
 *
 * @package WordPress
 * @subpackage NKT_Template_1
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php include(get_template_directory() . '/nav.php'); ?>

<?php $google_api_key = 'AIzaSyAnL4zStsZJPP02QcauWi52QUHUReLg9UE'; ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
	$title = get_the_title();
	$thumb_id = get_post_thumbnail_id();
 	$isDefined = is_int($thumb_id); 
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
	$thumb_url = $thumb_url_array[0];	
?>

	<div id="subpage-hero" class="row cover center_vert_parent" style='background-image: url("<?php echo $thumb_url; ?>");'>
		<div class="tint"></div>
			<hgroup class="col-xs-12 col-xs-10 col-xs-offset-1 center_vert">
				<h1><?php echo get_the_title() ?></h1>
				<p><?php echo $post->subpage_blurb; ?></p>
			</hgroup>
		<?php include(get_template_directory() . '/mobile-nav.php'); ?>
	</div>

	<!-- Subnav -->
	<?php include(get_template_directory() . '/subpage_subnav.php'); ?>

	<!-- Content -->
	<?php if ($post->post_name == 'classes') { ?>

		<div id="google-calendar" class="col-xs-12 col-sm-10 col-sm-offset-1">
                <iframe id="desktop" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=meditationincolorado.org_n7apuls8319n0df3gfpgcig5dc%40group.calendar.google.com&amp;color=%23A32929&amp;src=meditationincolorado.org_7ohr4kkqmn0uja1h94te7b919s%40group.calendar.google.com&amp;color=%235229A3&amp;src=meditationincolorado.org_2c4lr14duqdc6t2s2nkrkf24ms%40group.calendar.google.com&amp;color=%231B887A&amp;src=meditationincolorado.org_l19o5o3uhcb4r7stv9affdjdg0%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=America%2FDenver" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                <iframe id="mobile" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=meditationincolorado.org_n7apuls8319n0df3gfpgcig5dc%40group.calendar.google.com&amp;color=%23A32929&amp;src=meditationincolorado.org_7ohr4kkqmn0uja1h94te7b919s%40group.calendar.google.com&amp;color=%235229A3&amp;src=meditationincolorado.org_2c4lr14duqdc6t2s2nkrkf24ms%40group.calendar.google.com&amp;color=%231B887A&amp;src=meditationincolorado.org_l19o5o3uhcb4r7stv9affdjdg0%40group.calendar.google.com&amp;color=%23AB8B00&amp;ctz=America%2FDenver" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
		</div>
		
	<?php } ?>

	<?php include(get_template_directory() . '/custom-content.php'); ?>
	
<?php endwhile; endif; ?>


<?php get_footer(); ?>

