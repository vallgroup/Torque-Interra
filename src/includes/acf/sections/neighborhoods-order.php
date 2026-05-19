<?php

return array(
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
);
