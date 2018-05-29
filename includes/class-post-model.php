<?php
namespace Clubdeuce\WPJuicer;

/**
 * Class Post_Model
 * @package Clubduece\WPJuicer
 * @link    https://www.juicer.io/api#post
 *
 * @method int    id()
 * @method string external_id()
 * @method string external_created_at()
 * @method string full_url()
 * @method string image()
 * @method string external()
 * @method int    like_count()
 * @method int    comment_count()
 * @method string tagged_users()
 * @method string poster_url()
 * @method string poster_id()
 * @method string location()
 * @method int    height()
 * @method int    width()
 * @method string edit()
 * @method int    position()
 * @method string deleted_at()
 * @method string deleted_by()
 * @method string message()
 * @method string unformatted_message()
 * @method string description()
 * @method string feed()
 * @method string likes()
 * @method string comments()
 * @method string video()
 * @method string poster_image()
 * @method string poster_name()
 */
class Post_Model extends Model_Base {

	/**
	 * The post response object
	 *
	 * @var \StdClass
	 */
	protected $_post;

	/**
	 * Post_Model constructor.
	 *
	 * @param object $post
	 * @param array  $args
	 */
	public function __construct( $post, $args = array() ) {

		$args = wp_parse_args( $args, array(
			'post' => $post
		) );

		parent::__construct( $args );

	}

	/**
	 * @return bool
	 */
	public function has_post() {

		$has = false;

		if ( isset( $this->_post ) ) {
			$has = true;
		}

		return $has;

	}

	/**
	 * An alias for the external_created_at property
	 *
	 * @return string
	 */
	public function timestamp() {

		return $this->external_created_at();

	}

	/**
	 * @return Source
	 */
	public function source() {

		$source = new Source(null);

		if ( isset( $this->_post->source ) ) {
			$source = new Source( $this->_post->source );
		}

		return $source;

	}

	/**
	 * @param  string $method_name
	 * @param  array $args
	 * @return mixed|null
	 */
	public function __call( $method_name, $args ) {

		$value = null;

		do {
			if ( ! $this->has_post() ) {
				break;
			}

			if ( isset( $this->_post->{$method_name} ) ) {
				$value = $this->_post->{$method_name};
				break;
			}

		} while ( false );

		return $value;

	}

}