<?php
/**
 * IMG Digital v1 functions and definitions
 *
 * @package IMG Digital v1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170; /* pixels */
}

if ( ! function_exists( 'imgdigital_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function imgdigital_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on IMG Digital v1, use a find and replace
	 * to change 'imgdigital' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'imgdigital', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'imgdigital' ),
	) );

	// Enable support for Post Formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	/*add_theme_support( 'custom-background', apply_filters( 'imgdigital_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );*/

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // imgdigital_setup
add_action( 'after_setup_theme', 'imgdigital_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function imgdigital_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Front Page', 'imgdigital' ),
        'id'            => 'frontpage',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'imgdigital' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

    register_sidebar( array(
        'name'          => __( 'Footer', 'imgdigital' ),
        'id'            => 'footer-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );

}
add_action( 'widgets_init', 'imgdigital_widgets_init' );

/**
 * Jquery enqueue
 */
function imgd_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null, true);
    wp_enqueue_script('jquery');
}


/**
 * Enqueue scripts and styles.
 */
function imgdigital_scripts() {

	wp_enqueue_style( 'imgdigital-style', get_stylesheet_uri() );

    //Modernizer
    wp_register_script('img_modern', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.6.2.min.js', false, null, false);

    /* EnQueue jQuery */
    imgd_jquery_enqueue();

	//wp_enqueue_script( 'imgdigital-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'imgdigital-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    // Scripts from Bootstrap
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/script-ck.js', false, null, true );

    wp_enqueue_script('img_modern');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'imgdigital_scripts' );

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
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Funciones de IMGDigital
 */
require_once get_template_directory() . '/inc/imgd/imgd_funciones.php';

