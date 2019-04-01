<?php

$meta = get_post_meta(get_the_ID(), 'staff_meta', true);
$vcard = get_field('vcard_file');

?>

<div class="torque-staff-contact" >
  <?php if ($meta['email']) { ?>
    <a class="broker-icon-link" href="mailto:<?php echo $meta['email']; ?>" >
      <div class="broker-icon envelope"></div>
      <?php echo $meta['email']; ?>
    </a>
  <?php } ?>

  <?php if ($meta['tel']) { ?>
    <a class="broker-icon-link" href="tel:<?php echo $meta['tel']; ?>" >
      <div class="broker-icon phone"></div>
      <?php echo $meta['tel']; ?>
    </a>
  <?php } ?>

  <?php if ($vcard) { ?>
    <a class="broker-icon-link" href="<?php echo $vcard; ?>" target="_blank" referrer="noreferrer noopener">
      <div class="broker-icon vcard"></div>
      Download vcard
    </a>
  <?php } ?>
</div>
