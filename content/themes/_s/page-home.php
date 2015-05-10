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

					<?php echo _s_carousel(); ?>

				</div>

			</section><!-- .section -->

			<?php while ( have_posts() ) : the_post(); ?>

				<section id="front-page" class="section">

					<div>

						<?php the_title("<h2 class='section-title'>", "</h2>"); ?>

						<?php the_content(); ?>

						<?php // get_template_part( 'content', 'page' ); ?>

					</div>

				</section><!-- .section -->
				
			<?php endwhile; // end of the loop. ?>

			<section id="services" class="section">

				<div>

					<h2 class="section-title"><?php bloginfo('description'); ?></h2>

					<?php echo _s_query(array('arguements' => 'order=ASC&category_page=services', 'markup' => 'partials/service')); ?>

				</div>

			</section><!-- .section -->

			<section id="associations" class="section">

				<div>

					<h2 class="section-title"><?php _e( 'Associations', '_s' ); ?></h2>

					<?php echo _s_carousel(); ?>

				</div>

			</section><!-- .section -->

			<div class="section-group">

				<div>

					<section id="reviews" class="section">

						<div>

							<h2 class="section-title"><?php _e( 'Reviews', '_s' ); ?></h2>

							<?php echo _s_review(array('limit' => 2, 'carousel' => true)); ?>

							<?php // echo _s_query(array('arguements' => 'pagename=reviews', 'markup' => 'partials/page')); ?>

						</div>

					</section><!-- .section -->

					<section id="galleries" class="section">

						<div>

							<h2 class="section-title"><?php _e( 'Gallery', '_s' ); ?></h2>

							<?php echo _s_gallery(array('thumbnail_size' => 'medium', 'title' => true)); ?>

							<?php // echo _s_query(array('arguements' => 'pagename=gallery', 'markup' => 'partials/page')); ?>

						</div>

					</section><!-- .section -->

				</div>

			</div><!-- .section-group -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
