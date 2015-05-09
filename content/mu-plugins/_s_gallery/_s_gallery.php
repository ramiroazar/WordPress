<?php
/**
 * Plugin Name: Gallery
 * Author: Insight Digital
 * Author URI: http://insightdigital.com.au
 * License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
 */

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

	$atts = shortcode_atts( 
		array(
			'id' 					=> null,
			'limit' 				=> null,
			'category' 			=> null,
			'caption' 			=> false,
			'title' 				=> false,
			'image_total' 		=> 4,
			'image_size' 		=> 'large',
			'thumbnail_size' 	=> 'thumbnail',
			'columns' 			=> 2,
			'carousel' 			=> false,
			'autoplay'			=> true,
			'pagination'		=> false,
			'prev' 				=> '<i class="fa fa-angle-left"></i>',
			'next' 				=> '<i class="fa fa-angle-right"></i>',
			'interval'			=> 5000,
			'transition' 		=> 'fade',
		), 
		$atts
	);

	$args = array(
		'post_type' => 'gallery', 
		'posts_per_page' => $atts[limit], 
		'orderby' => 'rand', 
	);

	if ($atts[id]) :
		$id_array = explode(',', $atts[id]);

		if ($id_array) :
			$args['post__in'] = $id_array;
		endif;
	endif;

	if ($atts[category]) :
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category_gallery',
				'field' => 'slug',
				'terms' => explode(',', $atts[category]),
			)
		);
	endif;

	$the_query = "";
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :

		$return = "";

		$return .= "<div class='gallery gallery-columns-" . $atts[columns] . " gallery-size-" . $atts[thumbnail_size] . "'>";

		while ($the_query->have_posts()) : $the_query->the_post(); 

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

	         $gallery = get_post_gallery( get_the_ID(), false );

				if ( $gallery ) :

			      $gallery_images = explode(',', $gallery['ids']);

					$c = 0; foreach( $gallery_images AS $gallery_image ) : $c++;		         

						$gallery_image_thumbnail = wp_get_attachment_image( 
							$gallery_image, 
							$atts[thumbnail_size], 
							null, 
							array(
								"sizes" => tevkori_get_sizes( $gallery_image, $atts[thumbnail_size] ),
								"srcset" => implode( ', ', tevkori_get_srcset_array( $gallery_image, $atts[thumbnail_size] ) ),
							)
						);
			         $gallery_image_src = wp_get_attachment_image_src($gallery_image, $atts[image_size])[0];
			         $gallery_image_meta = wp_get_attachment($gallery_image);
			         $gallery_image_caption = $gallery_image_meta['caption'];

					   if ( $c <= $atts[image_total] ) :
							$return.= "<figure class='gallery-item'>";
								$return.= "<div class='gallery-icon'>";
									$return.= "<a href='" . $gallery_image_src . "' target='_blank'>";
										$return.= $gallery_image_thumbnail;
									$return.= "</a>";
								$return.= "</div>";
								if($atss[caption]) :
									if ( $gallery_image_caption ) :
										$return.= "<figcaption class='wp-caption-text gallery-caption'>";
											$return.= 	$gallery_image_caption;
										$return.= "</figcaption>";
									endif;
								endif;
							$return.= "</figure>";
			         endif; 
				   endforeach;
			   endif;

			if ($atts[carousel]) : $return.= "</div>"; endif;

		endwhile; 

			$return.= "</div>";

	endif; 

	wp_reset_postdata();

	return $return;
}

add_shortcode( '_s_gallery', '_s_gallery' );