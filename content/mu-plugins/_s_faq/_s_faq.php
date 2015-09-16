<?php
/**
 * Plugin Name: FAQs
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

/**
 * Register a post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', '_s_post_type_faq_init' );

function _s_post_type_faq_init() {
	$labels = array(
		'name'               => _x( 'FAQs', 'post type general name', '_s' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name', '_s' ),
		'menu_name'          => _x( 'FAQs', 'admin menu', '_s' ),
		'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', '_s' ),
		'add_new'            => _x( 'Add New', 'faq', '_s' ),
		'add_new_item'       => __( 'Add New FAQ', '_s' ),
		'new_item'           => __( 'New FAQ', '_s' ),
		'edit_item'          => __( 'Edit FAQ', '_s' ),
		'view_item'          => __( 'View FAQ', '_s' ),
		'all_items'          => __( 'All FAQs', '_s' ),
		'search_items'       => __( 'Search FAQs', '_s' ),
		'parent_item_colon'  => __( 'Parent FAQs:', '_s' ),
		'not_found'          => __( 'No faqs found.', '_s' ),
		'not_found_in_trash' => __( 'No faqs found in Trash.', '_s' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false, // array( 'slug' => 'faq' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' 			=> 'dashicons-editor-help',
		'supports'           => array( 'title', 'editor' )
	);

	register_post_type( 'faq', $args );
}

/**
 * Register a taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

add_action( 'init', '_s_taxonomy_faq_init', 0 );

function _s_taxonomy_faq_init() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category_faq' ),
	);

	register_taxonomy( 'category_faq', array( 'faq' ), $args );

}

/**
 * Register shortcode.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

function _s_faq( $atts ) {

	$atts = shortcode_atts(
		array(
			'limit' 		=> -1,
			'questions'	=> true,
			'answers'	=> true,
			'order' => '',
		),
		$atts
	);

	$args = array(
		'post_type' => 'faq',
		'posts_per_page' => $atts['limit'],
		'orderby' => $atts['order'],
	);

	$return = '';

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :

		if ($atts['questions'] === true) :

			$return .= "<ol class='faq'>";

			while ($the_query->have_posts()) : $the_query->the_post();

				$faq_link = preg_replace('/\s+/', '_', get_the_title());

				$return .= "<li>";
				$return .= "<a href='#" . $faq_link . "'>";
				$return .= get_the_title();
				$return .= "</a>";
				$return .= "</li>";

			endwhile;

			$return .= "</ol>";

		endif;

		if ($atts['answers'] === true) :

			$return .= "<dl class='faq'>";

			while ($the_query->have_posts()) : $the_query->the_post();

				$faq_link = preg_replace('/\s+/', '_', get_the_title());

				$return .= "<dt>";
				$return .= "<a href='#" . $faq_link . "'>";
				$return .= get_the_title();
				$return .= "</a>";
				$return .= "</dt>";
				$return .= "<dd id='" . $faq_link . "'>";
				$return .= wpautop(get_the_content());
				$return .= "</dd>";

			endwhile;

			$return .= "</dl>";

		endif;

	endif; wp_reset_query();

	return $return;
}

add_shortcode( 'faq', '_s_faq' );
