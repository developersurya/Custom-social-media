<?php
/**
 * The public-facing functionality of the plugin.
 * Generate shortcode to show in frontend
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    lds_social_media
 * @subpackage lds_social_media/public
 * @author     lastdoorsolutions <info@lastdoorsolutions.com>
 */
class Lds_Social_Media_Shortcode {

	/**
	 * Initialize the class and set its properties.
	 *
	 */
	public function __construct() {

		//$this->options = get_option( 'hbl_option_name' );
		add_shortcode( 'lds_social_youtube', array( $this, 'youtube_shortcode' ) );
		add_shortcode( 'lds_social_instagram', array( $this, 'instagram_shortcode' ) );
		add_shortcode( 'lds_social_facebook', array( $this, 'facebook_shortcode' ) );
		add_shortcode( 'lds_social_twitter', array( $this, 'twitter_shortcode' ) );


	}

	public function youtube_shortcode(){
		/**
		 * get youtube data
		 */
		$Lds_Social_Youtube = new  Lds_Social_Youtube();
		$youtube_data = $Lds_Social_Youtube->youtube_api_connect();
		$youtube_video_count = $Lds_Social_Youtube->get_youtube_count();
		//var_dump($youtube_data);
		$yt   = '<div class="yt-wrp">';
		//Check if returned data contain error message
		if( 'Youtube API key or Channel ID error!!!' === $youtube_data ){
			$yt  .= $youtube_data;
		}
		//Loop only if data does not contain error message
		if( 'Youtube API key or Channel ID error!!!' !== $youtube_data ){
			$i = 0;
			foreach($youtube_data->items as $yt_data){
				//Check all data
				//var_dump($yt_data);

				$yt_channelId = "";
				$yt_videoId   = "";
				//First Loop always contain channel detail not video id.
				if( $yt_data->id->kind == "youtube#channel"){
					$yt_channelId = $yt_data->id->channelId;
				}else{
					$yt_videoId = $yt_data->id->videoId;
				}
				//Use required variable to show in frontend, add them in $yt
				$yt_title = $yt_data->snippet->title;
				$yt_description = $yt_data->snippet->description;
				$yt_img = $yt_data->snippet->thumbnails->high->url;
				$yt_date = $yt_data->snippet->publishedAt;
				//Change date format
				$yt_formatted_date = date('M d, Y' , strtotime($yt_date));
				//Start repeat data
				//Repeat if only video id
				if($yt_videoId){
					$yt  .= '<div class="yt-wrp-repeat">';
					$yt  .= '<div class="yt-date">' . $yt_formatted_date . '</div>';
					$yt  .= '<div class="yt-video"><iframe width="420" height="315" src="https://www.youtube.com/embed/' . $yt_videoId . '"></iframe></div>';
					//$yt  .= '<div class="yt-description">' . $yt_description . '</div>';
					//$yt  .= '<div class="yt-image"><img width="50" src="' . $yt_img . '"></div>';
					$yt  .= '<div class="yt-video">' . $yt_title . '</div>';
					$yt  .= '</div>';
				}
				$i++;

				//Add video count logic
				if( !empty( $youtube_video_count ) )
				{
					$yt_video_count = (int)$youtube_video_count + 1;
				}else{
					//show two videos data but first one will contain about channel.
					$yt_video_count = 2;
				}
				if ( $i == $yt_video_count ) { break; }
			}


		}
		$yt  .= '</div>';
		return $yt;
	}

