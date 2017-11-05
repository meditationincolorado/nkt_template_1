<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage NKT_Template_1
 * @since Twenty Fourteen 1.0
 */

 	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
		$args = array( 
      'post_type' => 'post',
      'posts_per_page' => 1,
      'category_name' => 'Social Media'
    );

        $socialMediaInfo = new WP_Query($args);
        while ($socialMediaInfo->have_posts()) : $socialMediaInfo->the_post(); ?>
		
		<meta name="description" content="<?php echo $post->default_og_description ?>">
      	<meta property="og:description" content="<?php echo $post->default_og_description ?>" />
		<meta name="twitter:description" content="<?php echo $post->default_og_description ?>">
		<meta property="og:title" content="<?php echo $post->default_og_title ?>" />
		<meta name="twitter:title" content="<?php echo $post->default_og_title ?>">
        <meta property="og:image" content="<?php echo $post->default_og_image ?>" />
		<meta name="twitter:image" content="<?php echo $post->default_og_image ?>">
	<?php  
		endwhile;
		wp_reset_postdata();
	?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick-theme.css"/>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <script>
        var hostname = window.location.hostname,
            gaLiveID = 'UA-106895575-1',
            gaStageID = 'UA-106895575-2',
            activeID = 'UA-106895575-3';

        if (hostname === 'meditationincolorado.org') {
            activeID = gaLiveID;
        } else if (hostname.includes('staging')) {
            activeID = gaStageID;
        }
            
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', activeID, 'auto');
        ga('send', 'pageview');
    </script>


    <!-- Classes -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/classes.js" async></script>
	<?php wp_head(); ?>
</head>

<body>