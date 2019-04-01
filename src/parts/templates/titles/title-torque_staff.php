<?php

$roles = get_the_terms( get_the_ID(), Interra_Staff_CPT::$STAFF_ROLE_TAX_SLUG );

?>

<div class="torque_staff-title" >
  <img class="featured-image" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" />

  <div class="staff-detail" >
    <h2><?php the_title(); ?></h2>

    <?php if (count($roles)) { ?>
      <div class="staff-roles" >

        <?php foreach ($roles as $role) { ?>
          <div class="staff-role" >
            <?php echo $role->name; ?>
          </div>
        <?php } ?>

      </div>
    <?php } ?>

    <div class="hide-on-tablet staff-content" >
      <?php the_content(); ?>
    </div>

    <?php include locate_template('/parts/templates/titles/title-torque_staff-contact.php'); ?>
  </div>

  <div class="show-on-tablet staff-content" >
    <?php the_content(); ?>
  </div>
</div>
