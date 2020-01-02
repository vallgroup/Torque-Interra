<?php

$action = 'https://torquelaunch.us20.list-manage.com/subscribe/post?u=ad84318294be29bb41e051167&amp;id=f999becc29';

$title = get_sub_field( 'mailchimp_title' );
$desc = get_sub_field( 'mailchimp_desc' );

 ?>

<div class="interra-mailchimp-form">

<!-- Begin Mailchimp Signup Form -->
<!-- <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css"> -->
<!-- <style type="text/css">
  #mc_embed_signup{background:#fff; clear:left; }
</style>
<div id="mc_embed_signup">
  <form action="<?php echo $action; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
      <div id="mc_embed_signup_scroll">

        <h2>
          <?php echo $title; ?>
        </h2>

        <p>
          <?php echo $desc; ?>
        </p>

        <div class="mc-field-group first">
          <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name">
        </div>

        <div class="mc-field-group last">
          <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name">
        </div>

        <div style="clear: both;">
        </div>

        <div class="mc-field-group email">
          <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
        </div>


        <div style="position: absolute; left: -5000px;" aria-hidden="true">
          <input type="text" name="b_ad84318294be29bb41e051167_f999becc29" tabindex="-1" value="">
        </div>

        <div class="clear submit-btn">
          <input type="submit" value="Sign Up" name="subscribe" id="mc-embedded-subscribe" class="button">
        </div>

        <div style="clear: both;">
        </div>

        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display:none">
          </div>
          <div class="response" id="mce-success-response" style="display:none">
          </div>
        </div>

      </div>
  </form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'>
</script>
<script type='text/javascript'>
(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[0]='EMAIL';ftypes[0]='email';}(jQuery));var $mcj = jQuery.noConflict(true);
</script> -->
<!--End mc_embed_signup-->

<!-- iContact Form -->
<div id="mc_embed_signup">

