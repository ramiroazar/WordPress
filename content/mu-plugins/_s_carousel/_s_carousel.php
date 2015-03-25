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

    	wp_enqueue_script('_s-responsive-carousel.script', plugins_url("js/responsive-carousel.js", __FILE__), array('_s-jquery'));
		wp_enqueue_script('_s-responsive-carousel.dynamic-containers', plugins_url("js/responsive-carousel.dynamic-containers.js", __FILE__), array('_s-jquery'));
		wp_enqueue_script('_s-responsive-carousel.pagination', plugins_url("js/responsive-carousel.pagination.js", __FILE__), array('_s-jquery'));
		wp_enqueue_script('_s-responsive-carousel.autoinit', plugins_url("js/responsive-carousel.autoinit.js", __FILE__), array('_s-jquery'));
		wp_enqueue_script('_s-responsive-carousel.autoplay', plugins_url("js/responsive-carousel.autoplay.js", __FILE__), array('_s-jquery'));

    }
}
 
function _s_carousel_register_styles() {

	wp_enqueue_style('_s-responsive-carousel.style', plugins_url("css/responsive-carousel.css", __FILE__));
	wp_enqueue_style('_s-responsive-carousel.fade', plugins_url("css/responsive-carousel.fade.css", __FILE__));
	wp_enqueue_style('_s-responsive-carousel.slide', plugins_url("css/responsive-carousel.slide.css", __FILE__));
	wp_enqueue_style('_s-responsive-carousel.pagination', plugins_url("css/responsive-carousel.pagination.css", __FILE__));

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
		'supports'           => array( 'title' )
	);

	register_post_type( 'carousel', $args );
}

/**
 * Register CMB2 metaboxes.
 *
 * @link https://github.com/WebDevStudios/CMB2/wiki/Basic-Usage
 */

add_filter( 'cmb2_meta_boxes', '_s_cmb2_carousel' );

function _s_cmb2_carousel( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	$meta_boxes['carousel'] = array(
		'id'         => 'carousel',
		'title'      => __( 'Carousel', 'cmb2' ),
		'object_types'      => array( 'carousel', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
        // 'show_on' => array( 'key' => 'id', 'value' => array( #, #, # ) ),
		// 'cmb2_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'id'          => $prefix . 'slides',
				'type'        => 'group',
				'name' => __( 'Slides', 'cmb2' ),
				'description' => __( 'Generate slides', 'cmb2' ),
				'options'     => array(
					'group_title'   => __( 'Slide {#}', 'cmb2' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Slide', 'cmb2' ),
					'remove_button' => __( 'Remove Slide', 'cmb2' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => __( 'Slide Image', 'cmb2' ),
						'id'   => 'slide_image',
						'type' => 'file',
						'options' => array(
							// 'url' => false,
						),
					),
					array(
						'name' => __( 'Slide Caption Title', 'cmb2' ),
						'id'   => 'slide_caption_title',
						'type' => 'text',
					),
					array(
						'name' => __( 'Slide Caption Content', 'cmb2' ),
						'id'   => 'slide_caption_content',
						'type' => 'textarea',
					),
					array(
						'name' => __( 'Slide Caption Button Text', 'cmb2' ),
						'id'   => 'slide_caption_button_text',
						'type' => 'text',
					),
					array(
						'name' => __( 'Slide Caption Button Link', 'cmb2' ),
						'id'   => 'slide_caption_button_link',
						'type' => 'text',
					),
				),
			),
		),
	);

	return $meta_boxes;
}

/**
 * Register shortcode.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

function _s_carousel( $atts ) {
	
	extract( shortcode_atts(
		array(
			'ids' 			=> null,
			'limit' 			=> 1,
			'transition' 	=> 'fade',
			'prev' 			=> '<i class="fa fa-chevron-circle-left"></i>',
			'next' 			=> '<i class="fa fa-chevron-circle-right"></i>',
			'image_size' 	=> 'full',
			'pagination'	=> false,
			'autoplay'		=> true,
			'interval'		=> 5000,
			'placeholder'	=> null,
		), $atts )
	);

	$args = array(
		'post_type' => 'carousel',
		'posts_per_page' => $limit,
	);

	if (isset($ids)) :
		$ids_array = explode(',', $ids);

		if (isset($ids_array)) :
			$args['post__in'] = $ids_array;
		endif;
	endif;

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
	while ($the_query->have_posts()) : $the_query->the_post();

		the_title();

		$prefix = '_cmb2_';

		$slides = get_post_meta( get_the_ID(), $prefix . 'slides', true );

		if ( $pagination === true )
			$pagination_output = 'data-paginate';

		if ( $autoplay === true )
			$autoplay_output = 'data-autoplay';

		$return = "<div class='carousel' " . $pagination_output . " " . $autoplay_output . " data-transition='" . $transition . "' data-prev='" . $prev . "' data-next='" . $next . "' data-interval='" . $interval . "'>";

		foreach ( (array) $slides as $key => $slide ) :

			if ( isset( $slide['slide_image'] ) )
				$slide_img = wp_get_attachment_image( $slide['slide_image_id'], $image_size );
			else
				$slide_img = null;

			if ( isset( $slide['slide_caption_title'] ) )
				$slide_caption_title = $slide['slide_caption_title'];
			else
				$slide_caption_title = null;

			if ( isset( $slide['slide_caption_content'] ) )
				$slide_caption_content =$slide['slide_caption_content'];
			else
				$slide_caption_content = null;

			if ( isset( $slide['slide_caption_button_text'] ) )
				$slide_caption_button_text = $slide['slide_caption_button_text'];
			else
				$slide_caption_button_text = null;

			if ( isset( $slide['slide_caption_button_link'] ) )
				$slide_caption_button_link = $slide['slide_caption_button_link'];
			else
				$slide_caption_button_link = null;

			if ( isset( $placeholder ) )
				$placeholder_output = "<img src='http://placehold.it/" . $placeholder . "' />";
			else
				$placeholder_output = null;

		   // Do something with the data

			$return.= "<figure>";

				if ( $slide_img )
					$return.= $slide_img;
				else
					$return.= $placeholder_output;

				$return.= "<figcaption>";

					$return.= "<div class='caption'>";

					if ( $slide_caption_title )
						$return.= "<p class='caption-title'>" . $slide_caption_title . "</p>";

					if ( $slide_caption_content )
						$return.= "<p class='caption-content'>" . $slide_caption_content . "</p>";

					if ( $slide_caption_button_text || $slide_caption_button_link )
						$return.= "<a class='caption-link' href='" . $slide_caption_button_link . "'>" . $slide_caption_button_text . "</a>";

					$return.= "</div>";

				$return.= "</figcaption>";

			$return.= "</figure>";

		endforeach;

		$return.= "</div>";

	endwhile; endif; wp_reset_query();

	return $return;
}

add_shortcode( '_s_carousel', '_s_carousel' );