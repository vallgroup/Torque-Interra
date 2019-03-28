<?php

class Interra_Staff_CPT {

  public static $STAFF_ROLE_TAX_SLUG = 'torque_staff_role';

  public function __construct() {
    add_action( 'init', array( $this, 'add_staff_taxonomies' ) );
    add_action('acf/init', array( $this, 'add_acf_metaboxes' ) );
    add_filter( Torque_Staff_CPT::$STAFF_METABOXES_FILTER_HOOK, array( $this, 'exclude_metaboxes' ) );
  }

  public function add_staff_taxonomies() {
    register_taxonomy(
      self::$STAFF_ROLE_TAX_SLUG,
      Torque_Staff_CPT::$staff_labels['post_type_name'],
      array(
        'label'        => 'Roles',
        'labels'       => array(
          'singular_name'   => 'Role'
        ),
        'hierarchical' => true,
      )
    );
  }

  public function exclude_metaboxes() {

    return array('role');
  }

  public function add_acf_metaboxes() {
    if( function_exists('acf_add_local_field_group') ):

      acf_add_local_field_group(array(
      	'key' => 'group_5c9d4fca4fc93',
      	'title' => 'User Relationship',
      	'fields' => array(
      		array(
      			'key' => 'field_5c9d4fd222c78',
      			'label' => 'User',
      			'name' => 'user',
      			'type' => 'user',
      			'instructions' => 'Pick a WP user to associate with this staff member. This allows us to display a staff member\'s blog posts by checking the author.',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'role' => '',
      			'allow_null' => 0,
      			'multiple' => 0,
      			'return_format' => 'id',
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'torque_staff',
      			),
      		),
      	),
      	'menu_order' => 5,
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
