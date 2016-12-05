<div id="content" class="row" data>

	<?php if (get_post()->post_content !== '') {
		echo 
			'<div class="col-xs-12 col-sm-10 col-sm-offset-1">' .
				'<section id="subpage_content">' .
					get_post()->post_content .
				'</section>' .
			'</div>';
	} ?>

	<?php
		$categoryName = $post->post_name . ' Page';

		$args = array( 
	      'post_type' => 'post',
	      'posts_per_page' => -1,
	      'category_name' => $categoryName,
	      'meta_key' => 'subpage_section_order',
	      'orderby' => 'meta_value_num',
	      'order'   => 'ASC'
	    );

    	$subpageFeatures = new WP_Query($args);
    
    	while ($subpageFeatures->have_posts()) : $subpageFeatures->the_post(); ?>
    		<?php 
    			$bkgColor = ($post->feature_section_background_color) ? 'background-color: ' . $post->feature_section_background_color . '; ' : '';
    			$fontColor = ($post->font_color) ? 'color: ' . $post->font_color . '; ': '';
    			$style = 'style="' . $bkgColor . $fontColor . '"';
    		?>
		<section class="nav-section" <?php echo $style; ?>>
			<div class="col-xs-12 col-sm-10 col-sm-offset-1">
      			<?php 
		            $find = array(" ", "/", "&","#038;");
		            $replace = array("-","-","and","");
		            $anchorTag = str_replace($find, $replace, get_the_title());
		        ?>
	        	<article id="<?php echo $anchorTag; ?>">
	        		<a name="<?php echo $anchorTag; ?>"></a>
		        	<h2><?php echo get_the_title(); ?></h2>
		        	<?php echo the_content(); ?>
	        	</article>
			</div>
			<div style="clear:both"></div>
		</section>
    <?php 
    	endwhile;
    	wp_reset_postdata();
	?>
</div><!-- /content -->