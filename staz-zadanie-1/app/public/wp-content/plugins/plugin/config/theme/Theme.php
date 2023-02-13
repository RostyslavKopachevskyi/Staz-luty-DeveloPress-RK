<?php

namespace dp\config\theme;

/**
 * Theme bootstrap
 */
class Theme {
	function __construct() {
		new General_Config();
		new Images();
		new Ajax();
		new Assets();
		new Menu();
	}
}
