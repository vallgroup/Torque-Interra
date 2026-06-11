<?php

add_filter('get_canonical_url', 'custom_multidomain_canonical_url', 10, 2);

function custom_multidomain_canonical_url($canonical_url, $post)
{
    if (is_singular('torque_listing')) {

        $main_blog_id = 1;

        // Get the current listing's slug
        $current_slug = $post->post_name;
        switch_to_blog($main_blog_id);
        $raw_home_url = get_home_url($main_blog_id);
        $main_site_url = rtrim($raw_home_url, '/') . '/';
        $main_post_match = get_page_by_path($current_slug, OBJECT, 'torque_listing');
        restore_current_blog();

        if ($main_post_match) {
            $canonical_url = $main_site_url . '/listing/' . $current_slug . '/';
        }
        // WordPress will naturally output the sub-site's own URL as the canonical.
    }

    return $canonical_url;
}
