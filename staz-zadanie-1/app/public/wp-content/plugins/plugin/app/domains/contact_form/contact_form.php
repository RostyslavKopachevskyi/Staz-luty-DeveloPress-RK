<?php
/**
 * Functionality responsible sending emails with email form
 */

namespace dp\app\domains\contact_form;

/**
 * Define functionality for contact form
 */
class Contact_Form {
	/**
	 * Add AJAX support for the form
	 */
	public function __construct() {
		add_action( 'wp_ajax_send_from_contact_form', [ $this, 'sender_handler' ] );
		add_action( 'wp_ajax_nopriv_send_from_contact_form', [ $this, 'sender_handler' ] );
	}

	/**
	 * Sender handler
	 */
	function sender_handler(): void {
		if (
			! isset( $_POST['nonce'] )
			|| ! wp_verify_nonce( sanitize_text_field( $_POST['nonce'] ), 'wp_ajax' )
		) {
			wp_send_json_error( __( 'You passed incorrect data...', 'dp' ) );
		}

		$args = [];

		if ( isset( $_POST['name'] ) ) {
			$args['name'] = sanitize_text_field( $_POST['name'] );
		}
		if ( isset( $_POST['message'] ) ) {
			$args['message'] = sanitize_text_field( $_POST['message'] );
		}
		if ( isset( $_POST['email'] ) ) {
			$args['email'] = sanitize_email( $_POST['email'] );
		}
		if ( isset( $_POST['url'] ) ) {
			$args['url'] = esc_url_raw( $_POST['url'] );
		}

		$message = $this->print_message( $args );

		if ( $this->send_message( $message ) ) {
			wp_send_json_success();
		} else {
			wp_send_json_error();
		}
	}

	/**
	 * Prepare a message that should be send
	 *
	 * @param array $args parameters to use in the email content.
	 *
	 * @return string
	 */
	function print_message( array $args ): string {
		return sprintf(
			'Hello,<br>there is a new message from the %s website.<br><br>
		<b>Sender:</b> %s (%s)<br>
		<b>Message:</b> %s<br>
		<b>Message sent from:</b> <a href="%s">%s</a><br>
		',
			get_option( 'blogname' ),
			$args['name'],
			$args['email'],
			$args['message'],
			$args['url'],
			$args['url'],
		);
	}

	/**
	 * Send the message with email
	 *
	 * @param string $message Message content to send.
	 *
	 * @return bool
	 */
	function send_message( string $message ): bool {
		$admin_email = get_option( 'admin_email' );
		$title       = sprintf(
			__( 'Message from the Comprehend website', 'dp' ),
			get_option( 'blogname' )
		);

		return wp_mail( // phpcs:ignore
			$admin_email,
			$title,
			$message,
			[ 'Content-Type: text/html; charset=UTF-8' ]
		);
	}
}
