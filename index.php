<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage One_Dashboard
 * @since One Dashboard 1.0
 */

?>

<div style="text-align: center; display: flex; flex-flow: column; justify-content: center; align-items: center; height: 100vh;">
      <h1 style="margin-bottom: 50px; margin-top: 0;">Welcome to API Hub</h1>
      <img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.jpg' ); ?>" alt="" style="height: 300px; width: 500px;">
</div>
