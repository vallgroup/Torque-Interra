<?php

require_once( get_template_directory() . '/includes/customizer/customizer-tabs/tabs/torque-customizer-tab-site-identity-class.php' );

$tab_settings = Torque_Customizer_Tab_Site_Identity::get_settings();

$logo_src = get_theme_mod( $tab_settings['logo_white_setting'] );

if ( $logo_src ) {
?>

  <a href="<?php echo get_home_url(); ?>" title="Interra Realty home">
    <div>
      <img class="torque-logo torque-header-logo torque-logo-white" src="<?php echo $logo_src; ?>" alt="Interra Realty logo" />
    </div>
  </a>

<?php
}

?>
