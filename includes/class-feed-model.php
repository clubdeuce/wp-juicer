<?php
namespace Clubdeuce\WPJuicer;

/**
 * Class Feed_Model
 * @package Clubdeuce\WPJuicer
 * @link https://www.juicer.io/api
 *
 * @method string        id()
 * @method string        slug()
 * @method string        name()
 * @method string        plan()
 * @method int           update_frequency()
 * @method string        last_synced()
 * @method integer       max_sources()
 * @method string        more_sources_allowed()
 * @method bool          analytics_allowed()
 * @method bool          moderation_allowed()
 * @method string        css()
 * @method int           interval()
 * @method int           width()
 * @method int           height()
 * @method int           columns()
 * @method string        order()
 * @method string        display_filter()
 * @method bool          display_filter_type()
 * @method bool          colored_icons()
 * @method bool          photos()
 * @method bool          videos()
 * @method bool          lazy_load()
 * @method bool          overlay()
 * @method bool          infinite_scroll()
 * @method bool          poll()
 * @method string        disallowed()
 * @method string        allowed()
 * @method int           distance()
 * @method string        location()
 * @method float         lat()
 * @method float         lng()
 * @method bool          profanity()
 * @method bool          prevent_duplicates()
 * @method bool          queue()
 * @method bool          moderating()
 * @method int           page_views_count()
 * @method string        custom_css()
 * @method \stdClass     colors()
 * @method array         social_accounts()
 */
class Feed_Model extends Model_Base {

	/**
	 * @var \stdClass
	 */
	protected $_response;

	/**
	 * @var Source[]
	 */
	protected $_sources;
	
	/**
	 * Feed_Model constructor.
	 *
	 * @param object $response
	 * @param array  $args
	 */
	public function __construct( $response, $args = array() ) {
		
		$args = wp_parse_args( $args );

		$args['response'] = $response;

		parent::__construct( $args );

	}

	/**
	 * @return bool
	 */
	public function has_feed() {

		$has = false;

		do {
			if ( empty( $this->response() ) ) {
				break;
			}

			if ( $this->response() instanceof \WP_Error ) {
				break;
			}

			$has = true;
		} while ( false );


		return $has;

	}

	/**
	 * @return Post[]
	 */
	public function posts() {

		$posts = array();

		do {

			$response = $this->response();

			if ( isset( $this->extra_args()['posts'] ) ) {
				$posts = $this->extra_args()['posts'];
				break;
			}

			if ( ! isset( $response->posts->items ) ) {
				break;
			}

			foreach ( $this->response()->posts->items as $post ) {
				$posts[] = new Post( $post );
			}

		} while ( false );

		return $posts;

	}

	/**
	 * @return Source[]
	 */
	public function sources() {

		do {

			if ( ! empty( $this->_sources ) ) {
				$sources = $this->_sources;
				break;
			}

			foreach( $this->response()->sources as $source ) {
				$this->_sources[] = new Source( $source );
			}

			$sources = $this->_sources;

		} while ( false );

		return $sources;

	}

	/**
	 * @return \stdClass
	 */
	public function response() {

		return $this->_response;

	}

	/**
	 * @param string $method_name
	 * @param array $args
	 *
	 * @return mixed|null
	 */
	public function __call( $method_name, $args ) {

		do {
			if ( isset( $this->response()->{$method_name} ) ) {
				$value = $this->response()->{$method_name};
				break;
			}

			$value = call_user_func_array( array( parent::class, $method_name ), $args );
		} while ( false );

		return $value;

	}

}
