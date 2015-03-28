<?php if (_s_contact()) : ?>

	<address itemscope itemtype="http://schema.org/Organization">

		<ul>

			<?php if (_s_contact(phone)) : ?>
				<li>
					<a href="tel:<?php echo _s_contact(phone) ?>" itemprop="telephone">
						<?php echo _s_contact(phone) ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(mobile)) : ?>
				<li>
					<a href="tel:<?php echo _s_contact(mobile) ?>" itemprop="telephone">
						<?php echo _s_contact(mobile) ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(fax)) : ?>
				<li>
					<a href="tel:<?php echo _s_contact(fax) ?>" itemprop="telephone">
						<?php echo _s_contact(fax) ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(address)) : ?>
				<li>
					<a href="http://maps.google.com/?q=<?php echo _s_contact(address) ?>" target="_blank" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<?php echo _s_contact(address) ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(facebook)) : ?>
				<li>
					<a href='<?php echo _s_contact(facebook) ?>' target="_blank">Facebook</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(googleplus)) : ?>
				<li>
					<a href='<?php echo _s_contact(googleplus) ?>' target="_blank">Google Plus</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(twitter)) : ?>
				<li>
					<a href='<?php echo _s_contact(twitter) ?>' target="_blank">Twitter</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(instagram)) : ?>
				<li>
					<a href='<?php echo _s_contact(instagram) ?>' target="_blank">Instagram</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(pinterest)) : ?>
				<li>
					<a href='<?php echo _s_contact(pinterest) ?>' target="_blank">Pinterest</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(youtube)) : ?>
				<li>
					<a href='<?php echo _s_contact(youtube) ?>' target="_blank">YouTube</a>
				</li>
			<?php endif; ?>

			<?php if (_s_contact(linkedin)) : ?>
				<li>
					<a href='<?php echo _s_contact(linkedin) ?>' target="_blank">LinkedIn</a>
				</li>
			<?php endif; ?>

		</ul>

	</address>

<?php endif; ?>