<?php
/**
 * Plugin Name: Review
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

/**
 * Register shortcode.
 *
 * @link https://codex.wordpress.org/Shortcode_API
 */

function _s_review( $atts ) {

	$atts = shortcode_atts( 
		array(
			'id' 				=> null,
			'limit' 			=> -1,
			'order' 			=> 'rand',
			'words' 			=> 25,
			'link' 			=> null,
			'columns' 		=> 2,
			'caption' 		=> false,
			'carousel' 		=> false,
			'autoplay'		=> true,
			'pagination'	=> false,
			'prev' 			=> '<i class="fa fa-angle-left"></i>',
			'next' 			=> '<i class="fa fa-angle-right"></i>',
			'interval'		=> 5000,
			'transition' 	=> 'fade',
		), 
		$atts
	);

	$args = array(
		'posts_per_page' => $atts[limit], 
		'orderby' => $atts[order], 
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'post_format',
				'terms' => array('post-format-quote'),
				'field' => 'slug',
			),
			array(
				'taxonomy' => 'category',
				'terms' => array('quote'),
				'field' => 'slug',
			),
		),
	);

	if (isset($atts[id])) :
		$id_array = explode(',', $atts[id]);

		if (isset($id_array)) :
			$args['post__in'] = $id_array;
		endif;
	endif;

	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :

		$return = '';

		if ($atts[carousel]) :

			$return .= "<div class='carousel' ";
				$return .= ($atts[autoplay] === true) ? "data-autoplay " : "";
				$return .= ($atts[pagination] === true) ? "data-paginate " : "";
				$return .= ($atts[prev]) ? "data-prev='" . $atts[prev] . "' " : "";
				$return .= ($atts[next]) ? "data-next='" . $atts[next] . "' " : "";
				$return .= ($atts[interval]) ? "data-interval='" . $atts[interval] . "' " : "";
				$return .= ($atts[transition]) ? "data-transition='" . $atts[transition] . "' " : "";
			$return .= ">"; 

		endif;

		while ($the_query->have_posts()) : $the_query->the_post();

			$return .= "<blockquote class='review' itemscope itemtype='http://schema.org/Review'>";
				$return .= "<div class='description' itemprop='description'>";
					if (in_the_loop()) :
						$return .= wpautop(get_the_content());
					else :
						$return .= _s_excerpt($atts[words]);	
						if ($atts[link]) :
							$return .= "<a href='" . $atts[link] . "'>";
								$return .= "Read More";
							$return .= "</a>";
						endif;		
					endif;
				$return .= "</div>";
				$return .= "<footer>";
					$return .= "<span itemprop='author' itemscope itemtype='http://schema.org/Person'>";
						$return .= "<cite itemprop='name'>";
							$return .= get_the_title();
						$return .= "</cite>";
					$return .= "</span>";
					$return .= "<span itemprop='itemReviewed' itemscope itemtype='http://schema.org/Organization'>";
						$return .= ", about ";
						$return .= "<a href='" . esc_url( home_url( '/' ) ) . "' rel='home' itemprop='url'>";
							$return .= "<span itemprop='name'>";
								$return .= get_bloginfo('name');
							$return .= "<span>";
						$return .= "</a>";
					$return .= "</span>";
				$return .= "</footer>";
			$return .= "</blockquote>";

		endwhile;

		if ($atts[carousel]) : $return.= "</div>"; endif;

	endif; 

	wp_reset_postdata();

	return $return;
}

add_shortcode( '_s_review', '_s_review' );