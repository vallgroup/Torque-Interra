<?php

return array(
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
);
