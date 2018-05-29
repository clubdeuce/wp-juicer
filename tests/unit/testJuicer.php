<?php
namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\Feed;
use Clubdeuce\WPJuicer\Feed_Model;
use Clubdeuce\WPJuicer\Juicer;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testJuicer
 * @package Clubdeuce\WPJuicer\Tests\Unit
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\Juicer
 */
class testJuicer extends TestCase {

	/**
	 * @var array
	 */
	protected $_errors;

	/**
	 * @var string
	 */
	protected $_feed;

	public function setUp() {
		$this->_feed = 'mytestfeed-362c6099-dcfa-4214-a907-1a49d65f3012';
	}

	/**
	 * @covers ::set_default_feed
	 * @covers ::default_feed
	 */
	public function testSetDefaultFeed() {
		Juicer::set_default_feed( $this->_feed);
		$this->assertEquals($this->_feed, Juicer::default_feed());
	}

	/**
	 * @covers ::get_feed
	 * @covers ::_url_params
	 */
	public function testGetFeed() {
		$feed = Juicer::get_feed(array('per' => 2));

		$this->assertInstanceOf(Feed::class, $feed);
		$this->assertCount(2, $feed->posts());
	}

	/**
	 * @covers ::get_feed
	 */
	public function testTransportErrorReturnsWpError() {
		$transport = \Mockery::mock('HTTP');
		$transport->shouldReceive('fetch')->andReturn(new \WP_Error());

		$this->assertInstanceOf(Feed::class, Juicer::get_feed(array('transport' => $transport)));
	}

	/**
	 * @param string $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param string $errline
	 * @param string $errcontext
	 *
	 * @return bool
	 */
	public function _errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
		$this->_errors[] = compact("errno", "errstr", "errfile",
			"errline", "errcontext");

		return true;
	}
}