<?php
namespace Clubdeuce\WPJuicer;

/**
 * Class View_Base
 * @package Clubdeuce\WPJuicer
 *
 * @method Item_Base item()
 */
class View_Base {

	/**
	 * @var Item_Base
	 */
	protected $_item;

	/**
	 * View_Base constructor.
	 *
	 * @param object $item
	 */
	public function __construct( $item ) {

		$this->_item = $item;

	}

	/**
	 * @return Model_Base
	 */
	public function model() {

		return $this->_item->model();

	}

	/**
	 * @param string $template
	 * @param array  $args
	 */
	public function the_template( $template, $args = array() ) {

		echo wp_kses_post( $this->get_template_html( $template, $args ) );

	}

	/**
	 * @param string $template
	 * @param array  $args
	 *
	 * @return string
	 */
	public function get_template_html( $template, $args = array() ) {

		$html = sprintf( '<!-- Unable to locate template: %1$s -->', $template );

		if ( $path = $this->_locate_template( $template ) ) {

			$item = $this->item();
			$args = wp_parse_args( $args );

			/**
			 * This usage of extract is here to emulate the default WP behavior
			 * of having variables accessible inside templates as if they were
			 * global variables (e.g. $post). This is a very specific use case.
			 */
			extract( $args );
			unset( $args );

			ob_start();
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				printf( '<!-- BEGIN TEMPLATE: %1$s -->', $template );
			}
			include $path;
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				printf( '<!-- END TEMPLATE: %1$s -->', $template );
			}
			$html = ob_get_clean();
		}

		return $html;

	}

	/**
	 * @param string $method_name
	 * @param array  $args
	 *
	 * @return null|mixed
	 */
	public function __call( $method_name, $args ) {

		do {
			if ( property_exists( $this, $name = "_{$method_name}" ) ) {
				$value = $this->{$name};
				break;
			}

			if ( preg_match( '#^the_(.*)$#', $method_name, $matches ) ) {
				if ( method_exists( $this, $matches[1] ) ) {
					$value = call_user_func_array( array( $this, $matches[1] ), $args );
					echo $value;
					break;
				}

				$value = call_user_func_array( array( $this->model(), $matches[1] ), $args );
				echo $value;
				break;
			}

			$value = null;
		} while ( false );

		return $value;

	}

	/**
	 * @param  string $name
	 *
	 * @return null|string
	 */
	protected function _locate_template( $name ) {

		if ( ! preg_match( '#^.*\.php$#', $name ) ) {
			$name .= '.php';
		}

		do {
			if ( file_exists( $name ) ) {
				$path = $name;
				break;
			}

			if ( file_exists( $maybe = sprintf( '%1$s/wpjuicer/%2$s', get_stylesheet_directory(), $name ) ) ) {
				$path = $maybe;
				break;
			}

			if ( file_exists( $maybe = sprintf( '%1$s/templates/%2$s', Juicer::WPJUICER_DIR, $name ) ) ) {
				$path = $maybe;
				break;
			}

			$path = null;

		} while ( false );

		return $path;

	}

}
