<?php
/**
 * _s Theme Customizer
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Contact

	$wp_customize->add_section( '_s_page_displays', array(
		'title'          => 'Page displays',
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'page_display_contact', array() );
	$wp_customize->add_control( 'page_display_contact', array(
		'label'   => 'Contact',
		'section' => '_s_page_displays',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'page_display_about', array() );
	$wp_customize->add_control( 'page_display_about', array(
		'label'   => 'About',
		'section' => '_s_page_displays',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'page_display_faqs', array() );
	$wp_customize->add_control( 'page_display_faqs', array(
		'label'   => 'FAQs',
		'section' => '_s_page_displays',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'page_display_gallery', array() );
	$wp_customize->add_control( 'page_display_gallery', array(
		'label'   => 'Gallery',
		'section' => '_s_page_displays',
		'type'    => 'dropdown-pages',
	) );

	// Contact

	$wp_customize->add_section( '_s_contact', array(
		'title'          => 'Contact',
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'email', array() );
	$wp_customize->add_control( 'email', array(
		'label'   => 'Email',
		'section' => '_s_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'phone', array() );
	$wp_customize->add_control( 'phone', array(
		'label'   => 'Phone',
		'section' => '_s_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'mobile', array() );
	$wp_customize->add_control( 'mobile', array(
		'label'   => 'Mobile',
		'section' => '_s_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'fax', array() );
	$wp_customize->add_control( 'fax', array(
		'label'   => 'Fax',
		'section' => '_s_contact',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'address', array() );
	$wp_customize->add_control( 'address', array(
		'label'   => 'Address',
		'section' => '_s_contact',
		'type'    => 'text',
	) );

	// Social Media

	$wp_customize->add_section( '_s_social_media', array(
		'title'          => 'Social Media',
		'priority'       => 35,
	) );

	$wp_customize->add_setting( 'facebook', array() );
	$wp_customize->add_control( 'facebook', array(
		'label'   => 'Facebook',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'googleplus', array() );
	$wp_customize->add_control( 'googleplus', array(
		'label'   => 'Google Plus',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'twitter', array() );
	$wp_customize->add_control( 'twitter', array(
		'label'   => 'Twitter',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'instagram', array() );
	$wp_customize->add_control( 'instagram', array(
		'label'   => 'Instagram',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'pinterest', array() );
	$wp_customize->add_control( 'pinterest', array(
		'label'   => 'Pinterest',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'youtube', array() );
	$wp_customize->add_control( 'youtube', array(
		'label'   => 'YouTube',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'linkedin', array() );
	$wp_customize->add_control( 'linkedin', array(
		'label'   => 'LinkedIn',
		'section' => '_s_social_media',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );
