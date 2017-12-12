<nav id="main-nav" class="row"> <!--banner-cta-->
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<a href="<?php echo get_home_url(); ?>" id="logo">
			<?php include('kmcco_svg.php'); ?>
		</a>
		<a href="<?php echo get_home_url(); ?>" id="big-logo">
			<?php include('kmcco_full_svg.php'); ?>
		</a>
			<?php
				$args1 = array( 
					'post_type' => 'page',
					'posts_per_page' => 8,
					'meta_key' => 'nav_order',
					'orderby' => 'meta_value_num',
					'order'   => 'ASC'
			    );

		        $navSubpages1 = new WP_Query($args1);
			?>
		<ul>
			<?php
		        while ($navSubpages1->have_posts()) : $navSubpages1->the_post(); ?>

					<li><a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo get_the_title();?></a></li>
		        <?php endwhile;
		        wp_reset_postdata();
			?>
		</ul>
	</div>
</nav>