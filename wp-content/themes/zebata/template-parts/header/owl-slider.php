    <div class="site-slider zebata-owl-basic">

        <div id="zebata-owl-basic" class="owl-carousel owl-theme">
    
    		<?php 
			
				if(get_theme_mod('zebata_slider_num')){
					$zebata_slider_num = get_theme_mod('zebata_slider_num');
				}else{
					$zebata_slider_num = '5';
				}
			
				if(get_theme_mod('zebata_slider_cat')){
					$zebata_slider_cat = get_theme_mod('zebata_slider_cat');
				}else{
					$zebata_slider_cat = 0;
				}			
			
				$zebata_slider_args = array(
                    // Change these category SLUGS to suit your use.
                    'ignore_sticky_posts' => 1,
                    'post_type' => array('post'),
                    'posts_per_page'=> $zebata_slider_num,
					'cat' => $zebata_slider_cat
               );
        
			   $zebata_slider = new WP_Query($zebata_slider_args);
			
            if ( $zebata_slider->have_posts() ) : ?>            
			<?php /* Start the Loop */ ?>
			<?php while ( $zebata_slider->have_posts() ) : $zebata_slider->the_post(); ?>
            <div class="owl-carousel-slide">
                
                <?php if ( has_post_thumbnail()) : ?>	
                <?php the_post_thumbnail('zebata-owl'); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/2000.png">
                <?php endif; ?>
                
                <div class="owl-carousel-caption-container">
                    <h3>
						<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="owl-carousel-caption">
						<p><?php echo esc_html(zebata_limitedstring(get_the_excerpt())); ?></p>
						<p><a href="<?php the_permalink() ?>"><?php echo __( 'Read More', 'zebata' ); ?></a></p>
					</div>
                </div>
                 	
            </div>
    		<?php endwhile; wp_reset_postdata(); endif; ?>
            
         </div>
    
    </div><!-- .site-slider --> 