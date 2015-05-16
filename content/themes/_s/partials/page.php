<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<article itemscope itemtype="http://schema.org/Article">
			<header class="entry-header">
				<a href="<?php the_permalink(); ?>">
					<h3 class='entry-title' itemprop='headline'><?php the_title() ?></h3>					
					<?php
						/*if ($context == get_option( 'page_on_front')) :
							the_title("<h3 class='entry-title' itemprop='name'><a href='" . get_the_permalink() . "' aria-controls='tab-" . get_the_ID() . "' aria-selected='false' role='tab' data-target='tab-" . get_the_ID() . "' itemprop='url'>","</a></h3>");
						else:
							the_title("<h4 class='entry-title' itemprop='name'><a href='" . get_the_permalink() . "' aria-controls='tab-" . get_the_ID() . "' aria-selected='false' role='tab' data-target='tab-" . get_the_ID() . "' itemprop='url'>","</a></h4>");
						endif;*/
					?>
				</a>
			</header>
			<div class="entry-content" itemprop="description">
				<?php the_excerpt(); ?>
			</div>
			<footer class="entry-footer">
				<p>
					<a class="more" href="<?php the_permalink(); ?>">More</a>
				</p>
			</footer>
		</article>

	<?php	endwhile; ?>

<?php endif; ?>