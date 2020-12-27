<template>
	<div class="section section-popup">		
		<div v-show="showRegisterPopup" class="popup-modal">
			<div class="popup-modal__info-box">
				<div class="popup-modal__head">
					<h2 class="popup-modal__title">Създай Акаунт</h2><!-- popup-modal__title -->
				</div><!-- popup-modal__head -->

				<div class="popup-modal__body">
					<p>
						<input type="text" name="username" placeholder="Име">
					</p>

					<p>
						<input type="email" name="email" placeholder="Имейл">
					</p>

					<p>
						<input type="password" name="password" placeholder="Парола">
					</p>

					<p>
						<input type="password" name="confirmpassword" placeholder="Потвърди Парола">
					</p>

					<p>
						<button>Регистрация</button>
					</p>					
				</div><!-- popup-modal__body -->

				<div class="popup-modal__foot">
					<span>Вече имате регистрация?</span> <button @click="showLoginPopup">Влезте в профила си</button>
				</div><!-- popup-modal__foot -->
			</div><!-- info-box -->
		</div><!-- popup-modal -->
	</div><!-- section-home -->
</template>

<script>
import axios from 'axios';

export default {
	data() {
		return {
			userIsLoggedIn: false,
		}
	},
	methods: {
		showModalAfterDelay: function(delay) {
			setTimeout(()=>{  
				this.$store.commit('reverseRegisterPopup');
			}, delay);
		},
		showLoginPopup: function() {
			this.$store.commit('reverseRegisterPopup');
			this.$store.commit('reverseLoginPopup');
		}
	},
	mounted: function(){
		var data = new FormData();
		data.append('action', 'crb_is_user_logged_in');

		var $promise = axios({
			method: 'post',
			url: crb_site_utils.ajaxurl,
			data: data
		})
		.then((response) => {
			this.userIsLoggedIn = response.data.data.is_logged_in;

			this.showModalAfterDelay(1000);
		})
		.catch(function (error) {
			console.log(error);
		});
	},
	computed: {
		domain() {
			let domain = this.$store.getters.getDomain;
			return domain;
		},
		showRegisterPopup() {
			return this.$store.getters.showRegisterPopup;
		}
	}
}
</script>
