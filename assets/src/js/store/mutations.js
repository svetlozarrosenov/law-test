var mutations = {
	setTest(state, payload){
		state.questions = payload.questions;
		state.domain = payload.domain;
		state.currentQuestion = state.questions[0];

		state.initialTime = new Date("1971/01/01 00:00:00");

		state.testTime = new Date( state.initialTime );

		state.testTime.setMinutes(state.initialTime.getMinutes() + payload.time);		
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
			state.rightAnswers++;
		}else{
			payload.event.answer_class = 'wrong-answer';
			this.commit('findRightAnswer', payload.index);
		}

		state.questions[payload.index].answered = true;
		state.currentQuestion = state.questions[payload.index];
	},
	findRightAnswer(state, index) {
		state.questions[index].answers.forEach((answer, index) => {
			if(answer.right_answer){
				answer.answer_class = 'right-answer';
			}
		});
	},
	nextQuestion(state, index) {
		state.questions[index].show = false;
		state.questions[index +1].show = true;
		state.currentQuestion = state.questions[index +1];
	},
	prevQuestion(state, index) {
		state.questions[index].show = false;
		state.questions[index -1].show = true;
		state.currentQuestion = state.questions[index -1];
	},
};

export default mutations;