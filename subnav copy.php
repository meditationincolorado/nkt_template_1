<div class="row">
<div id="sub-nav" class="col-xs-12">
	<?php
		$args = array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/homepage-feature.php',
			      'orderby' => 'sort',
			      'order'   => 'ASC',
   			    'posts_per_page' => 3
          );

        $homepageFeatures = new WP_Query($args);
        while ($homepageFeatures->have_posts()) : $homepageFeatures->the_post(); ?>
			<a id="<?php echo $post->anchor_tag ?>"><?php echo $post->anchor_tag ?></a>
        <?php endwhile;
        wp_reset_postdata();
	?>
</div><!-- #main-content -->
</div>