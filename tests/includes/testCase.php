<?php

namespace Clubdeuce\WPJuicer\Tests;
use Clubdeuce\WPJuicer\Post;
use Mockery\Mock;

/**
 * Class TestCase
 * @package Clubdeuce\WPJuicer\Tests
 */
class TestCase extends \WP_UnitTestCase {

	/**
	 * @param $class
	 * @param $property
	 * @return mixed
	 */
	public function getReflectionPropertyValue( $class, $property )
	{
		$reflection = new \ReflectionProperty( $class, $property );
		$reflection->setAccessible( true );
		return $reflection->getValue( $class );
	}

	/**
	 * @param $class
	 * @param $property
	 * @param $value
	 */
	public function setReflectionPropertyValue( $class, $property, $value )
	{
		$reflection = new \ReflectionProperty( $class, $property );
		$reflection->setAccessible( true );
		$reflection->setValue( $class, $value );
	}

	/**
	 * @param $class
	 * @param $method
	 * @return mixed
	 */
	public function reflectionMethodInvoke( $class, $method )
	{
		$reflection = new \ReflectionMethod( $class, $method );
		$reflection->setAccessible( true );
		if (is_string($class)) {
			$class = null;
		}
		return $reflection->invoke( $class );
	}

	/**
	 * @param $class
	 * @param $method
	 * @param $args
	 * @return mixed
	 */
	public function reflectionMethodInvokeArgs( $class, $method, $args )
	{
		$reflection = new \ReflectionMethod( $class, $method );
		$reflection->setAccessible( true );
		if (is_string($class)) {
			$class = null;
		}
		return $reflection->invoke( $class, $args );
	}

	/**
	 * @return object
	 */
	protected function _get_sample_response()
	{
		$response = new \stdClass();

		if(file_exists( $file = TEST_INCLUDES_DIR . '/sample.json')) {
			$response = json_decode(file_get_contents( $file));
		}

		return $response;
	}

	/**
	 * @return \stdClass
	 */
	protected function _getSampleSource() {

		$source = new \stdClass();

		$source->id        = '12345678';
		$source->term      = 'foo_term';
		$source->term_type = 'feed';
		$source->source    = 'foo_source';
		$source->options   = array();

		return $source;

	}

	/**
	 * @return \Mockery\MockInterface
	 */
	protected function _getSampleItem() {
		$item = \Mockery::mock('Item_Base');
		$item->shouldReceive('model')->andReturn(new \stdClass());

		return $item;
	}

}
