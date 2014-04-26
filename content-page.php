<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package IMG Digital v1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if(has_post_thumbnail()){?>
        <div class="thumbnail">
            <?php echo imgd_thumbnail(get_the_ID(), img_get_size_thumbnail() ); ?>
        </div>
    <?php } ?>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'imgdigital' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'imgdigital' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
