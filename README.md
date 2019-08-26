# WhitePaper Blocks
_A gutenberg block suite made to be used in conjunction with the [WhitePaper](https://github.com/drbrickhouse/whitepaper/) WordPress theme. Created by [Dillon Brickhouse](https://drbrickhouse.com/)_

## Is this plugin for you?
Just like the WhitePaper theme, this block suite is built for the power user. It includes no front-end styling except what is provided by Bootstrap.

In order to use this plugin you must be running either the WhitePaper theme or another theme that includes Bootstrap 4. Bootstrap itself is not included on the front end with these plugins in order to avoid adding unnecessary weight to a theme that may already include it, therefore you must use a theme that includes it, or enqueue it yourself.

## Installation
The repository for this project does not include pre-built files. To use this plugin, you must build it. In order to do so, ensure that you have NPM installed on your machine and follow these steps after downloading the project.

1. Open a terminal and navigate into the project folder.
2. Run `npm install`
3. Run `npm run build`

You will now see a .zip file in your project. You may upload this zip file to WordPress as you would with any other plugin and activate it.

## WhitePaper Handlebars
WhitePaper Handlebars are simply a set of custom shortcodes that allow information to be dynamically inserted within a WordPress loop. A handlebar must be placed between `{{` and `}}`. Here is a list of available handlebars:

### WordPress Handlebars:
* __`{{title}}`:__ Displays the title of the current post in the loop.
* __`{{content}}`:__ Displays the full content of the current post in the loop.
* __`{{excerpt}}`:__ Displays the excerpt of the current post in the loop.
* __`{{permalink}}`:__ Displays the url of the permalink to the current post in the loop.
* __`{{featured_image}}`:__ Displays the url of the featured image of the current post in the loop.
* __`{{year}}`:__ Displays the year that current post in the loop was published.
* __`{{monthnum}}`:__ Displays the number of the month that current post in the loop was published.
* __`{{monthname}}`:__ Displays full name of the month that current post in the loop was published.
* __`{{monthabr}}`:__ Displays abbreviated name of the month that current post in the loop was published.
* __`{{day}}`:__ Displays day of the month that current post in the loop was published.
* __`{{hour}}`:__ Displays hour that current post in the loop was published (12-hour clock).
* __`{{minute}}`:__ Displays minute that current post in the loop was published.
* __`{{second}}`:__ Displays second that current post in the loop was published.
* __`{{category}}`:__ Displays the primary category of the current post in the loop.

### ACF Handlebars:
The following handlebars require the [ACF](https://wordpress.org/plugins/advanced-custom-fields/) plugin. They make use of several fields that are built into the WhitePaper theme to be used in the custom post types provided by [WhitePaper CPTs](https://github.com/drbrickhouse/whitepaper-cpts). If you are using ACF, WhitePaper, and WhitePaper CPTs, you can make use of these handlebars. Otherwise, do not use them.

* __`{{link}}`:__ Displays the url in the link field for the current post in the loop.
* __`{{icon}}`:__ Displays Font Awesome icon class field for the current post in the loop.
* __`{{staff_position}}`:__ Displays the text in the staff position field for the current post in the loop.
* __`{{email}}`:__ Displays the text in the email address field for the current post in the loop.
* __`{{phone}}`:__ Displays the text in the phone number field for the current post in the loop.

### Events Organiser Handlebars
The following handlebars require the [Event Organiser](https://wordpress.org/plugins/event-organiser/) plugin. If you are using this plugin, you can make use of these handlebars. Otherwise, do not use them.

* __`{{event_start_date}}`:__ Displays the start date for the current event in the loop.
* __`{{event_end_date}}`:__ Displays the end date for the current event in the loop.
* __`{{event_start_time}}`:__ Displays the start time for the current event in the loop.
* __`{{event_end_time}}`:__ Displays the end time for the current event in the loop.

### Custom handlebars
WhitePaper Handlebars allows you to create your own custom handlebars in your theme. In order to to so, create a folder in your root directory named `inc` and create a file inside of it called `whitepaper-custom-handlebars.php`. In that file, copy and paste the following code and then add your own switch cases:

```
function whitepaper_parse_handlebars( array $matches = array() ) {

	if (isset($matches[1])) {
		$key = strtolower( $matches[1] );

		switch ($key) {
			/* Write your own switch cases below and before the default value
			*  An example switch case is included here to get you started.
      *
      *  case 'text-to-replace':
  		*		return function_to_return();
  		*		break;
      *
      */

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
```
