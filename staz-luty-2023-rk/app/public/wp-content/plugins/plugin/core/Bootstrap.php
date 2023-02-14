<?php
/**
 * The main place to run the plugin core
 */

namespace dp\core;

use dp\app\users\Users;
use dp\app\domains\Domains;

/**
 * All required elements for the plugin
 */
class Bootstrap {
	/**
	 * Run all required stuff in the plugin
	 */
	public function __construct() {
		new Acf();
		new Svg();
		new Translations();
		new Users();
		new Domains();
	}
}
