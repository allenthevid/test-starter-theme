<?php
/**
 * Theme Utilities and Helper Functions
 * 
 * @package Test_Starter_Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get theme mod with default fallback
 * 
 * @param string $setting Setting name
 * @param mixed  $default Default value if not set
 * @return mixed
 */
function test_starter_get_theme_mod( $setting, $default = '' ) {
    return get_theme_mod( $setting, $default );
}

/**
 * Safely output theme mod
 * 
 * @param string $setting Setting name
 * @param mixed  $default Default value if not set
 * @return void
 */
function test_starter_the_theme_mod( $setting, $default = '' ) {
    echo esc_attr( test_starter_get_theme_mod( $setting, $default ) );
}

/**
 * Get site logo with fallback
 * 
 * @return string
 */
function test_starter_get_site_logo() {
    $logo_id = get_theme_mod( 'custom_logo' );
    if ( $logo_id ) {
        return wp_get_attachment_image( $logo_id, 'medium' );
    }
    return '';
}

/**
 * Get primary navigation menu
 * 
 * @return string
 */
function test_starter_get_primary_menu() {
    return wp_nav_menu(
        [
            'theme_location' => 'primary',
            'echo'            => false,
            'fallback_cb'     => 'wp_page_menu',
        ]
    );
}

/**
 * Check if Gutenberg is available
 * 
 * @return bool
 */
function test_starter_is_gutenberg_available() {
    return function_exists( 'register_block_type' );
}

/**
 * Check if full site editing is enabled
 * 
 * @return bool
 */
function test_starter_is_fse_enabled() {
    return (
        current_theme_supports( 'block-templates' ) ||
        ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() )
    );
}

/**
 * Get block template part
 * 
 * @param string $part Template part name
 * @param string $content Fallback content
 * @return string
 */
function test_starter_get_template_part( $part, $content = '' ) {
    if ( function_exists( 'block_template_part' ) ) {
        ob_start();
        block_template_part( $part );
        return ob_get_clean();
    }
    return $content;
}

/**
 * Enqueue Google Fonts
 * 
 * @param array $fonts Array of font names
 * @return void
 */
function test_starter_enqueue_google_fonts( $fonts = [] ) {
    if ( empty( $fonts ) ) {
        return;
    }

    $font_query = implode( '|', array_map( 'rawurlencode', $fonts ) );
    wp_enqueue_style(
        'test-starter-google-fonts',
        "https://fonts.googleapis.com/css2?family={$font_query}&display=swap",
        [],
        TEST_STARTER_THEME_VERSION
    );
}

/**
 * Get image attachment
 * 
 * @param int    $attachment_id Attachment ID
 * @param string $size Image size
 * @param array  $args Additional arguments
 * @return string
 */
function test_starter_get_image( $attachment_id, $size = 'large', $args = [] ) {
    $defaults = [
        'alt' => get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ),
    ];

    $args = wp_parse_args( $args, $defaults );

    return wp_get_attachment_image( $attachment_id, $size, false, $args );
}

/**
 * Get customizer setting value
 * 
 * @param string $setting Setting name
 * @return mixed
 */
function test_starter_get_customizer_setting( $setting ) {
    return get_option( "test_starter_customizer_{$setting}" );
}

/**
 * Sanitize class names
 * 
 * @param string|array $classes Class name(s)
 * @return string
 */
function test_starter_sanitize_classes( $classes ) {
    if ( is_array( $classes ) ) {
        $classes = implode( ' ', $classes );
    }

    return sanitize_html_class( $classes );
}

/**
 * Get post classes formatted for Gutenberg
 * 
 * @param int|WP_Post $post Post ID or object
 * @return array
 */
function test_starter_get_post_classes( $post = null ) {
    $post = get_post( $post );
    if ( ! $post ) {
        return [];
    }

    return get_the_class( [], $post->ID );
}
