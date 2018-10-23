<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    lds_social_media
 * @subpackage lds_social_media/admin
 * @author     lastdoorsolutions <info@lastdoorsolutions.com>
 */
class Lds_Social_media_Public {
	/**
	 * Initialize the class and set its properties.
	 *
	 */
	public function __construct( ) {

		add_action( 'admin_enqueue_scripts', array( $this,'lds_social_media_enqueue_admin_script'));
		//add_filter( 'acf/load_field/name=select_trip', array( $this,'lds_social_media_load_select_trip_field_choices') );

	}

	/**
	 * Add script in admin area
	 *
	 * @since    1.0.0
	 */
	public function lds_social_media_enqueue_admin_script() {
		/**
		 * Add admin scripts
		 */
		wp_register_script('lds-social-media-admin-script', plugin_dir_url( __FILE__ ) . '/js/date-generator.js', array('jquery'), true);
		wp_enqueue_script( 'lds-social-media-admin-script' );

	}
}