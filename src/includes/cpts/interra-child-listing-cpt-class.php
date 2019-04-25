<?php
/**
 * Register the torque cpt and it's meta boxes
 */
class Interra_Listing_CPT {

  public static $LISTING_PROPERTY_TYPE_TAX_SLUG = 'interra_listing_property_type';

  public static $LISTING_REGION_TAX_SLUG = 'interra_listing_region';

	/**
	 * Holds the listing cpt object
	 *
	 * @var Object
	 */
	protected $listing = null;

	/**
	 * Holds the labels needed to build the listing custom post type.
	 *
	 * @var array
	 */
	public static $listing_labels = array(
			'singular'       => 'Listing',
			'plural'         => 'Listing',
			'slug'           => 'torque-listing',
			'post_type_name' => 'torque_listing',
	);

	/**
	 * Holds options for the listing custom post type
	 *
	 * @var array
	 */
	protected $listing_options = array(
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
		),
		'menu_icon'           => 'dashicons-building',
    'show_in_rest'        => true
	);

	/**
	 * register our post type and meta boxes
	 */
	function __construct() {
		if ( class_exists( 'PremiseCPT' ) ) {
			new PremiseCPT( self::$listing_labels, $this->listing_options );
		}

    add_action( 'init', array( $this, 'add_listing_taxonomies' ) );
    add_action('acf/init', array( $this, 'add_acf_metaboxes' ) );
	}

  public function add_listing_taxonomies() {
    register_taxonomy(
      self::$LISTING_PROPERTY_TYPE_TAX_SLUG,
      self::$listing_labels['post_type_name'],
      array(
        'label'        => 'Property Types',
        'labels'       => array(
          'singular_name'   => 'Property Type'
        ),
        'hierarchical' => true,
        'show_in_rest' => true
      )
    );

    register_taxonomy(
      self::$LISTING_REGION_TAX_SLUG,
      self::$listing_labels['post_type_name'],
      array(
        'label'        => 'Regions',
        'labels'       => array(
          'singular_name'   => 'Region'
        ),
        'hierarchical' => true,
        'show_in_rest' => true
      )
    );
  }

  public function add_acf_metaboxes() {
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
      			'key' => 'field_5cc09759d8bff',
      			'label' => 'Brokers',
      			'name' => 'listing_brokers',
      			'type' => 'user',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'role' => array(
      				0 => 'broker',
      				1 => 'manager',
      			),
      			'allow_null' => 0,
      			'multiple' => 1,
      			'return_format' => 'object',
      		),
          array(
      			'key' => 'field_5cc0b5257531e',
      			'label' => 'Address',
      			'name' => 'listing_address',
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
          array(
      			'key' => 'field_5cc0b6d621a24',
      			'label' => 'Highlights',
      			'name' => 'listing_highlights',
      			'type' => 'wysiwyg',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'tabs' => 'all',
      			'toolbar' => 'full',
      			'media_upload' => 0,
      			'delay' => 0,
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => self::$listing_labels['post_type_name'],
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
      	'key' => 'group_5c9bdef982949',
      	'title' => 'Listing Header',
      	'fields' => array(
      		array(
      			'key' => 'field_5c9bdf032847a',
      			'label' => 'Image',
      			'name' => 'listing_image',
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
      				'featured' => 'Use Featured Image',
      				'slideshow' => 'Use Slideshow',
      			),
      			'allow_null' => 0,
      			'other_choice' => 0,
      			'default_value' => 'featured',
      			'layout' => 'horizontal',
      			'return_format' => 'value',
      			'save_other_choice' => 0,
      		),
      		array(
      			'key' => 'field_5c9bdf292847b',
      			'label' => 'Slideshow',
      			'name' => 'listing_slideshow',
      			'type' => 'post_object',
      			'instructions' => '',
      			'required' => 1,
      			'conditional_logic' => array(
      				array(
      					array(
      						'field' => 'field_5c9bdf032847a',
      						'operator' => '==',
      						'value' => 'slideshow',
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
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => self::$listing_labels['post_type_name'],
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
      	'key' => 'group_5c9ba4e29e924',
      	'title' => 'Featured Image',
      	'fields' => array(
      		array(
      			'key' => 'field_5c9ba4ec433cd',
      			'label' => 'Image',
      			'name' => 'region_featured_image',
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
      	'location' => array(
      		array(
      			array(
      				'param' => 'taxonomy',
      				'operator' => '==',
      				'value' => self::$LISTING_REGION_TAX_SLUG,
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
