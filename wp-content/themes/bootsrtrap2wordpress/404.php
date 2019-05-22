<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bootstrap_to_Wordpress
 */

get_header();
?>

<section class="feature-image feature-image-default-alt" data-type="background" data-speed="2">
    <h1>Bummer! That page can't be found.</h1>
</section>

	<div class="contanier">
		<div id="primary" class="row">
			<main class="content col-sm-8">
				<div class="error-404 not-found">
					<div class="page-content">
						<h2>Don't fret! Let's get you back on track.</h2>

						<!--Resources
						======================================-->
						<h3>Resources</h3>
						<p>Perhaps you were looknig for a specific resource?</p>

						<div class="resource-row clearfix">

						<?php while($loop-> have_posts()) : $loop-> the_post(); ?>

						<?php

							$resource_image = get_field('resource_image');
							$resource_url   = get_field('resource_url');
							$button_text    = get_field('button_text');

						?>

						<div class="resource">

							<img src="<?php echo $resource_image['url']; ?>" alt="<?php echo $resource_image['alt']; ?>">                        
							<!-- <?php echo $resource_image; ?> -->
							<h3><a href="<?php echo $resource_url; ?>"><?php the_title(); ?></a></h3>
							<?php the_content(); ?>
							<?php if (!empty($button_text)): ?>
							<a href="<?php echo $resource_url; ?>" class="btn btn-success"><?php echo $button_text; ?></a>
							<?php endif; ?>
						</div>

						<?php endwhile; ?>

						</div>

					</div>
				</div>
			</main>

			<!---Sidebar
			======================================-->
			<aside class="col-sm-4">
				<?php get_sidebar(); ?>
			</aside>

		</div>
	</div>

<?php
get_footer();
