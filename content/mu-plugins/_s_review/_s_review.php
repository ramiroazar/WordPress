<?php
/**
 * Plugin Name: Review
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

/**
 * Register a post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

add_action( 'init', '_s_post_type_review_init' );

function _s_post_type_review_init() {
	$labels = array(
		'name'               => _x( 'Reviews', 'post type general name', '_s' ),
		'singular_name'      => _x( 'Review', 'post type singular name', '_s' ),
		'menu_name'          => _x( 'Reviews', 'admin menu', '_s' ),
		'name_admin_bar'     => _x( 'Review', 'add new on admin bar', '_s' ),
		'add_new'            => _x( 'Add New', 'review', '_s' ),
		'add_new_item'       => __( 'Add New Review', '_s' ),
		'new_item'           => __( 'New Review', '_s' ),
		'edit_item'          => __( 'Edit Review', '_s' ),
		'view_item'          => __( 'View Review', '_s' ),
		'all_items'          => __( 'All Reviews', '_s' ),
		'search_items'       => __( 'Search Reviews', '_s' ),
		'parent_item_colon'  => __( 'Parent Reviews:', '_s' ),
		'not_found'          => __( 'No reviews found.', '_s' ),
		'not_found_in_trash' => __( 'No reviews found in Trash.', '_s' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false, // array( 'slug' => 'review' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon' 			=> 'dashicons-format-quote',
		'supports'           => array( 'title', 'editor' )
	);

	register_post_type( 'review', $args );
}

/**
 * Register shortcode.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

function _s_review( $atts ) {
	
	extract( shortcode_atts(
		array(
			'ids' => null,
			'limit' 		=> -1,
			'order' => 'rand',
			'words' => 25,
			'link' => null,
			'columns' 			=> 2,
			'caption' 			=> false,
			'carousel' 			=> false,
			"autoplay"			=> true,
			"pagination"		=> false,
			"transition" 		=> "fade",
			"prev" 				=> "<i class=\"fa fa-angle-left\"></i>",
			"next" 				=> "<i class=\"fa fa-angle-right\"></i>",
			"interval"			=> 5000,
		), $atts )
	);

	$args = array(
		'post_type' => 'review', 
		'posts_per_page' => $limit,
		'orderby' => $order,
	);

	if (isset($ids)) :
		$ids_array = explode(',', $ids);

		if (isset($ids_array)) :
			$args['post__in'] = $ids_array;
		endif;
	endif;

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :

		$return = '';

		if ($carousel) : 

			if ( $autoplay == true )
				$autoplay = "data-autoplay ";

			if ( $pagination == true )
				$pagination = "data-paginate ";

			if ( $transition == true )
				$transition = "data-transition='" . $transition . "' ";

			if ( $prev == true )
				$prev = "data-prev='" . $prev . "' ";

			if ( $next == true )
				$next = "data-next='" . $next . "' ";

			if ( $interval == true )
				$interval = "data-interval='" . $interval . "' ";

			$return.= "<div class='carousel' " . $pagination . $autoplay . $transition . $prev . $next . $interval . ">"; 

		endif;

		while ($the_query->have_posts()) : $the_query->the_post();

			$return .= "<blockquote class='review' itemscope itemtype='http://data-vocabulary.org/Review'>";
				$return .= "<div class='description' itemprop='description'>";
					if (in_the_loop()) :
						$return .= wpautop(get_the_content());
					else :
						$return .= _s_excerpt($words);	
						if ($link) :
							$return .= " <a href='" . $link . "'>";
							$return .= "Read More";
							$return .= "</a>";
						endif;		
					endif;
				$return .= "</div>";
				$return .= "<footer class='author' itemprop='author' itemscope itemtype='http://schema.org/Person'>";
					$return .= "<cite itemprop='name'>";
					$return .= get_the_title();
					$return .= "</cite>";
				$return .= "</footer>";
			$return .= "</blockquote>";

		endwhile;

		if ($carousel) : $return.= "</div>"; endif;

	endif; 

	wp_reset_postdata();

	return $return;
}

add_shortcode( '_s_review', '_s_review' );