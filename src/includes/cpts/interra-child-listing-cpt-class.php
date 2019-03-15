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
	);

	/**
	 * register our post type and meta boxes
	 */
	function __construct() {
		if ( class_exists( 'PremiseCPT' ) ) {
			new PremiseCPT( self::$listing_labels, $this->listing_options );
		}

    add_action( 'init', array( $this, 'add_listing_taxonomies' ) );
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
      )
    );
  }
}

?>
