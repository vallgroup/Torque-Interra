<?php

$term_ids = get_sub_field('regions');

if ($term_ids) {
  $terms = get_terms( array(
      'taxonomy'   => $taxonomy,
      'hide_empty' => false,
      'include'    => $term_ids
  ) );
} else {
  $terms = [];
}


if (count($terms)) {

?>

<div class="quick-search taxonomy-<?php echo $taxonomy; ?>" >

  <h2>Quick Search</h2>

<?php foreach ($terms as $term) {

  $image = get_field('region_featured_image', $term);
  ?>
  <a class="quick-search-term-wrapper" href="/listings?<?php echo $taxonomy.'='.$term->term_id; ?>" >
    <div class="quick-search-term" style="background-image: url('<?php echo $image; ?>')">
      <div class="term-name"><?php echo $term->name; ?></div>

      <div class="overlay"></div>
    </div>
  </a>

<?php } ?>

</div>

<?php } ?>
