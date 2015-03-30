<?php
/**
 * Plugin Name: Gallery
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

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

/**
 * Register shortcode.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

function wp_get_attachment( $attachment_id ) {

    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

function _s_gallery( $atts ) {
	
	extract( shortcode_atts(
		array(
			'ids' => null,
			'limit' => 1,
			'image_total' => 4,
			'image_size' => 'medium',
			'columns' => 2,
			'caption' => false,
		), $atts )
	);

	$args = array(
		'post_type' => 'gallery', 
		'posts_per_page' => $limit, 
		'orderby' => 'rand', 
	);

	if (isset($ids)) :
		$ids_array = explode(',', $ids);

		if (isset($ids_array)) :
			$args['post__in'] = $ids_array;
		endif;
	endif;

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) : 

		$return = "<div class='gallery gallery-columns-" . $columns . " gallery-size-" . $image_size . "'>";

		while ($the_query->have_posts()) : $the_query->the_post();

	         $gallery = get_post_gallery( get_the_ID(), false );

				if ( $gallery ) :

			      $gallery_images = explode(',', $gallery['ids']);

					$c = 0; foreach( $gallery_images AS $gallery_image ) : $c++;		         

			         $gallery_image_meta 			= wp_get_attachment($gallery_image);
			         $gallery_image_file_url		= $gallery_image_meta['src'];
			         $gallery_image_thumb_url	= wp_get_attachment_image_src( $gallery_image, $image_size )[0];
			         $gallery_image_caption 		= $gallery_image_meta['caption'];

					   if ( $c <= $image_total ) :

							$return.= "<figure class='gallery-item'>";
							$return.= 	"<div class='gallery-icon'>";
							$return.= 		"<a href='" . $gallery_image_file_url . "'>";
							$return.= 			"<img src='" . $gallery_image_thumb_url . "' class='attachment-thumbnail' alt='" . $gallery_image_caption . "'>";
							$return.= 		"</a>";
							$return.= 	"</div>";
								if($caption):
									if ( $gallery_image_caption ) :
										$return.= "<figcaption class='wp-caption-text gallery-caption' id='gallery-1-21'>";
										$return.= 	$gallery_image_caption;
										$return.= "</figcaption>";
									endif;
								endif;
							$return.= "</figure>";
			         endif; 
				   endforeach;
			   endif;

		endwhile; 

		$return.= "</div>";

	endif; wp_reset_query();

	return $return;
}

add_shortcode( '_s_gallery', '_s_gallery' );