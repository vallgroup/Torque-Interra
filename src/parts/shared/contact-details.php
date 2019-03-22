<?php

$address = get_field('address', 'options');
$phone = get_field('phone', 'options');
$fax = get_field('fax', 'options');

?>

<div class="contact-details">

  <?php if ($address) { ?>
    <div class="address" >
      <?php echo $address; ?>
    </div>
  <?php } ?>

  <?php if ($phone) { ?>
    <div class="phone" >
      P: <a href="tel:<?php echo $phone; ?>" ><?php echo $phone; ?></a>
    </div>
  <?php } ?>

  <?php if ($fax) { ?>
    <div class="fax" >
      F: <?php echo $fax; ?>
    </div>
  <?php } ?>

</div>
