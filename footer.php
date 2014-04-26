<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package IMG Digital v1
 */
?>

        </div><!-- #content -->



	<div class="site-footer">
        <footer id="colophon" class="container" role="contentinfo">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <?php get_template_part( 'templates/menu', 'social' ); ?>
                </div>
                <div class="col-md-4 col-sm-6">
                   <?php
                   if (! dynamic_sidebar( 'footer-1' )){ ?>
                    <div class="col-md-4">
                        <img src="http://lorempixel.com/360/250/sports/4" alt="Google Adsense"/>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-4 col-sm-12">
                    <main id="news" class="noticias" role="secondary">
                        <?php
                        // Acá seleciono las Páginas que voy a mostrar en la Home
                        $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'meta_query' => array(
                                array(
                                    'key' => 'imgd_home',
                                    'value' => '1',
                                    'compare' => 'NOT LIKE'
                                )
                            ),
                            'posts_per_page'=> 3
                        );
                        $busq = new WP_Query($args);
                        if ($busq->have_posts()){ ?>
                            <h3><?php _e('Otras Novedades', 'imgd'); ?></h3>
                            <?php while ( $busq->have_posts() ) : $busq->the_post(); ?>
                                <?php get_template_part( 'content',  'home' ); ?>
                            <?php
                            endwhile; // end of the loop.

                            // Reset the post data
                            wp_reset_postdata();
                        } // End IF
                        ?>
                    </main><!-- #main -->
                </div>
            </div>
			<div class="site-info row">
				<?php do_action( 'imgdigital_credits' ); ?>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'imgdigital' ), 'MB Catedral', '<a href="http://imgdigital.com.ar" rel="designer">Federico Reinoso</a>' ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
    </div>

</div><!-- #page -->

<?php wp_footer(); ?>
<?php
if ( function_exists( 'yoast_analytics' ) ) {
    yoast_analytics();
}
?>
</body>
</html>