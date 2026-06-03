<?php

$title = $user->display_name;
$description = $user->description;
$description = wpautop($description, false);

switch_to_blog(1);
$thumbnail = get_field('featured_image', 'user_' . $user->ID);
$second_img = get_field('second_image', 'user_' . $user->ID);
restore_current_blog();
if (!$thumbnail) {
  $thumbnail = get_avatar_url($user->ID, array('size' => 1000));
}
if (!$second_img) {
  $second_img = $thumbnail;
}

?>

<div class="torque_staff-title">
  <div class="staff-image-container">
    <img class="featured-image" src="<?php echo $thumbnail; ?>" />
  </div>

  <div class="staff-detail">
    <h2><?php echo $title; ?></h2>

    <?php include locate_template('parts/shared/author-roles.php'); ?>

    <div class="hide-on-tablet staff-content">
      <p><?php echo $description; ?></p>
    </div>

    <?php include locate_template('/parts/templates/titles/title-author-contact.php'); ?>
  </div>

  <div class="show-on-tablet staff-content">
    <p><?php echo $description; ?></p>
  </div>
</div>