<?php

$type = get_field('hero_type', 'options');

$image = get_field('hero_image', 'options');
$slideshow = get_field('hero_image_slideshow', 'options');
$video_small = get_field('hero_video_src', 'options');
$video_full = get_field('hero_video_src_full', 'options');
$video_poster = get_field('hero_video_poster', 'options');

$overlay_title = get_field('hero_overlay_title', 'options');
$overlay_subtitle = get_field('hero_overlay_subtitle', 'options');


if (($type === 'image' && $image) || ($type === 'image_slideshow' && $slideshow) || ($type === 'video' && $video_small)) { ?>

  <div class="page-hero type-<?php echo $type; ?>">

    <?php if ($type === 'image' && $image) { ?>
      <div class="hero-image-size">
        <div class="hero-overlay-bg"></div>
        <div class="hero-image" style="background-image: url(<?php echo $image; ?>);"></div>
      </div>
    <?php } else if ($type === 'image_slideshow' && $slideshow) {
      echo do_shortcode('[torque_slideshow id="' . $slideshow . '" type="image"]');
    } else if ($type === 'video' && $video_small) {
    ?>
      <div class="hero-video-wrapper">
        <div class="hero-overlay-bg"></div>
        <video
          autoplay
          loop
          muted
          playsinline
          class="hero-video"
          poster="<?php echo $video_poster; ?>"
          src="<?php echo $video_small; ?>">
        </video>
      </div>
    <?php
    } ?>

    <?php if ($overlay_title || $overlay_subtitle) { ?>
      <div class="hero-overlay">
        <?php if ($overlay_title) { ?>
          <h1><?php echo $overlay_title; ?></h1>
        <?php } ?>

        <?php if ($overlay_subtitle) { ?>
          <div class="hero-subtitle"><?php echo $overlay_subtitle; ?></div>
        <?php } ?>

        <button aria-haspopup="true" aria-expanded="false" class="play-full-video">Play Video</button>
      </div>
    <?php } ?>
  </div>
  <div class="popup-video">
    <button class="popup-video-close" type="button" aria-label="Close Video Popup">x</button>
    <video
      controls
      autoplay
      class="popup-video-content"
      src="<?php echo $video_full; ?>"
      style="width: 100%; height: 100%;">
    </video>
  </div>

<?php } else { ?>

  <div class="page-hero-filler"></div>

<?php } ?>