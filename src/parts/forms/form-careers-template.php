<div id="careers-form" class="careers-form">
  <h2>Start Wearing Green</h2>

  <div class="form-intro" >
    If you’re interested in any of these positions, fill out this form, and get started on the path to Interra.
  </div>

  <?php if (isset($message)) {
    $success_class = ! $message['success'] ? 'error' : '';
    ?>
    <div class="form-message <?php echo $success_class; ?>">
      <?php echo $message['message']; ?>
    </div>
  <?php } ?>

  <form method="post" action="#careers-form" enctype="multipart/form-data">

    <?php echo wp_nonce_field( 'submit_careers_form' ); ?>

    <?php
    // this hidden input is important for us to know
    // if the form has been submitted yet
    // so we can check that all fields are filled
    ?>
    <input type="hidden" name="tq-careers-form" />

    <div class="input-wrapper">
      <input type="text" name="tq-name" id="tq-name" placeholder="Name"/>
    </div>

    <div class="input-wrapper">
      <input type="email" name="tq-email" id="tq-email" placeholder="Email Address"/>
    </div>

    <div class="input-wrapper">
      <input type="tel" name="tq-phone" id="tq-phone" placeholder="Phone Number"/>
    </div>

    <div class="input-wrapper">
      <textarea name="tq-intro" id="tq-intro" placeholder="Tell us about yourself"></textarea>
    </div>

    <div class="input-wrapper">
      <div class="file-picker">
        <label for="tq-resume" >Upload Resume</label>
        <label for="tq-resume" class="filename">Choose File</label>
        <input type="file" accept=".pdf" name="tq-resume" id="tq-resume" />
      </div>
    </div>

    <div class="input-wrapper" >
      <?php echo do_shortcode('[torque_recaptcha]'); ?>
    </div>

    <button type="submit" class="white">Send</button>
  </form>

</div>
