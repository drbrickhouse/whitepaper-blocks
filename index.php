<?php

/*
* Plugin Name: WhitePaper Blocks
* Description: Provides useful custom blocks for Gutenberg to be used with the WhitePaper theme
* Version: 2.0.0
* Author: Dillon Brickhouse
* Author URI: drbrickhouse.com
*/

defined( 'ABSPATH' ) || exit;

// Render callback functions - these call the template files
function whitepaper_loop_block_render($attributes) {
	ob_start();
	require( 'templates/loop-block.php' );
	$output = ob_get_clean();

	return $output;
}

function whitepaper_carousel_block_render($attributes) {
	ob_start();
	require( 'templates/carousel-block.php' );
	$output = ob_get_clean();

	return $output;
}

// Registering the blocks
function whitepaper_register_blocks($attributes) {
	//Enqueue Block Scripts
	wp_register_script( 'whitepaper-blocks-js', plugins_url( '/build/blocks.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ), true );

	wp_register_style( 'whitepaper-block-editor-css', plugins_url( '/build/styles/whitepaper-blocks-editor.css', __FILE__ ), array( 'wp-edit-blocks' ));

	//Register Blocks
	register_block_type(
      'whitepaper-blocks/loop-block',
      array(
					'editor_script' => 'whitepaper-blocks-js',
          'attributes' => array(
						'blockId' => array(
							'type' => 'string',
							'default' => null
						),
						'title' => array(
							'type' => 'string',
							'default' => null
						),
						'postType' => array(
							'type' => 'string',
							'default' => 'post'
						),
						'numPosts' => array(
							'type' => 'number',
							'default' => 3
						),
						'postClasses' => array(
							'type' => 'string',
							'default' => 'col-12'
						),
						'beforeLoopLayout' => array(
							'type' => 'string',
							'default' => null
						),
						'postLayout' => array(
							'type' => 'string',
							'default' => null
						),
						'afterLoopLayout' => array(
							'type' => 'string',
							'default' => null
						),
						'taxonomy' => array(
							'type' => 'string',
							'default' => null
						),
						'taxonomyTerm' => array(
							'type' => 'string',
							'default' => null
						),
						'offset' => array(
							'type' => 'number',
							'default' => 0
						),
						'className' => array(
							'type' => 'string',
						)
          ),
          'render_callback' => 'whitepaper_loop_block_render',
      )
  );

	register_block_type(
      'whitepaper-blocks/carousel-block',
      array(
					'editor_script' => 'whitepaper-blocks-js',
          'attributes' => array(
						'blockId' => array(
							'type' => 'string',
							'default' => null
						),
						'carouselClasses' => array(
							'type' => 'string',
							'default' => 'row no-gutters'
						),
						'postType' => array(
							'type' => 'string',
							'default' => 'post'
						),
						'numPosts' => array(
							'type' => 'number',
							'default' => 3
						),
						'postClasses' => array(
							'type' => 'string',
							'default' => null
						),
						'carouselLayout' => array(
							'type' => 'string',
							'default' => null
						),
						'carouselIndicators' => array(
							'type' => 'boolean',
							'default' => false
						),
						'carouselControls' => array(
							'type' => 'boolean',
							'default' => false
						),
						'taxonomy' => array(
							'type' => 'string',
							'default' => null
						),
						'taxonomyTerm' => array(
							'type' => 'string',
							'default' => null
						),
						'className' => array(
							'type' => 'string'
						)
          ),
          'render_callback' => 'whitepaper_carousel_block_render',
      )
  );

	register_block_type(
		'whitepaper-blocks/wrapper-block',
		array(
			'editor_script' => 'whitepaper-blocks-js',
			'editor_style' => 'whitepaper-block-editor-css',
		)
	);
	register_block_type(
		'whitepaper-blocks/hero-block',
		array(
			'editor_script' => 'whitepaper-blocks-js',
			'editor_style' => 'whitepaper-block-editor-css',
		)
	);
}

// Hook above funtions into init
add_action( 'init', 'whitepaper_register_blocks' );

require_once __DIR__ . '/whitepaper-blocks-functions.php';
?>
