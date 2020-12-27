import $ from 'jquery';

function paywall () {
	var stripe = Stripe('pk_test_9xIM265FWMlLRQvwIqJSEwJ300QB0E7H8C');

	var elements = stripe.elements();

	var style = {
		base: {
			color: "#32325d",
		}
	};

	var card = elements.create("card", { style: style });
	card.mount("#card-element");

	var form = document.getElementById('payment-form');

	var clientSecret = $('#submit').data('secret');

	form.addEventListener('submit', function(ev) {
		ev.preventDefault();
		stripe.confirmCardPayment(clientSecret, {
			payment_method: {
				card: card,
				billing_details: {
					name: 'Jenny Rosen'
				}
			}
		}).then(function(result) {
				console.log(result);
			if (result.error) {
				// Show error to your customer (e.g., insufficient funds)
				console.log(result.error.message);
			} else {
				// The payment has been processed!
				if (result.paymentIntent.status === 'succeeded') {
					// Show a success message to your customer
					// There's a risk of the customer closing the window before callback
					// execution. Set up a webhook or plugin to listen for the
					// payment_intent.succeeded event that handles any business critical
					// post-payment actions.
				}
			}
		});
	}); 
}

export default paywall;