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
class Lds_Social_Facebook {

	public function __construct() {
		//add_action('');
		$facebook_data = $this->facebook_api_connect();
		//var_dump($facebook_data);
	}

	public function get_facebook_page_name(){
		$social_media_option = get_option('social_media_option');
		$facebook_page_name = $social_media_option['facebook_page_name'];
		return $facebook_page_name;
	}

	public function get_api_key(){
		$social_media_option = get_option('social_media_option');
		$facebook_access_token = $social_media_option['facebook_access_token'];
		return $facebook_access_token;
	}

	public function get_facebook_count(){
		$social_media_option = get_option('social_media_option');
		$facebook_post_count = $social_media_option['facebook_post_count'];
		return $facebook_post_count;
	}

	public function facebook_api_connect(){
		/**
		 * Need to register client and manage it properly to get client id ( uncheck Disable implicit OAuth ).
		 * Follow https://www.facebook.com/developer/authentication/ to get access token strickly.
		 * Get end point url from https://www.facebook.com/developer/endpoints/users/
		 * See some examples
		 * https://graph.facebook.com/leaderlawfirmaz/feed?fields=attachments,picture,full_picture,story,message,created_time,from,story_tags,shares,likes.summary(true),comments.summary(true)&access_token=EAAS8LGISx9wBANlfXjbVb8ygXymodEx7mybxRjSNx9wLWPtfLxNIXwyh1LfkynaXAfcnZBZCJUi6eDjGlSlJZCpyWgT4zngAdFwNfoBSZAlqOZBeZAOy1jVavE34QJfZC8AsyHfva1d7HuLQmFHzxLrdlrSzpPnsfXROJMtqVOmlgZDZD&limit=10
		 *
		 */
		$api_access_token = $this->get_api_key();
		$facebook_page_name = $this->get_facebook_page_name();
		$endpoint_url = "https://graph.facebook.com/".$facebook_page_name ."/feed?fields=attachments,picture,full_picture,story,message,created_time,from,story_tags,shares,likes.summary(true),comments.summary(true)&access_token=".$api_access_token."&limit=10";
		$file_get_contents = file_get_contents($endpoint_url);

		//var_dump(json_decode($file_get_contents) );
		if( false === $file_get_contents  ) {
			return "facebook Access Token error!!!";
		}
		return json_decode($file_get_contents);

	}

	public function facebook_profile_connect() {
		/**
		 * Need to register client and manage it properly to get client id ( uncheck Disable implicit OAuth ).
		 * Follow https://developers.facebook.com/ to get access token strickly.
		 * Get end point url from https://www.facebook.com/developer/endpoints/users/
		 * See some examples
		 * https://graph.facebook.com/leaderlawfirmaz/?fields=picture,username&access_token=
		 *
		 */
		$api_access_token = $this->get_api_key();
		$facebook_page_name = $this->get_facebook_page_name();
		$endpoint_url = "https://graph.facebook.com/".$facebook_page_name ."/?fields=picture,username&access_token=".$api_access_token;
		$file_get_contents = file_get_contents($endpoint_url);

		//var_dump(json_decode($file_get_contents) );
		if( false === $file_get_contents  ) {
			return "facebook Access Token error!!!";
		}
		return json_decode($file_get_contents);

	}
}
//$Lds_Social_facebook = new Lds_Social_Facebook();
