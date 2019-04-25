<?php

$content = get_the_content();
$highlights = get_field( 'listing_highlights' );

?>

<div class="torque-listing-content">

  <div class="torque-listing-content-details" >
    <?php if ($content) { ?>
      <div class="the-content" >
        <?php echo $content; ?>
      </div>
    <?php } ?>

    <?php if ($highlights) { ?>
      <h4>Highlights</h4>
      <div class="highlights" >
        <?php echo $highlights; ?>
      </div>
    <?php } ?>

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

    $users = get_field('listing_brokers');

    if( $users ): ?>
    	<div class="brokers-wrapper">
        <h4 class="brokers-section-title">Brokers</h4>
    	<?php foreach( $users as $user ): // variable must NOT be called $post (IMPORTANT)

        $title = $user->data->display_name;
        $permalink = get_author_posts_url( $user->ID );
        $thumbnail = get_field( 'featured_image', 'user_'.$user->ID );
        if (!$thumbnail) $thumbnail = get_avatar_url( $user->ID, array( 'size' => 400 ) );
        $tel = get_field( 'telephone', 'user_'.$user->ID );
        $email = $user->user_email;

        ?>

    	    <div class="broker">
            <img class="broker-image" src="<?php echo $thumbnail; ?>" />

            <div class="broker-content" >
      	    	<h4><?php echo $title; ?></h4>


              <div class="meet-broker" >
                <a href="<?php echo $permalink; ?>">
                  Meet <?php echo $user->first_name; ?>
                </a>
              </div>


              <?php if ($email) { ?>
                <a href="mailto:<?php echo $email; ?>" >
                  <div class="broker-icon envelope"></div>
                </a>
              <?php } ?>

              <?php if ($tel) { ?>
                <a href="tel:<?php echo $tel; ?>" >
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
