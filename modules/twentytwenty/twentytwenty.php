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
