<?php
/**
 * The Option page plugin class.
 *
 * @since      1.0.0
 * @package    social_media
 * @subpackage social_media/includes
 * @author     lastdoorsolutions <info@lastdoorsolutions.com>
 */
class Lds_Social_Media_Option_Page
{
	/**
	 * Holds the values to be used in the fields callbacks.
	 *
	 */
	protected $options;


	/**
	 * Define the Option page functionality of the plugin.
	 */
	public function __construct()
	{

		add_action('admin_menu', array($this, 'add_plugin_page'));
		add_action('admin_init', array($this, 'page_init'));

	}
	/**
	 * Add options page
	 */
	public function add_plugin_page()
	{
		// This page will be under "Settings"
		add_options_page(
			'Social Media settings',
			'Social Media settings',
			'manage_options',
			'social-media-page',
			array($this, 'social_media_general'),
			'dashicons-social', 90
		);


	}
	/**
	 * Setting page callback
	 */
	public function social_media_general()
	{
		$this->options = get_option('social_media_option');
		?>
		<div class="wrap">
			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields('social_media_option');
				do_settings_sections('social-media-page');
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{
		register_setting(
			'social_media_option',
			'social_media_option',
			array($this, 'sanitize')
		);

		add_settings_section(
			'setting_section_id',
			'Youtube Options',
			array($this, 'print_section_info'),
			'social-media-page'
		);

		add_settings_field(
			'youtube_channel_id',
			'Channel ID',
			array($this, 'youtube_channel_id_callback'),
			'social-media-page',
			'setting_section_id'
		);

		add_settings_field(
			'youtube_api_key',
			'API Key',
			array($this, 'youtube_api_key_callback'),
			'social-media-page',
			'setting_section_id'
		);
		add_settings_field(
			'youtube_video_count',
			'Video Count',
			array($this, 'youtube_video_count_callback'),
			'social-media-page',
			'setting_section_id'
		);
		add_settings_section(
			'setting_section_instagram',
			'Instagram Options',
			array($this, 'print_instagram_info'),
			'social-media-page'
		);
		add_settings_field(
			'setting_instagram_token',
			'Access Token',
			array($this, 'instagram_access_token_callback'),
			'social-media-page',
			'setting_section_instagram'
		);
		add_settings_field(
			'setting_instagram_count',
			'Post Count',
			array($this, 'instagram_post_count_callback'),
			'social-media-page',
			'setting_section_instagram'
		);

		//Facebook section
		add_settings_section(
			'setting_section_facebook',
			'Facebook Options',
			array($this, 'print_facebook_info'),
			'social-media-page'
		);
		add_settings_field(
			'setting_facebook_token',
			'Access Token',
			array($this, 'facebook_access_token_callback'),
			'social-media-page',
			'setting_section_facebook'
		);
		add_settings_field(
			'setting_facebook_page_name',
			'Page Name',
			array($this, 'facebook_page_name_callback'),
			'social-media-page',
			'setting_section_facebook'
		);
		add_settings_field(
			'setting_facebook_count',
			'Post Count',
			array($this, 'facebook_post_count_callback'),
			'social-media-page',
			'setting_section_facebook'
		);

		//Twitter section
		add_settings_section(
			'setting_section_twitter',
			'Twitter Options',
			array($this, 'print_twitter_info'),
			'social-media-page'
		);
		add_settings_field(
			'setting_twitter_consumer_key',
			'Costumer Key',
			array($this, 'twitter_consumer_key_callback'),
			'social-media-page',
			'setting_section_twitter'
		);
		add_settings_field(
			'setting_twitter_consumer_secret',
			'Consumer Secret',
			array($this, 'twitter_consumer_secret_callback'),
			'social-media-page',
			'setting_section_twitter'
		);
		add_settings_field(
			'setting_twitter_access_token',
			'Access Token',
			array($this, 'twitter_access_token_callback'),
			'social-media-page',
			'setting_section_twitter'
		);
		add_settings_field(
			'setting_twitter_access_token_secret',
			'Access Token Secret',
			array($this, 'twitter_access_token_secret_callback'),
			'social-media-page',
			'setting_section_twitter'
		);
		add_settings_field(
			'setting_twitter_screen_name',
			'Screen Name',
			array($this, 'twitter_screen_name_callback'),
			'social-media-page',
			'setting_section_twitter'
		);
		add_settings_field(
			'setting_twitter_post_count',
			'Post Count',
			array($this, 'twitter_post_count_callback'),
			'social-media-page',
			'setting_section_twitter'
		);

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize($input)
	{
		$new_input = array();
		if (isset($input['youtube_channel_id']))
			$new_input['youtube_channel_id'] = sanitize_text_field($input['youtube_channel_id']);
		if (isset($input['youtube_api_key']))
			$new_input['youtube_api_key'] = sanitize_text_field($input['youtube_api_key']);
		if (isset($input['youtube_video_count']))
			$new_input['youtube_video_count'] = sanitize_text_field($input['youtube_video_count']);
		if (isset($input['instagram_access_token']))
			$new_input['instagram_access_token'] = sanitize_text_field($input['instagram_access_token']);
		if (isset($input['instagram_post_count']))
			$new_input['instagram_post_count'] = sanitize_text_field($input['instagram_post_count']);
		if (isset($input['facebook_access_token']))
			$new_input['facebook_access_token'] = sanitize_text_field($input['facebook_access_token']);
		if (isset($input['facebook_page_name']))
			$new_input['facebook_page_name'] = sanitize_text_field($input['facebook_page_name']);
		if (isset($input['facebook_post_count']))
			$new_input['facebook_post_count'] = sanitize_text_field($input['facebook_post_count']);
		if (isset($input['twitter_cosumer_key']))
			$new_input['twitter_cosumer_key'] = sanitize_text_field($input['twitter_cosumer_key']);
		if (isset($input['twitter_consumer_secret']))
			$new_input['twitter_consumer_secret'] = sanitize_text_field($input['twitter_consumer_secret']);
		if (isset($input['twitter_access_token']))
			$new_input['twitter_access_token'] = sanitize_text_field($input['twitter_access_token']);
		if (isset($input['twitter_access_token_secret']))
			$new_input['twitter_access_token_secret'] = sanitize_text_field($input['twitter_access_token_secret']);
		if (isset($input['twitter_screen_name']))
			$new_input['twitter_screen_name'] = sanitize_text_field($input['twitter_screen_name']);
		if (isset($input['twitter_post_count']))
			$new_input['twitter_post_count'] = sanitize_text_field($input['twitter_post_count']);


		return $new_input;
	}
	/**
	 * Print the Section text
	 */
	public function print_section_info()
	{
		print 'Get your API keys and other details for youtube.<br/>
		Please get your API keys from https://console.developers.google.com/ by activating youtube data API. <br/>
		<strong>Shortcode: [lds_social_youtube]</strong>';
	}
	 public function print_instagram_info(){
		print 'Get your API keys and other details for instagram.Visit https://www.instagram.com/developer/authentication/ to get access token.</br> 
		<strong>Shortcode: [lds_social_instagram]</strong>';
	 }
	public function print_facebook_info(){
		print 'Get your API keys and other details for facebook page ( https://developers.facebook.com/).</br>
		<strong>Shortcode: [lds_social_facebook]</strong>';
	}

	public function print_twitter_info(){
		print 'Get your API keys and other details for Twitter page ( https://developer.twitter.com/ ).<br/>
        <strong>Shortcode: [lds_social_twitter]</strong>';
	}
	/**
	 * Get the settings option array and print one of its values
	 */
	public function youtube_channel_id_callback()
	{
		printf(
			'<input style="width:400px;" type="text" id="youtube_channel_id" name="social_media_option[youtube_channel_id]" value="%s" />',
			isset($this->options['youtube_channel_id']) ? esc_attr($this->options['youtube_channel_id']) : ''
		);

	}
	public function youtube_api_key_callback()
	{
		printf(
			'<input style="width:400px;" type="text" id="youtube_api_key" name="social_media_option[youtube_api_key]" value="%s" />',
			isset($this->options['youtube_api_key']) ? esc_attr($this->options['youtube_api_key']) : ''
		);

	}
	public function youtube_video_count_callback()
	{
		printf(
			'<input style="width:40px;" type="text" id="youtube_video_count" name="social_media_option[youtube_video_count]" value="%s" />',
			isset($this->options['youtube_video_count']) ? esc_attr($this->options['youtube_video_count']) : ''
		);

	}
	public function instagram_access_token_callback(){
		printf(
			'<input style="width:400px;" type="text" id="instagram_access_token" name="social_media_option[instagram_access_token]" value="%s" />',
			isset($this->options['instagram_access_token']) ? esc_attr($this->options['instagram_access_token']) : ''
		);
	}
	public function instagram_post_count_callback(){
		printf(
			'<input style="width:40px;" type="text" id="instagram_post_count" name="social_media_option[instagram_post_count]" value="%s" />',
			isset($this->options['instagram_post_count']) ? esc_attr($this->options['instagram_post_count']) : ''
		);
	}
	public function facebook_access_token_callback(){
		printf(
			'<input style="width:400px;" type="text" id="facebook_access_token" name="social_media_option[facebook_access_token]" value="%s" />',
			isset($this->options['facebook_access_token']) ? esc_attr($this->options['facebook_access_token']) : ''
		);
	}
	public function facebook_page_name_callback(){
		printf(
			'<input style="width:200px;" type="text" id="facebook_page_name" name="social_media_option[facebook_page_name]" value="%s" />',
			isset($this->options['facebook_page_name']) ? esc_attr($this->options['facebook_page_name']) : ''
		);
	}
	public function facebook_post_count_callback(){
		printf(
			'<input style="width:40px;" type="text" id="facebook_post_count" name="social_media_option[facebook_post_count]" value="%s" />',
			isset($this->options['facebook_post_count']) ? esc_attr($this->options['facebook_post_count']) : ''
		);
	}
	public function twitter_consumer_key_callback(){
		printf(
			'<input style="width:400px;" type="text" id="twitter_cosumer_key" name="social_media_option[twitter_cosumer_key]" value="%s" />',
			isset($this->options['twitter_cosumer_key']) ? esc_attr($this->options['twitter_cosumer_key']) : ''
		);
	}
	public function twitter_consumer_secret_callback(){
		printf(
			'<input style="width:400px;" type="text" id="twitter_consumer_secret" name="social_media_option[twitter_consumer_secret]" value="%s" />',
			isset($this->options['twitter_consumer_secret']) ? esc_attr($this->options['twitter_consumer_secret']) : ''
		);
	}
	public function twitter_access_token_callback(){
		printf(
			'<input style="width:400px;" type="text" id="twitter_access_token" name="social_media_option[twitter_access_token]" value="%s" />',
			isset($this->options['twitter_access_token']) ? esc_attr($this->options['twitter_access_token']) : ''
		);
	}
	public function twitter_access_token_secret_callback(){
		printf(
			'<input style="width:400px;" type="text" id="twitter_access_token_secret" name="social_media_option[twitter_access_token_secret]" value="%s" />',
			isset($this->options['twitter_access_token_secret']) ? esc_attr($this->options['twitter_access_token_secret']) : ''
		);
	}
	public function twitter_screen_name_callback(){
		printf(
			'<input style="width:200px;" type="text" id="twitter_screen_name" name="social_media_option[twitter_screen_name]" value="%s" />',
			isset($this->options['twitter_screen_name']) ? esc_attr($this->options['twitter_screen_name']) : ''
		);
	}
	public function twitter_post_count_callback(){
		printf(
			'<input style="width:40px;" type="text" id="twitter_post_count" name="social_media_option[twitter_post_count]" value="%s" />',
			isset($this->options['twitter_post_count']) ? esc_attr($this->options['twitter_post_count']) : ''
		);
	}

}
if (is_admin())
	$option_page = new Lds_Social_Media_Option_Page();