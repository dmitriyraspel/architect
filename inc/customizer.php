<?php
/**
 * Architect Theme Customizer
 *
 * @package Architect
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function architect_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'architect_customize_partial_blogname',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'architect_customize_partial_blogdescription',	
		)
	);

	/* Display Logo and Title ---------------- */
	
	$wp_customize->add_setting(
		'site_logo_and_title',
		array(
			'default'	=> '',
		)
	);

	$wp_customize->add_control(
		'site_logo_and_title',
		array(
			'type'        => 'checkbox',
			'section'     => 'title_tagline',
			'priority'    => 10,
			'label'       => __( 'Display Site Logo & Title', 'architect' ),
		)
	);

	/* Display Title and description ---------------- */
	$wp_customize->add_setting(
		'site_title_and_description',
		array(
			'default'	=> '',
		)
	);

	$wp_customize->add_control(
		'site_title_and_description',
		array(
			'type'        => 'checkbox',
			'section'     => 'title_tagline',
			'priority'    => 11,
			'label'       => __( 'Display Site Title & Tagline', 'architect' ),
		)
	);

	/* Add panel for theme settings ---------------- */
	$wp_customize->add_section( 
		'architect_theme_settings_section', 
		array(
			'title'      => __( 'Theme Settings', 'architect' ),
			'priority'   => 30,
		)
 	);

	/* Disable global styles in header WP 5.9 ---------------- */
	$wp_customize->add_setting(
		'disable-global-styles',
		array(
			'default'	=> '',
			'transport'            => 'refresh',
			// 'type'                 => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		'disable-global-styles',
		array(
			'type'        => 'checkbox',
			'section'     => 'architect_theme_settings_section',
			'priority'    => 5,
			'label'       => __( 'Disable Global Style in Head', 'architect' ),
		)
	);

}
add_action( 'customize_register', 'architect_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function architect_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function architect_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function architect_customize_preview_js() {
	wp_enqueue_script( 'architect-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'architect_customize_preview_js' );
