<nav id="mobile-nav">

	<?php
		$args1 = array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/subpage.php',
			'orderby' => 'sort',
			'order'   => 'ASC',
   			'posts_per_page' => 3
          );
		
        $subNavSubpages = new WP_Query($args1);

        while ($subNavSubpages->have_posts()) : $subNavSubpages->the_post(); ?>
			<a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo get_the_title();?></a>
        <?php endwhile;
        wp_reset_postdata();
	?>
</nav>