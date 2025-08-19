<?php

$type = get_field('page_intro_type');
$heading = get_field('page_heading');
$intro = get_field('page_intro');
if ($type !== 'none') {
?>
  <div class="page-intro type-<?php echo $type; ?>">

    <?php if ($heading) { ?>
      <h2><?php echo $heading; ?></h2>
    <?php } ?>

    <?php if ($intro) { ?>
      <div class="page-intro-intro"><?php echo $intro; ?></div>
    <?php } ?>
  </div>
<?php
}
?>