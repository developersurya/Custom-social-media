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
class Lds_Social_Instagram {

	public function __construct() {
		//add_action('');
		$instagram_data = $this->instagram_api_connect();
		//var_dump($instagram_data);

	}

	public function get_channel_Id(){
		$social_media_option = get_option('social_media_option');
		$channel_ID = $social_media_option['instagram_channel_id'];
		return $channel_ID;
	}

	public function get_api_key(){
		$social_media_option = get_option('social_media_option');
		$instagram_access_token = $social_media_option['instagram_access_token'];
		return $instagram_access_token;
	}

	public function get_instagram_count(){
		$social_media_option = get_option('social_media_option');
		$instagram_post_count = $social_media_option['instagram_post_count'];
		return $instagram_post_count;
	}

	public function instagram_api_connect(){
		/**
		 * Need to register client and manage it properly to get client id ( uncheck Disable implicit OAuth ).
		 * Follow https://www.instagram.com/developer/authentication/ to get access token strickly.
		 * Get end point url from https://www.instagram.com/developer/endpoints/users/
		 * See some examples
		 * https://api.instagram.com/v1/users/self/?access_token=4682485111.f63cd69.965d564e9d034d649070d9f2567b1a0e
		 * https://api.instagram.com/v1/users/self/media/recent/?access_token=
		 */
		$api_access_token = $this->get_api_key();
		//$channel_Id = $this->get_channel_Id();
		$endpoint_url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=".$api_access_token;
		$file_get_contents = file_get_contents($endpoint_url);

		//var_dump(json_decode($file_get_contents) );
		if( false === $file_get_contents  ) {
			return "Instagram Access Token error!!!";
		}
		return json_decode($file_get_contents);

	}
}
//$Lds_Social_instagram = new Lds_Social_instagram();
