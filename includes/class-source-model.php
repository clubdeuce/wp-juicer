<?php
namespace Clubdeuce\WPJuicer;

/**
 * Class Source_Model
 * @package Clubdeuce\WPJuicer
 *
 * @method int       id()
 * @method string    term()
 * @method string    term_type()
 * @method string    source()
 * @method string    options()
 * @method \stdClass source_object()
 */
class Source_Model extends Model_Base {

	/**
	 * @var \stdClass
	 */
	protected $_source_object;

	/**
	 * Source_Model constructor.
	 *
	 * @param \stdClass $source_object
	 * @param array     $args
	 */
	public function __construct( $source_object, $args = array() ) {

		$args = wp_parse_args( $args, array(
			'source_object' => $source_object
		) );

		parent::__construct( $args );

	}

	/**
	 * @return bool
	 */
	public function has_source() {

		$has = false;

		if ( isset( $this->_source_object ) ) {
			$has = true;
		}

		return $has;

	}

	/**
	 * @param string $method_name
	 * @param array $args
	 *
	 * @return mixed|null
	 */
	function __call( $method_name, $args ) {

		do {
			if ( isset( $this->_source_object->{$method_name} ) ) {
				$value = $this->_source_object->{$method_name};
				break;
			}

			$value = call_user_func_array( array( parent::class, $method_name ), $args );
		} while ( false );

		return $value;

	}

}
