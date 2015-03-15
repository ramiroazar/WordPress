<?php

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

function _s_gallery_shortcode( $atts ) {
	
	extract( shortcode_atts(
		array(
			'ids' => null,
			'limit' => 1,
			'image_total' => 3,
			'image_size' => 'thumbnail',
			'columns' => 3,
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

		echo "<div class='gallery gallery-columns-" . $columns . " gallery-size-" . $image_size . "'>";

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
						?>
							<figure class="gallery-item">
								<div class="gallery-icon">
									<a href="<?php echo $gallery_image_file_url ?>">
										<img width="150" height="150" src="<?php echo $gallery_image_thumb_url; ?>" class="attachment-thumbnail" alt="<?php echo $gallery_image_caption; ?>">
									</a>
								</div>
								<?php if ( $gallery_image_caption ) : ?>
									<figcaption class="wp-caption-text gallery-caption" id="gallery-1-21">
										<?php echo $gallery_image_caption; ?>
									</figcaption>
								<?php endif; ?>
							</figure>
					   <?php
			         endif; 
				   endforeach;
			   endif;

		endwhile; 

		echo '</div>';

	endif; wp_reset_query();
}
add_shortcode( '_s_gallery', '_s_gallery_shortcode' );
?>