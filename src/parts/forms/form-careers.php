<?php

if (isset($_POST['tq-careers-form'])) {
  // form was submitted
  try {
    if (
      ! $_POST['tq-name']       ||
      ! $_POST['tq-email']      ||
      ! $_POST['tq-phone']      ||
      ! $_POST['tq-intro']      ||
      ! isset($_FILES['tq-resume'])
    ) {
      throw new Exception('All form fields are required');
    }

    if (
      ! isset($_POST['_wpnonce']) ||
      ! wp_verify_nonce( $_POST['_wpnonce'], 'submit_careers_form' )
    ) {
      // couldnt verify nonce
      throw new Exception('Form failed validation');
    }

    if ( ! class_exists('Torque_Job_Application_CPT') ) {
      // job applications cpt failed to load
      throw new Exception('Couldnt find plugin class');
    }

    // form is validated - can save the application post

    $application_id = Interra_Job_Application_CPT::save_application( $_POST['tq-name'], $_POST );

    if ( ! $application_id ) {
      throw new Exception();
    }

    // lets upload the resume pdf

    require_once( ABSPATH . 'wp-admin/includes/image.php' );
  	require_once( ABSPATH . 'wp-admin/includes/file.php' );
  	require_once( ABSPATH . 'wp-admin/includes/media.php' );
    $media_id = media_handle_upload( 'tq-resume', $application_id );

    if ( ! $media_id || is_wp_error($media_id) ) {
      throw new Exception('Failed uploading resume');
    }

    Interra_Job_Application_CPT::attach_resume($media_id, $application_id);

    $message = array(
      'success' => true,
      'message' => 'Thank you for your application. Your application ID is '.$application_id
    );

  } catch (Exception $e) {

    $message = array(
      'success' => false,
      'message' => $e->getMessage() !== '' ? $e->getMessage() : 'Something went wrong'
    );
  }
}

include locate_template( 'parts/forms/form-careers-template.php', false, false);

?>
