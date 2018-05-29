<?php

namespace Clubdeuce\WPJuicer;

/**
 * Class Feed_View
 * @package Clubdeuce\WPJuicer
 *
 * @property Feed $item
 *
 * @method string        the_id()
 * @method string        the_slug()
 * @method string        the_name()
 * @method string        the_plan()
 * @method int           the_update_frequency()
 * @method string        the_last_synced()
 * @method integer       the_max_sources()
 * @method string        the_more_sources_allowed()
 * @method bool          the_analytics_allowed()
 * @method bool          the_moderation_allowed()
 * @method string        the_css()
 * @method int           the_interval()
 * @method int           the_width()
 * @method int           the_height()
 * @method int           the_columns()
 * @method string        the_order()
 * @method string        the_display_filter()
 * @method bool          the_display_filter_type()
 * @method bool          the_colored_icons()
 * @method bool          the_photos()
 * @method bool          the_videos()
 * @method bool          the_lazy_load()
 * @method bool          the_overlay()
 * @method bool          the_infinite_scroll()
 * @method bool          the_poll()
 * @method string        the_disallowed()
 * @method string        the_allowed()
 * @method int           the_distance()
 * @method string        the_location()
 * @method float         the_lat()
 * @method float         the_lng()
 * @method bool          the_profanity()
 * @method bool          the_prevent_duplicates()
 * @method bool          the_queue()
 * @method bool          the_moderating()
 * @method int           the_page_views_count()
 * @method string        the_custom_css()
 * @method \stdClass     the_colors()
 * @method array         the_social_accounts()
 */
class Feed_View extends View_Base {

	/**
	 * @param array $args
	 */
	public function the_feed_html( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'template' => 'feed.php',
		) );

		$template = $args['template'];
		unset( $args['template'] );

		$this->the_template( $template, $args );

	}

}
