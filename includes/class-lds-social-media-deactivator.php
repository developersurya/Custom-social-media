<?php
/**
 * Fired during plugin de-activation.
 *
 * This class defines all code necessary to run during the plugin's de-activation.
 *
 * @since      1.0.0
 * @package    Lds_Social_Media
 * @subpackage Lds_Social_Media/includes
 * @author     lastdoorsolutions <info@lastdoorsolutions.com>
 */

class Lds_Social_Media_Deactivator {

	public function __construct() {
		add_action( 'init', array( $this, 'deactivate' ) );

	}

	public static function deactivate() {
		//code run after theme activate.
	}
}