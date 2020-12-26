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
		console.log(state.testTime.getMinutes());
		return  state.testTime.getHours() + ':' + state.testTime.getMinutes();
	}
};

export default getters;