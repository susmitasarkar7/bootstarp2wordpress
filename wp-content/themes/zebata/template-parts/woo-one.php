<div class="wooOneContainer">

	<div class="wooOneWelcomeContainer">
		
			<?php
			
				$zebataWelcomePostTitle = '';
				$zebataWelcomePostDesc = '';

				if( '' != get_theme_mod('zebata_wooone_welcome_post') && 'select' != get_theme_mod('zebata_wooone_welcome_post') ){

					$zebataWelcomePostId = get_theme_mod('zebata_wooone_welcome_post');

					if( ctype_alnum($zebataWelcomePostId) ){

						$zebataWelcomePost = get_post( $zebataWelcomePostId );

						$zebataWelcomePostTitle = $zebataWelcomePost->post_title;
						$zebataWelcomePostDesc = $zebataWelcomePost->post_excerpt;
						$zebataWelcomePostContent = $zebataWelcomePost->post_content;

					}

				}			
			
			?>
			
			<h1><?php echo esc_html($zebataWelcomePostTitle); ?></h1>
			<div class="wooOneWelcomeContent">
				<p>
					<?php 
					
						if( '' != $zebataWelcomePostDesc ){
							
							echo esc_html($zebataWelcomePostDesc);
							
						}else{
							
							echo esc_html($zebataWelcomePostContent);
							
						}
					
					?>
				</p>
			</div><!-- .wooOneWelcomeContent -->	
		
	</div><!-- .wooOneWelcomeContainer -->
	
	
	<div class="new-arrivals-container">
		
		<?php 
					
			if( 'no' != get_theme_mod('zebata_show_wooone_heading') ): 
			
				$zebataWooOneLatestHeading = __('Latest Products', 'zebata');	
				$zebataWooOneLatestText = __('Some of our latest products', 'zebata');
			
					
				if( '' != get_theme_mod('zebata_wooone_latest_heading') ){
					$zebataWooOneLatestHeading = get_theme_mod('zebata_wooone_latest_heading');
				}
				
				if( '' != get_theme_mod('zebata_wooone_latest_text') ){
					$zebataWooOneLatestText = get_theme_mod('zebata_wooone_latest_text');
				}				
			
					
		?>
		<div class="new-arrivals-title">
		
			<h3><?php echo esc_html($zebataWooOneLatestHeading); ?></h3>
			<p><?php echo esc_html($zebataWooOneLatestText); ?></p>
		
		</div><!-- .new-arrivals-title -->
		<?php endif; ?>
		
		<?php
			
			$zebataWooOnePaged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
			
			$zebata_front_page_ecom = array(
				'post_type' => 'product',
				'paged' => $zebataWooOnePaged
			);
			$zebata_front_page_ecom_the_query = new WP_Query( $zebata_front_page_ecom );
			
			$zebata_front_page_temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $zebata_front_page_ecom_the_query;
			
		?>		
		
		<div class="new-arrivals-content">
		<?php if ( have_posts() && post_type_exists('product') ) : ?>
		
		
			<div class="zebata-woocommerce-content">
			
				<ul class="products">
			
					<?php /* Start the Loop */ ?>
					<?php while ( $zebata_front_page_ecom_the_query->have_posts() ) : $zebata_front_page_ecom_the_query->the_post(); ?>			
					<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				
				</ul><!-- .products -->
				
				<?php //the_posts_navigation(); ?>
				
				<?php zebata_pagination( $zebataWooOnePaged, $zebata_front_page_ecom_the_query->max_num_pages); // Pagination Function ?>
				
			</div><!-- .zebata-woocommerce-content -->
			
		<?php else : ?>
		
			<p><?php echo __('Please install wooCommerce and add products.', 'zebata') ?></p>

		<?php 
			
			endif; 
			wp_reset_postdata();
			$wp_query = NULL;
			$wp_query = $zebata_front_page_temp_query;
		?>			
		
		
		</div><!-- .new-arrivals-content -->		
	
	</div><!-- .new-arrivals-container -->	

</div>