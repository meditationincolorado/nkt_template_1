<nav id="main-nav" class="row"> <!--banner-cta-->
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<a href="<?php echo get_home_url(); ?>" id="logo">
			<?php include('kmcco_svg.php'); ?>
		</a>
		<a href="<?php echo get_home_url(); ?>" id="big-logo">
			<?php include('kmcco_full_svg.php'); ?>
		</a>
		<?php wp_nav_menu( array(
		'menu_id'        => 'primary-menu',
	) ); ?>
	</div>
</nav>