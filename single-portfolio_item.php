<?php
/**
 * @package Carola Dreidemie
 */

get_header();
?>
    <div id="primary" class="content-area row">
        <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio_item col-md-8'); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php if(function_exists('rwmb_meta') && rwmb_meta('portfolio_item_url')!=""){?>
                    <h2 class="entry-url">
                        <a href="<?php echo rwmb_meta('portfolio_item_url'); ?>">
                            <?php echo rwmb_meta('portfolio_item_url'); ?>
                        </a>
                    </h2>
                <?php } ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php if(has_post_thumbnail()){?>
                <div class="thumbnail">
                    <?php echo imgd_thumbnail(get_the_ID(), 'tablet'); ?>
                </div>
                <?php } ?>
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
            <?php imgdigital_post_nav(); ?>
        </article><!-- #post-## -->
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>