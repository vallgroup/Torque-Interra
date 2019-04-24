<?php

class Interra_Roles {

  public function __construct() {
    add_action('init', array($this, 'add_broker'));
    add_action('init', array($this, 'add_manager'));
  }

  public function add_broker() {
    $parent_role = get_role( 'editor' );
    add_role(
      'broker',
      'Broker',
      array_merge(
        $parent_role->capabilities,
        array() // override capabilities
      )
    );
  }

  public function add_manager() {
    $parent_role = get_role( 'administrator' );
    add_role(
      'manager',
      'Manager',
      array_merge(
        $parent_role->capabilities,
        array() // override capabilities
      )
    );
  }
}

?>
