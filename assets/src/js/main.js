import Vue from 'vue';
import App from './App.vue';
import store from './store/state'

store.dispatch('getTest');

new Vue({
	store,
	el: '#app',
	template: '<App/>',
	components: { App },
}).$mount('#app');

var stripe = Stripe('pk_test_9xIM265FWMlLRQvwIqJSEwJ300QB0E7H8C');

var purchase = {
  items: [{ id: "xl-tshirt" }]
};
// Disable the button until we have Stripe set up on the page
document.querySelector("button").disabled = true;
fetch("/create.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(purchase)
})
  .then(function(result) {
    return result.json();
  })
  .then(function(data) {
    var elements = stripe.elements();
    var style = {
      base: {
        color: "#32325d",
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
          color: "#32325d"
        }
      },
      invalid: {
        fontFamily: 'Arial, sans-serif',
        color: "#fa755a",
        iconColor: "#fa755a"
      }
    };
    var card = elements.create("card", { style: style });
    // Stripe injects an iframe into the DOM
    card.mount("#card-element");
    card.on("change", function (event) {
      // Disable the Pay button if there are no card details in the Element
      document.querySelector("button").disabled = event.empty;
      document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
    });
    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function(event) {
      event.preventDefault();
      // Complete payment when the submit button is clicked
      payWithCard(stripe, card, data.clientSecret);
    });
  });


// var elements = stripe.elements();

// console.log(elements);

// var cardElement = elements.create('card', {hidePostalCode: true});

// cardElement.mount('#card-element');