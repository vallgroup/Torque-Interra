<?php

$type = get_field('hero_type');

$image = get_field('hero_image');
$slideshow = get_field('hero_image_slideshow');
$video = get_field('hero_video_src');

$overlay_title= get_field('hero_overlay_title');
$overlay_subtitle= get_field('hero_overlay_subtitle');


if (($type === 'image' && $image) || ($type === 'image_slideshow' && $slideshow) || ($type === 'video' && $video)) { ?>

<div class="page-hero type-<?php echo $type; ?>">

  <?php if ($type === 'image' && $image) { ?>
    <div class="hero-image-size">
      <div class="hero-image" style="background-image: url(<?php echo $image; ?>);" ></div>
    </div>
  <?php } else if ($type === 'image_slideshow' && $slideshow) {
    echo do_shortcode('[torque_slideshow id="'.$slideshow.'" type="image"]');
  } ?>

  <?php if ($overlay_title || $overlay_subtitle) { ?>
    <div class="hero-overlay" >
      <?php if ($overlay_title) { ?>
        <h1><?php echo $overlay_title; ?></h1>
      <?php } ?>

      <?php if ($overlay_subtitle) { ?>
        <div class="hero-subtitle"><?php echo $overlay_subtitle; ?></div>
      <?php } ?>
    </div>
  <?php } ?>
</div>

<?php } else { ?>

<div class="page-hero-filler" ></div>

<?php } ?>
