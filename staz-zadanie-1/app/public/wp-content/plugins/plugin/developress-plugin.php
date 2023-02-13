<?php
/**
 * Plugin name: DeveloPress plugin
 * Author: DeveloPress sp. z o. o. Poland
 * Plugin URI: https://developress.io/
 * Text Domain: dp
 * Domain Path: /i18n
 */

namespace dp;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/../../vendor/autoload.php';
// todo: it should be added only when we start working with Guttenberg blocks.
// require_once __DIR__ . '/app/blocks/blocks.php';.

/**
 * Plugin starter
 */
class Develoress_Plugin {
	/**
	 * Run baby, run!!!
	 */
	function __construct() {
		new core\Bootstrap();
		new config\theme\Theme();
	}
}

new Develoress_Plugin();
