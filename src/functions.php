<?php

require_once(get_stylesheet_directory() . '/includes/interra-child-nav-menus-class.php');
require_once(get_stylesheet_directory() . '/includes/widgets/interra-child-widgets-class.php');
require_once(get_stylesheet_directory() . '/includes/customizer/interra-child-customizer-class.php');
require_once(get_stylesheet_directory() . '/includes/acf/interra-child-acf-class.php');
require_once(get_stylesheet_directory() . '/includes/cpts/interra-child-listing-cpt-class.php');
require_once(get_stylesheet_directory() . '/includes/cpts/interra-child-job-application-cpt-class.php');
require_once(get_stylesheet_directory() . '/includes/interra-roles-class.php');


/**
 * Custom Roles
 */

if (class_exists('Interra_Roles')) {
  new Interra_Roles();
}

/**
 * Child Theme Nav Menus
 */

if (class_exists('Interra_Nav_Menus')) {
  new Interra_Nav_Menus();
}

/**
 * Child Theme Widgets
 */

if (class_exists('Interra_Widgets')) {
  new Interra_Widgets();
}

/**
 * Child Theme Customizer
 */

if (class_exists('Interra_Customizer')) {
  new Interra_Customizer();
}

/**
 * Child Theme ACF
 */

if (class_exists('Interra_ACF')) {
  new Interra_ACF();
}


/**
 * Listing CPT
 */
if (class_exists('Interra_Listing_CPT')) {
  new Interra_Listing_CPT();
}


/**
 * Filtered Loop plugin settings
 */

if (class_exists('Torque_Filtered_Loop') && class_exists('Torque_Filtered_Loop_Shortcode')) {
  add_filter(Torque_Filtered_Loop_Shortcode::$LOOP_TEMPLATE_FILTER_HANDLE, function () {
    return "3";
  });
}


/**
 * Careers plugin settings
 */

if (class_exists('Torque_Careers')) {
  if (class_exists('Interra_Job_Application_CPT')) {
    new Interra_Job_Application_CPT();
  }
}


/**
 * Slideshow plugin settings
 */

