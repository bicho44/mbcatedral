<?php
/**
 * @package IMG Digital v1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php

    if(has_post_thumbnail()){
        /* Obtengo el URL de la imagen principal */
        $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());

        $html = wp_get_attachment_image_src($post_thumbnail_id, 'full-cropped');
        //$thumbnail_name = img_get_size_thumbnail();
        $params = imgd_parametros_thumbnail('tablet');
        $post_image .= '<img src="' . bfi_thumb( $html[0], $params ) . '" alt="' . get_the_title() . '">';
        echo '<div class="thumbnail">'.$post_image.'</div>';
    }
    ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php imgdigital_posted_on(); ?>
		</div><!-- .entry-meta -->
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

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'imgdigital' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'imgdigital' ) );

			if ( ! imgdigital_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'imgdigital' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'imgdigital' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'imgdigital' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'imgdigital' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'imgdigital' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
