var mutations = {
	startApp(state, payload){
		state.isTestPage = payload.isTestPage;
		state.test.questions = payload.questions;
		state.test.domain = payload.domain;
		state.test.currentQuestion = state.test.questions[0];

		state.test.initialTime = new Date("1971/01/01 00:00:00");

		state.test.testTime = new Date( state.test.initialTime );

		state.test.testTime.setMinutes(state.test.initialTime.getMinutes() + payload.time);		
	},
	reverseRegisterPopup(state, payload) {
		state.showRegisterPopup = !state.showRegisterPopup;
	},
	reverseLoginPopup(state, payload) {
		state.showLoginPopup = !state.showLoginPopup;	
	},
	checkAnswer(state, payload) {
		if(payload.question.answered){
			return;
		}

		if(payload.event.right_answer) {
			payload.event.answer_class = 'right-answer';
			state.test.rightAnswers++;
		}else{
			payload.event.answer_class = 'wrong-answer';
			this.commit('findRightAnswer', payload.index);
		}

		state.test.questions[payload.index].answered = true;
		state.test.currentQuestion = state.test.questions[payload.index];
	},
	findRightAnswer(state, index) {
		state.test.questions[index].answers.forEach((answer, index) => {
			if(answer.right_answer){
				answer.answer_class = 'right-answer';
			}
		});
	},
	nextQuestion(state, index) {
		state.test.questions[index].show = false;
		state.test.questions[index +1].show = true;
		state.test.currentQuestion = state.test.questions[index +1];
	},
	prevQuestion(state, index) {
		state.test.questions[index].show = false;
		state.test.questions[index -1].show = true;
		state.test.currentQuestion = state.test.questions[index -1];
	},
};

export default mutations;