<?php
/*
Title: Slide Show
Post Type: page,post,portfolio_item
Description: Un Meta Box para que este post aparezca en el slideshow del Front Page
Priority: high
Order: 3
Context: side
*/

/*piklist-StandBy('field', array(
    'type' => 'file'
,'field' => 'imgd_slideshow_img'
,'scope' => 'post_meta'
,'label' => __('Agregar imagen', 'imgd')
,'options' => array(
        'basic' => true
    )
));*/
piklist (
    'field',
    array(
        'type' => 'radio',
        'scope' => 'post_meta',
        'field' => 'imgd_home',
        'label' => __('Mostrar en Home', 'imgd'),
        'value' => 0,
        'attributes' => array(
            'class' => 'radio'
        ),
        'choices' => array(
            0 => __('No mostrar', 'imgd'),
            1 => __('Mostrar', 'imgd')
        ),
        'position' => 'wrap'
    )
);

piklist (
    'field',
    array(
        'type' => 'radio',
        'scope' => 'post_meta',
        'field' => 'imgd_slideshow',
        'label' => __('Mostrar en SlideShow', 'imgd'),
        'value' => 0,
        'attributes' => array(
            'class' => 'radio'
        ),
        'choices' => array(
            0 => __('No mostrar', 'imgd'),
            1 => __('Mostrar', 'imgd')
        ),
        'position' => 'wrap'
    )
);