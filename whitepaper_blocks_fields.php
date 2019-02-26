<?php
function whitepaper_blocks_register_fields() {
	if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5c744b5e93e4e',
		'title' => 'WhitePaper Blocks: Loop',
		'fields' => array(
			array(
				'key' => 'field_5c744b7df70a1',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c744babf70a2',
				'label' => 'Block ID',
				'name' => 'block_id',
				'type' => 'text',
				'instructions' => 'A unique CSS ID for this block. Make sure to use all lower case and dashes instead of spaces',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c744ca5f70a4',
				'label' => 'Post Type',
				'name' => 'post_type',
				'type' => 'select',
				'instructions' => 'What kind of posts do you want to show? You can choose blog posts, pages, or a custom post type.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'post' => 'post',
					'page' => 'page',
					'attachment' => 'attachment',
				),
				'default_value' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'return_format' => 'value',
				'ajax' => 0,
				'placeholder' => '',
			),
			array(
				'key' => 'field_5c744c1ff70a3',
				'label' => 'Number of Posts to Display',
				'name' => 'num_posts',
				'type' => 'number',
				'instructions' => 'The maximum number of posts to be displayed from your selected post type',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => 1,
			),
			array(
				'key' => 'field_5c744f5af70a5',
				'label' => 'Post Classes',
				'name' => 'post_class',
				'type' => 'text',
				'instructions' => 'One or more CSS classes to be added to each post in this block. Separate classes with a space, but make sure that each class uses all lower case and dashes instead of spaces.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5c744ff7f70a6',
				'label' => 'Before Loop',
				'name' => 'before_loop_layout',
				'type' => 'textarea',
				'instructions' => 'Information to be placed before the loop. This will only be shown once, no matter how many posts are displayed. You can use HTML and Boostrap for formatting. You can also use handlebar codes to display dynamic information. This section is totally optional.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 16,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5c74514ef70a7',
				'label' => 'Post Layout',
				'name' => 'post_layout',
				'type' => 'textarea',
				'instructions' => 'How would you like the individual posts in the loop to be laid out? You can use HTML and Boostrap for formatting. You can also use handlebar codes to display dynamic information. If you aren\'t sure, you can leave this blank and just use the default.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 16,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5c745248f70a8',
				'label' => 'After Loop',
				'name' => 'after_loop_layout',
				'type' => 'textarea',
				'instructions' => 'Information to be placed after the loop. This will only be shown once, no matter how many posts are displayed. You can use HTML and Boostrap for formatting. You can also use handlebar codes to display dynamic information. This section is totally optional.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 16,
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/loop',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	endif;
}

add_action('acf/init', 'whitepaper_blocks_register_fields');

/************ Load Choices for Post Type Field ******************/
function whitepaper_choice_generator( $field ) {
    //Change this to whatever data you are using.

    $field['choices'] = array();

    //Loop through whatever data you are using, and assign a key/value
		$types = get_post_types( array( 'public' => true, '_builtin' => true ) );
    foreach($types as $type) {
        $field['choices'][$type] = $type;
    }
    return $field;
}
add_filter('acf/load_field/name=post_type', 'whitepaper_choice_generator');
?>
