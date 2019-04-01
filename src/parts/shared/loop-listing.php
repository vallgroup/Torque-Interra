<div class="loop-post loop-listing">
  <a href=<?php echo get_the_permalink($listing_id); ?>>
    <div class="featured-image-wrapper">
      <div
        class="featured-image"
        style="background-image: url('<?php echo get_the_post_thumbnail_url($listing_id, 'medium'); ?>')"
      ></div>
    </div>
  </a>

  <div class="content-wrapper">
    <a href=<?php echo get_the_permalink($listing_id); ?>>
      <h4><?php echo get_the_title($listing_id); ?></h4>
    </a>

    <div class="excerpt" >
      <?php echo get_the_excerpt($listing_id); ?>
    </div>

    <a href=<?php echo get_the_permalink($listing_id); ?>>
      <button>View listing</button>
    </a>

    <div class="post-terms-wrapper">
      <?php
      include locate_template('parts/shared/terms-listing.php');
      ?>
    </div>
  </div>
</div>