	public function instagram_shortcode(){
		/**
		 * get Instagram data
		 */
		$Lds_Social_Instagram = new  Lds_Social_Instagram();
		$instagram_data = $Lds_Social_Instagram->instagram_api_connect();
		$instagram_post_count = $Lds_Social_Instagram->get_instagram_count();
		//var_dump($instagram_data);

		$insta   = '<div class="insta-wrp">';

		//Check if returned data contain error message
		if( 'Instagram Access Token error!!!' === $instagram_data ){
			$insta  .= $instagram_data;
		}
		//Loop only if data does not contain error message
		if( 'Instagram Access Token error!!!' !== $instagram_data ){

			$count =1;
			foreach($instagram_data->data as $insta_data){
				$insta_username = $insta_data->user->full_name;
				$insta_userprofile = $insta_data->user->profile_picture;
				$insta  .= '<div class="insta-username">' . $insta_username . '</div>';
				$insta  .= '<div class="insta-userprofile"><img src="' . $insta_userprofile . '" width="50"></div>';
				$count ++;
				//break after first loop to show only 1 post.
				if ( $count == 2 ) { break; }
			}
			$i = 0;
			foreach($instagram_data->data as $insta_data){
				//check all data
				//var_dump($insta_data);

				$insta_channelId = "";
				$insta_videoId   = "";

				//Use required variable to show in frontend, add them in $insta

				$insta_description = $insta_data->caption->text;
				$insta_img = $insta_data->images->standard_resolution->url;
				$insta_date = $insta_data->created_time;
				//Change date format
				// Make sure they are in timestring else use php strtotime function
				$insta_formatted_date = date('M d, Y' , ($insta_date));


				//Start repeat data
					$insta  .= '<div class="insta-wrp-repeat">';
					$insta  .= '<div class="insta-date">' . $insta_formatted_date . '</div>';
					//$insta  .= '<div class="insta-video"><iframe width="420" height="315" src="https://www.instagram.com/embed/' . $insta_videoId . '"></iframe></div>';
					//$insta  .= '<div class="insta-description">' . $insta_description . '</div>';
					$insta  .= '<div class="insta-image"><img width="500" src="' . $insta_img . '"></div>';
					$insta  .= '<div class="insta-text">' . $insta_description . '</div>';
					$insta  .= '</div>';
				$i++;

				//Add post count logic
				if(  !empty( $instagram_post_count  ) )
				{
					$insta_post_count = (int)$instagram_post_count ;
				}else{
					//show two post data but first one will contain about channel.
					$insta_post_count = 2;
				}
				if ( $i == $insta_post_count ) { break; }
			}


		}
		$insta  .= '</div>';
		return $insta;
	}

	public function facebook_shortcode(){
		/**
		 * Get Facebook data
		 */
		$Lds_Social_facebook = new  Lds_Social_Facebook();
		$facebook_data       = $Lds_Social_facebook->facebook_api_connect();
		$facebook_post_count = $Lds_Social_facebook->get_facebook_count();

		//Facebook profile data
		$facebook_profile_data       = $Lds_Social_facebook->facebook_profile_connect();

		$fb   = '<div class="fb-wrp">';

		//Check if returned data contain error message
		if( 'facebook Access Token error!!!' === $facebook_data ){
			$fb  .= "Facebook API error. Please check your settings.";
		}
		//Loop only if data does not contain error message
		if( 'facebook Access Token error!!!' !== $facebook_data ){

				$fb_username = $facebook_profile_data->username;
				$fb_userprofile = $facebook_profile_data->picture->data->url;

			$i = 0;
			foreach($facebook_data->data as $fb_inner_data){
				//check all data
				//var_dump($fb_inner_data);
				$attachment             = $fb_inner_data->attachments;
				$fb_post_desc           = $attachment->data['0'];
				$fb_post_img_crop       = $fb_post_desc->media->image->src;
				$fb_post_img_data       = $fb_inner_data->full_picture;
				$fb_post_message        = $fb_inner_data->message;
				$fb_post_created_time   = $fb_inner_data->created_time;
				$fb_post_like_count     = $fb_inner_data->likes->summary->total_count;
				//$fb_post_comments_count = $fb_inner_data->comments->summary->total_count;
				//$fb_post_shares_count   = $fb_inner_data->shares->count;
				$fb_post_url            = $fb_post_desc->url;

				

				//Use required variable to show in frontend, add them in $fb
				//Change date format
				// Make sure they are in timestring else use php strtotime function
				$fb_formatted_date = date('M d, Y' , strtotime($fb_post_created_time));

				//Start repeat data
				$fb  .= '<div class="fb-wrp-repeat">';
				$fb  .= '<div class="fb-profile">';
				$fb  .= '<div class="fb-username">' . $fb_username . '</div>';
				$fb  .= '<div class="fb-userprofile"><img src="' . $fb_userprofile . '" width="50"></div>';
				$fb  .= '</div>';
				$fb  .= '<div class="fb-date">' . $fb_formatted_date . '</div>';
				$fb  .= '<div class="fb-image"><img width="500" src="' . $fb_post_img_data . '"></div>';
				$fb  .= '<div class="fb-text">' . $fb_post_message . '</div>';
				$fb  .= '</div>';
				$i++;

				//Add post count logic
				if( !empty( $facebook_post_count  )  )
				{
					$fb_post_count = (int)$facebook_post_count ;
				}else{
					//show two post data but first one will contain about channel.
					$fb_post_count = 1;
				}
				if ( $i == $fb_post_count ) { break; }
			}


		}
		$fb  .= '</div>';
		return $fb;
	}

