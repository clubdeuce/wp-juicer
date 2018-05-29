<?php
namespace Clubdeuce\WPJuicer;

/**
 * Class HTTP
 * @package Clubdeuce\WPJuicer
 */
class HTTP {

	/**
	 * @param  $url
	 * @return string|\WP_Error
	 */
	public function fetch( $url ) {

		do {
			if ( ! wp_http_validate_url( $url ) ) {
				$response = new \WP_Error( '100', __( 'Invalid URL', 'wpjuicer' ), array( 'url' => $url ) );
				break;
			}

			if ( $data = wp_cache_get( $cache_key = md5( $url ) ) ) {
				$response = $data;
				break;
			}

			$fetch = wp_remote_get( $url );

			if ( $fetch instanceof \WP_Error ) {
				$response = $fetch;
				break;
			}

			if ( ! ( 200 === wp_remote_retrieve_response_code( $fetch ) ) ) {
				$response = new \WP_Error(
					wp_remote_retrieve_response_code( $fetch ),
					__( 'Unsuccessful request', 'wpjuicer' ),
					wp_remote_retrieve_body( $fetch )
				);
				break;
			}

			$response = wp_remote_retrieve_body( $fetch );

			wp_cache_set( $cache_key, $response, 'juicer', 600 );

		} while ( false );

		return $response;

	}
}
