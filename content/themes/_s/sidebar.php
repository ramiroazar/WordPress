<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package _s
 */

if ( 
	// ! is_active_sidebar( 'sidebar-1' ) ||
	wp_is_mobile()
) :
	return;
endif
?>

<section id="secondary" class="widget-area" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">

	<h2 class="sidebar-title"><?php _e( 'Sidebar', '_s' ); ?></h2>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php if (is_page(get_theme_mod('page_display_contact'))) : ?>

		<aside id="sidebar-contact" class="site-contact section">

			<div>

				<h3 class="section-title"><?php _e( 'Contact Details', '_s' ); ?></h3>

				<?php get_template_part( 'partials/contact' ); ?>

			</div>

		</aside><!-- .site-contact -->

	<?php endif; ?>

</section><!-- #secondary -->
