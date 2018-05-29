<?php
define('VENDOR_DIRECTORY', dirname(__DIR__) . '/vendor');
define('TEST_INCLUDES_DIR', dirname(__FILE__) . '/includes');

if (! file_exists( dirname(__DIR__) . '/build' ) ) {
	mkdir(dirname(__DIR__) . '/build');
}

require_once getenv( 'WP_TESTS_DIR' ) . '/tests/phpunit/includes/functions.php';
require_once getenv( 'WP_TESTS_DIR' ) . '/tests/phpunit/includes/bootstrap.php';

require_once 'includes/testCase.php';

require VENDOR_DIRECTORY . '/autoload.php';

require dirname( __DIR__ ) . '/wp-juicer.php';
