<?php
/**
 * Theme info page
 *
 * @package Life_In_Balance
 */

/**
 * Recommended plugins
 */
require get_template_directory() . '/inc/onboarding/plugins/class-life_in_balance-recommended-plugins.php'; 

//Add the theme page
add_action('admin_menu', 'life_in_balance_add_theme_info');
function life_in_balance_add_theme_info(){

	if ( !current_user_can('install_plugins') ) {
		return;
	}

	$theme_info = add_theme_page( __('Life_In_Balance Info','life_in_balance'), __('Life_In_Balance Info','life_in_balance'), 'manage_options', 'life_in_balance-info.php', 'life_in_balance_info_page' );
	add_action( 'load-' . $theme_info, 'life_in_balance_info_hook_styles' );
}

//Callback
function life_in_balance_info_page() {
	$user = wp_get_current_user();
?>
	<div class="info-container">
		<p class="hello-user"><?php echo sprintf( __( 'Hello, %s,', 'life_in_balance' ), '<span>' . esc_html( ucfirst( $user->display_name ) ) . '</span>' ); ?></p>
		<h1 class="info-title"><?php echo __( 'Welcome to Life_In_Balance', 'life_in_balance' ); ?><span class="info-version"><?php echo 'v' . esc_html( wp_get_theme()->version ); ?></span></h1>
		<p class="welcome-desc"><?php _e( 'Life_In_Balance is now installed and ready to go. To help you with the next step, we’ve gathered together on this page all the resources you might need. We hope you enjoy using Life_In_Balance. You can always come back to this page by going to <strong>Appearance > Life_In_Balance Info</strong>.', 'life_in_balance' ); ?>
	

		<div class="life_in_balance-theme-tabs">

			<div class="life_in_balance-tab-nav nav-tab-wrapper">
				<a href="#begin" data-target="begin" class="nav-button nav-tab begin active"><?php esc_html_e( 'Getting started', 'life_in_balance' ); ?></a>
			</div>

			<div class="life_in_balance-tab-wrapper">

				<div id="#begin" class="life_in_balance-tab begin show">
					
					<div class="plugins-row">
						<h2><span class="step-number">1</span><?php esc_html_e( 'Install recommended plugins', 'life_in_balance' ); ?></h2>
						<p><?php _e( 'Install one plugin at a time. Wait for each plugin to activate.', 'life_in_balance' ); ?></p>

						<div style="margin: 0 -15px;overflow:hidden;display:flex;">
							<div class="plugin-block">
								<?php $plugin = 'life_in_balance-toolbox'; ?>
								<h3>Life_In_Balance Toolbox</h3>
								<p><?php esc_html_e( 'Life_In_Balance Toolbox is a free addon for the Life_In_Balance WordPress theme. It helps with things like demo import and additional Elementor widgets.', 'life_in_balance' ); ?></p>
								<?php echo Life_In_Balance_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>

							<div class="plugin-block">
								<?php $plugin = 'elementor'; ?>
								<h3>Elementor</h3>
								<p><?php esc_html_e( 'Elementor will enable you to create pages by adding widgets to them using drag and drop.', 'life_in_balance' ); ?>
								<?php 
								//If Elementor is active, show a link to Elementor's getting started video
								$is_elementor_active = Life_In_Balance_Recommended_Plugins::instance()->check_plugin_state( $plugin );
								if ( $is_elementor_active == 'deactivate' ) {
									echo '<a target="_blank" href="https://www.youtube.com/watch?v=nZlgNmbC-Cw&feature=emb_title">' . __( 'First time Elementor user?', 'life_in_balance') . '</a>';
								}; ?>
								</p>
								<?php echo Life_In_Balance_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>

							<div class="plugin-block">
								<?php $plugin = 'one-click-demo-import'; ?>
								<h3>One Click Demo Import</h3>
								<p><?php esc_html_e( 'This plugin is useful for importing our demos. You can uninstall it after you\'re done with it.', 'life_in_balance' ); ?></p>
								<?php echo Life_In_Balance_Recommended_Plugins::instance()->get_button_html( $plugin ); ?>
							</div>
						</div>
					</div>
					<hr style="margin-top:25px;margin-bottom:25px;">
					
					<div class="import-row">
						<h2><span class="step-number">2</span><?php esc_html_e( 'Import demo content (optional)', 'life_in_balance' ); ?></h2>
						<p><?php esc_html_e( 'Importing the demo will make your website look like our website.', 'life_in_balance' ); ?></p>
						<?php 
							$plugin = 'life_in_balance-toolbox';
							$is_life_in_balance_toolbox_active = Life_In_Balance_Recommended_Plugins::instance()->check_plugin_state( $plugin );
							$plugin = 'elementor';
							$is_elementor_active = Life_In_Balance_Recommended_Plugins::instance()->check_plugin_state( $plugin );
							$plugin = 'one-click-demo-import';
							$is_ocdi_active = Life_In_Balance_Recommended_Plugins::instance()->check_plugin_state( $plugin );														
						?>
							<?php if ( $is_life_in_balance_toolbox_active == 'deactivate' && $is_elementor_active == 'deactivate' && $is_ocdi_active == 'deactivate' ) : ?>
								<a class="button button-primary button-large" href="<?php echo admin_url( 'themes.php?page=pt-one-click-demo-import.php' ); ?>"><?php esc_html_e( 'Go to the automatic importer', 'life_in_balance' ); ?></a>
							<?php else : ?>
								<p class="life_in_balance-notice"><?php esc_html_e( 'All recommended plugins need to be installed and activated for this step.', 'life_in_balance' ); ?></p>
							<?php endif; ?>
					</div>
					<hr style="margin-top:25px;margin-bottom:25px;">

					<div class="customizer-row">
						<h2><span class="step-number">3</span><?php esc_html_e( 'Styling with the Customizer', 'life_in_balance' ); ?></h2>
						<p><?php esc_html_e( 'Theme elements can be styled from the Customizer. Use the links below to go straight to the section you want.', 'life_in_balance' ); ?></p>		
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[section]=title_tagline' ) ); ?>"><?php esc_html_e( 'Change your site title or add a logo', 'life_in_balance' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[panel]=life_in_balance_header_panel' ) ); ?>"><?php esc_html_e( 'Header options', 'life_in_balance' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[panel]=life_in_balance_colors_panel' ) ); ?>"><?php esc_html_e( 'Color options', 'life_in_balance' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[section]=life_in_balance_fonts' ) ); ?>"><?php esc_html_e( 'Font options', 'life_in_balance' ); ?></a></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( '/customize.php?autofocus[section]=blog_options' ) ); ?>"><?php esc_html_e( 'Blog options', 'life_in_balance' ); ?></a></p>		
					</div>
				</div>	
			</div>
		</div>
	</div>
<?php
}

//Styles
function life_in_balance_info_hook_styles(){
	add_action( 'admin_enqueue_scripts', 'life_in_balance_info_page_styles' );
}
function life_in_balance_info_page_styles() {
	wp_enqueue_style( 'life_in_balance-info-style', get_template_directory_uri() . '/inc/onboarding/assets/info-page.css', array(), true );

	wp_enqueue_script( 'life_in_balance-info-script', get_template_directory_uri() . '/inc/onboarding/assets/info-page.js', array('jquery'),'', true );

}