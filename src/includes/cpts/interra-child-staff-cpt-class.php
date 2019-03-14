<?php

class Interra_Staff_CPT {

  public static $STAFF_ROLE_TAX_SLUG = 'torque_staff_role';

  public function __construct() {
    add_action( 'init', array( $this, 'add_staff_taxonomies' ) );
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
}

?>
