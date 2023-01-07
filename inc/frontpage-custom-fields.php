<?php

/*-------------------------------------*\
  FRONT PAGE ACF FIELDS
\*-------------------------------------*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_63b9805dc26d1',
	'title' => 'Voorpagina-links',
	'fields' => array(
		array(
			'key' => 'field_63b980993287c',
			'label' => 'Links',
			'name' => 'links',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'table',
			'pagination' => 0,
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Nieuwe regel',
			'rows_per_page' => 20,
			'sub_fields' => array(
				array(
					'key' => 'field_63b9805d3287a',
					'label' => 'Link-tekst',
					'name' => 'link-text',
					'type' => 'text',
					'instructions' => 'Gebruik <code>&lt;strong>&lt;/strong></code> als je tekst dikgedrukt wil maken.',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_63b980993287c',
				),
				array(
					'key' => 'field_63b980783287b',
					'label' => 'URL',
					'name' => 'url',
					'type' => 'url',
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
					'parent_repeater' => 'field_63b980993287c',
				),
				array(
					'key' => 'field_63b980f4b900c',
					'label' => 'Uitgelicht',
					'name' => 'highlight',
					'type' => 'true_false',
					'instructions' => 'Dan krijgt ’ie een groene achtergrond en valt iets meer op.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => 'Uitgelicht',
					'default_value' => 0,
					'ui_on_text' => 'Ja',
					'ui_off_text' => 'Nee',
					'ui' => 1,
					'parent_repeater' => 'field_63b980993287c',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_type',
				'operator' => '==',
				'value' => 'front_page',
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