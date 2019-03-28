<?php

$query = new WP_Query( array(
  'post_type' => Torque_Staff_CPT::$staff_labels['post_type_name'],
  'posts_per_page'  => -1
));

if ($query->have_posts()) { ?>

  <div class="staff-members-module" >

    <?php while($query->have_posts()) { $query->the_post();

      $title = get_the_title();
      $meta = get_post_meta(get_the_ID(), 'staff_meta', true);
      $roles = get_the_terms( get_the_ID(), Interra_Staff_CPT::$STAFF_ROLE_TAX_SLUG );

      ?>

      <div class="staff-member" >
        <a class="image-wrapper" href="<?php echo get_the_permalink(); ?>">
          <img class="staff-member-image" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" />
        </a>

        <div class="staff-member-content" >
          <h4><?php echo $title; ?></h4>

          <?php if (count($roles)) { ?>
            <div class="staff-roles" >

              <?php foreach ($roles as $role) { ?>
                <div class="staff-role" >
                  <?php echo $role->name; ?>
                </div>
              <?php } ?>

            </div>
          <?php } ?>

          <div class="contact-container" >

            <div class="meet-broker" >
              <a href="<?php echo get_the_permalink(); ?>">
                <button>
                  Meet <?php echo explode(' ', $title)[0]; ?>
                </button>
              </a>
            </div>

            <div class="broker-icons" >
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

        </div>
      </div>

    <?php } ?>

  </div>

<?php } ?>
