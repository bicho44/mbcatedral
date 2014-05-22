<?php
/**
 * @package IMGD Digital
 *
 * Template para El Contenido del Archivo
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(' col-sm-6 col-md-4 col-lg-3'); ?>>

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
			<?php echo imgd_content(20); ?>
			<p><a href="<?php the_permalink(); ?>">[Leer más]</a></p>
		</div>

		<?php //imgdigital_post_nav(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php //the_taxonomies('prop_tipo'); ?>

		<?php edit_post_link( __( 'Edit', 'imgdigital' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
