<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage One_Dashboard
 * @since One Dashboard 1.0
 */

if ( ! function_exists( 'one_dashboard_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since One Dashboard 1.0
	 *
	 * @return void
	 */
	function one_dashboard_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on One Dashboard, use a find and replace
		 * to change 'one-dashboard' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'one-dashboard', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}
add_action( 'after_setup_theme', 'one_dashboard_setup' );

// Custom color classes.
require get_template_directory() . '/taxonomies/taxonomy-site.php';

/**
 * Restrict rest api for non-logged in users.
 *
 * NOTE: We can use https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/ plugin to create token and send
 *       the REST request.
 */
function one_dashboard_determine_current_user( $user ) {

	if ( empty( $user ) ) {

		add_filter( 'rest_pre_dispatch', 'one_dashboard_rest_pre_dispatch', 11, 3 );
	}

	return $user;
}
add_filter( 'determine_current_user', 'one_dashboard_determine_current_user', 11 );

/**
 * Show error if the user not send the Authorization token for each request.
 *
 * @param mixed           $result  Response to replace the requested version with. Can be anything
 *                                 a normal endpoint can return, or null to not hijack the request.
 * @param WP_REST_Server  $server  Server instance.
 * @param WP_REST_Request $request Request used to generate the response.
 *
 * @return mixed|WP_Error
 */
function one_dashboard_rest_pre_dispatch( $result, $server, $request ) {

	if ( '/jwt-auth/v1/token' !== $request->get_route() ) {

		return new WP_Error(
			'jwt_auth_no_auth_header',
			'Authorization header not found.',
			array(
				'status' => 403,
			)
		);
	}

	return $result;
}
