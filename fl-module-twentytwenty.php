<?php
/**
 * Plugin Name: Beaver Builder TwentyTwenty Module
 * Plugin URI: https://github.com/Pross/custom-module-example-twentytwenty
 * Description: An example plugin thats demonstrates how to create a simple module for BeaverBuilder using a jQuery plugin.
 * Version: 1.0
 * Author: The Beaver Builder Team
 * Author URI: https://www.wpbeaverbuilder.com
 */
class TwentyTwentyExamplePlugin {

	public static function init() {

		if( class_exists( 'FLBuilder' ) ) {
			require_once 'modules/twentytwenty/twentytwenty.php';
		}
	}
}
add_action( 'init', array( 'TwentyTwentyExamplePlugin', 'init' ) );
