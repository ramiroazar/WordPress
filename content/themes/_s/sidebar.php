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
</section><!-- #secondary -->
