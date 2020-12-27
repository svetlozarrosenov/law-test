import Vue from 'vue';
import App from './App.vue';
import store from './store/state';
import paywall from './paywall';

store.dispatch('getTest');

new Vue({
	store,
	el: '#app',
	template: '<App/>',
	components: { App },
}).$mount('#app');

paywall();