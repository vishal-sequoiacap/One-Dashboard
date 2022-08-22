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
