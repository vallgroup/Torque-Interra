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
    $fields[] = 'hero_overlay_title';
    $fields[] = 'hero_overlay_subtitle';
    $fields[] = 'page_heading';
    $fields[] = 'page_intro';
    $fields[] = 'heading';
    $fields[] = 'content';

    return $fields;
  }

  public function acf_init() {
    if( function_exists('acf_add_local_field_group') ):

      acf_add_local_field_group(array(
      	'key' => 'group_5cc3297fda429',
      	'title' => 'Post Authors',
      	'fields' => array(
      		array(
      			'key' => 'field_5cc32988eb3b0',
      			'label' => 'Additional Authors',
      			'name' => 'post_authors',
      			'type' => 'user',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'role' => '',
      			'allow_null' => 0,
      			'multiple' => 1,
      			'return_format' => 'id',
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'post',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'side',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

      acf_add_local_field_group(array(
      	'key' => 'group_5c954a9073a65',
      	'title' => 'Page Hero',
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
      			'taxonomy' => array(
      			),
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
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'default',
      			),
      		),
          array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'contact.php',
      			),
      		),
          array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'careers.php',
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
      	'key' => 'group_5c955c2570f80',
      	'title' => 'Page Intro',
      	'fields' => array(
      		array(
      			'key' => 'field_5c955c931df7b',
      			'label' => 'Type',
      			'name' => 'page_intro_type',
      			'type' => 'radio',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'choices' => array(
      				'none' => 'None',
      				'green' => 'Green Background',
      				'white' => 'White w/ Side Graphic',
      			),
      			'allow_null' => 0,
      			'other_choice' => 0,
      			'default_value' => 'none',
      			'layout' => 'horizontal',
      			'return_format' => 'value',
      			'save_other_choice' => 0,
      		),
      		array(
      			'key' => 'field_5c955c421df79',
      			'label' => 'Heading',
      			'name' => 'page_heading',
      			'type' => 'text',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => array(
      				array(
      					array(
      						'field' => 'field_5c955c931df7b',
      						'operator' => '!=',
      						'value' => 'none',
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
      			'prepend' => '',
      			'append' => '',
      			'maxlength' => '',
      		),
      		array(
      			'key' => 'field_5c955c581df7a',
      			'label' => 'Intro',
      			'name' => 'page_intro',
      			'type' => 'textarea',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => array(
      				array(
      					array(
      						'field' => 'field_5c955c931df7b',
      						'operator' => '!=',
      						'value' => 'none',
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
      			'maxlength' => '',
      			'rows' => 4,
      			'new_lines' => 'br',
      		),
      	),
      	'location' => array(
          array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'default',
      			),
      		),
          array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'contact.php',
      			),
      		),
          array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'careers.php',
      			),
      		),
      	),
      	'menu_order' => 2,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

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
              '5c9561c747434' => array(
      					'key' => '5c9561c747434',
      					'name' => 'content_section',
      					'label' => 'Content Section',
      					'display' => 'block',
      					'sub_fields' => array(
                  array(
      							'key' => 'field_5c9563c44bc13',
      							'label' => 'Align',
      							'name' => 'align',
      							'type' => 'radio',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'choices' => array(
      								'left' => 'Left',
      								'right' => 'Right',
      							),
      							'allow_null' => 0,
      							'other_choice' => 0,
      							'default_value' => 'left',
      							'layout' => 'horizontal',
      							'return_format' => 'value',
      							'save_other_choice' => 0,
      						),
      						array(
      							'key' => 'field_5c9561e91af35',
      							'label' => 'Image',
      							'name' => 'image',
      							'type' => 'image',
      							'instructions' => '',
      							'required' => 1,
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
      						array(
      							'key' => 'field_5c95621c1af36',
      							'label' => 'Heading',
      							'name' => 'heading',
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
      							'key' => 'field_5c9562761af37',
      							'label' => 'Content',
      							'name' => 'content',
      							'type' => 'textarea',
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
      							'maxlength' => '',
      							'rows' => 5,
      							'new_lines' => 'br',
      						),
      						array(
      							'key' => 'field_5c9562871af38',
      							'label' => 'CTA',
      							'name' => 'cta',
      							'type' => 'link',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'return_format' => 'array',
      						),
      					),
      					'min' => '',
      					'max' => '',
      				),
              '5ca3cf9d6b5db' => array(
      					'key' => '5ca3cf9d6b5db',
      					'name' => 'images',
      					'label' => 'Images',
      					'display' => 'block',
      					'sub_fields' => array(
      						array(
      							'key' => 'field_5ca3cfcf5efc7',
      							'label' => 'Image 1',
      							'name' => 'image_1',
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
      						array(
      							'key' => 'field_5ca3cfe15efc8',
      							'label' => 'Image 2 Start',
      							'name' => 'image_2_start',
      							'type' => 'range',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'default_value' => '',
      							'min' => 4,
      							'max' => 12,
      							'step' => 2,
      							'prepend' => '',
      							'append' => '',
      						),
      						array(
      							'key' => 'field_5ca3d0095efc9',
      							'label' => 'Image 2',
      							'name' => 'image_2',
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
      					'min' => '',
      					'max' => '',
      				),
              'layout_5c956991bcc4b' => array(
      					'key' => 'layout_5c956991bcc4b',
      					'name' => 'cta_section',
      					'label' => 'CTA Section',
      					'display' => 'block',
      					'sub_fields' => array(
      						array(
      							'key' => 'field_5c956991bcc4c',
      							'label' => 'Heading',
      							'name' => 'heading',
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
      							'key' => 'field_5c956991bcc4d',
      							'label' => 'Content',
      							'name' => 'content',
      							'type' => 'textarea',
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
      							'maxlength' => '',
      							'rows' => 5,
      							'new_lines' => 'br',
      						),
      						array(
      							'key' => 'field_5c956991bcc4e',
      							'label' => 'CTA',
      							'name' => 'cta',
      							'type' => 'link',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'return_format' => 'array',
      						),
      					),
      					'min' => '',
      					'max' => '',
      				),
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
              '5c9ba1ad52cd2' => array(
      					'key' => '5c9ba1ad52cd2',
      					'name' => 'region_quick_search',
      					'label' => 'Region Quick Search',
      					'display' => 'block',
      					'sub_fields' => array(
                  array(
              			'key' => 'field_5cc1d309ed5e3',
              			'label' => 'Regions',
              			'name' => 'regions',
              			'type' => 'taxonomy',
              			'instructions' => '',
              			'required' => 0,
              			'conditional_logic' => 0,
              			'wrapper' => array(
              				'width' => '',
              				'class' => '',
              				'id' => '',
              			),
              			'taxonomy' => 'interra_listing_region',
              			'field_type' => 'checkbox',
              			'add_term' => 0,
              			'save_terms' => 0,
              			'load_terms' => 0,
              			'return_format' => 'id',
              			'multiple' => 0,
              			'allow_null' => 0,
              		),
      					),
      					'min' => '',
      					'max' => '',
      				),
'5c9d3f4702dde' => array(
	'key' => '5c9d3f4702dde',
	'name' => 'staff_members',
	'label' => 'Staff Members',
	'display' => 'block',
	'sub_fields' => array(
	),
	'min' => '',
	'max' => '',
),
'5c9d3f4702arg' => array(
      'key' => '5c9d3f4702arg',
      'name' => 'mailchimp_form',
      'label' => 'MailChimp Form',
      'display' => 'block',
            'sub_fields' => array(
                  array(
                        'key' => 'field_5c951939e2222',
                        'label' => 'Title',
                        'name' => 'mailchimp_title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                        ),
                        'post_type' => array(
                        ),
                        'taxonomy' => array(
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'return_format' => '',
                        'ui' => 1,
                  ),
                  array(
                        'key' => 'field_5c951939e2332',
                        'label' => 'description',
                        'name' => 'mailchimp_desc',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                              'width' => '',
                              'class' => '',
                              'id' => '',
                        ),
                        'post_type' => array(
                        ),
                        'taxonomy' => array(
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'return_format' => '',
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
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'default',
      			),
      		),
      	),
      	'menu_order' => 10,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));

      acf_add_local_field_group(array(
      	'key' => 'group_5c953fd028818',
      	'title' => 'Company Details',
      	'fields' => array(
      		array(
      			'key' => 'field_5c953fd49ef57',
      			'label' => 'Address',
      			'name' => 'address',
      			'type' => 'textarea',
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
      			'maxlength' => '',
      			'rows' => 4,
      			'new_lines' => 'br',
      		),
      		array(
      			'key' => 'field_5c953fe99ef58',
      			'label' => 'Phone',
      			'name' => 'phone',
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
      			'key' => 'field_5c953fff9ef59',
      			'label' => 'Fax',
      			'name' => 'fax',
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
      			'key' => 'field_5c9540109ef5a',
      			'label' => 'Copyright',
      			'name' => 'copyright',
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

		acf_add_local_field_group(array(
			'key' => 'group_5cd44dac63578',
			'title' => 'Staff Details',
			'fields' => array(
				array(
					'key' => 'field_5cd44dd099191',
					'label' => 'Job Titles',
					'name' => 'staff_job_titles',
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
					'button_label' => 'Add a Job Title',
					'sub_fields' => array(
						array(
							'key' => 'field_5cd44e82fd6d5',
							'label' => 'Job Title',
							'name' => 'staff_job_title',
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

      acf_add_local_field_group(array(
      	'key' => 'group_5c98f5f420ccb',
      	'title' => 'Page',
      	'fields' => array(
      		array(
      			'key' => 'field_5c98f636196b5',
      			'label' => 'Heading',
      			'name' => 'custom_template_heading',
      			'type' => 'text',
      			'instructions' => 'use em tags to emphasise works',
      			'required' => 1,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'placeholder' => 'eg <em>Green</em> heading text',
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
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'listings.php',
      			),
      		),
          array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      			array(
      				'param' => 'post_template',
      				'operator' => '==',
      				'value' => 'blog.php',
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


acf_add_local_field_group(array(
      'key' => 'group_5ce8548fef5fd',
      'title' => 'Neighborhoods Order',
      'fields' => array(
            array(
                  'key' => 'field_5ce854d7461fb',
                  'label' => 'Order Neighborhoods',
                  'name' => 'order_neighborhoods',
                  'type' => 'repeater',
                  'instructions' => 'Select Neighborhoods in the order you want them displayed. These will display above all other regions/neighborhoods.',
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
                  'layout' => 'row',
                  'button_label' => 'Add Neighborhood',
                  'sub_fields' => array(
                        array(
                              'key' => 'field_5ce85513461fc',
                              'label' => 'Neighborhood',
                              'name' => 'neighborhood',
                              'type' => 'taxonomy',
                              'instructions' => '',
                              'required' => 0,
                              'conditional_logic' => 0,
                              'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                              ),
                              'taxonomy' => 'interra_listing_region',
                              'field_type' => 'select',
                              'allow_null' => 0,
                              'add_term' => 0,
                              'save_terms' => 0,
                              'load_terms' => 0,
                              'return_format' => 'id',
                              'multiple' => 0,
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

acf_add_local_field_group(array(
	'key' => 'group_5d02766fe2b64',
	'title' => 'Career Form Settings',
	'fields' => array(
		array(
			'key' => 'field_5d0276901e091',
			'label' => 'Notification Email',
			'name' => 'notification_email',
			'type' => 'email',
			'instructions' => 'Please enter the email address for which you\'d like to receive notifications of Career submissions.',
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
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_template',
				'operator' => '==',
				'value' => 'careers.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
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
