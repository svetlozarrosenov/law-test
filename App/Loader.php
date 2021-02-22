<?php
namespace App\Test;

class Loader {
	public static function render( $view, $context = [] ) {
		extract( $context );

		require TEST_MAKER_PATH . 'fragments' . DIRECTORY_SEPARATOR . $view . '.php';
	}

	public static function loadAssets( $assetName, $assetType='css' ) {
		require_once TEST_MAKER_URL . DIRECTORY_SEPARATOR . $assetType . DIRECTORY_SEPARATOR . $assetName . '.' . $assetType;
	}
}