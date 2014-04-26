<?php

/* * ******************* META BOX DEFINITIONS ********************** */

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'imgd_';

if (!isset($meta_boxes)){
    global $meta_boxes;
    $meta_boxes = array();
}

$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => $prefix . 'home',
    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => 'Display Options',
    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array('post','page','portfolio_item'),
    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'side',
    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',
    // List of meta fields
    'fields' => array(
        array(
            // Field name - Will be used as label
            'name' => __('Slide Show', 'imgd'),
            // Field ID, i.e. the meta key
            'id' => $prefix . 'slideshow',
            // Field description (optional)
            'desc' => __('Se muestra en el Slide Show del Home Page', 'imgd'),
            // CLONES: Add to make the field cloneable (i.e. have multiple value)
            'clone' => false,
            'type' => 'checkbox'
        ),
        array(
            'name' => __('Home Page', 'imgd'),
            'id' => $prefix . "home",
            'clone' => false,
            'type' => 'checkbox',
            'desc' => __('Implica los elementos a publicar en la Home Page', 'imgd')
        ),
    )
);


/* * ******************* META BOX REGISTERING ********************** */

/**
 * Register meta boxes
 *
 * @return void
 */
function imgd_alquiler_register_meta_boxes() {
    global $meta_boxes;

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if (class_exists('RW_Meta_Box')) {
        foreach ($meta_boxes as $meta_box) {
            new RW_Meta_Box($meta_box);
        }
    }

    wp_enqueue_style('imgd', get_stylesheet_directory_uri() . '/assets/css/admin.css');
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'imgd_alquiler_register_meta_boxes');