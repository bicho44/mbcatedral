 <?php
/*
 * Carrousel
 */

// Acá seleciono las Páginas que voy a mostrar en la Home
$args = array('post_type' => array( 'post', 'page', 'portfolio_item', 'imgd_propiedad'),
    'meta_key' => 'imgd_slideshow',
    'meta_value' => '1',
    'post_status' => 'publish',
    'post_per_pag' => -1,
);
$loop = new WP_Query($args);

$noThumb = '';
$carrousel = '';

$indicator = "";

$thumbnail_name = img_get_size_thumbnail();
$params = imgd_parametros_thumbnail($thumbnail_name);

 ?>
 <!-- start loop SlideShow -->
 <?php
 if ($loop->have_posts()) {
     $active = 0;
     while ($loop->have_posts()) : $loop->the_post();
         // Verificar si es una propiedad para mostrar en la home
         //$front_page = rwmb_meta('imgd_alquiler_home', 'checkbox');
?>
<!--         <h2>Active original = --><?php //echo (int)$active; ?><!--</h2>-->
         <?php
         // Verifico que la noticia tenga imágen
         if (has_post_thumbnail()) {

             if (0 === (int)$active) {?>
<!--                 <h3>Active = --><?php //echo $active; ?><!--</h3>-->
                 <?php    $class = "active item";
                 $indiclass = 'class="active"';

             } else {?>
<!--                 <h3>Active  = --><?php //echo $active; ?><!--</h3>-->
                 <?php
                 $class = "item";
                 $indiclass = "";
             }

             $indicator .= '<li data-target="#myCarousel" data-slide-to="'.$active.'" '.$indiclass.'></li>';

             $carrousel .= '<div class="' . $class . '">';

             /* Obtengo el URL de la imagen principal */
             $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
             $html = wp_get_attachment_image_src($post_thumbnail_id, 'full-cropped');

             $carrousel .= '<img src="' . bfi_thumb( $html[0], $params ) . '" alt="' . get_the_title() . '">';

             $carrousel .='<div class="carousel-caption">';

             $carrousel .='<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
             $carrousel .= '<p class="hidden-xs hidden-sm">' . get_the_excerpt() . '</p>';
             $carrousel .='</div>';
             $carrousel .='</div><!-- end item -->';

             $active++;
         } else {// end verification of post_thumbnail
             // Poner acá un array de los post que no tienen Post Thumbnail
             //$noThumb .= get_the_ID();
         }

     endwhile;
     // Reset the post data
     wp_reset_postdata();
     ?>
     <!-- end loop SlideShow -->
     <?php // var_dump($noThumb);    ?>

     <?php if ($carrousel != '') { ?>
         <!-- Carrousel -->
<!--         <div class="container">-->
             <div id="myCarousel" class="carousel slide">
                 <!-- Indicators -->
                 <ol class="carousel-indicators">
                     <?php echo $indicator; ?>
                 </ol>
                 <!-- Carousel items -->
                 <div class="carousel-inner">
                     <?php echo $carrousel; ?>
                 </div>
                 <!-- Controls -->
                 <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                     <span class="glyphicon icon-chevron-left"></span>
                 </a>
                 <a class="right carousel-control" href="#myCarousel" data-slide="next">
                     <span class="glyphicon icon-chevron-right"></span>
                 </a>
             </div>
<!--         </div>-->
         <!-- end Carrousel -->
     <?php
     } //End Check Carrousel
 } else {// End Have Post ?>
     <div class="container hidden">
         <h3> <?php echo __('No hay Items para Mostrar', 'imgd'); ?>
             <small> <?php echo __('Por favor asigne un item al SlideShow', 'imgd');?> </small>
         </h3>
     </div>
 <?php } ?>