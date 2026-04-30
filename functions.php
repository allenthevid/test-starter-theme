<?php
/**
 * TEST Starter Theme Functions
 * 
 * Main theme functions file
 * 
 * @package Test_Starter_Theme
 */

// Prevent direct file access
defined( 'ABSPATH' ) || exit;

// Define theme constants
define( 'TEST_STARTER_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'TEST_STARTER_THEME_DIR', get_template_directory() );
define( 'TEST_STARTER_THEME_URI', get_template_directory_uri() );

// Load theme includes
require TEST_STARTER_THEME_DIR . '/inc/enqueue.php';
require TEST_STARTER_THEME_DIR . '/inc/theme-support.php';
require TEST_STARTER_THEME_DIR . '/inc/custom-post-types.php';
require TEST_STARTER_THEME_DIR . '/inc/acf-fields.php';
require TEST_STARTER_THEME_DIR . '/inc/block-patterns.php';
require TEST_STARTER_THEME_DIR . '/inc/blocks.php';
require TEST_STARTER_THEME_DIR . '/inc/utilities.php';
