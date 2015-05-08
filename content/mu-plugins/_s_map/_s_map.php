<?php
/**
 * Plugin Name: Map
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

add_action('wp_print_scripts', '_s_map_register_scripts');
add_action('wp_print_styles', '_s_map_register_styles');

function _s_map_register_scripts() {
    if (!is_admin()) {

    	wp_enqueue_script('_s-map', plugins_url("js/_s_maps.js", __FILE__), array('jquery'));

    }
}
 
function _s_map_register_styles() {

	//wp_enqueue_style('_s-responsive-carousel.style', plugins_url("css/responsive-carousel.css", __FILE__));

}

/**
 * Register a post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', '_s_post_type_map_init' );

function _s_post_type_map_init() {
	$labels = array(
		'name'               => _x( 'Maps', 'post type general name', '_s' ),
		'singular_name'      => _x( 'Map', 'post type singular name', '_s' ),
		'menu_name'          => _x( 'Maps', 'admin menu', '_s' ),
		'name_admin_bar'     => _x( 'Map', 'add new on admin bar', '_s' ),
		'add_new'            => _x( 'Add New', 'map', '_s' ),
		'add_new_item'       => __( 'Add New Map', '_s' ),
		'new_item'           => __( 'New Map', '_s' ),
		'edit_item'          => __( 'Edit Map', '_s' ),
		'view_item'          => __( 'View Map', '_s' ),
		'all_items'          => __( 'All Maps', '_s' ),
		'search_items'       => __( 'Search Maps', '_s' ),
		'parent_item_colon'  => __( 'Parent Maps:', '_s' ),
		'not_found'          => __( 'No maps found.', '_s' ),
		'not_found_in_trash' => __( 'No maps found in Trash.', '_s' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false, // array( 'slug' => 'map' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' 			=> 'dashicons-location-alt',
		'supports'           => array( 'title' )
	);

	register_post_type( 'map', $args );
}

/**
 * Register CMB2 metaboxes.
 *
 * @link https://github.com/WebDevStudios/CMB2/wiki/Basic-Usage
 */

add_filter( 'cmb2_meta_boxes', '_s_cmb2_map' );

function _s_cmb2_map( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb2_';

	$meta_boxes['map'] = array(
		'id'         => 'map',
		'title'      => __( 'Map', 'cmb2' ),
		'object_types'      => array( 'map', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'id'          => $prefix . 'locations',
				'type'        => 'group',
				'name' => __( 'Locations', 'cmb2' ),
				'description' => __( 'Generate Location', 'cmb2' ),
				'options'     => array(
					'group_title'   => __( 'Location {#}', 'cmb2' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Location', 'cmb2' ),
					'remove_button' => __( 'Remove Location', 'cmb2' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
					    'name' => __( 'Information', 'cmb2' ),
					    'desc' => __( 'Populate information window content (<strong><u>Note</u></strong>: If populated, information window is displayed on marker click)', 'cmb2' ),
					    'id'   => 'location_information',
					    'type' => 'wysiwyg',
					    'options' => array(
					        'textarea_rows' => get_option('default_post_edit_rows', 4), // rows="..."
					    ),
					),
					array(
					    'name' => __( 'Coordinates', 'cmb2' ),
					    'desc' => __( 'Drag the marker to set the exact map', 'cmb2' ),
					    'id'   => 'location_coordinates',
					    'type' => 'pw_map',
					    'sanitization_cb' => 'pw_map_sanitise',
					),
					array(
					    'name' => __( 'Map Center', 'cmb2' ),
					    'desc' => __( 'Check to center map to this location (<strong><u>Note</u></strong>: Check one location per map)', 'cmb2' ),
					    'id'   => 'location_center',
					    'type' => 'checkbox',
					),
					array(
					    'name' => __( 'Information Window', 'cmb2' ),
					    'desc' => __( 'Check to display information window on load (<strong><u>Note</u></strong>: Check one location per map)', 'cmb2' ),
					    'id'   => 'location_infowindow',
					    'type' => 'checkbox',
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

function _s_map( $atts ) {

	$atts = shortcode_atts( 
		array(
			'id' 				=> null,
			'zoom'			=> 10,
			'scrollwheel'	=> false,
			'width'	=> '320px',
			'height'	=> '320px',
		), 
		$atts
	);

	if ($atts[id]) :

		$args = array(
			'post_type' => 'map',
			'posts_per_page' => 1,
			'p' => $atts[id],
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) :

			while ($the_query->have_posts()) : $the_query->the_post();

				$prefix = '_cmb2_';

				$locations = get_post_meta( get_the_ID(), $prefix . 'locations', true );

				if ($locations) :

					$return .= "<div ";
						$return .= "id='map-" . get_the_ID() . "' ";
						$return .= "class='map-canvas'";
						$return .= ($atts[zoom]) ? "data-zoom='" . $atts[zoom] . "'" : "";
						$return .= ($atts[width]) ? "data-width='" . $atts[width] . "'" : "";
						$return .= ($atts[height]) ? "data-height='" . $atts[height] . "'" : "";
						$return .= ($atts[scrollwheel] === false) ? "data-scrollwheel='false'" : "";
					$return .= ">";

					// Create empty array
					$location_array = array();

					foreach ( (array) $locations as $key => $location ) :

						$return.= "<div class='location " . ($location[location_center] ? 'location_center' : '') . " " . ($location[location_infowindow] ? 'location_infowindow' : '') . "'>";

							$return .= ($location[location_information]) ? "<input type='hidden' name='location_information' value='" . wpautop($location[location_information]) . "'>" : "";
							$return .= ($location[location_coordinates][latitude]) ? "<input type='hidden' name='location_latitude' value='" . $location[location_coordinates][latitude] . "'>" : "";
							$return .= ($location[location_coordinates][longitude]) ? "<input type='hidden' name='location_longitude' value='" . $location[location_coordinates][longitude] . "'>" : "";

						$return.= "</div>";

						// Create empty array
						$location_metadata_array = array();
						// Push metadata into array
						array_push(
							$location_metadata_array, 
							$location[location_information], 
							$location[location_coordinates][latitude], 
							$location[location_coordinates][longitude]
						);
						// Push array for each into overarching array to create a 2 dimensional array.
						array_push($location_array, $location_metadata_array);

					endforeach;

					$return.= "</div>";

					$location_array = json_encode($location_array);

				endif;

			endwhile; 

		return $return;

		endif; wp_reset_query();

	endif;
}

add_shortcode( '_s_map', '_s_map' );