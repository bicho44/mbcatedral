<?php
/** Definir el largo de los excerpt */
define('POST_EXCERPT_LENGTH', 55);
/** Enable to load jQuery from the Google CDN */
add_theme_support('jquery-cdn');

/**
 * Otros elementos para este tema
 */
//define('RWMB_DIR', trailingslashit(STYLESHEETPATH . '/inc/meta-box'));
// Re-define meta box path and URL
//define('RWMB_URL', trailingslashit(get_stylesheet_directory_uri() . '/inc/meta-box'));

//require get_template_directory() . '/inc/meta-box/meta-box.php';// MetaBox functions
require get_template_directory() . '/inc/imgd/imgd_cleanup.php';
require get_template_directory() . '/inc/imgd/imgd_images_sizes.php';

//require get_template_directory() . '/inc/imgd/imgd_settings.php'; // Estas opciones estaban pensadas para el theme de onepagescroll
require get_template_directory() . '/inc/imgd/imgd_gallery.php';
require get_template_directory() . '/inc/imgd/imgd_nav.php';
require get_template_directory() . '/inc/imgd/imgd_widgets.php';

//require get_template_directory() . '/inc/imgd/imgd_propiedades_custom.php'; // Define Las Propiedades
//require get_template_directory() . '/inc/imgd/imgd_metaboxes.php'; // Define los MetaBoxes

require locate_template('inc/BFI_Thumb.php');         // Images Manipulation

/*
 * Registro del Menú Social
 */
function imgd_register_social_menu() {
    register_nav_menu( 'social', __( 'Social', 'imgdigital' ) );
    register_nav_menu( 'legal', __( 'Legales', 'imgdigital' ) );
}
add_action( 'init', 'imgd_register_social_menu' );

/*
 * IMGD Credits
 */
function imgd_credits() {
    echo "Copyright 2014 - Federico Reinoso";
}
add_action('imgdigital_credits', 'imgd_credits');

function imgd_custompost($atts){
    extract( shortcode_atts( array(
        'post_type' => 'portfolio_item',
        'template' => 'thumbnails',
        'limit' => '10',
        'orderby' => 'date',
    ), $atts ) );

    // Creating custom query to fetch the project type custom post.
    $loop = new WP_Query(array('post_type' => $post_type, 'posts_per_page' => $limit, 'orderby' => $orderby));

    if ($loop->have_posts()) {

        $output = '<div class="row">';
        while ($loop->have_posts()) {
            $loop->the_post();


            $output .= '<div class="type-post hentry col-sm-6 col-md-3">';
            $output .= '    <div class="thumbnail">';
            if (has_post_thumbnail(get_the_ID())) {

                $atts = array(
                    'alt'	=> trim(strip_tags( get_the_title() )),
                    'title'	=> trim(strip_tags( get_the_excerpt() )),
                );

            $output .= '       <a href="'.get_permalink().'" title="'.get_the_title().'">';
            $output .=            get_the_post_thumbnail(get_the_ID(),'thumb-archive', $atts);
            $output .= '       </a>';

            } elseif($post_type == "it_exchange_prod") { ?>
                    <p>ID: <?php
                echo get_the_ID();?></p>
                <p>
                <?php
                $data = it_exchange_get_product(get_the_ID());
                //$data_image = $data->hasimage();
                //it_exchange( 'product', 'has-images' )
                echo 'Has Featured: '. $data->has-featured-image;
                ?>
                <br>
                <?php echo 'Featured Image: '.$data->featured-image; ?>
                </p>
                <code><?php var_dump($data->featured-image); ?></code>

            <?php } else {
                $output .= '       <a href="'.get_permalink().'" >';
                $output .=            '<img src="http://lorempixel.com/gray/253/132/abstract/No Thumbnail" alt="No thumbnail">';
                $output .= '       </a>';
            }

            $output .= '       <div class="caption">';
            $output .= '           <h3 class="entry-title">';
            $output .= '              <a href="'.get_permalink().'">'.get_the_title().'</a>';
            $output .= '           </h3>';
            $output .= '           <div class="entry-content">'.get_the_excerpt().'</div>';
            $output .= '       </div><!-- end caption -->';
            $output .= '     </div><!-- end Thumbnail -->';
            $output .= '</div><!-- end col -->';
        }
        $output .= '</div><!-- end row -->';
    } else {
        $output = '<h2>No hay datos para '. $post_type.'</h2>';
    }
    return $output;
}
add_shortcode('imgdpost','imgd_custompost');

function thumbnail_extra($postID) {
    
    $thumb = "http://lorempixel.com/gray/253/132/abstract/0/No Thumbnail";
    
    if (!$postID) {
        $postID = get_the_ID();
    }

    $files = get_children('post_parent='.$postID.'&post_type=attachment&post_mime_type=image');
      if($files) :
        $keys = array_reverse(array_keys($files));
        $j=0;
        $num = $keys[$j];
        $image = wp_get_attachment_image($num, 'thumbnail', false);
        $imagepieces = explode('"', $image);
        $imagepath = $imagepieces[1];
        $thumb = wp_get_attachment_thumb_url($num);
      endif;
      
    return $thumb;
}

/**
 * IMGD Content
 *
 * @param int $limit Limite de palabras
 * @return string $content El contenido reducido de acuendo al límite de palabras
 */
function imgd_content($limit) {
    global $post;

    $content = explode(' ', get_the_content(), $limit);

    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }

//    $content = preg_replace('/\[.+\]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = preg_replace('/\[.+\]/', '', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

    return $content;
}

/**
 * IMG Excerpt
 * Limita la cantidad de palabras en el excerpt de acuerdo a una cantidad dada.
 *
 * @param int $limit Límite de palabras
 * @return string El contenido del excerpt limitado por el límite
 */
function imgd_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
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
             'width'    =>  1300,
             'height'   =>  500,
             'crop'     =>  true
         );
     } elseif ($thumbnail_name=="tablet") {
         $params = array(
             'width'    =>  722,
             'height'   =>  280,
             'crop'     =>  true
         );
     } elseif ($thumbnail_name=="phones") {
         $params = array(
             'width'    =>  349,
             'height'   =>  140,
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

?>