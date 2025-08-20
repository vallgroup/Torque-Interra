<?php

$shortcode = '[torque_filtered_loop ';
$shortcode .= 'post_type="post" ';
$shortcode .= 'posts_per_page="16" ';
$shortcode .= 'per_page_offset="2" ';
$shortcode .= 'filters_types="dropdown_tax,dropdown_date" ';
$shortcode .= 'category_term_exclude="232" ';
$shortcode .= 'filters_args="category" ';
$shortcode .= 'use_custom_label="true" ';
$shortcode .= ']';

echo do_shortcode($shortcode);

?>
