<?php

$modules = 'modules';

if (have_rows($modules)):

  while (have_rows($modules)) : the_row();

    switch (get_row_layout()) {

      case 'content_section':

        $align = get_sub_field('align');
        $image = get_sub_field('image');
        $heading = get_sub_field('heading');
        $content = get_sub_field('content');
        $cta = get_sub_field('cta');

        include locate_template('/parts/acf/modules/content-section.php');

        break;

      case 'stats':
        $stats = get_sub_field('stats');
        include locate_template('/parts/acf/modules/stats.php');
        break;

      case 'our_difference':
        $our_difference = get_sub_field('our_difference');
        $title = get_sub_field('title');
        include locate_template('/parts/acf/modules/our_difference.php');
        break;

      case 'images':

        $image_1 = get_sub_field('image_1');
        $image_2_start = get_sub_field('image_2_start');
        $image_2 = get_sub_field('image_2');

        include locate_template('/parts/acf/modules/images.php');

        break;

      case 'cta_section':

        $heading = get_sub_field('heading');
        $content = get_sub_field('content');
        $cta = get_sub_field('cta');

        include locate_template('/parts/acf/modules/cta-section.php');

        break;

      case 'post_slideshow':

        $slideshow_id = get_sub_field('slideshow_id');

        echo do_shortcode('[torque_slideshow id="' . $slideshow_id . '" type="post" template="interra"]');

        break;

      case 'region_quick_search':

        if (class_exists('Interra_Listing_CPT')) {
          $taxonomy = Interra_Listing_CPT::$LISTING_REGION_TAX_SLUG;

          include locate_template('/parts/acf/modules/quick-search.php');
        }

        break;

      case 'staff_members':

        include locate_template('/parts/acf/modules/staff-members.php');

        break;

      case 'mailchimp_form':

        include locate_template('/parts/acf/modules/mailchimp-form.php');

        break;

      case 'headline_and_content':
        $headline = get_sub_field('headline');
        $content = get_sub_field('content');
        include locate_template('/parts/acf/modules/headline-and-content.php');

        break;

      case 'images_row':
        $images = get_sub_field('images_row');
        include locate_template('/parts/acf/modules/images-row.php');

        break;

      case 'torque_filtered_loop':
        $post_type = get_sub_field('post_type');
        $posts_per_page = get_sub_field('posts_per_page');
        $filters_types = get_sub_field('filters_types');
        $use_template_variation = get_sub_field('use_template_variation');
        $use_custom_label = get_sub_field('use_custom_label');
        $custom_label = get_sub_field('custom_label');
        $filters_args = get_sub_field('filters_args');

        $shortcode = '[torque_filtered_loop ';
        $shortcode .= 'post_type="' . $post_type . '" ';
        $shortcode .= 'posts_per_page="' . $posts_per_page . '" ';
        $shortcode .= 'filters_types="' . $filters_types . '" ';
        $shortcode .= 'use_template_variation="' . $use_template_variation . '" ';
        $shortcode .= 'use_custom_label="' . $use_custom_label . '" ';
        $shortcode .= 'custom_label="' . $custom_label . '" ';
        $shortcode .= 'filters_args="' . $filters_args . '" ';
        $shortcode .= ']';

        echo do_shortcode($shortcode);

        break;

      case 'headline_and_content_2_columns':
        $columns_wrapper = get_sub_field('columns_wrapper');
        $headline = get_sub_field('headline');
        include locate_template('/parts/acf/modules/headline-and-content-2-columns.php');
        break;

      case 'featured_cards':
        $cards = get_sub_field('cards');
        $title = get_sub_field('title');
        include locate_template('/parts/acf/modules/featured-cards.php');
        break;
    }

  endwhile;
endif;
