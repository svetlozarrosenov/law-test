var getters = {
	getDomain(state) {
		return state.domain;
	},
	getCurrentQuestion(state) {
		return state.currentQuestion;
	},
	getRightAnswers(state) {
		return state.rightAnswers;
	},
	countMinutes(state) {
		if ( !state.testTime ) {
			return;
		}
		return  state.testTime.getHours() + ':' + state.testTime.getMinutes();
	},
	showRegisterPopup(state) {
		return state.showRegisterPopup;
	},
	showLoginPopup(state) {
		return state.showLoginPopup;
	},

};

export default getters;