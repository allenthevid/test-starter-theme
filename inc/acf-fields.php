<?php
/**
 * ACF Field Groups and Options Pages — ACF 6.0+ (Modern Approach)
 *
 * @package Test_Starter_Theme
 */

defined( 'ABSPATH' ) || exit;

// ---------------------------------------------------------------------------
// Local JSON — save & load paths
// ---------------------------------------------------------------------------

function test_starter_acf_json_save_path( $path ) {
    $theme_json = get_template_directory() . '/acf-json';
    if ( ! is_dir( $theme_json ) ) {
        wp_mkdir_p( $theme_json );
    }
    return $theme_json;
}
add_filter( 'acf/settings/save_json', 'test_starter_acf_json_save_path' );

function test_starter_acf_json_load_paths( $paths ) {
    $blocks_dir = get_template_directory() . '/blocks';

    foreach ( glob( $blocks_dir . '/*/acf-json', GLOB_ONLYDIR ) as $acf_json_path ) {
        $paths[] = $acf_json_path;
    }

    $theme_json = get_template_directory() . '/acf-json';
    if ( is_dir( $theme_json ) ) {
        $paths[] = $theme_json;
    }

    return $paths;
}
add_filter( 'acf/settings/load_json', 'test_starter_acf_json_load_paths' );

// ---------------------------------------------------------------------------
// Options Page — wrapped in acf/init so it doesn't run too early
// ---------------------------------------------------------------------------

function test_starter_register_options_page() {
    if ( ! function_exists( 'acf_add_options_page' ) ) {
        return;
    }

    acf_add_options_page( [
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ] );
}
add_action( 'acf/init', 'test_starter_register_options_page' );