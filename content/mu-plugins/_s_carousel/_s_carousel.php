<?php
/**
 * Plugin Name: Carousel
 * Plugin URI: https://github.com/filamentgroup/responsive-carousel
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

add_action('wp_print_scripts', '_s_carousel_register_scripts');
add_action('wp_print_styles', '_s_carousel_register_styles');

function _s_carousel_register_scripts() {
    if (!is_admin()) {

    	wp_enqueue_script('responsive-carousel.script', plugins_url("js/responsive-carousel.js", __FILE__), array('jquery'));
		wp_enqueue_script('responsive-carousel.dynamic-containers', plugins_url("js/responsive-carousel.dynamic-containers.js", __FILE__), array('jquery'));
		wp_enqueue_script('responsive-carousel.pagination', plugins_url("js/responsive-carousel.pagination.js", __FILE__), array('jquery'));
		wp_enqueue_script('responsive-carousel.autoinit', plugins_url("js/responsive-carousel.autoinit.js", __FILE__), array('jquery'));
		wp_enqueue_script('responsive-carousel.autoplay', plugins_url("js/responsive-carousel.autoplay.js", __FILE__), array('jquery'));
		wp_enqueue_script('responsive-carousel.aspectratio', plugins_url("js/responsive-carousel.aspectratio.js", __FILE__), array('jquery'));

    }
}

function _s_carousel_register_styles() {

	wp_enqueue_style('responsive-carousel.style', plugins_url("css/responsive-carousel.css", __FILE__));
	wp_enqueue_style('responsive-carousel.fade', plugins_url("css/responsive-carousel.fade.css", __FILE__));
	wp_enqueue_style('responsive-carousel.slide', plugins_url("css/responsive-carousel.slide.css", __FILE__));
	wp_enqueue_style('responsive-carousel.pagination', plugins_url("css/responsive-carousel.pagination.css", __FILE__));

}

/**
 * Register a post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', '_s_post_type_carousel_init' );

function _s_post_type_carousel_init() {
	$labels = array(
		'name'               => _x( 'Carousels', 'post type general name', '_s' ),
		'singular_name'      => _x( 'Carousel', 'post type singular name', '_s' ),
		'menu_name'          => _x( 'Carousels', 'admin menu', '_s' ),
		'name_admin_bar'     => _x( 'Carousel', 'add new on admin bar', '_s' ),
		'add_new'            => _x( 'Add New', 'carousel', '_s' ),
		'add_new_item'       => __( 'Add New Carousel', '_s' ),
		'new_item'           => __( 'New Carousel', '_s' ),
		'edit_item'          => __( 'Edit Carousel', '_s' ),
		'view_item'          => __( 'View Carousel', '_s' ),
		'all_items'          => __( 'All Carousels', '_s' ),
		'search_items'       => __( 'Search Carousels', '_s' ),
		'parent_item_colon'  => __( 'Parent Carousels:', '_s' ),
		'not_found'          => __( 'No carousels found.', '_s' ),
		'not_found_in_trash' => __( 'No carousels found in Trash.', '_s' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false, // array( 'slug' => 'carousel' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' 			=> 'dashicons-images-alt',
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'carousel', $args );
}

/**
 * Register a taxonomy.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

add_action( 'init', '_s_taxonomy_carousel_init', 0 );

function _s_taxonomy_carousel_init() {

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
		'rewrite'           => array( 'slug' => 'category_carousel' ),
	);

	register_taxonomy( 'category_carousel', array( 'carousel' ), $args );

}

/**
 * Register shortcode.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

function _s_carousel( $atts ) {

	$atts = shortcode_atts(
		array(
			"limit" 			=> null,
			"category" 		=> null,
			'caption' 		=> true,
			'title' 			=> true,
			'content' 		=> true,
			'autoplay'		=> true,
			'pagination'	=> false,
			'prev' 			=> '<i class="fa fa-angle-left"></i>',
			'next' 			=> '<i class="fa fa-angle-right"></i>',
			'interval'		=> 5000,
			'transition' 	=> 'fade',
			'placeholder'	=> false,
		),
		$atts
	);

	$args = array(
		"post_type" => "carousel",
		"posts_per_page" => $atts['limit'],
	);

	if ($atts['category']) :
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category_carousel',
				'field' => 'slug',
				'terms' => explode(',', $atts['category']),
			)
		);
	endif;

	$return = "";

	$the_query = "";
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :

		$return .= "<div class='carousel' ";
			$return .= ($atts['autoplay'] === true) ? "data-autoplay " : "";
			$return .= ($atts['pagination'] === true) ? "data-paginate " : "";
			$return .= ($atts['prev']) ? "data-prev='" . $atts['prev'] . "' " : "";
			$return .= ($atts['next']) ? "data-next='" . $atts['next'] . "' " : "";
			$return .= ($atts['interval']) ? "data-interval='" . $atts['interval'] . "' " : "";
			$return .= ($atts['transition']) ? "data-transition='" . $atts['transition'] . "' " : "";
		$return .= ">";

		while ($the_query->have_posts()) : $the_query->the_post();

				$return .= "<figure>";

					if( has_post_thumbnail() ) :
						$return .= get_the_post_thumbnail();
					else :
						$return .= ($atts['placeholder'] == true) ? "<img class='placeholder' />" : "";
					endif;

					if ($atts['caption'] === true) :

						$return .= "<figcaption>";

							$return .= "<div>";

								$return .= ($atts['title'] === true) ? ((get_the_title() != "") ? "<div class='figure-title'>" . get_the_title() . "</div>" : "") : "";

								$return .= ($atts['content'] === true) ? ((get_the_content() != "") ? "<div class='figure-content'>" . wpautop(do_shortcode(get_the_content())) . "</div>" : "") : "";

							$return .= "</div>";

						$return .= "</figcaption>";

					endif;

				$return .= "</figure>";

		endwhile;

		$return .= "</div>";

	endif;

	wp_reset_postdata();

	return $return;
}

add_shortcode( 'carousel', '_s_carousel' );
