<?php
/**
 * Pictorico Theme Customizer
 *
 * @package Pictorico
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pictorico_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_setting( 'flickr_url' , array(
        'default' => ''
    ) );
	$wp_customize->add_control( 'flickr_url', array(
		'label'    => __( 'Flickr URL', 'pictorico' ),
		'section'  => 'title_tagline',
        'settings' => 'flickr_url',
		'type'     => 'text',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'twitter_url' , array(
        'default' => ''
    ) );
	$wp_customize->add_control( 'twitter_url', array(
		'label'    => __( 'Twitter URL', 'pictorico' ),
		'section'  => 'title_tagline',
        'settings' => 'twitter_url',
		'type'     => 'text',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'youtube_url' , array(
        'default' => ''
    ) );
	$wp_customize->add_control( 'youtube_url', array(
		'label'    => __( 'Youtube URL', 'pictorico' ),
		'section'  => 'title_tagline',
        'settings' => 'youtube_url',
		'type'     => 'text',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'mapbox_map_id' , array(
        'default' => ''
    ) );
	$wp_customize->add_control( 'mapbox_map_id', array(
		'label'    => __( 'Mapbox map ID', 'pictorico' ),
		'section'  => 'title_tagline',
        'settings' => 'mapbox_map_id',
		'type'     => 'text',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'mapbox_access_token' , array(
        'default' => ''
    ) );
	$wp_customize->add_control( 'mapbox_access_token', array(
		'label'    => __( 'Mapbox access token', 'pictorico' ),
		'section'  => 'title_tagline',
        'settings' => 'mapbox_access_token',
		'type'     => 'text',
		'priority' => 100,
	) );

	$wp_customize->add_setting( 'mailchimp_subscribe_url' , array(
		'default' => ''
	) );
	$wp_customize->add_control( 'mailchimp_subscribe_url', array(
		'label'    => __( 'Mailchimp subscribe URL', 'pictorico' ),
		'section'  => 'title_tagline',
		'settings' => 'mailchimp_subscribe_url',
		'type'     => 'text',
		'priority' => 100,
	) );
}
add_action( 'customize_register', 'pictorico_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pictorico_customize_preview_js() {
	wp_enqueue_script( 'pictorico_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pictorico_customize_preview_js' );