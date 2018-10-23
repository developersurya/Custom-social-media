<?php
/**
 * The plugin main file
 *
 * @link              https://www.lastdoorsolutions.com/
 * @since             1.0.0
 * @package           lds_social_media
 *
 * @wordpress-plugin
 * Plugin Name:       LDS Social Media
 * Plugin URI:        https://www.lastdoorsolutions.com/
 * Description:       LDS social media plugin will show Facebook, Youtube, Instagram and Twitter feed by using their APIs. Each of the social media feed can be displayed in frontend by simple shortcode[lds_social_name]..
 * Version:           1.0.0
 * Author:            lastdoorsolutions
 * Author URI:        https://www.lastdoorsolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lds-social-media
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lds-social-media-activator.php
 */
function activate_lds_social_media() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lds-social-media-activator.php';
	//lds_social_media_Activator::activate();
	$Lds_social_media_Activator = new Lds_Social_Media_Activator();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lds-social-media-deactivator.php
 */
function deactivate_lds_social_media() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lds-social-media-deactivator.php';
	lds_social_media_deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_lds_social_media' );
register_deactivation_hook( __FILE__, 'deactivate_lds_social_media' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lds-social-media.php';

$Lds_Social_Media = new Lds_Social_Media();