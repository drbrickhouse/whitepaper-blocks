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
	}
}

add_action('acf/init', 'whitepaper_register_blocks');

/************ Render The Blocks ******************/
function whitepaper_blocks_render_callback( $block ) {

	// convert name ("acf/blockname") into path friendly slug ("blockname")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part
	//if( file_exists( 'templates/whitepaper-loop.php' ) ) {
		include( 'templates/whitepaper-loop.php' );
	//}
}

?>
