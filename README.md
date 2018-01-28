# Introduction
In this tutorial I'm going to show you how to create a module plugin for Beaver Builder using a 3rd party jQuery plugin.

The jQuery plugin we are using will compare two images with a sliding bar, this could be useful where you need to compare two images with similar dimensions.

![Module Demo](assets/module-demo.gif?raw=true)

# Creating the plugin.
Navigate to your WP plugins folder, typically `wp-content/plugins/` and create a new folder `custom-module-example-twentytwenty`.

For WP to recognise the plugin correctly we need a main plugin file with the WP plugin headers.

Create a file called `fl-module-twentytwenty.php` in your new plugin folder with the following:

```
<?php
/**
 * Plugin Name: Beaver Builder TwentyTwenty Module.
 * Plugin URI: http://www.wpbeaverbuilder.com
 * Description: An example plugin thats demonstrates how to create a simple module for BeaverBuilder using a jQuery plugin.
 * Version: 1.0
 * Author: The Beaver Builder Team
 * Author URI: http://www.wpbeaverbuilder.com
 */
```

This is the information WP uses on the plugins admin screen to show the name, description and version information.

Underneath this we will add the main plugin class which will load the module file.

```
class TwentyTwentyExamplePlugin {

	public static function init() {

		if( class_exists( 'FLBuilder' ) ) {
			require_once 'modules/twentytwenty/twentytwenty.php';
		}
	}
}
add_action( 'init', array( 'TwentyTwentyExamplePlugin', 'init' ) );
```

# Creating the module
Create a folder in your plugin called `modules` and inside that new folder create another folder called `twentytwenty`, this will be the actual module folder, all code and assets for your module will be in this folder.

Now create a new file in your `twentytwenty` module folder called `twentytwenty.php`, this will be the module file.

# The module file.

The module file will extend the `FLBuilderModule` class to register itself as a BeaverBuilder module and add any assets and settings that it needs.
```
class TwentyTwentyExampleModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Twenty Twenty', 'fl-builder' ),
			'description'     => __( 'An basic example module using jQuery TwentyTwenty.', 'fl-builder' ),
			'category'        => __( 'Example Modules', 'fl-builder' ),
			'dir'             => __DIR__,
			'partial_refresh' => true,
			'url'             => plugins_url( '', __FILE__ ),
		));
	}
}
```
# Module Assets.
Our jQuery plugin has 3 files and they need to be put in the right folders.

In the module folder create two new folders, `css` and `js`.

Move the twentytwenty css file and the js files into their respective folders.

We can now add these assets to the module file so they get enqueued properly when the module is on the page.

To do this you need to open the module file again and add the following into the `__construct` function.

Your module file should now look something like this.
```
<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class TwentyTwentyExampleModule
 */
class TwentyTwentyExampleModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Twenty Twenty', 'fl-builder' ),
			'description'     => __( 'An basic example module using jQuery TwentyTwenty.', 'fl-builder' ),
			'category'        => __( 'Example Modules', 'fl-builder' ),
			'dir'             => __DIR__,
			'partial_refresh' => true,
			'url'             => plugins_url( '', __FILE__ ),
		));

		/**
		 * Now we include our js and css files using the module classes built in methods.
		 */
		$this->add_js( 'jquery-event-move',   $this->url . 'js/jquery.event.move.js',   array( 'jquery' ) );
		$this->add_js( 'jquery-twentytwenty', $this->url . 'js/jquery.twentytwenty.js', array( 'jquery' ) );
		$this->add_css( 'twentytwenty',       $this->url . 'css/twentytwenty.css' );
	}
}
```

# Module options

Our module will only have two options, one for each photo so lets add them now.

Underneath the main module class we will use the `FLBuilder::register_module` method to register those two options.

```
/**
 * Register the module and its form settings.
 * We are using a very simple form here with only two options, photo_one and photo_two.
 */
FLBuilder::register_module( 'TwentyTwentyExampleModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Section Title', 'fl-builder' ),
				'fields' => array(
					'photo_one' => array(
						'type' => 'photo',
						'label' => __( 'Photo One', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'photo_two' => array(
						'type' => 'photo',
						'label' => __( 'Photo Two', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
		),
	),
));
```

# Module frontend.php

For any BeaverBuilder module to render it needs a `frontend.php` file, so create a new folder `includes` inside the module folder and create a new file `frontend.php` and add the following.

```
<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */

?>
<div class="fl-twenty-twenty twentytwenty-container">

 <!-- The before image is first -->
 <img src="<?php echo $settings->photo_one_src; ?>" />
 <!-- The after image is last -->
 <img src="<?php echo $settings->photo_two_src; ?>" />
</div>
```
This will be the HTML outputted by the module when it is inserted into a layout.

As you can see it simply creates a div with the two classes `fl-twenty-twenty twentytwenty-container` and includes the two images using the settings we previously registered.

The jQuery plugin will do the rest.

# Module frontend.js.php

Now we need to add the jQuery snippet needed to make all this work.

We use a `frontend.js.php` file in the includes folder with the following code.
```
jQuery(function($) {
	$('.fl-node-<?php echo $id; ?> .fl-twenty-twenty').twentytwenty();
});
```

# Conclusion
We have created a WP plugin from scratch and added all the files needed to get a Beaver Builder module working.

You should now be able to activate your new plugin in WP admin then add your new module to a page.

# Resources

Jquery TwentyTwenty https://github.com/zurb/twentytwenty

Custom module developer guide http://kb.wpbeaverbuilder.com/article/124-custom-module-developer-guide

This module working example https://github.com/Pross/custom-module-example-twentytwenty

BeaverBuilder KB tutorial https://kb.wpbeaverbuilder.com/article/578-create-a-module-plugin-with-a-jquery-plugin
