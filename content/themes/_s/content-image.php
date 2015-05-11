<?php
/**
 * The template used for displaying page content in image.php
 *
 * @package _s
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/Article">
	<header class="entry-header">
		<?php // echo "<img src='" . wp_mime_type_icon( get_post_mime_type( $post->ID ) ) . "' />"; ?>
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="articleBody">
		<?php echo "<a href='" . wp_get_attachment_url( $post->ID ) . "' itemprop='url'>" . wp_get_attachment_image( $post->ID, 'large' ) . "</a>"; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<nav class="navigation post-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Image navigation', '_s' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_image_link(false,'Previous'); ?></div>
				<div class="nav-next"><?php next_image_link(false,'Next'); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</div><!-- #post-## -->
