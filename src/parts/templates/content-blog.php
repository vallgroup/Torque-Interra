<?php

$shortcode = '[torque_filtered_loop ';
$shortcode .= 'post_type="post" ';
$shortcode .= 'posts_per_page="12" ';
$shortcode .= 'category_term_include="232" ';
$shortcode .= 'filters_types="dropdown_date" ';
$shortcode .= 'filters_args="category"';
$shortcode .= ']';

echo do_shortcode($shortcode);

?>
