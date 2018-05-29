<?php

namespace Clubdeuce\WPJuicer\Tests\Unit;

use Clubdeuce\WPJuicer\Feed_Model;
use Clubdeuce\WPJuicer\Post;
use Clubdeuce\WPJuicer\Source;
use Clubdeuce\WPJuicer\Tests\TestCase;

/**
 * Class testFeedModel
 * @package Clubdeuce\WPJuicer\Tests
 *
 * @coversDefaultClass \Clubdeuce\WPJuicer\Feed_Model
 */
class testFeedModel extends TestCase {

	/**
	 * @var Feed_Model
	 */
	protected $_model;

	public function setUp() {
		$this->_model = new Feed_Model($this->_get_sample_response());
	}

	/**
	 * @covers ::__call
	 */
	public function testExtraArgs() {
		$this->assertEmpty($this->_model->extra_args());
	}

	/**
	 * @covers ::response
	 */
	public function testResponse() {
		$this->assertEquals($this->_get_sample_response(), $this->_model->response());
	}

	/**
	 * @covers ::has_feed
	 */
	public function testHasFeedFalse() {
		$model = new Feed_Model(new \WP_Error());
		$this->assertFalse($model->has_feed());

		$model = new Feed_Model(array());
		$this->assertFalse($model->has_feed());
	}

	/**
	 * @covers ::has_feed
	 */
	public function testHasFeed() {
		$this->assertTrue($this->_model->has_feed());
	}

	/**
	 * @covers ::__construct
	 * @covers ::__call
	 */
	public function testId() {
		$id = $this->_model->id();

		$this->assertNotEmpty($id, 'Feed_Model::id() is empty.');
		$this->assertInternalType('int', $id, 'Feed_Model::id() is not an integer.');
	}

	/**
	 * @covers ::posts
	 */
	public function testPosts() {
		$posts = $this->_model->posts();

		$this->assertInternalType('array', $posts, 'Feed_Model::posts() failed to return an array.');
		$this->assertEquals(100, count($posts), 'Feed_Model::posts() failed to return 100 items.');
		foreach($posts as $post) {
			$this->assertInstanceOf(Post::class, $post, 'Feed_Model::posts() failed to return an array of Post objects.');
		}
	}

	/**
	 * @covers ::posts
	 */
	public function testInjectedPosts() {
		$model = new Feed_Model($this->_get_sample_response(), array('posts' => array('foobar' => 'foobaz')));
		$this->assertEquals(array('foobar' => 'foobaz'), $model->posts());
	}

	/**
	 * @covers ::posts
	 */
	public function testPostsEmpty() {
		$response = $this->_get_sample_response();
		$response->posts = null;

		$model = new Feed_Model($response);

		$this->assertEmpty($model->posts());
	}

	/**
	 * @covers ::sources
	 */
	public function testInjectedSources() {
		$model = new Feed_Model($this->_get_sample_response(), array('sources' => array('foo', 'bar')));

		$this->assertEquals(array('foo', 'bar'), $model->sources());
	}

	/**
	 * @covers ::sources
	 */
	public function testSources() {
		$sources = $this->_model->sources();

		foreach( $sources as $source ) {
			$this->assertInstanceOf(Source::class, $source, '::sources() did not return an instance of Source');
		}
	}
}
