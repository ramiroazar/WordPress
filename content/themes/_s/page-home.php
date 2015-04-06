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
		<main id="main" class="site-main" role="main" itemprop="mainContentOfPage">

			<section id="featured" class="section">

				<div>

					<h2>Featured</h2>

					<?php echo _s_carousel(array('placeholder' => '1920x500')); ?>

				</div>

			</section><!-- .section -->

			<?php while ( have_posts() ) : the_post(); ?>

				<section id="front-page" class="section">

					<div>

						<?php the_title("<h2>", "</h2>"); ?>

						<?php the_content(); ?>

						<?php // get_template_part( 'content', 'page' ); ?>

					</div>

				</section><!-- .section -->
				
			<?php endwhile; // end of the loop. ?>

			<section id="associations" class="section">

				<div>

					<h2>Associations</h2>

					<?php echo _s_carousel(array('placeholder' => '250x250')); ?>

				</div>

			</section><!-- .section -->

			<div class="section-group">

				<div>

					<section id="reviews" class="section">

						<div>

							<h2>Reviews</h2>

							<?php echo _s_review(array('limit' => 2)); ?>

						</div>

					</section><!-- .section -->

					<section id="galleries" class="section">

						<div>

							<h2>Gallery</h2>

							<?php echo _s_gallery(); ?>

						</div>

					</section><!-- .section -->

				</div>

			</div><!-- .section-group -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
