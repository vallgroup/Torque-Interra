<?php

return array(
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
);
