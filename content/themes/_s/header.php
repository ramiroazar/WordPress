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

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div>
			<div class="site-branding">
				<div>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo get_template_directory_uri(); ?>/favicon.png" alt="<?php bloginfo('name'); ?> Logo" itemprop="logo" />
					</a>
					<?php if (is_front_page() || is_home()) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php if (_s_contact()) : ?>
						<a href="tel:<?php echo _s_contact(phone) ?>" class="phone" itemprop="telephone">
							<?php echo _s_contact(phone) ?>
						</a>
					<?php endif; ?>
				</div>
			</div><!-- .site-branding -->

			<div id="site-navigation" class="site-navigation" role="navigation">
				<div>
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Primary Menu', '_s' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
				</div>
			</div><!-- .main-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
