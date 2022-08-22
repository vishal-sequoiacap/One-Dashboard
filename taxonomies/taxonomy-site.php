<?php
/**
 * Taxonomy Site.
 *
 * @package WordPress
 * @subpackage One_Dashboard
 * @since One Dashboard 1.0
 */

/**
 * Register taxonomy.
 */
function od_register_site_taxonomy() {

	$singular = __( 'Site', 'surge' );
	$plural   = __( 'Sites', 'surge' );

	$labels = array(
		'name'                       => $plural,
		'singular_name'              => $singular,
		'search_terms'               => 'Search ' . $plural,
		'popular_terms'              => 'Popular ' . $plural,
		'all_items'                  => 'All ' . $plural,
		'parent_item'                => 'Parent ' . $singular,
		'parent_item_colon'          => 'Parent ' . $singular . ':',
		'edit_item'                  => 'Edit ' . $singular,
		'update_item'                => 'Update ' . $singular,
		'add_new_item'               => 'Add New ' . $singular,
		'new_item_name'              => 'New ' . $singular . ' Name',
		'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
		'add_or_remove_items'        => 'Add or remove ' . $plural,
		'choose_from_most_used'      => 'Choose from the most used ' . $plural,
		'menu_name'                  => $plural,
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_nav_menus'  => true,
		'show_in_rest'       => true,
		'show_ui'            => true,
		'hierarchical'       => true,
		'capability_type'    => 'post',
		'publicly_queryable' => true,
	);

	register_taxonomy( 'site', 'post', $args );
}
add_action( 'init', 'od_register_site_taxonomy' );

/**
 * Show site param error.
 */
function od_show_site_param_error() {

	esc_html_e( 'Sorry, you are not allowed to fetch posts without adding `{site=ID}` in query string.', 'one-dashboard' );

	die;
}

/**
 * Verify if the posts rest api is called with site id or not, give and error if site id is not present.
 *
 * @param array           $args    Array of arguments for WP_Query.
 * @param WP_REST_Request $request The REST API request.
 *
 * @return array
 */
function od_rest_post_query( $args, $request ) {

	$site_ids = $request->get_param( 'site' );

	if ( empty( $site_ids ) ) {

		/**
		 * Show error when site term id is not available in rest api call query string.
		 */

		od_show_site_param_error();

	} else {

		/**
		 * Limit post results to max 30.
		 */

		$per_page = $args['posts_per_page'];

		if ( (int) $per_page > 30 ) {

			$args['posts_per_page'] = 30;
		}
	}

	return $args;
}
add_filter( 'rest_post_query', 'od_rest_post_query', 10, 2 );
add_filter( 'rest_post_search_query', 'od_rest_post_query', 10, 2 );

/**
 * Handle {site=ID} in the search rest api call.
 *
 * @param array           $args    Array of arguments for WP_Query.
 * @param WP_REST_Request $request The REST API request.
 *
 * @return array
 */
function od_rest_post_search_query( $args, $request ) {

	$site_ids = $request->get_param( 'site' );

	if ( ! empty( $site_ids ) ) {

		$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'site',
				'field'    => 'term_id',
				'terms'    => $site_ids,
			),
		);
	}

	return $args;
}
add_filter( 'rest_post_search_query', 'od_rest_post_search_query', 10, 2 );
