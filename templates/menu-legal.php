<?php
if ( has_nav_menu( 'legal' ) ) {

    wp_nav_menu(
        array(
            'theme_location'  => 'legal',
            'container'       => 'div',
            'container_id'    => 'menu-legal',
            'container_class' => 'menu',
            'menu_id'         => 'menu-legal-items',
            'menu_class'      => 'menu-items',
            'depth'           => 1,
            'link_before'     => '',
            'link_after'      => '',
            'fallback_cb'     => '',
        )
    );

}