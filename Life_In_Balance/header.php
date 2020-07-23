<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Life_In_Balance
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php do_action('life_in_balance_before_site'); //Hooked: life_in_balance_preloader() ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'life_in_balance' ); ?></a>

	<?php do_action('life_in_balance_before_header'); //Hooked: life_in_balance_header_clone() ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrap">
            <div class="container">
                <div class="row">
				<div class="col-md-4 col-sm-8 col-xs-12">
		        <?php if ( get_theme_mod('site_logo') ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><img class="site-logo" src="<?php echo esc_url(get_theme_mod('site_logo')); ?>" alt="<?php bloginfo('name'); ?>" /></a>
					<?php if ( is_home() && !is_front_page() ) : ?>
						<h1 class="site-title screen-reader-text"><?php bloginfo( 'name' ); ?></h1>
					<?php endif; ?>
				<?php else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	        
		        <?php endif; ?>
				</div>
				<div class="col-md-8 col-sm-4 col-xs-12">
					<div class="btn-menu"><i class="life_in_balance-svg-icon"><?php life_in_balance_get_svg_icon( 'icon-menu', true ); ?></i></div>
					<nav id="mainnav" class="mainnav" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'life_in_balance_menu_fallback' ) ); ?>
					</nav><!-- #site-navigation -->
				</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php do_action('life_in_balance_after_header'); ?>

	<div class="life_in_balance-hero-area">
		<?php life_in_balance_slider_template(); ?>
		<div class="header-image">
			<?php life_in_balance_header_overlay(); ?>
			<img class="header-inner" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
		</div>
		<?php life_in_balance_header_video(); ?>

		<?php do_action('life_in_balance_inside_hero'); ?>
	</div>

	<?php do_action('life_in_balance_after_hero'); ?>

	<div id="content" class="page-wrap">
		<div class="container content-wrapper">
			<div class="row">	