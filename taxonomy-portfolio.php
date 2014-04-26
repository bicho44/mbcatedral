<?php
/**
 * The template for displaying Archive pages of Portfolio Itens.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Carola Dreidemie
 */

// This sets out a variable called $term - we'll use it ALOT for what we're about to do.
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

get_header(); ?>
	<section id="primary" class="content-area row">
		<main id="main" class="site-main col-md-8" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
                    <?php printf(__('Trabajos en: %s', 'imgd'), '<span>' . ucwords($term->name) . '</span>'); ?>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<small class="taxonomy-description">%s</small>', $term_description );
					endif;
				?>
                </h1>
			</header><!-- .page-header -->

			<?php
            /* definir inicio del contador */
            $row = 0;

            /* Start the Loop */
            ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
                if (0===$row) {?>
                    <div class="row">
                <?php }

					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'archive-portfolio_item' );
                if (2===$row) { ?>
                     </div>
                <?php
                    /* reset $row */
                    $row = 0;
                } else {
                    $row++;
                }
				?>
			<?php endwhile; ?>
            </div>
            <?php imgdigital_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
        <?php get_sidebar(); ?>
	</section><!-- #primary -->


<?php get_footer(); ?>
