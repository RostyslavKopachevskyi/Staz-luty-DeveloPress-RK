<?php
/**
 * Register all domains
 */

namespace dp\app\domains;

use dp\app\domains\projects\Projects;
use dp\app\domains\settings_page\Settings_Page;

/**
 * Load required modules
 */
class Domains {
	public function __construct() {
		new Settings_Page();
		new Projects();
	}
}
