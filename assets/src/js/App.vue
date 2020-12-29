<template>
	<div id="app">
		<CheckoutPage/>
		<RegisterPopup/>
		<LoginPopup/>
		<Test/>
	</div><!-- app -->
</template>

<script>
	import CheckoutPage from './components/CheckoutPage.vue';
	import RegisterPopup from './components/RegisterPopup.vue';
	import LoginPopup from './components/LoginPopup.vue';
	import Test from './components/Test.vue';
	export default {
		name: 'app',
		components: {
			CheckoutPage,
			RegisterPopup,
			LoginPopup,
			Test,
		},
		data() {
			return {
			}
		},
	}
</script>
