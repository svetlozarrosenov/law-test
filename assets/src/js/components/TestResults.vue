<template>
	<div v-show="showTestResults" class="test-container">
		<div class="test-results">
			<h2 class="test-results__title">Резултати</h2><!-- test-results__title -->
			
			<div class="test-results__right-answers">
				Оставащо време: {{getTime}}
			</div><!-- test-step__right-answers -->

			<div class="test-results__questions">
				Въпроси: {{numberOfQuestions}}
			</div><!-- test-question-number -->
			
			<div class="test-results__right-answers">
				Верни отговори: {{rightAnswers}}
			</div><!-- test-step__right-answers -->

			<div class="test-actions">
				<button @click="seeTheTest" class="btn btn--prev">Разгледай теста</button>
				
				<button @click="resetTest" class="btn btn--next">Опитай Отново</button>
			</div><!-- test-actions -->
		</div><!-- test-results -->		
	</div><!-- test-container -->
</template>

<script>
	import store from '../store/state';

	export default {
		name: 'app',
		components: {
		},
		data() {
			return {
			}
		},
		methods: {
			seeTheTest: function() {
				this.$store.commit('showOrHideTest');
				this.$store.commit('showOrHideTestResults');
			},
			resetTest: function() {
				store.dispatch('startApp');
			}
		},
		computed: {
			getTime: function() {
				let testStartTime = this.$store.getters.getTime;
				if(!testStartTime){
					return;
				}

				let hours = testStartTime.getHours();
				hours = ("0" + hours).slice(-2);

				let minutes = testStartTime.getMinutes();
				minutes = ("0" + minutes).slice(-2);

				let seconds = testStartTime.getSeconds();
				seconds = ("0" + seconds).slice(-2);

				return hours + ':' + minutes + ':' + seconds;
			},
			rightAnswers: function() {
				let rightAnswers = this.$store.getters.getRightAnswers;

				return rightAnswers;
			},
			numberOfQuestions: function() {
				let numberOfQuestions = this.$store.state.test.questions.length;
				return numberOfQuestions;
			},
			showTestResults: function() {
				let showTestResults = this.$store.getters.showTestResults;
				return showTestResults;
			}
		}
	}
</script>
