<?php
$phone = get_field('phone', 'options');
$email = get_field('email', 'options');
?>

<header
  id="header-style-1-alt"
  class="torque-header">

  <div class="torque-header-content-wrapper torque-navigation-toggle">

    <div class="torque-header-logo-wrapper">
      <?php get_template_part('parts/shared/logo', 'white'); ?>
    </div>

    <div class="torque-header-right">
      <?php get_template_part('parts/shared/header-parts/menu-items/menu-tree', 'inline'); ?>
      <?php
      if (!empty($phone)) {
      ?>
        <a href="<?php echo 'tel:' . $phone; ?>" class="link-phone">
          tel
        </a>
      <?php
      }
      ?>
      <?php
      if (!empty($email)) {
      ?>
        <a href="<?php echo $email; ?>" class="link-email">
          email
        </a>
      <?php
      }
      ?>
      <?php get_search_form(); ?>

      <div class="torque-header-burger-menu-wrapper">
        <?php get_template_part('parts/elements/element', 'burger-menu-squeeze'); ?>
      </div>
    </div>

  </div>

  <div class="torque-navigation-toggle torque-header-menu-items-mobile">
    <?php get_template_part('parts/shared/header-parts/menu-items/menu-tree', 'stacked'); ?>
  </div>

</header>