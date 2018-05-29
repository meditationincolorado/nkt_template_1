<nav id="main-nav" class="row"> <!--banner-cta-->
	<?php wp_nav_menu( array(
		'menu_id'        => 'primary-menu',
	) ); ?>
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<a href="<?php echo get_home_url(); ?>" id="logo">
			<?php include('kmcco_svg.php'); ?>
		</a>
	</div>
</nav>