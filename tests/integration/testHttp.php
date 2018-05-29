<?php
namespace Clubdeuce\WPJuicer\Tests\Integration;

use Clubdeuce\WPJuicer\HTTP;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testHttp
 * @package Clubdeuce\WPJuicer\Tests\Integration
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\HTTP
 */
class testHttp extends TestCase {

	/**
	 * @var HTTP
	 */
	protected $_http;

	public function setUp() {
		$this->_http = new HTTP();
	}

	/**
	 * @covers ::fetch
	 */
	public function testFetch() {
		$response = $this->_http->fetch( 'https://wordpress.org');

		$this->assertInternalType('string', $response);
	}

	/**
	 * @covers ::fetch
	 */
	public function testFetchCache() {
		$response = $this->_http->fetch( 'https://wordpress.org');

		$this->assertInternalType('string', $response);
	}
}