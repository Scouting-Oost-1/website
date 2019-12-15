<?php

/*-------------------------------------*\
  ACTIVITY POST TYPE ACF FIELDS
\*-------------------------------------*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5df63caf49bf9',
	'title' => 'Datum, tijd en plaats',
	'fields' => array(
		array(
			'key' => 'field_5df68c5608b5a',
			'label' => 'Tonen',
			'name' => 'show_date',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_5df63e01df9bf',
			'label' => 'Eerstvolgende begindatum',
			'name' => 'date_upcoming',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '100',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'j F Y',
			'first_day' => 1,
		),
		array(
			'key' => 'field_5df63eb0df9c0',
			'label' => 'Eerstvolgende einddatum',
			'name' => 'date_upcoming_end',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5df63e01df9bf',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '34',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'j F Y',
			'first_day' => 1,
		),
		array(
			'key' => 'field_5df63ee6df9c1',
			'label' => 'Eerstvolgende begintijd',
			'name' => 'time_upcoming',
			'type' => 'time_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5df63e01df9bf',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'H:i',
			'return_format' => 'H:i',
		),
		array(
			'key' => 'field_5df63f1fdf9c2',
			'label' => 'Eerstvolgende eindtijd',
			'name' => 'time_upcoming_end',
			'type' => 'time_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5df63ee6df9c1',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'H:i',
			'return_format' => 'H:i',
		),
		array(
			'key' => 'field_5df6401cb7572',
			'label' => 'Eerstvolgende of permanente locatie',
			'name' => 'location_upcoming',
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
			'key' => 'field_5df63f5e1ce57',
			'label' => 'Vorige begindatum',
			'name' => 'date_last',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '34',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'j F Y',
			'first_day' => 1,
		),
		array(
			'key' => 'field_5df63f851ce59',
			'label' => 'Vorige einddatum',
			'name' => 'date_last_end',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5df63f5e1ce57',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'j F Y',
			'first_day' => 1,
		),
		array(
			'key' => 'field_5df64067b7573',
			'label' => 'Vorige locatie',
			'name' => 'location_last',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5df63f5e1ce57',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
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
				'value' => 'activity',
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

acf_add_local_field_group(array(
	'key' => 'group_5df6634803df2',
	'title' => 'Foto’s',
	'fields' => array(
		array(
			'key' => 'field_5df66350351bf',
			'label' => 'Foto’s',
			'name' => 'foto’s',
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
			'preview_size' => 'medium',
			'insert' => 'append',
			'library' => 'all',
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
				'value' => 'activity',
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
));

endif;
