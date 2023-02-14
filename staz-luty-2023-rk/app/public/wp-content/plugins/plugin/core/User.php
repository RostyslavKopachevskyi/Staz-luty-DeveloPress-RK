<?php
/**
 * User model
 */

namespace dp\core;

use WP_User;

/**
 * Class for user in system
 */
abstract class User extends WP_User {
	/**
	 * Class construct function.
	 */
	function __construct() {
		parent::__construct();
	}
}