if (class_exists('Torque_Slideshow')) {
  add_filter(Torque_Slideshow::$USE_POST_SLIDESHOW_FILTER_HOOK, function () {
    return true;
  });

  if (class_exists('Torque_Post_Slideshow_CPT')) {
    add_filter(Torque_Post_Slideshow_CPT::$RELATIONSHIP_FIELD_FILTER_HOOK, function ($field) {

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


/**
 * Remove various CPTs from search results
 */
add_action('pre_get_posts', 'remove_ss_cpt_from_search_results');
function remove_ss_cpt_from_search_results($query)
{
  /* check is front end main loop content */
  if (is_admin() || !$query->is_main_query()) return;

  $post_types_to_remove = array();

  if (class_exists('Torque_Slideshow_CPT')) {
    $post_types_to_remove[] = Torque_Slideshow_CPT::$slideshow_labels['post_type_name'];
    if (class_exists('Torque_Post_Slideshow_CPT')) {
      $post_type_to_remove[] = Torque_Post_Slideshow_CPT::$post_slideshow_labels['post_type_name'];
    }
  }

  /* check is search result query */
  if (!empty($post_types_to_remove) && $query->is_search()) {
    foreach ($post_types_to_remove as $post_type_to_remove) {
      /* get all searchable post types */
      $searchable_post_types = get_post_types(array('exclude_from_search' => false));
      /* make sure you got the proper results, and that your post type is in the results */
      if (is_array($searchable_post_types) && in_array($post_type_to_remove, $searchable_post_types)) {
        /* remove the post type from the array */
        unset($searchable_post_types[$post_type_to_remove]);
        /* set the query to the remaining searchable post types */
        $query->set('post_type', $searchable_post_types);
      }
    }
  }
}


//excerpt length
add_filter('excerpt_length', function ($length) {
  return 20;
}, 999);




/**
 * Admin settings
 */

// remove menu items
function torque_remove_menus()
{

  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page('edit-comments.php');          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings

}
add_action('admin_menu', 'torque_remove_menus');




/**
 * Enqueues
 */

// enqueue child styles after parent styles, both style.css and main.css
// so child styles always get priority
add_action('wp_enqueue_scripts', 'torque_enqueue_child_styles');
function torque_enqueue_child_styles()
{

  $parent_style = 'parent-styles';
  $parent_main_style = 'torque-theme-styles';

  // make sure parent styles enqueued first
  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
  wp_enqueue_style($parent_main_style, get_template_directory_uri() . '/bundles/main.css');

  // enqueue child style
  wp_enqueue_style(
    'interra-child-styles',
    get_stylesheet_directory_uri() . '/bundles/main.css?ts=' . time(),
    array($parent_style, $parent_main_style),
    wp_get_theme()->get('Version')
  );
}

// enqueue child scripts after parent script
add_action('wp_enqueue_scripts', 'torque_enqueue_child_scripts');
function torque_enqueue_child_scripts()
{

  wp_enqueue_script(
    'interra-child-script',
    get_stylesheet_directory_uri() . '/bundles/bundle.js',
    array('torque-theme-scripts'), // depends on parent script
    wp_get_theme()->get('Version'),
    true       // put it in the footer
  );
}


/**
 * Customise the Jetpack 'Successful Submission' message
 */
add_filter('grunion_contact_form_success_message', 'jetpackcom_contact_confirmation');
function jetpackcom_contact_confirmation()
{
  // Add new confirmation message here:
  $conf = __('<div class="contact-form-success-message">Thank you for your message!</div>', 'plugin-textdomain');
  return $conf;
}


/**
 * Update author slug to 'team'
 */
add_action('init', 'update_author_slug');
function update_author_slug()
{
  global $wp_rewrite;
  $author_slug = 'team'; // change slug name
  $wp_rewrite->author_base = $author_slug;
}


/**
 * Initialise ACF Social Media Options for theme
 */
add_action('acf/init', 'add_social_media_options_acf');
function add_social_media_options_acf()
{
  if (function_exists('acf_add_local_field_group')):

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
              'default_value' => array(),
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

add_action('acf/init', 'default_hero_options_acf');
function default_hero_options_acf()
{
  if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
      'key' => 'group_68926ed4be691',
      'title' => 'Default hero',
      'fields' => array(
        array(
          'key' => 'field_5c954a9886085',
          'label' => 'Type',
          'name' => 'hero_type',
          'type' => 'radio',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'none' => 'None',
            'image' => 'Image',
            'image_slideshow' => 'Image Slideshow',
            'video' => 'Video',
          ),
          'allow_null' => 0,
          'other_choice' => 0,
          'default_value' => 'image',
          'layout' => 'horizontal',
          'return_format' => 'value',
          'save_other_choice' => 0,
        ),
        array(
          'key' => 'field_5c954ac486086',
          'label' => 'Image',
          'name' => 'hero_image',
          'type' => 'image',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_5c954a9886085',
                'operator' => '==',
                'value' => 'image',
              ),
            ),
          ),
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
        array(
          'key' => 'field_5c954ae486087',
          'label' => 'Image Slideshow',
          'name' => 'hero_image_slideshow',
          'type' => 'post_object',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_5c954a9886085',
                'operator' => '==',
                'value' => 'image_slideshow',
              ),
            ),
          ),
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array(
            0 => 'torque_slideshow',
          ),
          'taxonomy' => array(),
          'allow_null' => 0,
          'multiple' => 0,
          'return_format' => 'id',
          'ui' => 1,
        ),
        array(
          'key' => 'field_5c954e7f5e0fc',
          'label' => 'Video Src',
          'name' => 'hero_video_src',
          'type' => 'file',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_5c954a9886085',
                'operator' => '==',
                'value' => 'video',
              ),
            ),
          ),
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'return_format' => 'url',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),

        array(
          'key' => 'field_5c954e7f5e0fe',
          'label' => 'Video Src Full',
          'name' => 'hero_video_src_full',
          'type' => 'file',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_5c954a9886085',
                'operator' => '==',
                'value' => 'video',
              ),
            ),
          ),
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'return_format' => 'url',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
        array(
          'key' => 'field_5c954ac48608a',
          'label' => 'Video Image Poster',
          'name' => 'hero_video_poster',
          'type' => 'image',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => array(
            array(
              array(
                'field' => 'field_5c954a9886085',
                'operator' => '==',
                'value' => 'video',
              ),
            ),
          ),
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
        array(
          'key' => 'field_5c954bb12e42b',
          'label' => 'Overlay Title',
          'name' => 'hero_overlay_title',
          'type' => 'text',
          'instructions' => 'use em tags to emphasise certain words',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => 'eg <em>Emphasised text</em> in title',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
        array(
          'key' => 'field_5c954be22e42c',
          'label' => 'Overlay Subtitle',
          'name' => 'hero_overlay_subtitle',
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

if ( isset($_GET['run_listing_author_import']) ) {
  require_once( get_stylesheet_directory() . '/import_data/import.php' );

  add_action('init', function() {
    interra_update_listings_with_authors();
  });
}

if ( isset($_GET['run_blog_post_content_update']) ) {
  require_once( get_stylesheet_directory() . '/import_data/import.php' );

  add_action('init', function() {
    interra_update_blog_post_content();
  });
}
*/
