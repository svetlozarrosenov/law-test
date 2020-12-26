import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

var actions = {
	getTest({commit, getters, state}){
		var data = new FormData();

		data.append('action', 'crb_ajax_get_questions');
		data.append('postID', crb_site_utils.postID);

		var $promise = axios({
			method: 'post',
			url: crb_site_utils.ajaxurl,
			data: data
		})
		.then((response) => {
			commit({
				type: 'setTest',
				questions: response.data.data.questions,
				domain: response.data.data.domain,
				time: response.data.data.time,
			});
		})
		.catch(function (error) {
			console.log(error);
		});

		return $promise;
	},
	startTest({commit, getters, state}) {
		setInterval(function(){ 
			state.testTime - 1000; 
		}, 1000);
	}
}

export default actions;