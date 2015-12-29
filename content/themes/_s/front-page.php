<?php
/**
 * Template Name: Home
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" itemprop="mainContentOfPage">

			<section id="featured" class="section">

				<div>

					<h2 class="section-title"><?php _e( 'Featured', '_s' ); ?></h2>

					<?php echo do_shortcode("[carousel category='front-page' pagination='true' placeholder='true']"); ?>

				</div>

			</section><!-- .section -->

			<?php while ( have_posts() ) : the_post(); ?>

				<section id="front-page" class="section">

					<div>

						<?php the_title("<h2 class='section-title'>", "</h2>"); ?>

						<?php the_content(); ?>

					</div>

				</section><!-- .section -->

			<?php endwhile; // end of the loop. ?>

			<section id="services" class="section">

				<div>

					<h2 class="section-title"><?php bloginfo('description'); ?></h2>

					<?php echo _s_query(array('arguements' => 'order=ASC&category_page=services', 'markup' => 'partials/service')); ?>

				</div>

			</section><!-- .section -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
