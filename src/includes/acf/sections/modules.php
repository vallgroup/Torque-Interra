<?php

return array(
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
                '5c9561c747434' => require __DIR__ . '/modules/content_section.php',
                '5ca3cf9d6b5db' => require __DIR__ . '/modules/images.php',
                '68b0de1f09abf' => require __DIR__ . '/modules/images_row.php',
                'layout_5c956991bcc4b' => require __DIR__ . '/modules/cta_section.php',
                '5c95192ad0ff0' => require __DIR__ . '/modules/post_slideshow.php',
                '5c9ba1ad52cd2' => require __DIR__ . '/modules/region_quick_search.php',
                '5c9d3f4702dde' => require __DIR__ . '/modules/staff_members.php',
                '5c9d3f4702arg' => require __DIR__ . '/modules/mailchimp_form.php',
                '5c9d3f4702arh' => require __DIR__ . '/modules/headline_and_content.php',
                '68b0de1f09abf1' => require __DIR__ . '/modules/stats.php',
                '5c9561c747434a' => require __DIR__ . '/modules/our_difference.php',
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
);
