<?php

/*-------------------------------------*\
  PHOTOALBUM POST TYPE ACF FIELDS
\*-------------------------------------*/
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_62890f2456569',
		'title' => 'Fotoalbums',
		'fields' => array(
			array(
				'key' => 'field_62890f376c21b',
				'label' => 'Album',
				'name' => 'album',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'insert' => 'prepend',
				'library' => 'uploadedTo',
				'min' => '',
				'max' => '',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'photoalbum',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));
	
endif;
