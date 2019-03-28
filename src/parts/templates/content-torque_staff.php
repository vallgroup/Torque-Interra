<?php

// setup listings
$listings = get_posts(array(
	'post_type' => Interra_Listing_CPT::$listing_labels['post_type_name'],
	'meta_query' => array(
		array(
			'key' => 'listing_brokers',
			'value' => '"' . get_the_ID() . '"',
			'compare' => 'LIKE'
		)
	)
));

foreach ($listings as &$listing) {
  $listing->availability = get_field('listing_status', $listing->ID);
}

$available_listings = array_filter($listings, function($listing) {
  return $listing->availability === 'available';
});

$closed_listings = array_filter($listings, function($listing) {
  return $listing->availability === 'closed';
});


// setup blog posts
$user = get_field('user');

$blog_posts = get_posts(array(
  'author'  => $user
));

?>
