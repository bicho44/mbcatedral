<?php
/*
* Display de 1 alquier 
*
*/

get_header();

// while (have_posts()) : the_post(); ?>
    <article <?php post_class('col-md-8') ?> id="post-<?php the_ID(); ?>">
        <header>
            <?php echo the_terms('', 'imgd_propiedad_tipo'); ?>
            <h1 class="entry-title"><?php the_title(); ?>
                <small>
                    <?php echo the_terms('', 'imgd_propiedad_ciudad'); ?>
                </small>
            </h1>
        </header>
        <div class="entry-content">
            <?php
            if (has_post_thumbnail()) {
                echo imgd_thumbnail(get_the_ID(), 'tablet', get_the_title() );
                //the_post_thumbnail(img_get_size_thumbnail(), array('class' => "imgdecor"));
            }

            $precio = rwmb_meta('imgd_propiedad_precio');

            $moneda = rwmb_meta('imgd_propiedad_moneda');

            if ($precio != 0) {
                if ('' === $moneda)
                    $moneda = '$';
                $precio = 'Precio ' . $moneda . ' ' . $precio;
            } else {
                $precio = 'Consultenos';
            }
            ?>
            <h4 class="pull-right"><?php echo $precio; ?></h4>

            <h4>Descripción</h4>
            <?php
            echo '<p>' . imgd_propiedad_datos(1) . '</p>';
            the_content();
            ?>
            <div class="row">
                <?php
                $esparcimiento = rwmb_meta('imgd_propiedad_esparcimiento', 'type=checkbox_list');
                $cont_espar = ucwords(implode(', ', $esparcimiento));
                if (!empty($cont_espar))
                    echo '<div class="col col-lg-4"><h5>Esparcimiento</h5><p>' . $cont_espar . '</p></div>';

                $comodidades = rwmb_meta('imgd_propiedad_comodidades', 'type=checkbox_list');
                $cont_como = ucwords(implode(', ', $comodidades));
                if (!empty($cont_como))
                    echo '<div class="col col-lg-4"><h5>Comodidades</h5><p>' . $cont_como . '</p></div>';

                $equipamiento = rwmb_meta('imgd_propiedad_equipamiento', 'type=checkbox_list');
                $cont_equi = ucwords(implode(', ', $equipamiento));
                if (!empty($cont_equi))
                    echo '<div class="col col-lg-4"><h5>Equipamiento</h5><p>' . $cont_equi . '</p></div>';
                ?>
            </div>
            <?php
            if(function_exists('jqlb_apply_lightbox')){
                echo jqlb_apply_lightbox(do_shortcode('[gallery size="thumb-archive" link="file"]'), "gallery-nowik");
            } else {
	            echo do_shortcode('[gallery size="thumb-archive"]');
            }
            ?>
        </div>

        <!-- Modal Form -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Consulta por <?php the_title(); ?> <small>Nro: <?php echo the_ID(); ?></small></h4>
            </div>
            <?php echo do_shortcode('[contact-form-7 id="41" title="Consultas" html_class="form-horizontal"]'); ?>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
            Consultar
        </button>

	    <footer>
		    <?php //get_template_part('templates/entry-meta'); ?>
		    <?php the_tags('<ul class="entry-tags"><li>', '</li><li>', '</li></ul>'); ?>

<!--		    <ul class="pager">-->
<!--			    <li class="previous"><a href="#">--><?php //previous_post_link(); ?><!--</a></li>-->
<!--			    <li class="next"><a href="#">--><?php //next_post_link(); ?><!--</a></li>-->
<!--		    </ul>-->
		    <?php imgdigital_post_nav(); ?>

	    </footer>

        <?php //comments_template('/templates/comments.php'); ?>
    </article>
<?php //endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>