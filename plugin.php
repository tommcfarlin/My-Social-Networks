<?php
/*
Plugin Name: My Social Network
Plugin URI: http://github.com/tommcfarlin/My-Social-Network
Description: A simple WordPress widget for sharing a few of your social networks.
Version: 1.1
Author: Tom McFarlin
Author URI: http://tommcfarlin.com
Author Email: tom@tommcfarlin.com
License:

  Copyright 2011 My Social Network (tom@tommcfarlin.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class My_Social_Network extends WP_Widget {

	const name = 'My Social Networks';
	const locale = 'my-social-networks-locale';
	const slug = 'my-social-networks-master';
	
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function __construct() {

		load_plugin_textdomain(self::locale, false, dirname(plugin_basename( __FILE__ ) ) . '/lang/' );

		$widget_opts = array (
			'classname' => self::name, 
			'description' => __('A simple WordPress widget for sharing a few of your social networks.', self::locale)
		);	
		
		parent::__construct(self::slug, __(self::name, self::locale), $widget_opts);

    	// Load JavaScript and stylesheets
    	$this->register_scripts_and_styles();
		
	} // end constructor

	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget($args, $instance) {
	
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		
    	$twitter_username = empty($instance['twitter_username']) ? '' : apply_filters('twitter_username', $instance['twitter_username']);
		$facebook_username = empty($instance['facebook_username']) ? '' : apply_filters('facebook_username', $instance['facebook_username']);
		$google_plus_id = empty($instance['google_plus_id']) ? '' : apply_filters('google_plus_id', $instance['google_plus_id']);
    
		// Display the widget
		include(WP_PLUGIN_DIR . '/' . self::slug . '/views/widget.php');
		
		echo $after_widget;
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
	    $instance['twitter_username'] = strip_tags(stripslashes($new_instance['twitter_username']));
	    $instance['facebook_username'] = strip_tags(stripslashes($new_instance['facebook_username']));
	    $instance['google_plus_id'] = strip_tags(stripslashes($new_instance['google_plus_id']));
	    
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form($instance) {
	
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'twitter_username' => '',
        		'facebook_username' => '',
        		'google_plus_id' => ''
			)
		);
    
    	$twitter_username = strip_tags(stripslashes($new_instance['twitter_username']));
    	$facebook_username = strip_tags(stripslashes($new_instance['facebook_username']));
    	$google_plus_id = strip_tags(stripslashes($new_instance['google_plus_id']));

		// Display the admin form
    	include(WP_PLUGIN_DIR . '/' . self::slug . '/views/admin.php');
		
	} // end form
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
	
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
		if(is_admin()) {
      		$this->load_file(PLUGIN_NAME, '/' . self::slug . '/js/admin.js', true);
			$this->load_file(PLUGIN_NAME, '/' . self::slug . '/css/admin.css');
		} else { 
      		$this->load_file(PLUGIN_NAME, '/' . self::slug . '/js/admin.css', true);
			$this->load_file(PLUGIN_NAME, '/' . self::slug . '/css/widget.css');
		} // end if/else
	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file($name, $file_path, $is_script = false) {
		
    	$url = WP_PLUGIN_URL . $file_path;
		$file = WP_PLUGIN_DIR . $file_path;
    
		if(file_exists($file)) {
			if($is_script) {
				wp_register_script($name, $url);
				wp_enqueue_script($name);
			} else {
				wp_register_style($name, $url);
				wp_enqueue_style($name);
			} // end if
		} // end if
    
	} // end load_file
	
} // end class
add_action('widgets_init', create_function('', 'register_widget("My_Social_Network");'));
?>
