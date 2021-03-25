var mutations = {
	startApp(state, payload){
		state.showTest = payload.showTest;
		state.showTestResults = false;
		state.test.questions = payload.test.questions;
		state.test.currentQuestion = state.test.questions[0];
		state.test.rightAnswers = 0;

		let initialTime = new Date("1971/01/01 00:00:00");

		state.test.testTime = new Date( initialTime.getTime() + (payload.test.testTime*60*1000) );		
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
	decreaseTime(state) {
		state.test.testTime = new Date( state.test.testTime.getTime() - 1000 );
	},
	showOrHideTest(state) {
		state.showTest = !state.showTest;
	},
	showTest(state) {
		state.showTest = true;
	},
	hideTest(state) {
		state.showTest = false;
	},
	showOrHideTestResults(state) {
		state.showTestResults = !state.showTestResults;
	},
	showTestResults(state) {
		state.showTestResults = true;
	}
};

export default mutations;