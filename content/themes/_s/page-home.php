<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section id="lead">

				<div>

					<?php echo _s_carousel(array('placeholder' => '1920x500')); ?>

				</div>

			</section>

			<?php while ( have_posts() ) : the_post(); ?>

				<section id="page-content">

					<div>

						<?php get_template_part( 'content', 'page' ); ?>

					</div>

				</section>
				
			<?php endwhile; // end of the loop. ?>

			<section id="associations">

				<div>

					<h2>Associations</h2>

					<?php echo _s_carousel(array('placeholder' => '250x250')); ?>

				</div>

			</section>

			<section id="reviews">

				<div>

					<h2>Reviews</h2>

					<?php // echo _s_gallery(); ?>

				</div>

			</section>

			<section id="gallery">

				<div>

					<h2>Gallery</h2>

					<?php echo _s_gallery(); ?>

				</div>

			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
