<template>
	<div class="section section-popup">		
		<div @click="showModal = !showModal" v-show="currentQuestion.answered && currentQuestion.info" class="info open-popup-link">
			<img :src="[domain] + 'wp-content/plugins/test-maker/assets/images/question.gif'">
		</div><!-- info -->

		<div v-show="showModal" class="popup-modal">
			<div class="popup-modal__info-box">
				<div @click="showModal = !showModal" class="popup-moda__close"></div><!-- popup-moda__close -->

				{{currentQuestion.info}}
			</div><!-- info-box -->
		</div><!-- popup-modal -->
	</div><!-- section-home -->
</template>

<script>
export default {
	data() {
		return {
			showModal: false,
		}
	},
	computed: {
		domain() {
			let domain = this.$store.getters.getDomain;
			return domain;
		},
		currentQuestion() {
			let currentQuestion = this.$store.getters.getCurrentQuestion;

			return currentQuestion;
		}
	}
}
</script>
