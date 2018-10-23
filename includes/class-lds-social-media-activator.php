<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Lds_Social_Media
 * @subpackage Lds_Social_Media/includes
 * @author     lastdoorsolutions <info@lastdoorsolutions.com>
 */

class Lds_Social_Media_Activator {

	public function __construct() {
		add_action( 'init', array( $this, 'activate' ) );

	}

	public static function activate() {
		//code run after theme activate.
	}
}