<?php
/**
 * @package IMGD Digital
 */
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4'); ?>>

        <div class="entry-content">
            <div class="thumbnail">
                <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) {?>
                
                        <?php echo imgd_thumbnail(get_the_ID(),'phones'); ?>
                
            <?php } else {?>

                <img src="http://lorempixel.com/g/350/200/city/No-Tiene-Imagen" alt="No tiene imagen"/>
                    <?php }?>
                </a>
            </div>
            <div class="caption">
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php imgd_excerpt(30); ?>
            </div>

            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Propiedades:', 'imgdigital' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-meta">
            <?php the_taxonomies('','portfolios'); ?>

            <?php edit_post_link( __( 'Edit', 'imgdigital' ), '<span class="edit-link">', '</span>' ); ?>
        </footer><!-- .entry-meta -->
    </article><!-- #post-<?php the_ID(); ?> -->