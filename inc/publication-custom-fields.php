<?php

/*-------------------------------------*\
  PUBLICATION POST TYPE ACF FIELDS
\*-------------------------------------*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e036110653ab',
	'title' => 'Eigenschappen',
	'fields' => array(
		array(
			'key' => 'field_5e036119a5e74',
			'label' => 'PDF',
			'name' => 'pdf',
			'type' => 'file',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'pdf',
		),
		array(
			'key' => 'field_5e03c22f4615b',
			'label' => 'Editie-kleur',
			'name' => 'page-bg',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'publication',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'excerpt',
		2 => 'discussion',
		3 => 'comments',
	),
	'active' => true,
	'description' => '',
));

endif;
