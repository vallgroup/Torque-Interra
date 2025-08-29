<?php

$heading = get_field('custom_template_heading');

//get the featured image from the post
$image = get_the_post_thumbnail_url();
?>

<div class="page-hero type-image">

  <div class="hero-image-size">
    <div class="hero-overlay-bg"></div>
    <div class="hero-image" style="background-image: url(<?php echo $image; ?>);"></div>
  </div>

  <div class="hero-overlay">
    <h1><?php echo $heading; ?></h1>
    <div class="hero-subtitle"><?php the_title(); ?></div>
  </div>
</div>