<div id="mc-embedded-subscribe-form">
  <h2>
    <?php echo $title; ?>
  </h2>

  <p>
    <?php echo $desc; ?>
  </p>


  <script type="text/javascript" src="//app.icontact.com/icp/static/form/javascripts/validation-captcha.js"></script>

  <script type="text/javascript" src="//app.icontact.com/icp/static/form/javascripts/tracking.js"></script>

  <link rel="stylesheet" type="text/css" href="//app.icontact.com/icp/static/human/css/signupBuilder/formGlobalStyles.css">

  <style type="text/css" id="signupBuilderAdvancedStyles">

  </style>

  <style type="text/css" id="signupBuilderStyles">
  #ic_signupform .elcontainer {
     background: #ffffff;
     text-align: left;
     max-width: 600px;
     padding: 3px 0px;
     border-radius: 3px;
     border: 1px none #acacac;
     font-size: 12px;
     color: #5a5a5e;
     font-family: lucida grande;
  }

  #ic_signupform .elcontainer.center-aligned .formEl {
  	margin-right: auto;
  	margin-left: auto;
  }

  #ic_signupform .elcontainer.right-aligned .formEl {
  	margin-left: auto;
  }

  #ic_signupform .form-header {

        display: none;

     background: #ffffff;
     margin-top: -3px;
     margin-left: -0px;
     margin-right: -0px;
     margin-bottom: 3px; /* using padding on purpose */
     padding-top: 20px;
     padding-right: 0px;
     padding-bottom: 20px;
     padding-left: 0px;
     border-radius: calc(3px - 1px) calc(3px - 1px) 0 0;
     text-align: center;
     font-size: 150%;
     color: #333333;
     border-bottom: 1px solid #dddddd;
  }

  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-input label,
  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-dropdown label,
  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-checkbox h3,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-input label,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-dropdown label,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-checkbox h3 {
     width: 30%;
  }

  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-checkbox h3,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-checkbox h3 {
     line-height: 3em;
  }

  #ic_signupform .elcontainer.tight.inline-label-left .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.tight.inline-label-left .formEl.fieldtype-checkbox h3,
  #ic_signupform .elcontainer.tight.inline-label-right .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.tight.inline-label-right .formEl.fieldtype-checkbox h3 {
     line-height: 2em;
  }

  #ic_signupform .elcontainer.generous.inline-label-left .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.generous.inline-label-left .formEl.fieldtype-checkbox h3,
  #ic_signupform .elcontainer.generous.inline-label-right .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer.generous.inline-label-right .formEl.fieldtype-checkbox h3 {
     line-height: 4em;
  }

  #ic_signupform .elcontainer.inline-label-left .formEl input[type="text"],
  #ic_signupform .elcontainer.inline-label-left .formEl select,
  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-radio .option-container,
  #ic_signupform .elcontainer.inline-label-left .formEl.fieldtype-checkbox .option-container,
  #ic_signupform .elcontainer.inline-label-right .formEl input[type="text"],
  #ic_signupform .elcontainer.inline-label-right .formEl select,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-radio .option-container,
  #ic_signupform .elcontainer.inline-label-right .formEl.fieldtype-checkbox .option-container {
     width: 70%;
  }

  #ic_signupform .elcontainer.hidden-label .formEl.required:before {
     color: #bdbdbf;
  }

  #ic_signupform .elcontainer .formEl {
     font-size: 1em;
  }

  #ic_signupform .elcontainer .formEl.fieldtype-input label,
  #ic_signupform .elcontainer .formEl.fieldtype-dropdown label,
  #ic_signupform .elcontainer .formEl.fieldtype-radio h3,
  #ic_signupform .elcontainer .formEl.fieldtype-checkbox h3 {
     font-size: 100%;
     font-weight: bold;
     color: #5a5a5e;
  }

  #ic_signupform .elcontainer .formEl.fieldtype-input input[type="text"],
  #ic_signupform .elcontainer .formEl.fieldtype-dropdown select {
     background-color: #ffffff;
     border: 1px solid #78b855;
     border-radius: 0px;
  }

  #ic_signupform .elcontainer .formEl.fieldtype-input input[type="text"],
  #ic_signupform .elcontainer .formEl.fieldtype-dropdown select,
  #ic_signupform .elcontainer .formEl.fieldtype-radio label,
  #ic_signupform .elcontainer .formEl.fieldtype-checkbox label {
     font-size: 100%;
  }

  #ic_signupform .elcontainer .formEl input[type="text"]::-moz-placeholder {
     color: #bdbdbf;
     font-family: inherit;
  }

  #ic_signupform .elcontainer .formEl input[type="text"]::-webkit-input-placeholder {
     color: #bdbdbf;
     font-family: inherit;
  }

  #ic_signupform .elcontainer .formEl input[type="text"]:-ms-input-placeholder {
     color: #bdbdbf;
     font-family: inherit;
  }

  #ic_signupform .elcontainer .formEl input[type="text"],
  #ic_signupform .elcontainer .formEl select,
  #ic_signupform .elcontainer .formEl .option-container label {
     color: #bdbdbf;
     font-family: inherit;
  }

  #ic_signupform .elcontainer.inline-button .submit-container {
  	display: inline-block;
  	box-sizing: border-box;
  	right: -.5em;
  	padding: 0 1em 0 0;
  	position: relative;
  	vertical-align: bottom;
  	margin-bottom: 1em;
  }

  #ic_signupform .elcontainer.inline-button.tight .sortables {
  	margin-bottom: -.5em;
  }

  #ic_signupform .elcontainer.inline-button .sortables {
  	margin-bottom: -1em;
  }

  #ic_signupform .elcontainer.inline-button.generous .sortables {
  	margin-bottom: -1.5em;
  }

  #ic_signupform .elcontainer .submit-container {
     text-align: center;
  }

  #ic_signupform .elcontainer .submit-container input[type="submit"] {
     background: #78b855;
     border: 0px solid #78b855;
     border-radius: 0px;
     line-height: 1em;
     padding: 12px 31px;
     color: #ffffff;
     font-size: 100%;
     font-family: inherit;
     width: auto;
  }</style>

  <form id="ic_signupform" captcha-key="6LeCZCcUAAAAALhxcQ5fN80W6Wa2K3GqRQK6WRjA" captcha-theme="light" new-captcha="true" method="POST" action="https://app.icontact.com/icp/core/mycontacts/signup/designer/form/?id=412&cid=576446&lid=18679"><div class="elcontainer normal hidden-label left-aligned inline-button"><div class="form-header"><h3>Form Heading</h3></div><div class="sortables"><div class="formEl fieldtype-input required" data-validation-type="1" data-label="First Name" style="display: inline-block; width: 50%;"><label>First Name<span class="indicator required">*</span></label><input type="text" placeholder="First Name" name="data[fname]"></div><div class="formEl fieldtype-input required" data-validation-type="1" data-label="Last Name" style="display: inline-block; width: 50%;"><label>Last Name<span class="indicator required">*</span></label><input type="text" placeholder="Last Name" name="data[lname]"></div><div class="formEl fieldtype-input required" data-validation-type="1" data-label="Email" style="display: inline-block; width: 75%;"><label>Email<span class="indicator required">*</span></label><input type="text" placeholder="Email Address" name="data[email]"></div><div class="formEl fieldtype-checkbox required" dataname="listGroups" data-validation-type="1" data-label="Lists" style="display: none; width: 100%;"><h3>Lists<span class="indicator required">*</span></h3><div class="option-container"><label class="checkbox"><input type="checkbox" alt="Lists" name="data[listGroups][]" value="790469" checked="checked">Unassigned From Contact Form</label></div></div><div class="submit-container"><input type="submit" value="Submit" class="btn btn-submit"></div></div><div class="hidden-container"></div></div></form><img src="//app.icontact.com/icp/core/signup/tracking.gif?id=412&cid=576446&lid=18679"/>

