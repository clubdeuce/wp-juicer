<?php

namespace Clubdeuce\WPJuicer;

require 'includes/class-item-base.php';
require 'includes/class-model-base.php';
require 'includes/class-view-base.php';
require 'includes/class-http.php';
require 'includes/class-post-model.php';
require 'includes/class-post-view.php';
require 'includes/class-post.php';
require 'includes/class-feed-model.php';
require 'includes/class-feed-view.php';
require 'includes/class-feed.php';
require 'includes/class-source.php';
require 'includes/class-source-model.php';
require 'includes/class-source-view.php';
/**
 * Class Juicer
 * @package Clubdeuce\WPLib\Components
 */
class Juicer {

	const WPJUICER_DIR = __DIR__;

	/**
	 * @var string
	 */
	protected static $_default_feed;

	/**
	 * The base API URL
	 *
	 * @var string
	 */
	protected static $_base_url = 'www.juicer.io/api';

	/**
	 * @param  array  $args
	 * @param  string $scheme
	 * @return Feed
	 */
	static function get_feed( $args = array(), $scheme = 'https' ) {

		$args = wp_parse_args( $args, array(
			'feed'        => static::$_default_feed,
			'per'         => '100',
			'page'        => '1',
			'filter'      => '',
			'starting_at' => '',
			'ending_at'   => '',
			'transport'   => new HTTP()
		) );

		/**
		 * @var HTTP $http
		 */
		$http     = $args['transport'];
		$feedname = $args['feed'];

		unset( $args['transport'] );
		unset( $args['feed'] );

		$api_url = sprintf( '%1$s://%2$s/feeds/%3$s?%4$s', $scheme, self::$_base_url, $feedname, self::_url_params( $args ) );

		$response = $http->fetch( $api_url );

		do {
			if ( $response instanceof \WP_Error ) {
				trigger_error( sprintf(
					'Juicer error requesting %1$s: %3$s %2$s',
					$api_url,
					$response->get_error_message(),
					$response->get_error_code()
				), E_USER_WARNING );

				$response = get_transient( 'wp-juicer' );
				break;
			}

			set_transient( 'wp-juicer', json_encode( $response ) );

		} while ( false );

		$feed = new Feed( $response, $args );

		return $feed;

	}

	/**
	 * @param $feed
	 */
	static function set_default_feed( $feed ) {

		static::$_default_feed = $feed;

	}

	/**
	 * @param  array $args
	 * @return string
	 */
	protected static function _url_params( $args = array() ) {

		$params = array();

		$args = wp_parse_args( $args );

		foreach ( array_filter( $args ) as $key => $val ) {
			$params[] = sprintf( '%1$s=%2$s', $key, $val );
		}

		return implode( '&', $params );

	}


}