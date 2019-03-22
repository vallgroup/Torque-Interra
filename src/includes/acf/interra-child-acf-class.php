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
      	'key' => 'group_5c9519163d799',
      	'title' => 'Modules',
      	'fields' => array(
      		array(
      			'key' => 'field_5c951924e250c',
      			'label' => 'Modules',
      			'name' => 'modules',
      			'type' => 'flexible_content',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'layouts' => array(
      				'5c95192ad0ff0' => array(
      					'key' => '5c95192ad0ff0',
      					'name' => 'post_slideshow',
      					'label' => 'Post Slideshow',
      					'display' => 'block',
      					'sub_fields' => array(
      						array(
      							'key' => 'field_5c951939e250d',
      							'label' => 'Slideshow',
      							'name' => 'slideshow_id',
      							'type' => 'post_object',
      							'instructions' => '',
      							'required' => 1,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'post_type' => array(
      								0 => 'torque_post_ss',
      							),
      							'taxonomy' => array(
      							),
      							'allow_null' => 0,
      							'multiple' => 0,
      							'return_format' => 'id',
      							'ui' => 1,
      						),
      					),
      					'min' => '',
      					'max' => '',
      				),
      			),
      			'button_label' => 'Add Module',
      			'min' => '',
      			'max' => '',
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
      	'active' => 1,
      	'description' => '',
      ));

      endif;
  }
}

?>
