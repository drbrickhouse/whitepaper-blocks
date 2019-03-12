<?php

/*
* Plugin Name: WhitePaper Blocks
* Plugin Description: Provides useful custom blocks for Gutenberg using ACF
* Version: 1.0
* Author: Dillon Brickhouse
* Author URI: drbrickhouse.com
*/

/************ Create The Fields ******************/
require( 'whitepaper_blocks_fields.php' );

/************ Register The Blocks ******************/
function whitepaper_register_blocks() {

	// Check function exists
	if( function_exists('acf_register_block') ) {

	    // Loop
	    acf_register_block(array(
	        'name'				=> 'loop',
	        'title'				=> __( 'Loop' ),
	        'description'		=> __( 'A customizable loop block.' ),
	        'render_callback'	=> 'whitepaper_blocks_render_callback',
	        'category'			=> 'formatting',
	        'icon'				=> 'controls-repeat',
	        'keywords'			=> array( 'query' ),
	    ));
			acf_register_block(array(
	        'name'				=> 'hero',
	        'title'				=> __( 'Hero' ),
	        'description'		=> __( 'A customizable hero image block.' ),
	        'render_callback'	=> 'whitepaper_blocks_render_callback',
	        'category'			=> 'formatting',
	        'icon'				=> 'slides',
	        'keywords'			=> array( 'hero', 'banner' ),
	    ));
	}
}

add_action('acf/init', 'whitepaper_register_blocks');

/************ Render The Blocks ******************/
function whitepaper_blocks_render_callback( $block ) {

	// convert name ("acf/blockname") into path friendly slug ("blockname")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part
	if( file_exists( __DIR__ . '/templates/whitepaper-' . $slug . '.php' ) ) {
		include( 'templates/whitepaper-'. $slug . '.php' );
	}
}

/*********** Traditional Blocks (Not using ACF) *********************/
function whitepaper_register_traditional_blocks() {
	// Wrapper Block
	wp_enqueue_script( 'whitepaper-blocks-wrapper-block-js', plugins_url( '/traditional-blocks/whitepaper-blocks-wrapper-build.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), true );
}

// Hook above funtion into enqueue_block_editor_assets
add_action( 'enqueue_block_editor_assets', 'whitepaper_register_traditional_blocks' );
?>
