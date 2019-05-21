<?php

$address = get_field('address', 'options');
$phone = get_field('phone', 'options');
$fax = get_field('fax', 'options');
$social_channels = have_rows('social_media', 'options');

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

<?php if ($social_channels) { ?>
  <div class="social-media" >
    <ul class="social-icons">
      <?php
      while ( have_rows('social_media', 'option') ) : the_row();
        $socialchannel = get_sub_field('social_channel', 'option');
        $socialurl = get_sub_field('social_url', 'option');
        echo '<li class="social-item">';
        echo '<a class="social-link" rel="nofollow noopener noreferrer" href="' . $socialurl . '" target="_blank">';
        echo '<i class="social-icon fa fa-' . $socialchannel . '" aria-hidden="true"></i>';
        echo '<span class="sr-only hidden">' . ucfirst($socialchannel) . '</span>';
        echo '</a></li>';
      endwhile;
      ?>
    </ul>
  </div>
<?php } ?>

</div>
