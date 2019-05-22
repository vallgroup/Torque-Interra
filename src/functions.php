<?php

require_once( get_stylesheet_directory() . '/includes/interra-child-nav-menus-class.php');
require_once( get_stylesheet_directory() . '/includes/widgets/interra-child-widgets-class.php');
require_once( get_stylesheet_directory() . '/includes/customizer/interra-child-customizer-class.php');
require_once( get_stylesheet_directory() . '/includes/acf/interra-child-acf-class.php');
require_once( get_stylesheet_directory() . '/includes/cpts/interra-child-listing-cpt-class.php');
require_once( get_stylesheet_directory() . '/includes/cpts/interra-child-job-application-cpt-class.php');
require_once( get_stylesheet_directory() . '/includes/interra-roles-class.php');


/**
 * Custom Roles
 */

if ( class_exists( 'Interra_Roles' ) ) {
  new Interra_Roles();
}

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


/**
 * Customise the Jetpack 'Successful Submission' message
 */
add_filter( 'grunion_contact_form_success_message', 'jetpackcom_contact_confirmation' );
function jetpackcom_contact_confirmation() {
  // Add new confirmation message here:
  $conf = __( '<div class="contact-form-success-message">Thank you for your message!</div>', 'plugin-textdomain' );
  return $conf;
}


/**
 * Update author slug to 'team'
 */
add_action('init', 'update_author_slug');
function update_author_slug() {
    global $wp_rewrite;
    $author_slug = 'team'; // change slug name
    $wp_rewrite->author_base = $author_slug;
}


/**
 * Initialise ACF Social Media Options for theme
 */
add_action('acf/init', 'add_social_media_options_acf');
function add_social_media_options_acf() {
  if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
      'key' => 'group_5ce3438132e73',
      'title' => 'Social Media',
      'fields' => array(
        array(
          'key' => 'field_5ce34402d4dab',
          'label' => 'Social Media',
          'name' => 'social_media',
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
          'button_label' => '',
          'sub_fields' => array(
            array(
              'key' => 'field_5ce34426d4dac',
              'label' => 'Social Channel',
              'name' => 'social_channel',
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
                'twitter' => 'Twitter',
                'linkedin' => 'LinkedIn',
                'instagram' => 'Instagram',
                'facebook' => 'Facebook',
                'youtube' => 'YouTube',
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
            array(
              'key' => 'field_5ce34444d4dad',
              'label' => 'Social URL',
              'name' => 'social_url',
              'type' => 'url',
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
            ),
          ),
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'options_page',
            'operator' => '==',
            'value' => 'acf-options',
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


/*
if ( isset($_GET['run_user_import']) ) {
  require_once( get_stylesheet_directory() . '/import_data/import.php' );

  add_action('init', function() {
    interra_insert_users();
  });
}

if ( isset($_GET['run_listings_import']) ) {
  require_once( get_stylesheet_directory() . '/import_data/import.php' );

  add_action('init', function() {
    interra_insert_listings();
  });
}

if ( isset($_GET['run_posts_import']) ) {
  require_once( get_stylesheet_directory() . '/import_data/import.php' );

  add_action('init', function() {
    interra_insert_blog_posts();
  });
}

if ( isset($_GET['remove_duplicates']) ) {
  require_once( get_stylesheet_directory() . '/import_data/import.php' );

  add_action('init', function() {
    interra_remove_duplicates();
  });
}
*/

?>
