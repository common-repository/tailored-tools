<?php
/*
Plugin Name:	Tailored Tools
Description:	Adds some functionality to WordPress that you'll need.
Version:		1.8.4
Author:			Tailored Web Services
Author URI:		http://www.tailored.com.au
*/



//	Register our scripts & styles for later enqueuing
add_action('init', 'tailored_tools_register_scripts');
function tailored_tools_register_scripts() {
	// Stylesheets
	wp_register_style('ttools', plugins_url('resource/custom.css', __FILE__));
	// Javascript
	wp_deregister_script('jquery-validate');	// Assume this plugin is more up-to-date than other sources.  Might be bad mannered, but we know which version we're getting.
	wp_register_script('jquery-validate',	plugins_url('js/jquery.validate.js', __FILE__), array('jquery'), '1.14.0', true);
	wp_register_script('jquery-timepicker',	plugins_url('js/jquery.timepicker.js', __FILE__), array('jquery-ui-datepicker'), '1.5.3', true);
	wp_register_script('google-maps-api', '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places', false, false, false);
	wp_register_script('jquery-geocomplete', plugins_url('js/jquery.geocomplete.js', __FILE__), array('jquery', 'google-maps-api'), false, true);
	wp_register_script('ttools-loader',	 plugins_url('js/loader.js', __FILE__), array('jquery'), false, true);
}


//	Include Helper Classes
if (!class_exists('TailoredTinyMCE'))			require( dirname(__FILE__).'/lib/tinymce.php' );
if (!class_exists('TailoredForm'))				require( dirname(__FILE__).'/lib/class.forms.php' );
if (!class_exists('tws_WP_List_Table'))			require( dirname(__FILE__).'/lib/class-wp-list-table.php' );

// Anti-spam Modules
if (!class_exists('Tailored_reCAPTCHA'))		require( dirname(__FILE__).'/lib/class.recaptcha.php' );
if (!class_exists('Tailored_Akismet'))			require( dirname(__FILE__).'/lib/class.akismet.php' );



//	Run after all plugins loaded
add_action('plugins_loaded', 'tailored_tools_plugins_loaded', 11);
function tailored_tools_plugins_loaded() {
	// Include Tailored Tools modules
	if (!class_exists('TailoredTools_Shortcodes'))	require( dirname(__FILE__).'/shortcodes.php' );
	if (!class_exists('ttools_mce_columns'))		require( dirname(__FILE__).'/mce-columns.php' );
	if (!class_exists('TailoredTools_GoogleMaps'))	require( dirname(__FILE__).'/googlemaps.php' );
	//	Contact Form
	if (!class_exists('ContactForm'))				require( dirname(__FILE__).'/form.contact.php' );
//	if (!class_exists('DummyForm'))					require( dirname(__FILE__).'/form.dummy.php' );
	//	Helper to embed JS like Adwords Conversion Code
	if (!class_exists('ttools_embed_page_js'))		require( dirname(__FILE__).'/embed-js.php' );
}









?>