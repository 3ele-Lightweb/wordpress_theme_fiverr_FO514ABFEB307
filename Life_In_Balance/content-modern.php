<?php
/**
 * @package Life_In_Balance
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('life_in_balance-large-thumb'); ?></a>
		</div>
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="title-post entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() && get_theme_mod('hide_meta_index') != 1 ) : ?>
		<div class="meta-post">
			<?php life_in_balance_post_date( $notext = true ); ?>
			<?php life_in_balance_get_first_cat(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-post">
		<?php if ( (get_theme_mod('full_content_home') == 1 && is_home() ) || (get_theme_mod('full_content_archives') == 1 && is_archive() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'life_in_balance' ),
				'after'  => '</div>',
			) );
		?>

		<a class="read-more" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read more', 'life_in_balance' ); ?> <span class="read-more-gt">&gt;</span></a>
	</div><!-- .entry-post -->

	<footer class="entry-footer">
		<?php life_in_balance_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->