<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package _s
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/Article">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
		<?php
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('large', array('itemprop' => 'primaryImageOfPage'));
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</div><!-- #post-## -->
