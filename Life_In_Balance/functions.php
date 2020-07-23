<?php
/**
 * Life_In_Balance functions and definitions
 *
 * @package Life_In_Balance
 */

if ( ! function_exists( 'life_in_balance_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function life_in_balance_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Life_In_Balance, use a find and replace
	 * to change 'life_in_balance' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'life_in_balance', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; /* pixels */
	}

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('life_in_balance-large-thumb', 830);
	add_image_size('life_in_balance-medium-thumb', 550, 400, true);
	add_image_size('life_in_balance-small-thumb', 230);
	add_image_size('life_in_balance-service-thumb', 350);
	add_image_size('life_in_balance-mas-thumb', 480);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'life_in_balance' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'life_in_balance_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	//Gutenberg align-wide support
	add_theme_support( 'align-wide' );

	//Forked Owl Carousel flag
	$forked_owl = get_theme_mod( 'forked_owl_carousel', false );
	if ( !$forked_owl ) {
		set_theme_mod( 'forked_owl_carousel', true );
	}	
}
endif; // life_in_balance_setup
add_action( 'after_setup_theme', 'life_in_balance_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function life_in_balance_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'life_in_balance' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'life_in_balance' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	//Register the front page widgets
	if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
		register_widget( 'Life_In_Balance_List' );
		register_widget( 'Life_In_Balance_Services_Type_A' );
		register_widget( 'Life_In_Balance_Services_Type_B' );
		register_widget( 'Life_In_Balance_Facts' );
		register_widget( 'Life_In_Balance_Clients' );
		register_widget( 'Life_In_Balance_Testimonials' );
		register_widget( 'Life_In_Balance_Skills' );
		register_widget( 'Life_In_Balance_Action' );
		register_widget( 'Life_In_Balance_Video_Widget' );
		register_widget( 'Life_In_Balance_Social_Profile' );
		register_widget( 'Life_In_Balance_Employees' );
		register_widget( 'Life_In_Balance_Latest_News' );
		register_widget( 'Life_In_Balance_Portfolio' );
	}
	register_widget( 'Life_In_Balance_Contact_Info' );

}
add_action( 'widgets_init', 'life_in_balance_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
	require get_template_directory() . "/widgets/fp-list.php";
	require get_template_directory() . "/widgets/fp-services-type-a.php";
	require get_template_directory() . "/widgets/fp-services-type-b.php";
	require get_template_directory() . "/widgets/fp-facts.php";
	require get_template_directory() . "/widgets/fp-clients.php";
	require get_template_directory() . "/widgets/fp-testimonials.php";
	require get_template_directory() . "/widgets/fp-skills.php";
	require get_template_directory() . "/widgets/fp-call-to-action.php";
	require get_template_directory() . "/widgets/video-widget.php";
	require get_template_directory() . "/widgets/fp-social.php";
	require get_template_directory() . "/widgets/fp-employees.php";
	require get_template_directory() . "/widgets/fp-latest-news.php";
	require get_template_directory() . "/widgets/fp-portfolio.php";

	/**
	 * Page builder support
	 */
	require get_template_directory() . '/inc/so-page-builder.php';	
}
require get_template_directory() . "/widgets/contact-info.php";

/**
 * Elementor ID
 */
if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
    define( 'ELEMENTOR_PARTNER_ID', 2128 );
}

/**
 * Elementor editor scripts
 */
function life_in_balance_elementor_editor_scripts() {
	wp_enqueue_script( 'life_in_balance-elementor-editor', get_template_directory_uri() . '/js/elementor.js', array( 'jquery' ), '20200504', true );
}
add_action('elementor/frontend/after_register_scripts', 'life_in_balance_elementor_editor_scripts');

/**
 * Enqueue scripts and styles.
 */
