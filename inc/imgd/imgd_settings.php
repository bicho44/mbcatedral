<?php

/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    tcx
 * @since      0.2.0
 * @version    1.0.0
 */
function imgd_register_theme_customizer( $wp_customize ) {

    /*-----------------------------------------------------------*
     * Defining our own 'Display Options' section
     *-----------------------------------------------------------*/

    $wp_customize->add_section(
        'imgd_display_options',
        array(
            'title'     => 'OnePage Options',
            'priority'  => 200
        )
    );

    $bloque = 1;

    while ($bloque <= 5) {

        /*$wp_customize->add_setting(
            'imgd_display_section'.$bloque,
            array(
                'default'    =>  'true',
                'transport'  =>  'postMessage'
            )
        );

        $wp_customize->add_control(
            'imgd_display_section'.$bloque,
            array(
                'section'   => 'imgd_display_options',
                'label'     => 'Bloque '.$bloque,
                'type'      => 'checkbox'
            )
        );*/

        $wp_customize->add_setting(
            'imgd_display_list_pages'.$bloque,
            array(
                'default'    =>  '0',
                'transport'  =>  'postMessage'
            )
        );
        $wp_customize->add_control(
            'imgd_display_list_pages'.$bloque,
            array(
                'section'   => 'imgd_display_options',
                'label'     => 'Contenido Bloque '.$bloque,
                'type'      => 'select',
                'choices'   => imgd_list_pages(),
            )
        );
    $bloque = $bloque+1;
    }


    /* Footer Options */

    $wp_customize->add_section(
        'imgd_footer_options',
        array(
            'title'     => 'Footer Options',
            'priority'  => 220
        )
    );

    /* Display Copyright */
    $wp_customize->add_setting(
        'imgd_footer_copyright_text',
        array(
            'default'            => 'All Rights Reserved',
            'sanitize_callback'  => 'tcx_sanitize_copyright',
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'imgd_footer_copyright_text',
        array(
            'section'  => 'imgd_footer_options',
            'label'    => 'Copyright Message',
            'type'     => 'text'
        )
    );



} // end tcx_register_theme_customizer
add_action( 'customize_register', 'imgd_register_theme_customizer' );

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 * @package    tcx
 * @since      0.5.0
 * @version    1.0.0
 */
function tcx_sanitize_copyright( $input ) {
    return strip_tags( stripslashes( $input ) );
} // end tcx_sanitize_copyright


/**
 * List of Pages
 */

function imgd_list_pages(){
    $pagesarray = array();
    $pages = get_pages();

    $pagesarray[0] = 'Seeccione una Página';

    foreach ( $pages as $page ) {
        $pagesarray[$page->ID] = $page->post_title;
    }
    return $pagesarray;
}

/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package    tcx
 * @since      0.3.0
 * @version    1.0.0
 */
/* function tcx_customizer_live_preview() {

    wp_enqueue_script(
        'tcx-theme-customizer',
        get_template_directory_uri() . '/js/theme-customizer.js',
        array( 'jquery', 'customize-preview' ),
        '1.0.0',
        true
    );

} // end tcx_customizer_live_preview
add_action( 'customize_preview_init', 'tcx_customizer_live_preview' );*/