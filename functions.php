<?php
/**
 * Architect functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Architect
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'architect_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function architect_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'architect', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		//add_theme_support( 'automatic-feed-links' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Navigation', 'architect' ),
				'social' => __( 'Social Links Navigation', 'architect' ),
				'footer' => __( 'Footer Navigation', 'architect' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		/* Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'architect_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);
		*/


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		$editor_stylesheet_path = './assets/css/style-editor.css';

		add_editor_style ( $editor_stylesheet_path );


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'architect_setup' );


/**
 * Register google fonts.
 */
function architect_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
   */
  $lora = esc_html_x( 'on', 'Lora font: on or off', 'architect' );

	/* Translators: If there are characters in your language that are not
	* supported by Lato, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$lato = esc_html_x( 'off', 'Lato font: on or off', 'architect' );

	if ( 'off' !== $lora || 'off' !== $lato ) {
		$font_families = array();

		if ( 'off' !== $lora ) {
			$font_families[] = 'Lora:400,600';
		}

		if ( 'off' !== $lato ) {
			$font_families[] = 'Lato:400';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'cyrillic-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function architect_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'architect_content_width', 720 );
}
add_action( 'after_setup_theme', 'architect_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function architect_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'architect' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here for displayed in the footer.', 'architect' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'architect_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function architect_scripts() {
	// wp_enqueue_style( 'architect-style', get_stylesheet_uri(), array(), _S_VERSION );
	//wp_style_add_data( 'architect-style', 'rtl', 'replace' );

	// Enqueue Google fonts
	wp_enqueue_style( 'architect-fonts', architect_fonts_url(), array(), null );

	// Main style temp
	wp_enqueue_style( 'architect-style-temp', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_template_directory() . '/assets/css/style.css') );

	wp_enqueue_script( 'architect-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'architect_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-architect-svg-icons.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
