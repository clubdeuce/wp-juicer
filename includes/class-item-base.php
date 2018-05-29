<?php
namespace Clubdeuce\WPJuicer;

/**
 * Class Item_Base
 * @package Clubdeuce\WPJuicer
 *
 * @method Model_Base model()
 * @method View_Base  view()
 */
class Item_Base {

	/**
	 * @var object
	 */
	protected $_model;

	/**
	 * @var object
	 */
	protected $_view;

	/**
	 * Item_Base constructor.
	 *
	 * @param object $item
	 * @param array  $args
	 */
	public function __construct( $item, $args = array() ) {

		$model_class = sprintf( '%1$s_Model', get_called_class() );
		$view_class  = sprintf( '%1$s_View',  get_called_class() );

		$args = wp_parse_args( $args, array(
			'model' => new $model_class( $item, $args ),
			'view'  => new $view_class( $this ),
		) );

		$this->_model = $args['model'];
		$this->_view  = $args['view'];

	}

	/**
	 * @param  string $method_name
	 * @param  array  $args
	 *
	 * @return mixed|null
	 */
	public function __call( $method_name, $args ) {

		do {
			$value = null;

			if ( property_exists( $this, $key = "_{$method_name}" ) ) {
				$value = $this->{$key};
				break;
			}

			if ( preg_match( '#^the_.*$#', $method_name, $matches ) || method_exists( $this->view(), $method_name ) ) {
				$value = call_user_func_array( array( $this->view(), $method_name ), $args );
				break;
			}

			$value = call_user_func_array( array( $this->model(), $method_name ), $args );
		} while ( false );

		return $value;

	}

}
