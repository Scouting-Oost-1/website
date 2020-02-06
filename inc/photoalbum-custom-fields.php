<?php

/*-------------------------------------*\
  PHOTOALBUM POST TYPE ACF FIELDS
\*-------------------------------------*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e3c6c1e9c1d8',
	'title' => 'Photoalbum',
	'fields' => array(
		array(
			'key' => 'field_5e3c6c2712f59',
			'label' => 'Flickr album ID',
			'name' => 'flickr_album_id',
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
			'placeholder' => 72157712542914493,
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
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
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
