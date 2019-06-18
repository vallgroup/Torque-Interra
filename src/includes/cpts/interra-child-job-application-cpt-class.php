<?php

class Interra_Job_Application_CPT
{

	public function __construct()
	{
		add_filter(Torque_Job_Application_CPT::$PUBLIC_FILTER_HOOK, function () {
			return true;
		});

		add_action('acf/init', array($this, 'add_acf_metaboxes'));
	}

	public static function save_application(string $applicant_name, array $application_data)
	{
		$email = $application_data['tq-email'];
		$phone = $application_data['tq-phone'];
		$intro = $application_data['tq-intro'];

		$application = array(
			'post_title'    => $applicant_name,
			'post_content'  => $intro,
			'post_status'   => 'publish',
			'post_type'			=> Torque_Job_Application_CPT::$job_applications_labels['post_type_name']
		);

		// Insert the post into the database
		$application_id = wp_insert_post($application);

		update_field('field_5ca514f92f6b0', $email, $application_id);
		update_field('field_5ca5151a2f6b1', $phone, $application_id);

		return $application_id;
	}

	public static function attach_resume($media_id, $application_id)
	{
		update_field('field_5ca515302f6b2', $media_id, $application_id);
	}

	public static function send_admin_notification(string $application_id, string $notification_email, array $application_data)
	{

		/*
		* Initialize phpmailer class
		*/
		global $phpmailer;

		// (Re)create it, if it's gone missing
		if (!($phpmailer instanceof PHPMailer)) {
			require_once ABSPATH . WPINC . '/class-phpmailer.php';
			require_once ABSPATH . WPINC . '/class-smtp.php';
		}
		$phpmailer = new PHPMailer;

		// SMTP configuration
		$smtp_server = get_field('smtp_server', 'options');
		$smtp_port = (int)get_field('smtp_port', 'options');
		$smtp_security = strtolower(get_field('smtp_security', 'options'));
		$smtp_email = get_field('smtp_email', 'options');
		$smtp_password = get_field('smtp_password', 'options');

		if ( $smtp_server && $smtp_port && $smtp_security && $smtp_email & $smtp_password ) {
			$phpmailer->isSMTP(true);
			$phpmailer->Host = $smtp_server;
			$phpmailer->Port = $smtp_port;
			$phpmailer->SMTPSecure = $smtp_security;
			$phpmailer->SMTPAuth = true;
			$phpmailer->Username = $smtp_email;
			$phpmailer->Password = $smtp_password;
		}

		// Set email format to HTML
		$phpmailer->isHTML(true);

		// Email subject
		$phpmailer->Subject = 'Career Application | Interra Realty';

		// Gather $_POST vars
		$name = $application_data['tq-name'];
		$email = $application_data['tq-email'];
		$phone = $application_data['tq-phone'];
		$intro = $application_data['tq-intro'];

		// Compile email message
		$mailContent = '<p>Hi, <br><br>You have just received a new job application for Interra Realty. Please see below for details:</p><ul>';
		$mailContent .= '<li><strong>Name: </strong>' . $name . '</li>';
		$mailContent .= '<li><strong>Email: </strong>' . $email . '</li>';
		$mailContent .= '<li><strong>Phone: </strong>' . $phone . '</li>';
		$mailContent .= '<li><strong>Intro: </strong>' . $intro . '</li>';
		$mailContent .= '<li><strong>Resume: </strong><a href="' . get_site_url() . '/wp-admin/post.php?post=' . $application_id . '&action=edit">' . get_site_url() . '/wp-admin/post.php?post=' . $application_id . '&action=edit</a></li>';
		$mailContent .= '</ul>';
		$mailContent .= '<p>Note: to repond to the applicant directly you can reply to this email.</p>';

		// Email body content
		$phpmailer->Body = $mailContent;

		$phpmailer->setFrom($smtp_email);

		// Add a recipient
		$phpmailer->addAddress( ( $notification_email != '' ? $notification_email : get_option( 'admin_email' ) ) );

		// Add cc or bcc 
		// $phpmailer->addCC('cc@example.com');
		// $phpmailer->addBCC('bcc@example.com');

		$mailResult = $phpmailer->send();

		return $mailResult;

	}

	public function add_acf_metaboxes()
	{
		if (function_exists('acf_add_local_field_group')) :

			acf_add_local_field_group(array(
				'key' => 'group_5ca514ef6a1ae',
				'title' => 'Job Application Data',
				'fields' => array(
					array(
						'key' => 'field_5ca514f92f6b0',
						'label' => 'Email',
						'name' => 'job_application_email',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ca5151a2f6b1',
						'label' => 'Phone',
						'name' => 'job_application_phone',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ca515302f6b2',
						'label' => 'Resume',
						'name' => 'job_application_resume',
						'type' => 'file',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'id',
						'library' => 'all',
						'min_size' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'torque_job_app',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

		endif;
	}
}
