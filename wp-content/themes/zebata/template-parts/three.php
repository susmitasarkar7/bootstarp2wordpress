<div class="zebataThreeContainer">
	
	<?php if( '' != get_theme_mod('zebata_three_welcome_post') && 'select' != get_theme_mod('zebata_three_welcome_post') ) : 

			$zebataThreeWelcomePostTitle = '';
			$zebataThreeWelcomePostDesc = '';
			$zebataThreeWelcomePostContent = '';


			$zebataThreeWelcomePostId = get_theme_mod('zebata_three_welcome_post');

			if( ctype_alnum($zebataThreeWelcomePostId) ){

				$zebataThreeWelcomePost = get_post( $zebataThreeWelcomePostId );

				$zebataThreeWelcomePostTitle = $zebataThreeWelcomePost->post_title;
				$zebataThreeWelcomePostDesc = $zebataThreeWelcomePost->post_excerpt;
				$zebataThreeWelcomePostContent = $zebataThreeWelcomePost->post_content;

			}			

	?>

	<div class="zebataThreeWelcome">

		<h2><?php echo esc_html($zebataThreeWelcomePostTitle); ?></h2>
		<p>
		<?php 

			if( '' != $zebataThreeWelcomePostDesc ){

				echo esc_html($zebataThreeWelcomePostDesc);

			}else{

				echo esc_html($zebataThreeWelcomePostContent);

			}

		?>			
		</p>

	</div>	
	
	<?php endif; ?>
	
	<?php
		if( '' != get_theme_mod('zebata_three_services_cat') && 'select' != get_theme_mod('zebata_three_services_cat') ):
	?>
	<div class="zebataThreeServices">
		
		<?php

			$zebata_three_cat = '';

			if(get_theme_mod('zebata_three_services_cat')){
					$zebata_three_cat = get_theme_mod('zebata_three_services_cat');
			}else{
					$zebata_three_cat = 0;
			}
		
			if(get_theme_mod('zebata_three_services_num')){
					$zebata_three_cat_num = get_theme_mod('zebata_three_services_num');
			}else{
					$zebata_three_cat_num = 6;
			}		

			$zebata_three_args = array(
				   // Change these category SLUGS to suit your use.
				   'ignore_sticky_posts' => 1,
				   'post_type' => array('post'),
				   'posts_per_page'=> $zebata_three_cat_num,
				   'cat' => $zebata_three_cat
			);

			$zebata_three = new WP_Query($zebata_three_args);		

			if ( $zebata_three->have_posts() ) : while ( $zebata_three->have_posts() ) : $zebata_three->the_post();
		
   		?>		
	
		<div class="zebataThreeServicesItem">
			
			<div class="zebataThreeServicesItemImage">
			
				<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('zebata-home-posts');
						}else{
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/frontitemimage.png" />';
						}						
				?>
				
			</div>
			
			<div class="zebataThreeServicesItemContent">
			
				<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
				<p>
					<?php  
						
						//$frontPostExcerpt = '';
						//$frontPostExcerpt = get_the_excerpt();
					
						if( has_excerpt() ){
							echo esc_html(get_the_excerpt());
						}else{
							echo esc_html(zebata_limitedstring(get_the_content(), 50));
						}
					
					?>
				</p>
				
			</div>			
			
		</div>
		<?php endwhile; wp_reset_postdata(); endif;?>
		
	</div>
	<?php endif; ?>
	
</div>