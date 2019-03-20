<?php

require_once( get_template_directory() . '/includes/acf/torque-acf-search-class.php' );

class Interra_ACF {

  public function __construct() {
    add_action('admin_init', array( $this, 'acf_admin_init'), 99);
    add_action('acf/init', array( $this, 'acf_init' ) );

    // hide acf in admin - client doesnt need to see this
    // add_filter('acf/settings/show_admin', '__return_false');

    // add acf fields to wp search
    if ( class_exists( 'Torque_ACF_Search' ) ) {
      add_filter( Torque_ACF_Search::$ACF_SEARCHABLE_FIELDS_FILTER_HANDLE, array( $this, 'add_fields_to_search' ) );
    }
  }

  public function acf_admin_init() {
    // hide options page
    // remove_menu_page('acf-options');
  }

  public function add_fields_to_search( $fields ) {
    // $fields[] = 'custom_field_name';
    return $fields;
  }

  public function acf_init() {
    if( function_exists('acf_add_local_field_group') ):

      acf_add_local_field_group(array(
      	'key' => 'group_5c8ae912b0625',
      	'title' => 'Listing Details',
      	'fields' => array(
      		array(
      			'key' => 'field_5c8ae924ce1a3',
      			'label' => 'Status',
      			'name' => 'listing_status',
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
      				'available' => 'Available',
      				'under_contract' => 'Under Contract',
      				'closed' => 'Closed',
      			),
      			'default_value' => array(
      				0 => 'available',
      			),
      			'allow_null' => 0,
      			'multiple' => 0,
      			'ui' => 0,
      			'return_format' => 'value',
      			'ajax' => 0,
      			'placeholder' => '',
      		),
      		array(
      			'key' => 'field_5c8ae9c7c08e3',
      			'label' => 'Brokers',
      			'name' => 'listing_brokers',
      			'type' => 'relationship',
      			'instructions' => '',
      			'required' => 1,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'post_type' => array(
      				0 => 'torque_staff',
      			),
      			'taxonomy' => array(
      				0 => 'torque_staff_role:broker',
      			),
      			'filters' => '',
      			'elements' => array(
      				0 => 'featured_image',
      			),
      			'min' => '',
      			'max' => '',
      			'return_format' => 'object',
      		),
      		array(
      			'key' => 'field_5c914327782ee',
      			'label' => 'City',
      			'name' => 'listing_city',
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
      			'key' => 'field_5c8aea4494450',
      			'label' => 'Key Details',
      			'name' => 'key_details',
      			'type' => 'repeater',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'collapsed' => '',
      			'min' => 0,
      			'max' => 0,
      			'layout' => 'table',
      			'button_label' => 'Add Detail',
      			'sub_fields' => array(
      				array(
      					'key' => 'field_5c8aea7594451',
      					'label' => 'Name',
      					'name' => 'name',
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
      					'placeholder' => 'eg Price',
      					'prepend' => '',
      					'append' => '',
      					'maxlength' => '',
      				),
      				array(
      					'key' => 'field_5c8aea9a94452',
      					'label' => 'Value',
      					'name' => 'value',
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
      					'placeholder' => 'eg $xxxx.xx',
      					'prepend' => '',
      					'append' => '',
      					'maxlength' => '',
      				),
      			),
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'torque_listing',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

      acf_add_local_field_group(array(
      	'key' => 'group_5c8aead89dd35',
      	'title' => 'Listing Media',
      	'fields' => array(
      		array(
      			'key' => 'field_5c8aeae148120',
      			'label' => 'Additional Images',
      			'name' => 'listing_images',
      			'type' => 'repeater',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'collapsed' => 'field_5c8aeb0748121',
      			'min' => 0,
      			'max' => 0,
      			'layout' => 'row',
      			'button_label' => 'Add Image',
      			'sub_fields' => array(
      				array(
      					'key' => 'field_5c8aeb0748121',
      					'label' => 'Image',
      					'name' => 'image',
      					'type' => 'image',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'return_format' => 'url',
      					'preview_size' => 'thumbnail',
      					'library' => 'all',
      					'min_width' => '',
      					'min_height' => '',
      					'min_size' => '',
      					'max_width' => '',
      					'max_height' => '',
      					'max_size' => '',
      					'mime_types' => '',
      				),
      			),
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'torque_listing',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

      endif;
  }
}

?>
