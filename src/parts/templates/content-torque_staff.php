<?php

$first_name = explode(' ', get_the_title())[0];

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

<?php if (count($available_listings)) { ?>

<div class="listings-wrapper active-listings" >
	<h2><?php echo $first_name."'s"; ?> Active Listings</h2>

	<?php foreach ($available_listings as $listing) {
		$listing_id = $listing->ID;

		include locate_template('parts/shared/loop-listing.php');
	} ?>
</div>

<?php } ?>

<?php if (count($closed_listings)) { ?>

<div class="listings-wrapper closed-listings" >
	<h2><?php echo $first_name."'s"; ?> Recently Closed Listings</h2>

	<?php foreach ($closed_listings as $listing) {
		$listing_id = $listing->ID;

		include locate_template('parts/shared/loop-listing.php');
	} ?>
</div>

<?php } ?>