function life_in_balance_scripts() {

	wp_enqueue_style( 'life_in_balance-google-fonts', esc_url( life_in_balance_enqueue_google_fonts() ), array(), null );

	if ( is_customize_preview() ) {
		wp_enqueue_style( 'life_in_balance-preview-google-fonts-body', 'https://fonts.googleapis.com/', array(), null );
		wp_enqueue_style( 'life_in_balance-preview-google-fonts-headings', 'https://fonts.googleapis.com/', array(), null );
	}

	wp_enqueue_style( 'life_in_balance-style', get_stylesheet_uri(), '', '20200129' );

	wp_enqueue_style( 'life_in_balance-ie9', get_template_directory_uri() . '/css/ie9.css', array( 'life_in_balance-style' ) );
	wp_style_add_data( 'life_in_balance-ie9', 'conditional', 'lte IE 9' );

	wp_enqueue_script( 'life_in_balance-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );

	wp_enqueue_script( 'life_in_balance-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'),'20200504', true );

	if ( defined( 'SITEORIGIN_PANELS_VERSION' )	) {
		wp_enqueue_script( 'life_in_balance-so-legacy-scripts', get_template_directory_uri() . '/js/so-legacy.js', array('jquery'),'', true );
		wp_enqueue_script( 'life_in_balance-so-legacy-main', get_template_directory_uri() . '/js/so-legacy-main.js', array('jquery'),'', true );
		wp_enqueue_style( 'life_in_balance-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	}

	if ( get_theme_mod('blog_layout') == 'masonry-layout' && (is_home() || is_archive()) ) {

		wp_enqueue_script( 'life_in_balance-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('masonry'),'', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'life_in_balance_scripts' );

/**
 * Disable Elementor globals on theme activation
 */
function life_in_balance_disable_elementor_globals () {
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
}
add_action('after_switch_theme', 'life_in_balance_disable_elementor_globals');

/**
 * Enqueue Bootstrap
 */
function life_in_balance_enqueue_bootstrap() {
	wp_enqueue_style( 'life_in_balance-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'life_in_balance_enqueue_bootstrap', 9 );

/**
 * Elementor editor scripts
 */

/**
 * Change the excerpt length
 */
function life_in_balance_excerpt_length( $length ) {

  $excerpt = get_theme_mod('exc_lenght', '55');
  return $excerpt;

}
add_filter( 'excerpt_length', 'life_in_balance_excerpt_length', 999 );

/**
 * Blog layout
 */
function life_in_balance_blog_layout() {
	$layout = get_theme_mod('blog_layout','classic-alt');
	return $layout;
}

/**
 * Menu fallback
 */
function life_in_balance_menu_fallback() {
	if ( current_user_can('edit_theme_options') ) {
		echo '<a class="menu-fallback" href="' . admin_url('nav-menus.php') . '">' . __( 'Create your menu here', 'life_in_balance' ) . '</a>';
	}
}

/**
 * Header image overlay
 */
function life_in_balance_header_overlay() {
	$overlay = get_theme_mod( 'hide_overlay', 0);
	if ( !$overlay ) {
		echo '<div class="overlay"></div>';
	}
}

/**
 * Header video
 */
function life_in_balance_header_video() {

	if ( !function_exists('the_custom_header_markup') ) {
		return;
	}

	$front_header_type 	= get_theme_mod( 'front_header_type' );
	$site_header_type 	= get_theme_mod( 'site_header_type' );

	if ( ( get_theme_mod('front_header_type') == 'core-video' && is_front_page() || get_theme_mod('site_header_type') == 'core-video' && !is_front_page() ) ) {
		the_custom_header_markup();
	}
}

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function life_in_balance_polylang() {
	for ( $i=1; $i<=5; $i++) {
		pll_register_string('Slide title ' . $i, get_theme_mod('slider_title_' . $i), 'Life_In_Balance');
		pll_register_string('Slide subtitle ' . $i, get_theme_mod('slider_subtitle_' . $i), 'Life_In_Balance');
	}
	pll_register_string('Slider button text', get_theme_mod('slider_button_text'), 'Life_In_Balance');
	pll_register_string('Slider button URL', get_theme_mod('slider_button_url'), 'Life_In_Balance');
}
add_action( 'admin_init', 'life_in_balance_polylang' );
endif;

/**
 * Preloader
 */
function life_in_balance_preloader() {
	?>
	<div class="preloader">
	    <div class="spinner">
	        <div class="pre-bounce1"></div>
	        <div class="pre-bounce2"></div>
	    </div>
	</div>
	<?php
}
add_action('life_in_balance_before_site', 'life_in_balance_preloader');

/**
 * Header clone
 */
function life_in_balance_header_clone() {

	$front_header_type 	= get_theme_mod('front_header_type','nothing');
	$site_header_type 	= get_theme_mod('site_header_type');

	if ( ( $front_header_type == 'nothing' && is_front_page() ) || ( $site_header_type == 'nothing' && !is_front_page() ) ) { ?>
	
	<div class="header-clone"></div>

	<?php }
}
add_action('life_in_balance_before_header', 'life_in_balance_header_clone');

/**
 * Get image alt
 */
function life_in_balance_get_image_alt( $image ) {
    global $wpdb;

    if( empty( $image ) ) {
        return false;
    }

    $attachment  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid=%s;", strtolower( $image ) ) );
    $id   = ( ! empty( $attachment ) ) ? $attachment[0] : 0;

    $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );

    return $alt;
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * from TwentyTwenty
 * 
 * @link https://git.io/vWdr2
 */
function life_in_balance_skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'life_in_balance_skip_link_focus_fix' );

/**
 * Get SVG code for specific theme icon
 */
function life_in_balance_get_svg_icon( $icon, $echo = false ) {
	$svg_code = wp_kses( //From TwentTwenty. Keeps only allowed tags and attributes
		Life_In_Balance_SVG_Icons::get_svg_icon( $icon ),
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
		)
	);	

	if ( $echo != false ) {
		echo $svg_code; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $svg_code;
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Slider
 */
require get_template_directory() . '/inc/slider.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Theme info
 */
require get_template_directory() . '/inc/onboarding/theme-info.php';

/**
 * Woocommerce basic integration
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * WPML
 */
if ( class_exists( 'SitePress' ) ) {
	require get_template_directory() . '/inc/wpml/class-life_in_balance-wpml.php';
}

/**
 * Upsell
 */
require get_template_directory() . '/inc/upsell/class-customize.php';

/**
 * Gutenberg
 */
require get_template_directory() . '/inc/editor.php';

/**
 * Fonts
 */
require get_template_directory() . '/inc/fonts.php';

/**
 * SVG codes
 */
require get_template_directory() . '/inc/classes/class-life_in_balance-svg-icons.php';

/**
 *TGM Plugin activation.
 */
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'life_in_balance_recommend_plugin' );
function life_in_balance_recommend_plugin() {

	$plugins = array();

	if ( !defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
	    $plugins[] = array(
	            'name'               => 'Elementor',
	            'slug'               => 'elementor',
	            'required'           => false,
	    );
	}

	if ( !function_exists('wpcf_init') ) {
	    $plugins[] = array(
		        'name'               => 'Life_In_Balance Toolbox - custom posts and fields for the Life_In_Balance theme',
		        'slug'               => 'life_in_balance-toolbox',
		        'required'           => false,
		);
	}

    tgmpa( $plugins);

}

/**
 * Admin notice
 */
require get_template_directory() . '/inc/notices/persist-admin-notices-dismissal.php';

function life_in_balance_welcome_admin_notice() {
	if ( ! PAnD::is_admin_notice_active( 'life_in_balance-welcome-forever' ) ) {
		return;
	}
	
	?>
	<div data-dismissible="life_in_balance-welcome-forever" class="life_in_balance-admin-notice updated notice notice-success is-dismissible">

		<p><?php echo sprintf( __( 'Welcome to Life_In_Balance. To get started please make sure to visit our <a href="%s">welcome page</a>.', 'life_in_balance' ), admin_url( 'themes.php?page=life_in_balance-info.php' ) ); ?></p>
		<a class="button" href="<?php echo admin_url( 'themes.php?page=life_in_balance-info.php' ); ?>"><?php esc_html_e( 'Get started with Life_In_Balance', 'life_in_balance' ); ?></a>

	</div>
	<?php
}
add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'life_in_balance_welcome_admin_notice' );