<?php
namespace App\Test;

class CrbUser {
	private $email;
	private $password;

	public static function Login() {
		$emailOrUsername = ! empty( $_POST['emailOrUsername'] ) ? $_POST['emailOrUsername'] : '';
		$password = ! empty( $_POST['password'] ) ? $_POST['password'] : '';

		$creds['user_login'] = $emailOrUsername; 

		$creds['user_password'] = $password;

		$user = wp_signon($creds);

		wp_send_json_success( [
			'user' => $user,
		] );
	}

}