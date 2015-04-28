<?php if (_s_contact()) : ?>

	<address class="contact" itemscope itemtype="http://schema.org/Organization">

		<ul>

			<?php if (_s_contact(array("type" => phone))) : ?>
				<li>
					<?php echo _s_contact(array("type" => phone)); ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => mobile))) : ?>
				<li>
					<?php echo _s_contact(array("type" => mobile)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => fax))) : ?>
				<li>
					<?php echo _s_contact(array("type" => fax)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => email))) : ?>
				<li>
					<?php echo _s_contact(array("type" => email)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => address))) : ?>
				<li>
					<?php echo _s_contact(array("type" => address)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => facebook))) : ?>
				<li>
					<?php echo _s_contact(array("type" => facebook)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => googleplus))) : ?>
				<li>
					<?php echo _s_contact(array("type" => googleplus)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => twitter))) : ?>
				<li>
					<?php echo _s_contact(array("type" => twitter)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => instagram))) : ?>
				<li>
					<?php echo _s_contact(array("type" => instagram)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => pinterest))) : ?>
				<li>
					<?php echo _s_contact(array("type" => pinterest)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => youtube))) : ?>
				<li>
					<?php echo _s_contact(array("type" => youtube)) ?>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(array("type" => linkedin))) : ?>
				<li>
					<?php echo _s_contact(array("type" => linkedin)) ?>
				</li>
			<?php endif; ?>

		</ul>

	</address>

<?php endif; ?>