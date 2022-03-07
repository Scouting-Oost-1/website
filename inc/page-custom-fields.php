<?php

/*-------------------------------------*\
  PAGE ACF FIELDS
\*-------------------------------------*/
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e03c5fa1f249',
	'title' => 'Pagina-kleur',
	'fields' => array(
		array(
			'key' => 'field_5e03c61c326c4',
			'label' => 'Kleur',
			'name' => 'palette_color',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'full-color' => 'Alle kleuren',
				'cyan' => 'Cyaan',
				'green' => 'Groen',
				'yellow' => 'Geel',
				'orange' => 'Oranje',
				'red' => 'Rood',
				'blue' => 'Blauw',
				'pink' => 'Roze',
				'purple' => 'Paars',
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
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
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
