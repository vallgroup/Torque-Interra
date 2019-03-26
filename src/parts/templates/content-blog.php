<?php

$shortcode = '[torque_filtered_loop ';
$shortcode .= 'post_type="post" ';
$shortcode .= 'filters_types="dropdown_tax,dropdown_date" ';
$shortcode .= 'filters_args="category"';
$shortcode .= ']';

echo do_shortcode($shortcode);

?>
