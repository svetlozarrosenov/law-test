import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

import actions from './actions.js';
import mutations from './mutations.js';
import state from './data.js';
import getters from './getters.js';

Vue.use(Vuex);

const store = new Vuex.Store({
	strict: true,
	state,
	mutations,
	actions,
	getters
});

export default store;