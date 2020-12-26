<?php
namespace App\Test;


class Paywall {
	private $clientSecret;

	public function __construct() {
		\Stripe\Stripe::setApiKey('sk_test_kV6YIBnQqyA0KSTtThCgSb8h00qnsk7JkQ');
		
		$intent = \Stripe\PaymentIntent::create([
			'amount' => 500,
			'currency' => 'bgn',
			// Verify your integration in this guide by including this parameter
			'metadata' => ['integration_check' => 'accept_a_payment'],
		] );
		
		$this->clientSecret = $intent->client_secret;
		
		$this->createClientForm();
	}

	public function createClientForm() {
		?>
		<input id="card-name" type="text">
		<!-- placeholder for Elements -->
		<div id="card-element"></div>
		<button id="card-button" data-secret="<?= $this->clientSecret ?>">
		  Submit Payment
		</button>
		<?php
	}
}