<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Life_In_Balance
 */
?>
			</div>
		</div>
	</div><!-- #content -->

	<?php do_action('life_in_balance_before_footer'); ?>

	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<?php get_sidebar('footer'); ?>
	<?php endif; ?>

    <a class="go-top"><i class="life_in_balance-svg-icon"><?php life_in_balance_get_svg_icon( 'icon-chevron-up', true ); ?></i></a>
		
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'life_in_balance' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'life_in_balance' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %2$s by %1$s.', 'life_in_balance' ), 'aThemes', '<a href="https://athemes.com/theme/life_in_balance" rel="nofollow">Life_In_Balance</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php do_action('life_in_balance_after_footer'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
