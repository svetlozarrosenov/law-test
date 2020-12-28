<template>
	<div class="section section-popup">		
		<div v-show="showLoginPopup" class="popup-modal">
			<div class="popup-modal-container">
				<form v-on:submit.prevent class="popup-modal-form">
					<div class="popup-modal__head">
						<h2 class="popup-modal__title">Вход</h2><!-- popup-modal__title -->
					</div><!-- popup-modal__head -->

					<div class="popup-modal__body">
						<p>
							<input type="text" name="emailOrUsername" v-model="emailOrUsername" placeholder="Потребителско име или имейл">
						</p>
						
						<p>
							<input type="password" name="password" v-model="password" placeholder="Парола">
						</p>

						<p>
							<button class="popup-form__btn" @click="login">Влез</button>
						</p>					
					</div><!-- popup-modal__body -->

				</form><!-- popup-modal-form -->	
					<div class="popup-modal-container__foot">
						<span>Нямаш регистрация?</span> <button @click="showRegisterPopup">Регистрирай се</button>
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
			emailOrUsername: '',
			password: '',
		}
	},
	methods: {
		showRegisterPopup: function() {
			this.$store.commit('reverseRegisterPopup');
			this.$store.commit('reverseLoginPopup');			
		},
		login: function() {
			var data = new FormData();

			data.append('action', 'crb_login_user');
			data.append('emailOrUsername', this.emailOrUsername);
			data.append('password', this.password);

			var $promise = axios({
				method: 'post',
				url: crb_site_utils.ajaxurl,
				data: data
			})
			.then((response) => {
				console.log(response);
				location.reload();
			})
			.catch(function (error) {
				console.log(error);
			});
		}
	},
	computed: {
		domain() {
			console.log('here');
			let domain = this.$store.getters.getDomain;
			return domain;
		},
		showLoginPopup() {
			return this.$store.getters.showLoginPopup;
		}
	}
}
</script>
