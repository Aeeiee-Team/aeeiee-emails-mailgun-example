<?php
/**
 * Aeeiee Email Plugin
 *
 * @author              Aeeiee Inc.
 *
 * @wordpress-plugin
 * Plugin Name:        Aeeiee E-mail Plugin
 * Description:        This plugin allows us send e-mails using the Mailgun service.
 * Author:            Aeeiee Inc.
 * Author URI:        https://www.aeeiee.com
 * Version:            1.0
 * Requires PHP:     7.2
 */

require_once plugin_dir_path( __FILE__) . 'vendor/autoload.php';

use Mailgun\Mailgun;

 	/**
  	*  Register the send_mailgun_email shortcode
  	*/
	add_shortcode( 'send_mailgun_email', 'init_send_mailgun_email_shortcode' );

	/**
	 * Register the callback action for when the form is submitted
	 */
	add_action( 'admin_post_nopriv_appointment_form', 'aeeiee_email_send_the_email' );
	add_action( 'admin_post_appointment_form', 'aeeiee_email_send_the_email' );


	/**
	 * Enqueue Bootstrap5
	 */
	function boostrap_scripts() {
		wp_enqueue_style('bootstrap5css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css');
		wp_enqueue_script( 'bootstrap5js','https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js');
	}

	add_action( 'wp_enqueue_scripts', 'boostrap_scripts' );

	/**
	* Runs when the send_mailgun_email shortcode is called
	 */
	function init_send_mailgun_email_shortcode() {
		display_form();
 	}

	/**
	 * appointment form HTML
	 */
	function display_form(){
		require_once plugin_dir_path( __FILE__) . 'views/display-form.php';
	}


	 /**
	  * Handles form submission
	  */
	function submit_form(){
		send_the_email();
	}


	/**
	 * sends the email
	 */

	 function aeeiee_email_send_the_email(){
		if ( isset( $_POST['send_mailgun_email'] ) ) {

			// check if nonce is valid
		$nonce = $_POST['appointment_form'];
		
		if(!wp_verify_nonce($nonce)){
			die('Invalid nonce');
		}
			// sanitize form values
			$to_email = sanitize_email( $_POST["to_email"] );
			$sender_name = sanitize_text_field( $_POST["sender_name"] );
			$time_slot = $_POST["time_slot"];

			$mg = Mailgun::create('YOUR_API_KEY');

			$domain = "YOUR_MAILGUN_DOMAIN";
			$res = $mg->messages()->send($domain, [
				'from'    => 'me@'.$domain,
				'to'      => $to_email,
				'subject' => 'Your appointment with Aeeiee has been scheduled!',
				'text'    => "Dear $sender_name, Thank you for booking an appointment with one of our Engineers. Please see your appointment details below. \n $time_slot",
			  ]);
		}
	 }


 ?>