<?php
namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\Tests\TestCase;
use Clubdeuce\WPJuicer\View_Base;

/**
 * Class testViewBase
 * @package Clubdeuce\WPJuicer\Tests\Unit
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\View_Base
 */
class testViewBase extends TestCase {

	/**
	 * @var \stdClass
	 */
	protected $_item;

	/**
	 * @var View_Base
	 */
	protected $_view;

	public function setUp() {
		$this->_item = $this->_getSampleItem();
		$this->_view = new View_Base($this->_item);
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testItem() {
		$this->assertEquals($this->_item, $this->_view->item());
	}

	/**
	 * @covers ::model
	 */
	public function testModel() {
		$this->assertEquals($this->_item->model(), $this->_view->model());
	}

	/**
	 * @covers ::the_template
	 * @covers ::get_template_html
	 * @covers ::_locate_template
	 */
	public function testTheTemplate() {
		ob_start();
		$this->_view->the_template(TEST_INCLUDES_DIR . '/templateFeed');
		$html = ob_get_clean();

		$this->assertInternalType('string', $html);
		$this->assertStringStartsWith( '<!-- BEGIN TEMPLATE: ', $html );
	}

}