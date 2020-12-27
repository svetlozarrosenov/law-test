<template>
	<div id="app">
		<RegisterPopup/>
		<LoginPopup/>
		<Test/>
	</div><!-- app -->
</template>

<script>
	import Test from './components/Test.vue';
	import RegisterPopup from './components/RegisterPopup.vue';
	import LoginPopup from './components/LoginPopup.vue';
	export default {
		name: 'app',
		components: {
			Test,
			RegisterPopup,
			LoginPopup
		},
		data() {
			return {
			}
		},
	}
</script>
