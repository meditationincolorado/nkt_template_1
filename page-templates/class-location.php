<?php
/**
 * Template Name: Class Location Page
 *
 * @package WordPress
 * @subpackage NKT_Template_1
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<h1>Test</h1>
<?php 
	$basedir = realpath(__DIR__);
	include($basedir . 'banner-cta.php'); 

?>
<?php include('nav.php'); ?>
<div id="hero-section">
	<?php include('../nkt_template_1/hero.php'); ?>
	<?php include('../mobile-nav.php'); ?>
</div>
<?php include('subnav.php'); ?>

<?php include('features.php'); ?>

<?php include('footer-contact.php'); ?>
<?php get_footer(); ?>

