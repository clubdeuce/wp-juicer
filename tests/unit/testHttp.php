<?php
namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\HTTP;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testHttp
 * @package Clubdeuce\WPJuicer\Tests\Unit
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
	public function testInvalidUrlReturnsWPError() {
		$result = $this->_http->fetch('foo');
		$this->assertInstanceOf(\WP_Error::class, $result);
		$this->assertEquals('100', $result->get_error_code());
	}

	/**
	 * @covers ::fetch
	 */
	public function testNonExistentUrlReturnsWPError() {
		$result = $this->_http->fetch( 'http://example.io');
		$this->assertInstanceOf(\WP_Error::class, $result);
	}

	/**
	 * @covers ::fetch
	 */
	public function test404ReturnsWPError() {
		$result = $this->_http->fetch( 'http://google.com/foo');
		$this->assertInstanceOf(\WP_Error::class, $result);
		$this->assertEquals('404', $result->get_error_code());
	}
}