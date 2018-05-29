<?php
namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\Model_Base;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testModelBase
 * @package Clubdeuce\WPJuicer\Tests
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\Model_Base
 */
class testModelBase extends TestCase {

	/**
	 * @var Model_Base
	 */
	protected $_model;

	public function setUp() {
		$this->_model = new Model_Base(array('foo' => 'bar'));
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testExtraArgs() {
		$this->assertEquals(array('foo' => 'bar'), $this->_model->extra_args());
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testFooProperty() {
		$this->assertEquals('bar', $this->_model->foo());
	}

	/**
	 * @covers ::__call
	 */
	public function testNonExistentProperty() {
		$this->assertNull($this->_model->bar());
	}
}
