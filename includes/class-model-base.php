<?php

namespace Clubdeuce\WPJuicer;

/**
 * Class Model_Base
 * @package Clubdeuce\WPJuicer
 *
 * @method array extra_args()
 */
class Model_Base {

	/**
	 * @var array
	 */
	protected $_extra_args;

	/**
	 * Model_Base constructor.
	 *
	 * @param array $args
	 */
	public function __construct( $args = array() ) {

		foreach( $args as $key => $value ) {
			$name = "_{$key}";

			if ( property_exists( $this, $name ) ) {
				$this->{$name} = $value;
				unset( $args[ $key ] );
			}
		}

		$this->_extra_args = $args;

	}

	/**
	 * @param  string $method_name
	 * @param  array $args
	 * @return null|mixed
	 */
	function __call( $method_name, $args ) {

		do {
			if ( property_exists( __CLASS__, "_{$method_name}" ) ) {
				$method_name = "_{$method_name}";
				$value = $this->{$method_name};
				break;
			}

			if ( isset( $this->_extra_args[ $method_name ] ) ) {
				$value = $this->_extra_args[ $method_name ];
				break;
			}

			$value = null;
		} while ( false );


		return $value;

	}

}
