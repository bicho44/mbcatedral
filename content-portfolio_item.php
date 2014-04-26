<?php
/**
 * @package IMG Digital
 */
?>
Content Portfolio Item
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header page-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php //echo the_post_thumbnail('small-feature'); ?>
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Portfolios:', 'imgdigital' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php the_taxonomies('','portfolios'); ?>

        <?php edit_post_link( __( 'Edit', 'imgdigital' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-## -->
