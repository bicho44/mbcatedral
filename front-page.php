<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package IMG Digital v1
 */

get_header(); ?>
<?php do_action('imgdigital_prefront'); ?>

<?php get_template_part('templates/carrousel'); ?>

	<div class="container">
		<div id="primary" class="content-area row">
			<?php

			if(post_type_exists('imgd_propiedad')){
				// Acá seleciono la lista de Propiedades que voy a mostrar en la Home
				$args = array( 'post_type' => array( 'imgd_propiedad'),
				               'post_status' => 'publish',
				               'post_per_page' => 12,
								'orderby' => 'rand'
				);
			} else {
				// Acá seleciono las Páginas que voy a mostrar en la Home
				$args = array( 'post_type' => array( 'post', 'page', 'portfolio_item', 'imgd_propiedad'),
				               'meta_key' => 'imgd_slideshow',
				               'meta_value' => '1',
				               'post_status' => 'publish',
				               'post_per_page' => 6
				);
			}
			$loop = new WP_Query($args);

			if ($loop->have_posts()) {
				$x = 0;?>
<!--				<div class="col-md-12 col-sm-12">-->
					<div class="row">
						<?php
						while ($loop->have_posts()) : $loop->the_post();
							get_template_part('content', 'front');
							$x++;
						endwhile;
						?>
					</div>
<!--				</div>-->
			<?php } ?>
			<!--	            <div class="col-md-4">-->
			<!--		            --><?php //dynamic_sidebar( 'front-page' ); ?>
			<!--	            </div>-->
		</div><!-- #primary row-->
	</div>
<?php do_action('imgdigital_postfront'); ?>

<?php get_footer(); ?>