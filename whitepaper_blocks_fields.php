<?php
function whitepaper_blocks_register_fields() {
	acf_add_local_field_group(array(
		'key' => 'group_5c3b9ab613d1c',
		'title' => 'WhitePaper Blocks: Loop',
		'fields' => array(
			array(
				'key' => 'field_5c3bb44cb51cf',
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
				'key' => 'field_5c3bb3f9b51ce',
				'label' => 'Block ID',
				'name' => 'block_id',
				'type' => 'text',
				'instructions' => '',
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
				'key' => 'field_5c3b9b17b51c8',
				'label' => 'Number of Posts to Display',
				'name' => 'num_posts',
				'type' => 'number',
				'instructions' => '',
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
				'min' => '',
				'max' => '',
				'step' => '',
			),
			array(
				'key' => 'field_5c3b9c61b51c9',
				'label' => 'Post Type',
				'name' => 'post_type',
				'type' => 'select',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
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
				'key' => 'field_5c3b9edbb51ca',
				'label' => 'Post Classes',
				'name' => 'post_class',
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
				'key' => 'field_5c3b9f1bb51cb',
				'label' => 'Before Loop Layout',
				'name' => 'before_loop_layout',
				'type' => 'textarea',
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
				'maxlength' => '',
				'rows' => 10,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5c3b9f7eb51cc',
				'label' => 'Post Layout',
				'name' => 'post_layout',
				'type' => 'textarea',
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
				'maxlength' => '',
				'rows' => 16,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5c3b9fd2b51cd',
				'label' => 'After Loop Layout',
				'name' => 'after_loop_layout',
				'type' => 'textarea',
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
				'maxlength' => '',
				'rows' => 10,
				'new_lines' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
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
}

add_action('acf/init', 'whitepaper_blocks_register_fields');
/************ Load Choices for Post Type Field ******************/
function whitepaper_choice_generator( $field ) {
    //Change this to whatever data you are using.

    $field['choices'] = array();

    //Loop through whatever data you are using, and assign a key/value
		global $post_types;
    foreach($post_types as $type) {
        $field['choices'][$type] = $type;
    }
    return $field;
}
add_filter('acf/load_field/name=post_type', 'whitepaper_choice_generator');
?>
