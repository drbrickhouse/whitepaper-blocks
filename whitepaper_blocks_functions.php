<?php
function whitepaper_parse_bracecodes( array $matches = array() ) {

	if (isset($matches[1])) {
		$key = strtolower( $matches[1] );

		switch ($key) {
			// Get the title of the post
			case 'title':
				return get_the_title();
				break;

			// Get the URL of the post
			case 'permalink':
				return get_permalink();
				break;

			// Get the year of the post
			case 'year':
				return get_the_time('Y');
				break;

			// Get the month of the post
			case 'monthnum':
				return get_the_time('m');
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

function whitespace_bracecodes($field) {
	$value = preg_replace_callback( '#\{(.*)\}#Ui', 'whitepaper_parse_bracecodes', $field);
	return $value;
}
?>
