<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php // Custom ?>

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<meta name="format-detection" content="telephone=no">

<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-icon-touch.png">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
<!--[if IE]><link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico"><![endif]-->
<!-- or, set /favicon.ico for IE10 win -->
<meta name="msapplication-TileColor" content="transparent">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/win8-tile-icon.png">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php echo body_tag_schema(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
		<div class="site-branding section-group" itemscope itemtype="http://schema.org/Organization">
			<div>
				<div class="site-brand section">
					<div>
						<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
							<img src="http://placehold.it/161x100" alt="<?php bloginfo('name'); ?> Logo" itemprop="logo" />
							<?php /* <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?> Logo" itemprop="logo" /> */ ?>
						</a>
						<?php if (is_front_page() || is_home()) : ?>
							<h1 class="site-title" itemprop="name">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
						<?php else : ?>
							<p class="site-title" itemprop="name">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
									<?php bloginfo( 'name' ); ?>
								</a>
							</p>
						<?php endif; ?>
						<p class="site-description" itemprop="description"><?php bloginfo( 'description' ); ?></p>
					</div>
				</div>
				<?php if (_s_contact()) : ?>
					<div class="site-contact section">
						<div>
							<a href="tel:<?php echo _s_contact(phone) ?>" class="phone" itemprop="telephone">
								<?php echo _s_contact(phone) ?>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- .site-branding -->

		<div id="site-navigation" class="site-navigation section" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<div>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Primary Menu', '_s' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</div><!-- .site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
