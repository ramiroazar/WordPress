	<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', 'gallery' );
		?>

	<?php	endwhile; ?>

<?php endif; ?>
