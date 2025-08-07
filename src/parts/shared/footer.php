<?php
$address = get_field('address', 'options');
?>

<footer>
  <div id="contact">
    <h3>Contact Us</h3>
    <?php echo apply_shortcodes('[contact-form-7 id="e133e7c" title="Contact form footer"]'); ?>
    <p class="address"><?php echo $address; ?></p>
  </div>
  
  <?php get_template_part('parts/shared/footer-bottom'); ?>

  <div class="footer-overlay"></div>
</footer>

<div class="back-to-top-container">
  <div class="back-to-top-btn fa fa-arrow-up"></div>
</div>