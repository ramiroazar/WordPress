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
		<?php 
			echo ($post->post_parent) ? "<a href='" . get_permalink($post->post_parent). "'>Return to ". get_the_title($post->post_parent) ."</a>" : "";
			echo previous_image_link('thumbnail');
			echo previous_image_link(false,'← Previous');
			echo next_image_link('thumbnail');
			echo next_image_link(false,'Next →');
		?>
		<?php edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</div><!-- #post-## -->
