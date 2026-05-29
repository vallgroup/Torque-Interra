<?php

require_once(get_template_directory() . '/includes/acf/torque-acf-search-class.php');

class Interra_ACF
{

	public function __construct()
	{
		add_action('admin_init', array($this, 'acf_admin_init'), 99);
		add_action('acf/init', array($this, 'acf_init'));

		// hide acf in admin - client doesnt need to see this
		// add_filter('acf/settings/show_admin', '__return_false');

		// add acf fields to wp search
		if (class_exists('Torque_ACF_Search')) {
			add_filter(Torque_ACF_Search::$ACF_SEARCHABLE_FIELDS_FILTER_HANDLE, array($this, 'add_fields_to_search'));
		}
	}

	public function acf_admin_init()
	{
		// hide options page
		// remove_menu_page('acf-options');
	}

	public function add_fields_to_search($fields)
	{
		$fields[] = 'hero_overlay_title';
		$fields[] = 'hero_overlay_subtitle';
		$fields[] = 'page_heading';
		$fields[] = 'page_intro';
		$fields[] = 'heading';
		$fields[] = 'content';

		return $fields;
	}

	public function acf_init()
	{
		if (function_exists('acf_add_local_field_group')) :

			$fields_post_authors = get_stylesheet_directory() . '/includes/acf/sections/post-authors.php';
			if (file_exists($fields_post_authors)) {
				acf_add_local_field_group(include $fields_post_authors);
			}

			$fields_page_hero = get_stylesheet_directory() . '/includes/acf/sections/page-hero.php';
			if (file_exists($fields_page_hero)) {
				acf_add_local_field_group(include $fields_page_hero);
			}

			$fields_page_intro = get_stylesheet_directory() . '/includes/acf/sections/page-intro.php';
			if (file_exists($fields_page_intro)) {
				acf_add_local_field_group(include $fields_page_intro);
			}

			$fields_modules = get_stylesheet_directory() . '/includes/acf/sections/modules.php';
			if (file_exists($fields_modules)) {
				acf_add_local_field_group(include $fields_modules);
			}

			$fields_company_details = get_stylesheet_directory() . '/includes/acf/sections/company-details.php';
			if (file_exists($fields_company_details)) {
				acf_add_local_field_group(include $fields_company_details);
			}

			$fields_staff_details = get_stylesheet_directory() . '/includes/acf/sections/staff-details.php';
			if (file_exists($fields_staff_details)) {
				acf_add_local_field_group(include $fields_staff_details);
			}

			$fields_page = get_stylesheet_directory() . '/includes/acf/sections/page.php';
			if (file_exists($fields_page)) {
				acf_add_local_field_group(include $fields_page);
			}

			$fields_social_media = get_stylesheet_directory() . '/includes/acf/sections/social-media.php';
			if (file_exists($fields_social_media)) {
				acf_add_local_field_group(include $fields_social_media);
			}

			$fields_neighborhoods_order = get_stylesheet_directory() . '/includes/acf/sections/neighborhoods-order.php';
			if (file_exists($fields_neighborhoods_order)) {
				acf_add_local_field_group(include $fields_neighborhoods_order);
			}

			$fields_career_form = get_stylesheet_directory() . '/includes/acf/sections/career-form.php';
			if (file_exists($fields_career_form)) {
				acf_add_local_field_group(include $fields_career_form);
			}

			$fields_listing_thumbnail = get_stylesheet_directory() . '/includes/acf/sections/listing-thumbnail.php';
			if (file_exists($fields_listing_thumbnail)) {
				acf_add_local_field_group(include $fields_listing_thumbnail);
			}

		endif;
	}
}
