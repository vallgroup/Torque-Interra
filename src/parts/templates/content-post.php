<?php

$terms = get_the_terms( get_the_ID(), 'category' );

?>

<div class="post-main" >
  <div class="post-content">
    <div class="post-title" >
      <h2><?php the_title(); ?></h2>

      <div class="the-date"><?php the_date('M Y'); ?></div>

      <?php if (count($terms)) { ?>
        <div class="post-terms" >

          <?php foreach ($terms as $term) { ?>
            <div class="post-term" >
              <?php echo $term->name; ?>
            </div>
          <?php } ?>

        </div>
      <?php } ?>
    </div>

    <div class="the-content" >
      <?php the_content(); ?>
    </div>

    <?php get_template_part('/parts/elements/pagination/pagination-buttons-single'); ?>
  </div>

  <div class="post-keep-reading" >

  </div>
</div>
