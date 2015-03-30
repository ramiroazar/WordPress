<?php if (have_posts()) : ?>

	<ul class="tabgroup">

		<?php while (have_posts()) : the_post(); ?>

			<li>

				<dl>

					<dt role="presentation">
							<a aria-controls="tab-<?php the_ID(); ?>" aria-selected="false" role="tab" data-target="tab-<?php the_ID(); ?>">
								<?php the_title() ?>
							</a>
					</dt>
					
					<dd aria-labelledby="tab-<?php the_ID(); ?>" aria-hidden="true" role="tabpanel" class="tabpanel" id="tab-<?php the_ID(); ?>">
							<?php the_content() ?>
					</dd>

				</dl>

			</li>

		<?php endwhile; ?>

	</ul>

<?php endif; ?>