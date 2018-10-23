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
class Lds_Social_Youtube {

	public function __construct() {
		//add_action('');
		$youtube_data = $this->youtube_api_connect();
		//var_dump($youtube_data);

	}

	public function get_channel_Id(){
		$social_media_option = get_option('social_media_option');
		//$channel_ID = "UCq86758SJ02c2CZxzgM87mA";
		$channel_ID = $social_media_option['youtube_channel_id'];
		return $channel_ID;
	}

	public function get_api_key(){
		//$api_key = "AIzaSyDWAWMQHayDGqgQZWjIeoEKoIGLNeI_zWQ";
		$social_media_option = get_option('social_media_option');
		$api_key = $social_media_option['youtube_api_key'];
		return $api_key;
	}

	public function get_youtube_count(){
		//$api_key = "AIzaSyDWAWMQHayDGqgQZWjIeoEKoIGLNeI_zWQ";
		$social_media_option = get_option('social_media_option');
		$youtube_video_count = $social_media_option['youtube_video_count'];
		return $youtube_video_count;
	}

	public function youtube_api_connect(){
		/**
		 * Goto https://console.developers.google.com/ and login.
		 * From credential menu, we need to create API key.
		 * We must choose API library youtube data API and enable it.
		 * By clicking try this API will take us to endpoint testing page or try https://developers.google.com/apis-explorer/?hl=en_US#p/youtube/v3/
		 * Get end point url from https://developers.google.com/apis-explorer/
		 * See examples
		 * https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCq86758SJ02c2CZxzgM87mA&key=AIzaSyDWAWMQHayDGqgQZWjIeoEKoIGLNeI_zWQ
		 */
		$api_key = $this->get_api_key();
		$channel_Id = $this->get_channel_Id();
		$endpoint_url = "https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=".$channel_Id."&key=".$api_key;
		$file_get_contents = file_get_contents($endpoint_url);

		//var_dump(json_decode($file_get_contents) );
		if( false === $file_get_contents  ) {
			return "Youtube API key or Channel ID error!!!";
		}
		return json_decode($file_get_contents);

	}
}
//$Lds_Social_Youtube = new Lds_Social_Youtube();