	public function twitter_shortcode(){
		/**
		 * Get Twitter data
		 */
		$Lds_Social_twitter = new  Lds_Social_Twitter();
		$twitter_data       = $Lds_Social_twitter->twitter_api_connect();
		$credential         = $Lds_Social_twitter->get_twitter_credentials();
		$twitter_profile    = $Lds_Social_twitter->twitter_profile_connect();
		//var_dump($twitter_data);
		//var_dump($twitter_data['errors']['message']);
		//Facebook profile data
		$tw   = '<div class="tw-wrp">';

		//Check if returned data contain error message
		if( $twitter_data->errors){
			$tw   .= 'Twitter API Error: '.$twitter_data->errors['0']->message;
		}
		//Loop only if data does not contain error message
		if( !isset($twitter_data->errors) ){

			$i = 0;

			foreach($twitter_data as $tw_inner_data){
				//var_dump($tw_inner_data);
				$tw_username            = $twitter_profile->name;
				$tw_userprofile         = $twitter_profile->profile_image_url;
				$tw_post_img_data       = $tw_inner_data->entities->media['0']->media_url;
				$tw_post_message        = $tw_inner_data->full_text;
				$tw_post_created_time   = $tw_inner_data->created_at;
				//Use required variable to show in frontend, add them in $tw
				//Change date format
				// Make sure they are in timestring else use php strtotime function
				$tw_formatted_date = date('M d, Y' , strtotime($tw_post_created_time));

				//Start repeat data
				$tw  .= '<div class="tw-wrp-repeat">';
				$tw  .= '<div class="tw-profile">';
				$tw  .= '<div class="tw-username">' . $tw_username . '</div>';
				$tw  .= '<div class="tw-userprofile"><img src="' . $tw_userprofile . '" width="50"></div>';
				$tw  .= '</div>';
				$tw  .= '<div class="tw-date">' . $tw_formatted_date . '</div>';
				$tw  .= '<div class="tw-image"><img width="500" src="' . $tw_post_img_data . '"></div>';
				$tw  .= '<div class="tw-text">' . $tw_post_message . '</div>';
				$tw  .= '</div>';
				$i++;

				//Add post count logic
				$twitter_post_count = $credential[5];
				if(  !empty( $twitter_post_count  )  )
				{
					$tw_post_count = (int)$twitter_post_count ;
				}else{
					//show two post data but first one will contain about channel.
					$tw_post_count = 2;
				}
				if ( $i == $tw_post_count ) { break; }
			}

		}
		$tw  .= '</div>';
		return $tw;
	}

}
$Lds_Social_Media_Shortcode = new Lds_Social_Media_Shortcode();
