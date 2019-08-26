<?php
// Allow users to create custom handlebars
if ( file_exists( get_stylesheet_directory() . '/inc/whitepaper-custom-handlebars.php' ) ) {
	include_once( get_stylesheet_directory() . '/inc/whitepaper-custom-handlebars.php' );
}

// Replace WhitePaper Handlebars with PHP
function whitepaper_parse_handlebars( array $matches = array() ) {

	if (isset($matches[1])) {
		$key = strtolower( $matches[1] );

		switch ($key) {
			// Get the title of the post
			case 'title':
				return get_the_title();
				break;

			// Get the post content
			case 'content':
				return get_the_content();
				break;

			// Get the post excerpt
			case 'excerpt':
				return get_the_excerpt();
				break;

			// Get the URL of the post
			case 'permalink':
				return get_permalink();
				break;

			// Get the featured image
			case 'featured_image':
				return get_the_post_thumbnail_url();
				break;

			// Get the URL of the post
			case 'link':
				return get_field( 'link', get_the_ID() );
				break;

			// Get the year of the post
			case 'year':
				return get_the_time('Y');
				break;

			// Get the month number of the post
			case 'monthnum':
				return get_the_time('m');
				break;

			// Get the month name of the post
			case 'monthname':
				return get_the_time('F');
				break;

			// Get the month abbreviation of the post
			case 'monthabr':
				return get_the_time('F');
				break;

			// Get the day of the post
			case 'day':
				return get_the_time('d');
				break;

			// Get the day of the post
			case 'hour':
				return get_the_time('H');
				break;

			// Get the day of the post
			case 'minute':
				return get_the_time('i');
				break;

			// Get the day of the post
			case 'second':
				return get_the_time('s');
				break;

			// Get the category of the post
			case 'category':
				return get_the_category();
				break;

			// Get the Font Awesome icon
			case 'icon':
				return get_field( 'font_awesome_icon_class', get_the_ID() );
				break;

			/***** Staff *****/
			// Get the FontAwesome icon
			case 'staff_position':
				return get_field( 'staff_position', get_the_ID() );
				break;

			case 'email':
				return get_field( 'email_address', get_the_ID() );
				break;

			case 'phone':
				return get_field( 'phone_number', get_the_ID() );
				break;

			/***** The following handlebars are built to work with the Events Organiser plugin *****/
			// Get the event start date
			case 'event_start_date':
				return eo_get_the_start("M j, Y");
				break;

			// Get the event end date
			case 'event_end_date':
				return eo_get_the_end("M j, Y");
				break;

			// Get the event start time
			case 'event_start_time':
				return eo_get_the_start("g:i A");
				break;

			// Get the event end time
			case 'event_end_time':
				return eo_get_the_end("g:i A");
				break;

			// default value
			default:
				if (isset($matches[0])) {
					return $matches[0];
				}
				return false;
				break;
		}

	}
	return false;
}

function whitepaper_handlebars($field) {
	$value = preg_replace_callback( '#\{{(.*)\}}#Ui', 'whitepaper_parse_handlebars', $field);
	if ( file_exists( get_stylesheet_directory() . '/inc/whitepaper-custom-handlebars.php' ) ) {
		$value = preg_replace_callback( '#\{{(.*)\}}#Ui', 'whitepaper_custom_handlebars', $value);
	}
	return $value;
}

// Creating a custom REST API endpoint containing the JSON needed to retrieve post types in the loop block (the native 'types' endpoint is not flexible enough for our purposes)
function whitepaper_public_post_types_api() {
  register_rest_route( 'whitepaper-api', '/post-types/public', array(
    'methods' => 'GET',
    'callback' => function() {
				return get_post_types(array('public' => true));
			},
  	)
	);
}

add_action( 'rest_api_init', 'whitepaper_public_post_types_api' );

// Registering Bootstrap jQuery on the backend for the carousel block
function whitepaper_register_admin_bootstrap_jquery() {
  wp_enqueue_script( 'whitepaper-bootstrap-admin-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '', true);
}

add_action( 'admin_enqueue_scripts', 'whitepaper_register_admin_bootstrap_jquery' );
?>
