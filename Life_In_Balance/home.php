<?php
/**
 * The home template file.
 *
 * @package Life_In_Balance
 */

get_header(); 

$layout = life_in_balance_blog_layout();

?>

	<?php do_action('life_in_balance_before_content'); ?>

	<div id="primary" class="content-area col-md-9 <?php echo esc_attr($layout); ?>">

		<?php life_in_balance_yoast_seo_breadcrumbs(); ?>
		
		<main id="main" class="post-wrap" role="main">

		<?php if ( have_posts() ) : ?>

		<div class="posts-layout">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					if ( $layout == 'modern' ) {
						get_template_part( 'content', 'modern' );
					} elseif ( $layout == 'classic-alt' ) {
						get_template_part( 'content', 'classic-alt' );
					} else {
						get_template_part( 'content', get_post_format() );
					}
				?>

			<?php endwhile; ?>
		</div>

		<?php
			the_posts_pagination( array(
				'mid_size'  => 1,
			) );
		?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action('life_in_balance_after_content'); ?>

<?php 
	if ( ( $layout == 'modern' ) || ( $layout == 'classic-alt' ) || ( $layout == 'classic' ) ) :
	get_sidebar();
	endif;
?>
<?php get_footer(); ?>
