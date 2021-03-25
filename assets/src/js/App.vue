<template>
	<div id="app">
		<CheckoutPage/>
		<RegisterPopup/>
		<LoginPopup/>
		<Test/>
		<TestResults/>
	</div><!-- app -->
</template>

<script>
	import CheckoutPage from './components/CheckoutPage.vue';
	import RegisterPopup from './components/RegisterPopup.vue';
	import LoginPopup from './components/LoginPopup.vue';
	import Test from './components/Test.vue';
	import TestResults from './components/TestResults.vue';
	export default {
		name: 'app',
		components: {
			CheckoutPage,
			RegisterPopup,
			LoginPopup,
			Test,
			TestResults,
		},
		data() {
			return {
			}
		},
	}
</script>
