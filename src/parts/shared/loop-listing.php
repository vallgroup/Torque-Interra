<div class="loop-post loop-listing">
  <a href=<?php echo get_the_permalink(); ?>>
    <div class="featured-image-wrapper">
      <div
        class="featured-image"
        style="background-image: url('<?php echo get_the_post_thumbnail_url(null, 'large'); ?>')"
      ></div>
    </div>
  </a>

  <div class="content-wrapper">
    <a href=<?php echo get_the_permalink(); ?>>
      <h4><?php echo get_the_title(); ?></h4>
    </a>

    <div class="excerpt" >
      <?php echo get_the_excerpt(); ?>
    </div>

    <a href=<?php echo get_the_permalink(); ?>>
      <button>View listing</button>
    </a>

    <div class="post-terms-wrapper">
      <?php
      include locate_template('parts/shared/terms-listing.php');
      ?>
    </div>
  </div>
</div>
