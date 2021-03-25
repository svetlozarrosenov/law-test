var getters = {
	getDomain(state) {
		return state.domain;
	},
	getCurrentQuestion(state) {
		return state.test.currentQuestion;
	},
	getRightAnswers(state) {
		return state.test.rightAnswers;
	},
	getTime(state) {
		return  state.test.testTime;
	},
	showRegisterPopup(state) {
		return state.showRegisterPopup;
	},
	showLoginPopup(state) {
		return state.showLoginPopup;
	},
	showTest(state) {
		return state.showTest;
	},
	showTestResults(state) {
		return state.showTestResults;
	}

};

export default getters;