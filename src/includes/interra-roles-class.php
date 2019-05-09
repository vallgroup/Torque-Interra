<?php

class Interra_Roles {

  public static $BROKER_ROLE_SLUG = 'broker';

  public static $MANAGER_ROLE_SLUG = 'manager';

  public function __construct() {
    add_action('init', array($this, 'add_broker'));
    add_action('init', array($this, 'add_manager'));

    add_action('acf/init', array( $this, 'add_custom_role_metaboxes' ) );

    // vcard support
    add_filter('upload_mimes', function ($mime_types){
      $mime_types['vcf'] = 'text/vcard';
      $mime_types['vcard'] = 'text/vcard';
      return $mime_types;
		}, 1, 1);
		
		// setup job title choices select based on job title ACF
		add_filter('acf/load_field/key=field_5cc096378bc25', array($this, 'setup_job_title_choices'));
  }

  public function add_broker() {
    $parent_role = get_role( 'editor' );
    add_role(
      self::$BROKER_ROLE_SLUG,
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
      self::$MANAGER_ROLE_SLUG,
      'Manager',
      array_merge(
        $parent_role->capabilities,
        array() // override capabilities
      )
    );
	}
	
	public function setup_job_title_choices( $field ) {

		/* Check the ACF for rows */
		if( have_rows('staff_job_titles', 'options') ):
			
			/* Loop through any existing rows */
			while ( have_rows('staff_job_titles', 'options') ) : the_row();

				//$job_title_id = get_row_index();
				$job_title = get_sub_field('staff_job_title');

				$choices[] = $job_title;
        $titles[] = $job_title;

				if( is_array($choices) ){
					foreach (array_combine($choices, $titles) as $choice => $title) {
						$field['choices'][ $choice ] = $title;
					}
				}

			endwhile;

		else :

			// Display placeholder
			$field['choices'] = array(
				'0' => 'No job titles found...'
			);

		endif;

		return $field;
	}

  public function add_custom_role_metaboxes() {
    if( function_exists('acf_add_local_field_group') ):

      acf_add_local_field_group(array(
      	'key' => 'group_5cc094e88f3b3',
      	'title' => 'User Fields',
      	'fields' => array(
      		array(
      			'key' => 'field_5cc096138bc24',
      			'label' => 'Featured Image',
      			'name' => 'featured_image',
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
            'key' => 'field_5cc9caeefdfaf',
            'label' => 'Second Image',
            'name' => 'second_image',
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
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
      		array(
      			'key' => 'field_5cc095d78bc22',
      			'label' => 'Telephone',
      			'name' => 'telephone',
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
      			'key' => 'field_5cc094eb862d1',
      			'label' => 'VCard File',
      			'name' => 'vcard_file',
      			'type' => 'file',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'return_format' => 'url',
      			'library' => 'all',
      			'min_size' => '',
      			'max_size' => '',
      			'mime_types' => 'vcf,vcard',
      		),
      		array(
      			'key' => 'field_5cc096378bc25',
      			'label' => 'Job Title',
      			'name' => 'job_title',
      			'type' => 'select',
      			'instructions' => 'Defaults to user role',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'prepend' => '',
      			'append' => '',
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'user_role',
      				'operator' => '==',
      				'value' => 'broker',
      			),
      		),
      		array(
      			array(
      				'param' => 'user_role',
      				'operator' => '==',
      				'value' => 'manager',
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
