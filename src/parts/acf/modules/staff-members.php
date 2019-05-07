<?php

$user_query = new WP_User_Query( array(
  'role__in' => array( Interra_Roles::$BROKER_ROLE_SLUG, Interra_Roles::$MANAGER_ROLE_SLUG )
) );

if ( ! empty( $user_query->get_results() ) ) { ?>

  <div class="staff-members-module" >

    <?php foreach ( $user_query->get_results() as $user ) {

      $title = $user->data->display_name;
      $permalink = get_author_posts_url( $user->ID );
      $tel = get_field( 'telephone', 'user_'.$user->ID );
      $thumbnail = get_field( 'featured_image', 'user_'.$user->ID );
      if (!$thumbnail) {
        $thumbnail = get_avatar_url( $user->ID, array( 'size' => 400 ) );
      }
      $second_img = get_field( 'second_image', 'user_'.$user->ID );
      if (!$second_img) {
        $second_img = $thumbnail;
      }

      ?>

      <div class="staff-member" >
        <a class="image-wrapper" href="<?php echo $permalink; ?>">
          <img class="staff-member-image" src="<?php echo $thumbnail; ?>" />
          <img class="staff-member-second-image" src="<?php echo $second_img; ?>" />
        </a>

        <div class="staff-member-content" >
          <h4><?php echo $title; ?></h4>

          <?php include locate_template( 'parts/shared/author-roles.php' ); ?>

          <div class="contact-container" >

            <div class="meet-broker" >
              <a href="<?php echo $permalink; ?>">
                <button>
                  Meet <?php echo $user->first_name; ?>
                </button>
              </a>
            </div>

            <div class="broker-icons" >
              <?php if ($user->user_email) { ?>
                <a href="mailto:<?php echo $user->user_email; ?>" >
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

        </div>
      </div>

    <?php } ?>

  </div>

<?php } ?>
