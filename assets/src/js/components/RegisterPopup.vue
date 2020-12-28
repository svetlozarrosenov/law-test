<template>
	<div class="section section-popup">		
		<div v-show="showRegisterPopup" class="popup-modal">
			<div class="popup-modal-container">
				<form class="popup-modal-form">
					<div class="popup-modal__head">
						<h2 class="popup-modal__title">Създай Акаунт</h2><!-- popup-modal__title -->
					</div><!-- popup-modal__head -->

					<div class="popup-modal__body">
						<p>
							<input type="text" name="userName" v-model="userName" placeholder="Потребителско име">
						</p>
						
						<p>
							<input type="text" name="firstName" v-model="firstName" placeholder="Име">
						</p>
						
						<p>
							<input type="text" name="lastName" v-model="lastName" placeholder="Фамилия">
						</p>

						<p>
							<input type="email" name="email" v-model="email" placeholder="Имейл">
						</p>

						<p>
							<input type="password" name="password" v-model="password" placeholder="Парола">
						</p>

						<p>
							<input type="password" name="confirmPassword" v-model="confirmPassword" placeholder="Потвърди Парола">
						</p>

						<p>
							<button class="popup-form__btn" @click="register">Регистрация</button>
						</p>					
					</div><!-- popup-modal__body -->

				</form><!-- popup-modal-form -->	
					<div class="popup-modal-container__foot">
						<span>Вече имаш регистрация?</span> <button @click="showLoginPopup">Влез в профила си</button>
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
			userName: '',
			firstName: '',
			lastName: '',
			email: '',
			password: '',
			confirmPassword: '',
		}
	},
	methods: {
		showModalAfterDelay: function() {
			setTimeout(()=>{  
				this.$store.commit('reverseRegisterPopup');
			});
		},
		showLoginPopup: function() {
			this.$store.commit('reverseRegisterPopup');
			this.$store.commit('reverseLoginPopup');
		},
		register: function() {

		}
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
