<?php
/**
 * Template Name: Gallery
 *
 * @package _s
 */

// Query posts with 'gallery' post format or category

$args = wp_parse_args($query_string);
 
query_posts(array(
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'post_format',
			'terms' => array('post-format-gallery'),
			'field' => 'slug',
		),
		array(
			'taxonomy' => 'category',
			'terms' => array('gallery'),
			'field' => 'slug',
		),
	),
	'paged' => $args['paged'],
) );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main" itemprop="mainContentOfPage">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
