<?php



?>

<div class="torque-listing-content">

  <div class="torque-listing-content-details" >
    <h4>Highlights</h4>
    <div class="the-content" >
      <?php the_content(); ?>
    </div>

    <?php if( have_rows('key_details') ): ?>
      <h4>Key Details</h4>
      <div class="key-details-wrapper">

      <?php while ( have_rows('key_details') ) : the_row(); ?>
        <div class="key-detail" >
          <div class="key-detail-name">
            <?php the_sub_field('name'); ?>
          </div>
          <div class="key-detail-value">
            <?php the_sub_field('value'); ?>
          </div>
        </div>
      <?php endwhile ?>

      </div>
    <?php endif; ?>

  </div>

  <div class="torque-listing-content-brokers">
    <?php

    $posts = get_field('listing_brokers');

    if( $posts ): ?>
    	<div class="brokers-wrapper">
        <h4 class="brokers-section-title">Brokers</h4>
    	<?php foreach( $posts as $broker ): // variable must NOT be called $post (IMPORTANT)

          $meta = get_post_meta($broker->ID, 'staff_meta', true);
        ?>

    	    <div class="broker">
            <img class="broker-image" src="<?php echo get_the_post_thumbnail_url($broker->ID, 'large'); ?>" />

            <div class="broker-content" >
      	    	<h4><?php echo $broker->post_title; ?></h4>


              <div class="meet-broker" >
                <a href="<?php echo get_the_permalink($broker->ID); ?>">
                  Meet <?php echo explode(' ', $broker->post_title)[0]; ?>
                </a>
              </div>


              <?php if ($meta['email']) { ?>
                <a href="mailto:<?php echo $meta['email']; ?>" >
                  <div class="broker-icon envelope"></div>
                </a>
              <?php } ?>

              <?php if ($meta['tel']) { ?>
                <a href="tel:<?php echo $meta['tel']; ?>" >
                  <div class="broker-icon phone"></div>
                </a>
              <?php } ?>
            </div>
    	    </div>
    	<?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

</div>
