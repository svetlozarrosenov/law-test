<?php
namespace App\Test;

class Paywall {
	private $clientSecret;

	public function __construct() {
		$this->clientSecret = 'sk_test_kV6YIBnQqyA0KSTtThCgSb8h00qnsk7JkQ';
		
		\Stripe\Stripe::setApiKey( $this->clientSecret );

		$intent = \Stripe\PaymentIntent::create([
			'amount' => 1099,
			'currency' => 'bgn',
			// Verify your integration in this guide by including this parameter
			'metadata' => ['integration_check' => 'accept_a_payment'],
		]);
		
		$this->createClientForm( $intent );
	}

	public static function createClientForm( $intent ) {
		?>
		<form id="payment-form">
		<div id="card-element">
			<!-- Elements will create input elements here -->
		</div>

		<!-- We'll put the error messages in this element -->
		<div id="card-errors" role="alert"></div>

		<button id="submit" data-secret="<?= $intent->client_secret ?>">Pay</button>
		</form>
		<?php
	}
}