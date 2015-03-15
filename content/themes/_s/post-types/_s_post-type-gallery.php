<?php

/**
 * Register a post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', '_s_post_type_gallery_init' );

function _s_post_type_gallery_init() {
	$labels = array(
		'name'               => _x( 'Galleries', 'post type general name', '_s' ),
		'singular_name'      => _x( 'Gallery', 'post type singular name', '_s' ),
		'menu_name'          => _x( 'Galleries', 'admin menu', '_s' ),
		'name_admin_bar'     => _x( 'Gallery', 'add new on admin bar', '_s' ),
		'add_new'            => _x( 'Add New', 'gallery', '_s' ),
		'add_new_item'       => __( 'Add New Gallery', '_s' ),
		'new_item'           => __( 'New Gallery', '_s' ),
		'edit_item'          => __( 'Edit Gallery', '_s' ),
		'view_item'          => __( 'View Gallery', '_s' ),
		'all_items'          => __( 'All Galleries', '_s' ),
		'search_items'       => __( 'Search Galleries', '_s' ),
		'parent_item_colon'  => __( 'Parent Galleries:', '_s' ),
		'not_found'          => __( 'No galleries found.', '_s' ),
		'not_found_in_trash' => __( 'No galleries found in Trash.', '_s' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false, // array( 'slug' => 'gallery' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' 			=> 'dashicons-format-image',
		'supports'           => array( 'title', 'editor', )
	);

	register_post_type( 'gallery', $args );
}

/**
 * Register a taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

add_action( 'init', '_s_taxonomy_gallery_init', 0 );

function _s_taxonomy_gallery_init() {

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
		'rewrite'           => array( 'slug' => 'category_gallery' ),
	);

	register_taxonomy( 'category_gallery', array( 'gallery' ), $args );
}

?>
