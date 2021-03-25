import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';

var actions = {
	startApp({commit, getters, state}){
		var data = new FormData();

		data.append('action', 'crb_ajax_start_app');
		data.append('postID', crb_site_utils.postID);
		
		var $promise = axios({
			method: 'post',
			url: crb_site_utils.ajaxurl,
			data: data
		})
		.then((response) => {
			commit({
				type: 'startApp',
				test: {
					questions: response.data.data.test.questions,
					domain: response.data.data.test.questions,
					testTime: response.data.data.test.testTime,
				},
				showTest: response.data.data.showTest,
				isProductPage: response.data.data.isProductPage,
				isLoggedIn: response.data.data.isLoggedIn,
			});
		})
		.catch(function (error) {
			console.log(error);
		});
	},
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
				time: response.data.data.testTime,
			});
		})
		.catch(function (error) {
			console.log(error);
		});

		var data = new FormData();

		data.append('action', 'crb_is_user_logged_in');
		var $promise = axios({
			method: 'post',
			url: crb_site_utils.ajaxurl,
			data: data
		})
		.then((response) => {
			commit({
				type: 'currentUserStatus',
				userStatus: response.data.data.is_logged_in
			});

			if (!response.data.data.is_logged_in) {
				setTimeout(()=>{  
					commit('reverseLoginPopup');
				}, 1000);
			}
		})
		.catch(function (error) {
			console.log(error);
		});

		var data = new FormData();

		data.append('action', 'crb_ajax_is_test_page');
		var $promise = axios({
			method: 'post',
			url: crb_site_utils.ajaxurl,
			data: data
		})
		.then((response) => {
			commit({
				type: 'showTest',
				showTest: response.data.data.is_test_page
			});
		})
		.catch(function (error) {
			console.log(error);
		});
		return $promise;
	},
	startTest({commit, getters, state}) {
		console.log('here');
		setInterval(function(){ 
			state.test.testTime - 1000; 
		}, 1000);
	}
}

export default actions;