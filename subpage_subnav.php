<div class="row">
<div id="sub-nav" class="col-xs-12" data-subpage="true">
  <?php 
    remove_all_filters('posts_orderby');
    $categoryName = $post->post_name . ' Page'; 
  ?>
	<?php
		$args = array( 
      'post_type' => 'post',
      'posts_per_page' => 12,
      'category_name' => $categoryName,
      'meta_key' => 'subpage_section_order',
      'orderby' => 'meta_value_num',
      'order'   => 'ASC'
    );

        $subpageFeatures = new WP_Query($args);
        while ($subpageFeatures->have_posts()) : $subpageFeatures->the_post(); ?>
          <?php 
            $find = array(" ", "/", "&","#038;");
            $replace = array("-","-","and","");
            $anchorTag = str_replace($find, $replace, get_the_title());
          ?>

			    <a id="<?php echo $anchorTag; ?>"><?php echo get_the_title() ?></a>

        <?php endwhile;
        wp_reset_postdata();
	?>
</div><!-- #main-content -->
</div>