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
