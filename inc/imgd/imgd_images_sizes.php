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

add_image_size('thumb-archive', 400, 300, true);

add_image_size('lead-image', 850, 400, true);


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

/**
 * Parametros para el BFI Thumb
 *
 * Devuelve los parámetros para croppear las imagenes
 *
 * @param $thumbnail_name
 * @return array con los parametros
 */
function imgd_parametros_thumbnail($thumbnail_name=""){
	// Determinar el tamaño de la imagen del Carrousel
	if ($thumbnail_name=="full-cropped"){
		$params = array(
			'width'    =>  1170,
			'height'   =>  590,
			'crop'     =>  true
		);
	} elseif ($thumbnail_name=="tablet") {
		$params = array(
			'width'    =>  960,
			'height'   =>  490,
			'crop'     =>  true
		);
	} elseif ($thumbnail_name=="phones") {
		$params = array(
			'width'    =>  480,
			'height'   =>  250,
			'crop'     =>  true
		);
	}

	return $params;
}

/**
 * IMGD Thumbnail
 *
 * @param $postID
 * @param string $size
 * @param string $alttext
 * @return string HTML de la imagen
 */
function imgd_thumbnail($postID, $size='full-cropped', $alttext="", $class="imgdecor"){

	/* Obtengo el URL de la imagen principal */
	$post_thumbnail_id = get_post_thumbnail_id($postID);

	/* Array con los datos de la imagen */
	$html = wp_get_attachment_image_src($post_thumbnail_id, $size);

	/* obtengo los parámetros para el resize */
	$params = imgd_parametros_thumbnail($size);

	/* HTML a devolver */
	$imagen = '<img src="'. bfi_thumb( $html[0], $params ) .'" alt="'. $alttext .'" class="'. $class .'" >';

	return $imagen;
}