<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bootstrap_to_Wordpress
 */

get_header();
?>


	<!-- Blog Contents
		================================================== -->
	<div class="container">
	    <div class="row" id="primary">
	    
		    <main id="content" class="col-sm-8">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'single' );

					the_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

		</main><!-- #main -->

		<!-- SIDEBAR
			================================================== -->
		<aside class="col-sm-4">
			<?php get_sidebar(); ?>
		</aside>

	</div><!-- #primary -->
</div><!--container-->

<?php
get_footer();
