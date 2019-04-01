<div class="loop-post loop-blog">
  <a href=<?php echo get_the_permalink($blog_post_id); ?>>
    <div class="featured-image-wrapper">
      <div
        class="featured-image"
        style="background-image: url('<?php echo get_the_post_thumbnail_url($blog_post_id, 'medium'); ?>')"
      ></div>
    </div>
  </a>

  <div class="content-wrapper">
    <a href=<?php echo get_the_permalink($blog_post_id); ?>>
      <h4><?php echo get_the_title($blog_post_id); ?></h4>
    </a>

    <div class="excerpt" >
      <?php echo get_the_excerpt($blog_post_id); ?>
    </div>

    <a href=<?php echo get_the_permalink($blog_post_id); ?>>
      <button>Read More</button>
    </a>
  </div>
</div>
