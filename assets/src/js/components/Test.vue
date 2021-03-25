<template>
	<div v-show="showTest" class="test-container">
		<InfoPopup/>
		
		Време: {{getTime}}

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

			<div v-show="!testIsStarted" class="test-step__actions">
				<button class="btn" @click="startTest">Започни теста</button>
			</div><!-- test-step__actions -->
			
			<div v-show="testIsStarted" class="test-step__actions">
				<button v-show="qIndex > 0" @click="prevQuestion(qIndex)" class="btn btn--prev">Предишен</button>
				
				<button v-show="qIndex < test.length -1" @click="nextQuestion(qIndex)" class="btn btn--next">Следващ</button>

				<button v-show="qIndex == test.length -1" @click="finishTheTest(qIndex)" class="btn btn--next">Предай</button>
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
				testIsStarted: false,
				testTime: false
			}
		},
		methods: {
			checkAnswer(event, index, question) {
				if(!this.testIsStarted){
					return;
				}

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
			},
			finishTheTest(index) {
				this.$store.commit('showTestResults');
				this.$store.commit('showOrHideTest');
				clearInterval(this.testTime); 
			},
			startTest() {
				this.testIsStarted = true;

				this.testTime = setInterval(() => { 
						this.$store.commit('decreaseTime', {
					}); 
				}, 1000);
			}
		},
		computed: {
			test: function() {
				let test = this.$store.state.test.questions;
				return test;
			},
			rightAnswers: function() {
				let rightAnswers = this.$store.getters.getRightAnswers;

				return rightAnswers;
			},
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
			showTest: function() {
				let showTest = this.$store.getters.showTest;
				return showTest;
			}
		}
	}
</script>

<style>

</style>
