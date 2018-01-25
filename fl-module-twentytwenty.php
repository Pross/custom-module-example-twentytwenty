<?php
/**
 * Plugin Name: Beaver Builder jQuery TwentyTwenty example.
 * Plugin URI: http://www.wpbeaverbuilder.com
 * Description: An example plugin thats demonstrates how to create a simple module.
 * Version: 1.0
 * Author: The Beaver Builder Team
 * Author URI: http://www.wpbeaverbuilder.com
 */
class TwentyTwentyExamplePlugin {

	public static function init() {
		require_once 'modules/twentytwenty/twentytwenty.php';
	}
}
add_action( 'init', array( 'TwentyTwentyExamplePlugin', 'init' ) );
