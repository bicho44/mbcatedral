<?php
/**
 * @package IMG Digital v1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php echo imgd_excerpt(15); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->