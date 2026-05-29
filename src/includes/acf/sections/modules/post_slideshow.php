<?php

return array(
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
            'taxonomy' => array(),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
            'ui' => 1,
        ),
    ),
    'min' => '',
    'max' => '',
);
