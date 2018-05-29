<?php
namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\Source_Model;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testSourceModel
 * @package Clubdeuce\WPJuicer\Tests\Unit
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\Source_Model
 */
class testSourceModel extends TestCase {

	/**
	 * @var \stdClass
	 */
	protected $_source;

	/**
	 * @var Source_Model
	 */
	protected $_model;


	public function setUp() {
		$this->_source = $this->_getSampleSource();
		$this->_model  = new Source_Model($this->_source);
	}

	/**
	 * @covers ::has_source
	 * @covers ::__construct
	 */
	public function testHasSource() {
		$this->assertTrue($this->_model->has_source());
	}

	/**
	 * @covers ::__call
	 * @covers ::__construct
	 */
	public function testId() {
		$this->assertEquals($this->_source->id, $this->_model->id());
	}

	/**
	 * @covers ::__call
	 */
	public function testCallReturnsNull() {
		$this->assertNull($this->_model->foo());
	}

}