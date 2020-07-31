<?php

/**
 *
 * @link              http://athemes.com
 * @since             1.0
 * @package           Life_In_Balance_Toolbox
 *
 * @wordpress-plugin
 * Plugin Name:       Life_In_Balance Toolbox
 * Plugin URI:        http://athemes.com/plugins/sydney-toolbox
 * Description:       Registers custom post types and custom fields for the Life_In_Balance theme
 * Version:           1.11
 * Author:            aThemes
 * Author URI:        http://athemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       life_in_balance-toolbox
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Set up and initialize
 */
class Life_In_Balance_Toolbox {

	private static $instance;

	/**
	 * Actions setup
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'constants' ), 2 );
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 3 );
		add_action( 'plugins_loaded', array( $this, 'includes' ), 4 );
		add_action( 'admin_notices', array( $this, 'admin_notice' ), 4 );

		//SVG styles
		add_action( 'wp_head', array( $this, 'svg_styles' ) );
		
		//Elementor actions
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'elementor_includes' ), 4 );
		add_action( 'elementor/init', array( $this, 'elementor_category' ), 4 );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'scripts' ), 4 );

	}

	/**
	 * Constants
	 */
	function constants() {

		define( 'ST_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'ST_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	}

	/**
	 * Includes
	 */
	function includes() {

		if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
			//Post types
			require_once( ST_DIR . 'inc/post-type-services.php' );
			require_once( ST_DIR . 'inc/post-type-employees.php' );
			require_once( ST_DIR . 'inc/post-type-testimonials.php' );	
			require_once( ST_DIR . 'inc/post-type-clients.php' );
			require_once( ST_DIR . 'inc/post-type-projects.php' );
			require_once( ST_DIR . 'inc/post-type-timeline.php' );		
			//Metaboxes
			require_once( ST_DIR . 'inc/metaboxes/services-metabox.php' );	
			require_once( ST_DIR . 'inc/metaboxes/employees-metabox.php' );	
			require_once( ST_DIR . 'inc/metaboxes/testimonials-metabox.php' );
			require_once( ST_DIR . 'inc/metaboxes/clients-metabox.php' );
			require_once( ST_DIR . 'inc/metaboxes/projects-metabox.php' );
			require_once( ST_DIR . 'inc/metaboxes/timeline-metabox.php' );
			require_once( ST_DIR . 'inc/metaboxes/singles-metabox.php' );
		}

		/**
		 * Demo content setup
		 * 
		 * @since 1.07
		 */
		if ( !$this->is_pro() ) {
			require_once( ST_DIR . 'demo-content/setup.php' );
		}
	}

	function elementor_includes() {
		if ( !version_compare(PHP_VERSION, '5.4', '<=') ) {
			require_once( ST_DIR . 'inc/elementor/block-testimonials.php' );
			require_once( ST_DIR . 'inc/elementor/block-posts.php' );
			require_once( ST_DIR . 'inc/elementor/block-portfolio.php' );
			require_once( ST_DIR . 'inc/elementor/block-employee-carousel.php' );			

			if ( $this->is_pro() ) {
				require_once( ST_DIR . 'inc/elementor/block-employee.php' );
				require_once( ST_DIR . 'inc/elementor/block-pricing.php' );
				require_once( ST_DIR . 'inc/elementor/block-timeline.php' );
			}
		}
	}

	function elementor_category() {
		if ( !version_compare(PHP_VERSION, '5.4', '<=') ) {
			\Elementor\Plugin::$instance->elements_manager->add_category( 
				'life_in_balance-elements',
				[
					'title' => __( 'Life_In_Balance Elements', 'life_in_balance-toolbox' ),
					'icon' => 'fa fa-plug',
				],
				2
			);
		}
	} 

	static function install() {
		if ( version_compare(PHP_VERSION, '5.4', '<=') ) {
			wp_die( __( 'Life_In_Balance Toolbox requires PHP 5.4. Please contact your host to upgrade your PHP. The plugin was <strong>not</strong> activated.', 'life_in_balance-toolbox' ) );
		};
	}	

	/**
	 * Translations
	 */
	function i18n() {
		load_plugin_textdomain( 'life_in_balance-toolbox', false, 'life_in_balance-toolbox/languages' );
	}

	/**
	 * Admin notice
	 */
	function admin_notice() {
		$theme  = wp_get_theme();
		$parent = wp_get_theme()->parent();
		if ( ($theme != 'Life_In_Balance' ) && ($theme != 'Life_In_Balance Pro' ) && ($parent != 'Life_In_Balance') && ($parent != 'Life_In_Balance Pro') ) {
		    echo '<div class="error">';
		    echo 	'<p>' . __('Please note that the <strong>Life_In_Balance Toolbox</strong> plugin is meant to be used only with the <a href="http://wordpress.org/themes/sydney/" target="_blank">Life_In_Balance theme</a></p>', 'life_in_balance-toolbox');
		    echo '</div>';			
		}
	}

	/**
	 * SVG styles
	 */
	function svg_styles() {
		?>
			<style>
				.life_in_balance-svg-icon {
					display: inline-block;
					width: 16px;
					height: 16px;
					vertical-align: middle;
					line-height: 1;
				}
				.team-item .team-social li .life_in_balance-svg-icon {
					fill: #fff;
				}
				.team-item .team-social li:hover .life_in_balance-svg-icon {
					fill: #000;
				}
				.team_hover_edits .team-social li a .life_in_balance-svg-icon {
					fill: #000;
				}
				.team_hover_edits .team-social li:hover a .life_in_balance-svg-icon {
					fill: #fff;
				}				
			</style>
		<?php
	}

	/**
	 * Scripts
	 */	
	function scripts() {

		$forked_owl = get_theme_mod( 'forked_owl_carousel', false );
		if ( $forked_owl ) {
			wp_enqueue_script( 'st-carousel', ST_URI . 'js/main.js', array(), '20200504', true );
		} else {
			wp_enqueue_script( 'st-carousel', ST_URI . 'js/main-legacy.js', array(), '20200504', true );
		}
	}

	/**
	 * Get current theme
	 */
	public static function is_pro() {
		$theme  = wp_get_theme();
		$parent = wp_get_theme()->parent();
		if ( ( $theme != 'Life_In_Balance Pro' ) && ( $parent != 'Life_In_Balance Pro') ) {
			return false;
	    } else {
	    	return true;
	    }		
	}

	/**
	 * Returns the instance.
	 */
	public static function get_instance() {

		if ( !self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

function life_in_balance_toolbox_plugin() {
		return Life_In_Balance_Toolbox::get_instance();
}
add_action('plugins_loaded', 'life_in_balance_toolbox_plugin', 1);

//Does not activate the plugin on PHP less than 5.4
register_activation_hook( __FILE__, array( 'Life_In_Balance_Toolbox', 'install' ) );