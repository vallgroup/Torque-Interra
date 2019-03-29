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
</div>
