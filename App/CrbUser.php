<?php
namespace LawtestManager\TestPackage;

class CrbUser {

	public function __construct() {
		add_action( 'wp_ajax_crb_login_user', array('LawtestManager\TestPackage\CrbUser', 'login') );
		add_action( 'wp_ajax_nopriv_crb_login_user', array('LawtestManager\TestPackage\CrbUser', 'login') );

		add_action( 'wp_ajax_crb_register_user', array('LawtestManager\TestPackage\CrbUser', 'register') );
		add_action( 'wp_ajax_nopriv_crb_register_user', array('LawtestManager\TestPackage\CrbUser', 'register') );

		add_filter( 'carbon_fields_user_meta_container_admin_only_access', function() {
			return false;
		} );
	}

	public static function login() {
		$emailOrUsername = ! empty( $_POST['emailOrUsername'] ) ? $_POST['emailOrUsername'] : '';
		$password = ! empty( $_POST['password'] ) ? $_POST['password'] : '';

		$creds['user_login'] = $emailOrUsername; 

		$creds['user_password'] = $password;

		$user = wp_signon($creds);

		wp_send_json_success( [
			'user' => $user,
		] );
	}

	public static function register() {
		$username = ! empty( $_POST['userName'] ) ? $_POST['userName'] : '';
		$email = ! empty( $_POST['email'] ) ? $_POST['email'] : '';
		$password = ! empty( $_POST['password'] ) ? $_POST['password'] : '';

		$firstName = ! empty( $_POST['firstName'] ) ? $_POST['firstName'] : '';
		$lastName = ! empty( $_POST['lastName'] ) ? $_POST['lastName'] : '';

		$userData = [
			'userName' => ! empty( $_POST['userName'] ) ? $_POST['userName'] : '',
			'email' => ! empty( $_POST['email'] ) ? $_POST['email'] : '',
			'password' => ! empty( $_POST['password'] ) ? $_POST['password'] : '',
			'firstName' => ! empty( $_POST['firstName'] ) ? $_POST['firstName'] : '',
			'lastName' => ! empty( $_POST['lastName'] ) ? $_POST['lastName'] : '',
		];

		$user = wp_insert_user( array(
			'user_pass' => $password,
			'user_login' => $username,
			'user_email' => $email,
			'first_name' => $firstName,
			'last_name' => $lastName,
			'role' => 'subscriber'
		) );

		wp_send_json_success( [
			'user' => $user,
		] );
	}
}