</div>

<!-- <form id="mc-embedded-subscribe-form" captcha-key="6LeCZCcUAAAAALhxcQ5fN80W6Wa2K3GqRQK6WRjA" captcha-theme="light" new-captcha="true" method="POST" action="https://app.icontact.com/icp/core/mycontacts/signup/designer/form/?id=412&cid=576446&lid=18679">
  <div id="mc_embed_signup_scroll">

    <h2>
      <?php echo $title; ?>
    </h2>

    <p>
      <?php echo $desc; ?>
    </p>

    <div class="mc-field-group first" data-validation-type="1" data-label="First Name">
      <input type="text" name="data[fname]" placeholder="First Name">
    </div>
    <div class="mc-field-group last" data-validation-type="1" data-label="Last Name">
      <input type="text" name="data[lname]" placeholder="Last Name">
    </div>

    <div style="clear: both;">
    </div>

    <div class="mc-field-group email" data-validation-type="1" data-label="Email">
      <input type="text" name="data[email]" placeholder="Email Address">
    </div>

    <div class="clear submit-btn">
      <input type="submit" value="Submit" id="mc-embedded-subscribe" class="button">
    </div>

    <div style="clear: both;">
    </div>

<div class="formEl fieldtype-checkbox required" dataname="listGroups" data-validation-type="1" data-label="Lists" style="display: none; width: 100%;">
<h3>Lists<span class="indicator required">*</span>
</h3>
<div class="option-container">
<label class="checkbox">
<input type="checkbox" alt="" name="data[listGroups][]" value="790469" checked="checked">Unassigned From Contact Form</label>
</div>
</div>
    </div>
  </form>
  <img src="//app.icontact.com/icp/core/signup/tracking.gif?id=null&cid=576446&lid=18679"/> -->

</div>
<!-- End iContact Form -->

</div>
