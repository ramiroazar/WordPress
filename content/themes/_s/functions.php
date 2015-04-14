<?php
/**
 * _s functions and definitions
 *
 * @package _s
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width =  null; // 640; /* pixels */
}

if ( ! function_exists( '_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _s_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
		'secondary' => __( 'Secondary Menu', '_s' ),
		'tertiary' => __( 'Tertiary Menu', '_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Custom scripts and styles

	// 1) Deregister local copy of jQuery (wp_enqueue_script( 'jquery' );)
	wp_deregister_script('jquery');
	// 2) Replace with Google CDN
	wp_enqueue_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"), false, '', true);
	// 3) Load jQuery backup script (http://stackoverflow.com/a/1014251)
	wp_enqueue_script('jquery-backup', (get_template_directory_uri() . "/js/jquery-backup.js"), false, '', true);

	// Load tabs
	wp_enqueue_script('tab', (get_template_directory_uri() . "/js/tab.js"), array('jquery'), '', true);

	// Load lightbox
	wp_enqueue_script('lightbox', (get_template_directory_uri() . "/js/jquery.magnific-popup.min.js"), array('jquery'), '', true);
	wp_enqueue_script('lightbox_adaptive', (get_template_directory_uri() . "/js/jquery.magnific-popup.adaptive.js"), array('jquery'), '', true);
	wp_localize_script( 'lightbox_adaptive', 'lightbox_adaptive_ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));

	// Load lightbox toggle
	wp_enqueue_script('lightbox-toggle', (get_template_directory_uri() . "/js/lightbox-toggle.js"), array('jquery'), '', true);

	// icon stylesheet
	wp_enqueue_style( 'icon-stylesheet', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), null);
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Functions
 */

// Load Schema.org

	require get_template_directory() . '/inc/_s_schema.org.php';

// Define custom image sizes

	// Resolution sizes
	add_image_size('2560', 2560);
	add_image_size('1920', 1920);
	add_image_size('1280', 1280);
	add_image_size('1024', 1024);
	add_image_size('768', 768);
	add_image_size('480', 480);
	add_image_size('320', 320);

	// Make custom image sizes accessible via dashboard
	function _s_insert_custom_image_sizes( $sizes ) {
		global $_wp_additional_image_sizes;
		if ( empty($_wp_additional_image_sizes) )
		return $sizes;

		foreach ( $_wp_additional_image_sizes as $id => $data ) {
			if ( !isset($sizes[$id]) )
			$sizes[$id] = ucfirst( str_replace( '-', ' ', $id ) );
		}

		return $sizes;
	}
	add_filter( 'image_size_names_choose', 'my_insert_custom_image_sizes' );

// Excerpt

	// Output Read More link
	function _s_excerpt_more_output( $more ) {
		return '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', '_s') . '</a>';
	}

	// Replace [...] with ...
	function _s_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', '_s_excerpt_more' );

	// Limit Excerpt
	function _s_excerpt($limit) {
	    return wp_trim_words(get_the_excerpt(), $limit); // . " " . _s_excerpt_more_output();
	}

// Remove Contact Form 7 Stylesheet

  function _s_deregister_ct7_styles() {
      wp_deregister_style( 'contact-form-7' );
  }

  add_action( 'wp_print_styles', '_s_deregister_ct7_styles', 100 );

// Custom Login Page CSS

	//Updated to proper 'enqueue' method
	//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
	function _s_login_css() {
		wp_enqueue_style( '_s_login_css', get_template_directory_uri() . '/login.css', false );
	}
	// changing the logo link from wordpress.org to your site
	function _s_login_url() {  return home_url(); }
	// changing the alt text on the logo to show your site name
	function _s_login_title() { return get_option( 'blogname' ); }
	// calling it only on the login page
	add_action( 'login_enqueue_scripts', '_s_login_css', 10 );
	add_filter( 'login_headerurl', '_s_login_url' );
	add_filter( 'login_headertitle', '_s_login_title' );

// Custom Admin Footer Text

	// Custom Backend Footer
	function _s_custom_admin_footer() {
		_e('<span id="footer-thankyou">Developed by <a href="http://insightdigital.com.au/" target="_blank">Insight Digital Marketing</a></span>. Built using <a href="http://underscores.me/" target="_blank">Underscores (_s)</a>.', '_s');
	}

	// adding it to the admin area
	add_filter( 'admin_footer_text', '_s_custom_admin_footer' );

// Query Shortcode

   function _s_query_markup($markup, $context) {
	   $context = $context;
   	$query_markup = "";
		ob_start();
			//get_template_part($markup); 
			include(locate_template($markup . '.php'));
			$query_markup .= ob_get_contents();  
		ob_end_clean();
		return $query_markup;
   }

	function _s_query($atts) {

	   // EXAMPLE USAGE:
	   // [_s_query arguements="showposts=100&post_type=page&post_parent=453"]
	   
	   // Defaults
	   extract(shortcode_atts(array(
	      "arguements" => '',
	      "markup" => '',
	      "conditionals" => false,
	   ), $atts));

	   // de-funkify query
	   $arguements = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $arguements);
	   $arguements = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $arguements);

		global $post;
	   $context = "";
	   $context = get_the_ID();

	   // query is made               
	   query_posts($arguements);
	   
	   // Reset and setup variables
	   $output = '';

	   if ($conditionals == true) :
			if (have_posts()) :
				while(have_posts()) : the_post();
					$output .= _s_query_markup($markup, $context);
		   	endwhile;
			endif;
		else :
			$output .= _s_query_markup($markup, $context);
   	endif;
	   
	   wp_reset_query();
	   return $output;
	   
	}
	add_shortcode("_s_query", "_s_query");

