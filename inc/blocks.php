<?php
/**
 * Custom Block Registration — ACF 6.0+ (Modern Approach)
 *
 * Blocks are registered via register_block_type() pointing at their
 * directory. ACF discovers block.json automatically and wires up the
 * render template. No acf_register_block_type() needed.
 *
 * @package Test_Starter_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all blocks in the /blocks directory.
 *
 * Each block must have a block.json with an "acf.renderTemplate" key.
 * ACF 6.0+ reads that file and sets up the block automatically.
 */
function register_theme_blocks() {
    $blocks_dir = get_template_directory() . '/blocks';

    if ( ! is_dir( $blocks_dir ) ) {
        return;
    }

    foreach ( glob( $blocks_dir . '/*', GLOB_ONLYDIR ) as $block_path ) {
        if ( file_exists( $block_path . '/block.json' ) ) {
            register_block_type( $block_path );
        }
    }
}
add_action( 'init', 'register_theme_blocks' );

/**
 * Restrict which blocks are available in the editor.
 *
 * Uncomment and adjust the list to lock down the editor to only the
 * blocks your project needs. Keeping this commented out means all
 * blocks (core + ACF) are available.
 *
 * @param bool|array $allowed_blocks
 * @param WP_Post    $post
 * @return bool|array
 */
// function restrict_allowed_blocks( $allowed_blocks, $post ) {
//     return [
//         'core/paragraph',
//         'core/heading',
//         'core/image',
//         'core/buttons',
//         'core/button',
//         'core/group',
//         'core/columns',
//         'core/column',
//         'core/spacer',
//         'acf/hero',
//     ];
// }
// add_filter( 'allowed_block_types_all', 'restrict_allowed_blocks', 10, 2 );

/**
 * Enqueue block editor assets (styles / scripts loaded only in the editor).
 */
function enqueue_block_editor_assets() {
    // $version      = wp_get_theme()->get( 'Version' );
    // $template_uri = get_template_directory_uri();

    // wp_enqueue_style(
    //     'test-starter-block-editor',
    //     $template_uri . '/assets/css/blocks-editor.css',
    //     [],
    //     $version
    // );
}
add_action( 'enqueue_block_editor_assets', 'enqueue_block_editor_assets' );

/**
 * Enqueue block frontend assets (styles / scripts loaded on the front end).
 */
function enqueue_block_frontend_assets() {
    // $version      = wp_get_theme()->get( 'Version' );
    // $template_uri = get_template_directory_uri();

    // wp_enqueue_style(
    //     'test-starter-blocks',
    //     $template_uri . '/assets/css/blocks.css',
    //     [],
    //     $version
    // );
}
add_action( 'wp_enqueue_scripts', 'enqueue_block_frontend_assets' );
