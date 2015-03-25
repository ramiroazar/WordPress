<?php

$contact = array();
$contact[phone]		= get_theme_mod( 'phone' );
$contact[mobile]		= get_theme_mod( 'mobile' );
$contact[fax]			= get_theme_mod( 'fax' );
$contact[address]		= get_theme_mod( 'address' );
$contact[facebook]	= get_theme_mod( 'facebook' );
$contact[googleplus]	= get_theme_mod( 'googleplus' );
$contact[twitter]		= get_theme_mod( 'twitter' );
$contact[instagram]	= get_theme_mod( 'instagram' );
$contact[pinterest]	= get_theme_mod( 'pinterest' );
$contact[youtube]		= get_theme_mod( 'youtube' );
$contact[linkedin]	= get_theme_mod( 'linkedin' );
$contact = array_filter($contact);

?>

<?php if (!empty($contact)) : ?>

	<address itemscope itemtype="http://schema.org/LocalBusiness">

		<ul>

			<?php if ($contact[phone]) : ?>
				<li>
					<a href="tel:<?php echo $contact[phone] ?>" itemprop="telephone">
						<?php echo $contact[phone] ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[mobile]) : ?>
				<li>
					<a href="tel:<?php echo $contact[mobile] ?>" itemprop="telephone">
						<?php echo $contact[mobile] ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[fax]) : ?>
				<li>
					<a href="tel:<?php echo $contact[fax] ?>" itemprop="telephone">
						<?php echo $contact[fax] ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[address]) : ?>
				<li>
					<a href="http://maps.google.com/?q=<?php echo $contact[address] ?>" target="_blank" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<?php echo $contact[address] ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[facebook]) : ?>
				<li>
					<a href='<?php echo $contact[facebook] ?>' target="_blank">Facebook</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[googleplus]) : ?>
				<li>
					<a href='<?php echo $contact[googleplus] ?>' target="_blank">Google Plus</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[twitter]) : ?>
				<li>
					<a href='<?php echo $contact[twitter] ?>' target="_blank">Twitter</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[instagram]) : ?>
				<li>
					<a href='<?php echo $contact[instagram] ?>' target="_blank">Instagram</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[pinterest]) : ?>
				<li>
					<a href='<?php echo $contact[pinterest] ?>' target="_blank">Pinterest</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[youtube]) : ?>
				<li>
					<a href='<?php echo $contact[youtube] ?>' target="_blank">YouTube</a>
				</li>
			<?php endif; ?>

			<?php if ($contact[linkedin]) : ?>
				<li>
					<a href='<?php echo $contact[linkedin] ?>' target="_blank">LinkedIn</a>
				</li>
			<?php endif; ?>

		</ul>

	</address>

<?php endif; ?>