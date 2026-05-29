<?php

return array(
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
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
            array(
                'param' => 'post_template',
                'operator' => '==',
                'value' => 'news.php',
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
