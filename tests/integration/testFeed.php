<?php
namespace Clubdeuce\WPJuicer\Tests\Integration;

use Clubdeuce\WPJuicer\Feed;
use Clubdeuce\WPJuicer\Feed_Model;
use Clubdeuce\WPJuicer\Feed_View;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testFeed
 * @package Clubdeuce\WPJuicer\Tests\Integration
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\Item_Base
 */
class testFeed extends TestCase {

	/**
	 * @var Feed
	 */
	protected $_feed;

	public function setUp() {
		$this->_feed = new Feed($this->_get_sample_response());
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testModel() {
		$this->assertInstanceOf(Feed_Model::class, $this->_feed->model());
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testView() {
		$this->assertInstanceOf(Feed_View::class, $this->_feed->view());
	}

	/**
	 * @covers ::__call
	 */
	public function testId() {
		$this->assertNotEmpty($this->_feed->id());
	}

	/**
	 * @covers ::__call
	 */
	public function testTheId() {
		$this->expectOutputRegex('/[0-9]*/');
		$this->_feed->the_id();
	}

	/**
	 * @covers \Clubdeuce\WPJuicer\Feed_View::the_feed_html
	 */
	public function testTheFeedHtml() {
		ob_start();
		$this->_feed->the_feed_html(array('template' => TEST_INCLUDES_DIR . '/templateFeed.php'));
		$html = ob_get_clean();

		$this->assertNotEmpty($html);
	}
}
