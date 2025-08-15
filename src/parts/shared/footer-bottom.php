<?php

$phone = get_field('phone', 'options');
$email = get_field('email', 'options');
$location = get_field('location', 'options');
$social_channels = have_rows('social_media', 'options');

$menu_items = Torque_Nav_Menus::get_nav_menu_items_by_location('footer');
?>

<div class="footer-bottom">
    <?php include locate_template('/parts/shared/header-parts/menu-items/menu-items-stacked.php'); ?>
    <div class="footer-bottom-icons">
        <div class="wrap-item">
            <a href="tel:<?php echo $phone; ?>"><span class="icon-phone"></span></a>
        </div>
        <div class="wrap-item">
            <a href="<?php echo $email; ?>"><span class="icon-email"></span></a>
        </div>
        <div class="wrap-item">
            <a href="<?php echo $location; ?>" target="_blank"><span class="icon-location"></span></a>
        </div>
        <?php if ($social_channels) { ?>
            <?php
            while (have_rows('social_media', 'option')) : the_row();
                $socialchannel = get_sub_field('social_channel', 'option');
                $socialurl = get_sub_field('social_url', 'option');
                echo '<div class="wrap-item">';
                echo '<a class="social-link" rel="nofollow noopener noreferrer" href="' . $socialurl . '" target="_blank">';
                echo '<i class="social-icon fa fa-' . $socialchannel . '" aria-hidden="true"></i>';
                echo '<span class="sr-only hidden">' . ucfirst($socialchannel) . '</span>';
                echo '</a></div>';
            endwhile;
            ?>
        <?php } ?>
    </div>
</div>