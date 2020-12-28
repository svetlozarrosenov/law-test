<?php
/**
* @package Test Maker
*/
/*
Plugin Name: Test Maker 
Description: This plugin helps you to create tests.
Version 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
}
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use App\Test\Admin;

class TestMaker {
	public function __construct() {
		require 'vendor/autoload.php';

		// add_action('after_setup_theme', function() {
		// 	new App\Test\Paywall();
		// } );

		$admin = new Admin();
		
		new App\Test\Test();

		add_action( 'wp_ajax_crb_login_user', array('App\Test\CrbUser', 'Login') );
		add_action( 'wp_ajax_nopriv_crb_login_user', array('App\Test\CrbUser', 'Login') );

		add_action( 'wp_ajax_crb_is_user_logged_in', 'crb_is_user_logged_in' );
		add_action( 'wp_ajax_nopriv_crb_is_user_logged_in', 'crb_is_user_logged_in' );

		function crb_is_user_logged_in() {
			wp_send_json_success( [
        		'is_logged_in' => \is_user_logged_in(),
  			] );
		}

		add_action( 'wp_ajax_crb_ajax_get_questions', array( 'App/Test/Test', 'getQuestions' ) );
		add_action( 'wp_ajax_nopriv_crb_ajax_get_questions', array( 'App/Test/Test', 'getQuestions' ) );
	}

	public function activate() {

	}

	public function deactivate() {}
}

$testMaker = new TestMaker();


register_activation_hook( __FILE__, array( $testMaker, 'activate' ) );

register_deactivation_hook( __FILE__, array( $testMaker, 'deactivate' ) );