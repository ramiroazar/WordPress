<?php if (have_posts()) : ?>

	<?php $c = 0; while (have_posts()) : the_post(); $c++; ?>

		<article class="service" itemscope itemtype="http://schema.org/Service">
			<header class="entry-header">
				<a href="<?php the_permalink(); ?>" itemprop="url">
					<?php the_title("<h3 class='entry-title' itemprop='name'>","</h3>") ?>
				</a>
			</header>
			<div class="entry-content" itemprop="description">
				<?php the_excerpt(); ?>
			</div>
			<footer class="entry-footer">
				<p>
					<a class="more" href="<?php the_permalink(); ?>" itemprop="url">More</a>
				</p>
			</footer>
		</article>

	<?php	endwhile; ?>

<?php endif; ?>