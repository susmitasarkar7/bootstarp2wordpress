<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zebata
 */

?>

	</div><!-- #content -->

	<?php 

				if( 'no' != get_theme_mod('zebata_show_quote') ): 

				$zebataQuoteTitle = '';
				$zebataQuoteDesc = '';
				$zebataQuoteContent = '';

				if( '' != get_theme_mod('zebata_quote_post') && 'select' != get_theme_mod('zebata_quote_post') ){

					$zebataQuoteId = get_theme_mod('zebata_quote_post');

					if( ctype_alnum($zebataQuoteId) ){

						$zebataQuote = get_post( $zebataQuoteId );

						$zebataQuoteTitle = $zebataQuote->post_title;
						$zebataQuoteDesc = $zebataQuote->post_excerpt;
						$zebataQuoteContent = $zebataQuote->post_content;

					}

				}



		?>		
		<div class="frontQuoteContainer">
		
			<div class="frontQuoteInnerContainer">
				
				<p>
				<?php 

					if( '' != $zebataQuoteDesc ){

						echo esc_html($zebataQuoteDesc);

					}else{

						echo esc_html(zebata_limitedstring($zebataQuoteContent, 300));

					}

				?>			
				</p>
				<p><span><?php echo esc_html($zebataQuoteTitle); ?></span></p>
				
			</div><!-- .frontQuoteInnerContainer -->
			
		</div><!-- .frontQuoteContainer -->
	<?php endif; ?>

	<?php if( 'no' != get_theme_mod('zebata_show_social') ): ?>
	<div class="frontpage-social">

			<?php if( '' != get_theme_mod('business_page_facebook') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_facebook')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/facebook.png'; ?>"></a>
			<?php endif; ?>
			
			<?php if( '' != get_theme_mod('business_page_flickr') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_flickr')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/flickr.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_page_gplus') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_gplus')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/gplus.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_page_linkedin') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_linkedin')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/linkedin.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_page_reddit') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_reddit')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/reddit.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_page_stumble') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_stumble')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/stumble.png'; ?>"></a>
			<?php endif; ?>		

			<?php if( '' != get_theme_mod('business_page_twitter') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_page_twitter')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/twitter.png'; ?>"></a>
			<?php endif; ?>				
					
	</div><!-- .frontpage-social -->	
	<?php endif; ?>

	<footer id="colophon" class="site-footer">

		<div class="site-logo">
		
			<?php
			
				$zebata_custom_logo_id = get_theme_mod( 'custom_logo' );
				$zebata_logo = wp_get_attachment_image_src( $zebata_custom_logo_id , 'full' );
				if ( has_custom_logo() ) {
						echo '<a href="' . esc_url(get_site_url()) . '"><img src="'. esc_url( $zebata_logo[0] ) .'"></a>';
				} else {
						echo '<h1>'. esc_html(get_bloginfo( 'name' )) .'</h1>';
				}			
			
			?>
			<p><?php esc_html_e( 'All rights reserved.', 'zebata' ); ?></p>
			<p>
				<?php 
					/* translators: %1: Theme Name, %2: Author  */
					printf( esc_html__( 'Theme: %1$s by %2$s', 'zebata' ), 'zebata', '<a href="https://themealley.com/">ThemeAlley</a>' ); 
				?>
			</p>
		
		</div><!-- .site-logo -->
		
		<div class="footer-widgets">
		
			<div class="footerWidgetContainer">
			<?php if ( dynamic_sidebar('footer-left') ){ } else { ?>
			
				<section class="widget">
					
					<div class="widgetContainerInner">
					
						<h2 class="widget-title"><span><?php _e( 'Pages', 'zebata' ); ?></span></h2>
                        <ul>
                            <?php wp_list_pages('title_li='); ?>
                        </ul>						
					
					</div>
					
				</section>
			
			<?php } ?> 
			</div><!-- .footerWidgetContainer -->
			
			<div class="footerWidgetContainer">
			<?php if ( dynamic_sidebar('footer-middle') ){ } else { ?>
			
				<section class="widget">
					
					<div class="widgetContainerInner">
					
						<h2 class="widget-title"><span><?php _e( 'Meta', 'zebata' ); ?></span></h2>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>						
					
					</div>
					
				</section>		
			
			<?php } ?> 			
			</div><!-- .footerWidgetContainer -->
			
			<div class="footerWidgetContainer">
			<?php if ( dynamic_sidebar('footer-right') ){ } else { ?>
			
				<section class="widget">
					
					<div class="widgetContainerInner">
					
						<h2 class="widget-title"><span><?php _e( 'Archives', 'zebata' ); ?></span></h2>
                        <ul>
							 <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>						
					
					</div>
					
				</section>			
			
			<?php } ?> 			
			</div><!-- .footerWidgetContainer -->			
		
		</div><!-- .footer-widgets -->
		
	
	</footer><!-- #colophon -->
</div><!-- #page -->
</div><!-- .outerContainer -->
<?php wp_footer(); ?>

</body>
</html>
