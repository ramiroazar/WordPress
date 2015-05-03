<?php if (have_posts()) : ?>

	<div class="tabgroup">

		<ul class="tabs">

		<?php while (have_posts()) : the_post(); ?>

			<li role="presentation">
				<a class="tab" aria-controls="tab-<?php the_ID(); ?>" role="tab" data-target="tab-<?php the_ID(); ?>">
					<?php the_title() ?>
				</a>
			</li>

		<?php	endwhile; ?>

		</ul>

		<div class="tabpanels">

		<?php while (have_posts()) : the_post(); ?>

			<div id="tab-<?php the_ID(); ?>" class="tabpanel" role="tabpanel">
				<?php the_content() ?>
			</div>

		<?php endwhile; ?>

		</div>

	</div>

<?php endif; ?>