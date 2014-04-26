<?php
/**
 * Definición de Custom image Sizes
 * Used for large feature (header) images.
 * $resolutions   = array(1200, 979, 767, 480);
 *
 * User: bicho44
 * Date: 26/08/13
 * Time: 12:05
 */

//1162x581.
add_image_size('full-cropped', 1170, 590, true);
add_image_size('tablet-h', 960, 490, true);
add_image_size('tablet-v', 780, 400, true);
add_image_size('phones', 480, 250, true);

add_image_size('thumb-archive', 300, 150, true);

add_image_size('lead-image', 780, 260, true);


/**
 * Get Size thumbnail
 *
 * @return string el nombre de la clase CSS
 */
function img_get_size_thumbnail()
{
    $thumbnail_name = 'full-cropped';

    /* Check to see if a valid cookie exists */
    if (isset($_COOKIE['resolution'])) {
        $cookie_value = intval($_COOKIE['resolution']);
    } else {
        $cookie_value = 1200;
    }

    if ($cookie_value >= 981) {
        $thumbnail_name = 'full-cropped';
    } elseif ($cookie_value >= 781 && $cookie_value <= 980) {
        $thumbnail_name = 'tablet-h';
    } elseif ($cookie_value >= 481 && $cookie_value <= 780) {
        $thumbnail_name = 'tablet-v';
    } elseif ($cookie_value <= 480) {
        $thumbnail_name = 'phones';
    }

    return $thumbnail_name;
}