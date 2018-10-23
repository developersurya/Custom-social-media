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

require_once plugin_dir_path( dirname( __FILE__ ) ) . '/twitteroauth/autoload.php';
// get the required resource from https://github.com/abraham/twitteroauth
use Abraham\TwitterOAuth\TwitterOAuth;

class Lds_Social_Twitter {

	public function __construct() {

		$twitter_data = $this->twitter_api_connect();

	}

	public function get_twitter_credentials(){
		$twitter_data = array();
		$social_media_option         = get_option( 'social_media_option' );
		$twitter_cosumer_key         = $social_media_option['twitter_cosumer_key'];
		$twitter_consumer_secret     = $social_media_option['twitter_consumer_secret'];
		$twitter_access_token_secret = $social_media_option['twitter_access_token_secret'];
		$twitter_access_token        = $social_media_option['twitter_access_token'];
		$twitter_screen_name         = $social_media_option['twitter_screen_name'];
		$twitter_post_count          = $social_media_option['twitter_post_count'];
		array_push($twitter_data,$twitter_cosumer_key,$twitter_consumer_secret,$twitter_access_token,$twitter_access_token_secret,$twitter_screen_name,$twitter_post_count );
		return $twitter_data;
	}



	public function twitter_api_connect(){
		/**
		 * Need to register client and manage it properly to get client id ( uncheck Disable implicit OAuth ).
		 * Follow https://developer.twitter.com/ to get access token .
		 * Get end point url from twitter api will not work. It was permanently removed and now we strickly need oAuth method.
		 * See some examples
		 *
		 */
		$credential = $this->get_twitter_credentials();
		//Sample key and  tokens
		//$cosumer_key = "wAVZdagTN2EYq1u1LHKANLdgU";
		//$consumer_secret = "bw0c9bOLI5Ur9iFD3C0nGYfrCqWJtCxc7IfpeqGVSGEuGDEsCm";
		//$access_token = "1056912775-4XPH397CUqLcFsi3AY4Vt6I1qXrbhDCmiLzPV28";
		//$access_token_secret = "DIJQ5cF14ITumwy88tP9Iq9odpv1qb48XVQSG8lDvlc2m";
		$connection = new TwitterOAuth($credential[0],$credential[1], $credential[2], $credential[3]);
		$content = $connection->get("account/verify_credentials");

		$statuses = $connection->get("statuses/user_timeline",
			array('count' => 10,
			      'tweet_mode' => 'extended',
			      'include_entities' => 'true',
			      'screen_name' =>  $credential[4]
			)
		);


		return $statuses;

	 }



	public function twitter_profile_connect() {
		/**
		 * https://developer.twitter.com/
		 */
		$credential = $this->get_twitter_credentials();
		$connection = new TwitterOAuth($credential[0],$credential[1], $credential[2], $credential[3]);
		$content = $connection->get("account/verify_credentials");
		$users = $connection->get("users/show",
			array('count' => 10,
			      'tweet_mode' => 'extended',
			      'include_entities' => 'true',
			      'screen_name' =>  $credential[4]
			)
		);
		return $users;

	}
}
//$Lds_Social_twitter = new Lds_Social_Twitter();
