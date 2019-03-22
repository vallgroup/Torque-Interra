<?php

$modules = 'modules';

if ( have_rows( $modules ) ):

  while ( have_rows( $modules ) ) : the_row();

    switch ( get_row_layout() ) {

      case 'content_section' :

        $align = get_sub_field( 'align' );
        $image = get_sub_field('image');
        $heading = get_sub_field( 'heading' );
        $content = get_sub_field( 'content' );
        $cta = get_sub_field('cta');

        include locate_template('/parts/acf/modules/content-section.php');

        break;

      case 'post_slideshow' :

        $slideshow_id = get_sub_field('slideshow_id');

        echo do_shortcode('[torque_slideshow id="'.$slideshow_id.'" type="post" template="interra"]');

        break;

    }

  endwhile;
endif;

?>
