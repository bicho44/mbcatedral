<?php
/**
 * @package IMG Digital v1
 *
 * Template para ser usado en el FrontPage
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-3 col-md-4 col-sm-6'); ?>>
	<div class="thumbnail">
		<?php
		echo imgd_thumbnail( get_the_ID(), 'phones');
		//the_post_thumbnail('thumb-archive');
		?>
	</div>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php echo imgd_excerpt(40); ?>
	</div><!-- .entry-content -->
	<footer>
		<p><a href="<?php the_permalink(); ?>" rel="bookmark">[Leer más]</a></p>
	</footer>
</article><!-- #post-## -->