// Contact information

	function _s_contact($type) {
		$contact = array();
		$contact[phone]		= get_theme_mod( 'phone' );
		$contact[mobile]		= get_theme_mod( 'mobile' );
		$contact[fax]			= get_theme_mod( 'fax' );
		$contact[address]		= get_theme_mod( 'address' );
		$contact[facebook]	= get_theme_mod( 'facebook' );
		$contact[googleplus]	= get_theme_mod( 'googleplus' );
		$contact[twitter]		= get_theme_mod( 'twitter' );
		$contact[instagram]	= get_theme_mod( 'instagram' );
		$contact[pinterest]	= get_theme_mod( 'pinterest' );
		$contact[youtube]		= get_theme_mod( 'youtube' );
		$contact[linkedin]	= get_theme_mod( 'linkedin' );
		$contact = array_filter($contact);

		if ($type)
			return $contact[$type];
		else
			return $contact;
	}

/*
 * Get image id from url 
 *
 * @link https://developer.wordpress.org/reference/functions/attachment_url_to_postid/
 * @link https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
 * @link https://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
 */

	function _s_get_attachment_id_from_url( $attachment_url = '' ) {
 
		global $wpdb;
		$attachment_id = false;
	 
		// If there is no url, return.
		if ( '' == $attachment_url )
			return;
	 
		// Get the upload directory paths
		$upload_dir_paths = wp_upload_dir();
	 
		// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
		if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
	 
			// If this is the URL of an auto-generated thumbnail, get the URL of the original image
			$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
	 
			// Remove the upload path base directory from the attachment URL
			$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
	 
			// Finally, run a custom database query to get the attachment ID from the modified attachment URL
			$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	 
		}
	 
		return $attachment_id;
	}

// Magnific Popup ajax function for adaptive images

	add_action('wp_ajax_nopriv_lightbox_adaptive_ajax', 'lightbox_adaptive_ajax');
	add_action('wp_ajax_lightbox_adaptive_ajax', 'lightbox_adaptive_ajax');

	function lightbox_adaptive_ajax() {

		// Get ajax data
		$img_src = $_POST['img_src'];
		// Get id
		$img_id = _s_get_attachment_id_from_url($img_src);
		// Get metadata
		$img_meta = wp_get_attachment($img_id);
		// Get element
		$img = wp_get_attachment_image( 
					$img_id, 
					null, 
					null, 
					array(
						"class" => "mfp-img",
						"sizes" => tevkori_get_sizes( $img_id, null ),
						"srcset" => implode( ', ', tevkori_get_srcset_array( $img_id, null ) ),
					)
				);

		// Build markup
		$img_markup = "";
		$img_markup .= "<div class='mfp-figure'>";
      $img_markup .=    "<figure>";
      $img_markup .=    	$img;
      $img_markup .=    	"<figcaption>";
      $img_markup .=    		"<div class='mfp-bottom-bar'>";
		if ($img_meta["caption"]) :
	      $img_markup .=      		"<div class='mfp-title'>";
		   $img_markup .=      			$img_meta["caption"];
	      $img_markup .=      		"</div>";
		endif;
      $img_markup .=      			"<div class='mfp-counter'></div>";
      $img_markup .=    		"</div>";
      $img_markup .=    	"</figure>";
      $img_markup .=    "</figure>";
		$img_markup .= "</div>";

		// Output markup
		echo $img_markup;

		die(); // this is required to return a proper result
	}