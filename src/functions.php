<?php

require_once( get_stylesheet_directory() . '/includes/interra-child-nav-menus-class.php');
require_once( get_stylesheet_directory() . '/includes/widgets/interra-child-widgets-class.php');
require_once( get_stylesheet_directory() . '/includes/customizer/interra-child-customizer-class.php');
require_once( get_stylesheet_directory() . '/includes/acf/interra-child-acf-class.php');
require_once( get_stylesheet_directory() . '/includes/cpts/interra-child-staff-cpt-class.php');
require_once( get_stylesheet_directory() . '/includes/cpts/interra-child-listing-cpt-class.php');
require_once( get_stylesheet_directory() . '/includes/cpts/interra-child-job-application-cpt-class.php');

/**
 * Child Theme Nav Menus
 */

 if ( class_exists( 'Interra_Nav_Menus' ) ) {
   new Interra_Nav_Menus();
 }

/**
 * Child Theme Widgets
 */

if ( class_exists( 'Interra_Widgets' ) ) {
  new Interra_Widgets();
}

/**
 * Child Theme Customizer
 */

if ( class_exists( 'Interra_Customizer' ) ) {
  new Interra_Customizer();
}

/**
 * Child Theme ACF
 */

 if ( class_exists( 'Interra_ACF' ) ) {
   new Interra_ACF();
 }



/**
 * Torque Staff Extras
 */
if ( class_exists( 'Torque_Staff_CPT' ) && class_exists( 'Interra_Staff_CPT' ) ) {
  new Interra_Staff_CPT();
}

/**
 * Listing CPT
 */
if ( class_exists( 'Interra_Listing_CPT' ) ) {
  new Interra_Listing_CPT();
}


/**
 * Filtered Loop plugin settings
 */

if ( class_exists( 'Torque_Filtered_Loop' ) && class_exists( 'Torque_Filtered_Loop_Shortcode' ) ) {
  add_filter( Torque_Filtered_Loop_Shortcode::$LOOP_TEMPLATE_FILTER_HANDLE, function() { return "2"; } );
}


/**
 * Careers plugin settings
 */

if ( class_exists( 'Torque_Careers' ) ) {
  if ( class_exists( 'Interra_Job_Application_CPT' ) ) {
    new Interra_Job_Application_CPT();
  }
}


/**
* Slideshow plugin settings
*/

if ( class_exists( 'Torque_Slideshow' ) ) {
  add_filter( Torque_Slideshow::$USE_POST_SLIDESHOW_FILTER_HOOK, function() { return true; });

  if ( class_exists( 'Torque_Post_Slideshow_CPT' ) ) {
    add_filter( Torque_Post_Slideshow_CPT::$RELATIONSHIP_FIELD_FILTER_HOOK, function($field) {

      $field['post_type'] = array(
        0 => Interra_Listing_CPT::$listing_labels['post_type_name'],
      );

      $field['filters'] = array(
        0 => 'post_type',
      );

      return $field;
    });
  }
}




//excerpt length
add_filter( 'excerpt_length', function( $length ) {
  return 20;
}, 999 );




// vcard support
add_filter('upload_mimes', function ($mime_types){
  $mime_types['vcf'] = 'text/vcard';
  $mime_types['vcard'] = 'text/vcard';
  return $mime_types;
}, 1, 1);


/**
 * Admin settings
 */

 // remove menu items
 function torque_remove_menus(){

   //remove_menu_page( 'index.php' );                  //Dashboard
   //remove_menu_page( 'edit.php' );                   //Posts
   //remove_menu_page( 'upload.php' );                 //Media
   //remove_menu_page( 'edit.php?post_type=page' );    //Pages
   remove_menu_page( 'edit-comments.php' );          //Comments
   //remove_menu_page( 'themes.php' );                 //Appearance
   //remove_menu_page( 'plugins.php' );                //Plugins
   //remove_menu_page( 'users.php' );                  //Users
   //remove_menu_page( 'tools.php' );                  //Tools
   //remove_menu_page( 'options-general.php' );        //Settings

 }
 add_action( 'admin_menu', 'torque_remove_menus' );




/**
 * Enqueues
 */

// enqueue child styles after parent styles, both style.css and main.css
// so child styles always get priority
add_action( 'wp_enqueue_scripts', 'torque_enqueue_child_styles' );
function torque_enqueue_child_styles() {

    $parent_style = 'parent-styles';
    $parent_main_style = 'torque-theme-styles';

    // make sure parent styles enqueued first
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( $parent_main_style, get_template_directory_uri() . '/bundles/main.css' );

    // enqueue child style
    wp_enqueue_style( 'interra-child-styles',
        get_stylesheet_directory_uri() . '/bundles/main.css',
        array( $parent_style, $parent_main_style ),
        wp_get_theme()->get('Version')
    );
}

// enqueue child scripts after parent script
add_action( 'wp_enqueue_scripts', 'torque_enqueue_child_scripts');
function torque_enqueue_child_scripts() {

    wp_enqueue_script( 'interra-child-script',
        get_stylesheet_directory_uri() . '/bundles/bundle.js',
        array( 'torque-theme-scripts' ), // depends on parent script
        wp_get_theme()->get('Version'),
        true       // put it in the footer
    );
}

?>
