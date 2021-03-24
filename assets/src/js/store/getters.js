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
	countMinutes(state) {
		return  state.test.testTime;
	},
	showRegisterPopup(state) {
		return state.showRegisterPopup;
	},
	showLoginPopup(state) {
		return state.showLoginPopup;
	},
	isTestPage(state) {
		return state.isTestPage;
	}

};

export default getters;