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

use LawtestManager\TestPackage\Admin;
use LawtestManager\TestPackage\CrbUser;
use LawtestManager\TestPackage\Loader;
use LawtestManager\TestPackage\Paywall;
use LawtestManager\TestPackage\Test;

define( 'TEST_MAKER_VERSION', '1.1.0' );
define( 'TEST_MAKER_URL', plugin_dir_url( __FILE__ ) );
define( 'TEST_MAKER_PATH', plugin_dir_path( __FILE__ ) );

class TestMaker {
	public function __construct() {
		require 'vendor/autoload.php';

		// add_action('after_setup_theme', function() {
		// 	new Paywall();
		// } );

		new Admin();
		
		new Test();

		new CrbUser();
	}

	public function activate() {

	}

	public function deactivate() {}
}

$testMaker = new TestMaker();


register_activation_hook( __FILE__, array( $testMaker, 'activate' ) );

register_deactivation_hook( __FILE__, array( $testMaker, 'deactivate' ) );