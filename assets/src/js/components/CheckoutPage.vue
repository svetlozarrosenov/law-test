<template>
	<div class="test-container">
		<InfoPopup/>
		
		Време: {{countMinutes}}

		<div class="test-step" v-show="question.show" v-for="( question, qIndex ) in test" :key="question.qIndex">
			<div class="test-question-number">
				Въпроси: {{qIndex + 1}}/{{test.length}}
			</div><!-- test-question-number -->

			<div class="test-step__right-answers">
				Верни отговори: {{rightAnswers}}
			</div><!-- test-step__right-answers -->

			<h3 class="test-step__question">{{question.question}}</h3><!-- test-step__question -->

			<div class="test-step-answers">
				<p v-for="( answer, aIndex ) in question.answers" :key="answer.aIndex" class="test-step-answers__answer">
					<span @click="checkAnswer(answer, qIndex, question)" :class="[answer.answer_class]">{{answer.answer}}</span>
				</p><!-- test-step__answer -->
			</div><!-- test-step__answers -->

			<hr>

			<div class="test-step__actions">
				<button v-show="qIndex > 0" @click="prevQuestion(qIndex)" class="btn-prev">Предишен</button>
				
				<button v-show="qIndex < test.length -1" @click="nextQuestion(qIndex)" class="btn-next">Следващ</button>
			</div><!-- test-step__actions -->
		</div><!-- test-step -->
	</div><!-- test-container -->
</template>

<script>
	import InfoPopup from './InfoPopup.vue';

	export default {
		name: 'app',
		components: {
			InfoPopup
		},
		data() {
			return {
			}
		},
		methods: {
			checkAnswer(event, index, question) {
				this.$store.commit('checkAnswer', {
					event,
					index, 
					question
				});
			},
			nextQuestion(index) {
				this.$store.commit('nextQuestion', index);
			},
			prevQuestion(index) {
				this.$store.commit('prevQuestion', index);
			}
		},
		computed: {
			test: function() {
				let test = this.$store.state.questions;

				return test;
			},
			rightAnswers: function() {
				let rightAnswers = this.$store.getters.getRightAnswers;

				return rightAnswers;
			},
			countMinutes: function() {
				let minutesLeft = this.$store.getters.countMinutes;

				return minutesLeft;
			},
			isTestPage: function() {
				let isTestPage = this.$store.getters.isTestPage;
				return isTestPage;
			}
		}
	}
</script>

