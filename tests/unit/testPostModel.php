<?php

namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\Post_Model;
use Clubdeuce\WPJuicer\Source;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testPostModel
 * @package Clubdeuce\WPJuicer\Tests
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\Post_Model
 */
class testPostModel extends TestCase {

	/**
	 * @var Post_Model
	 */
	protected $_model;

	/**
	 * @covers ::__construct
	 * @covers ::has_post
	 */
	public function testHasPostFalse() {
		$model = new Post_Model(null);
		$this->assertFalse($model->has_post());
	}

	/**
	 * @covers ::has_post
	 */
	public function testHasPost() {
		$model = new Post_Model($this->_getSamplePost());

		$this->assertTrue($model->has_post());
	}

	/**
	 * @depends testHasPost
	 * @covers ::__construct
	 * @covers \Clubdeuce\WPJuicer\Model_Base::__construct
	 */
	public function testInjectedPost() {
		$model = new Post_Model(null, array('post' => 'foo'));

		$this->assertTrue($model->has_post());
	}

	/**
	 * @covers ::timestamp
	 */
	public function testTimestamp() {
		$model = new Post_Model($this->_getSamplePost());
		$this->assertNotEmpty($model->timestamp());
		$this->assertInternalType('string', $model->timestamp());
	}

	/**
	 * @covers ::source
	 */
	public function testSource() {
		$model = new Post_Model($this->_getSamplePost());

		$this->assertInstanceOf(Source::class, $model->source());
	}

	/**
	 * @covers ::__call
	 */
	public function testId() {
		$post = $this->_getSamplePost();

		$model = new Post_Model($post);

		$this->assertEquals($post->id, $model->id());
	}

	/**
	 * @covers ::__call
	 */
	public function testCallNoPost() {
		$model = new Post_Model(null);

		$this->assertNull($model->id());
	}

	/**
	 * @covers ::__call
	 */
	public function testCallNonExistentProperty() {
		$model = new Post_Model($this->_getSamplePost());

		$this->assertNull($model->foo());
	}

	/**
	 * @return \stdClass
	 */
	protected function _getSamplePost() {

		return $this->_get_sample_response()->posts->items[0];

	}

}
