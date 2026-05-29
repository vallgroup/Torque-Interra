<?php

return array(
    'key' => 'group_5d4b303d3ba36',
    'title' => 'Listing Thumbnail',
    'fields' => array(
        array(
            'key' => 'field_5d4b3054cdc8c',
            'label' => 'Thumbnail Image',
            'name' => 'thumbnail_image',
            'type' => 'image',
            'instructions' => 'Select an image to be used throughout the website where properties are displayed in a grid layout. If left blank the Featured Image will be used.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'url',
            'preview_size' => 'large',
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
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'torque_listing',
            ),
        ),
    ),
    'menu_order' => 20,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
);
