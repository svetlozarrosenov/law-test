<?php
namespace App\Test;

class Loader {
	private static $pluginName = 'test-maker';

	private static $viewsDir = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'test-maker' . DIRECTORY_SEPARATOR . 'fragments' . DIRECTORY_SEPARATOR;

	public static function render( $view, $context = [] ) {
		extract( $context );

		require self::$viewsDir . $view . '.php';
	}

	public static function loadAssets( $assetName, $assetType='css' ) {
		require_once WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . self::$pluginName . DIRECTORY_SEPARATOR . $assetType . DIRECTORY_SEPARATOR . $assetName . '.' . $assetType;
	}
}