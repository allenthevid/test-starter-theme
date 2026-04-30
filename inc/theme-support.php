<?php
function theme_setup() {
    // Core support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Site logo — exposes Logo option under Customizer > Site Identity
    add_theme_support( 'custom-logo', [
        'height'               => 80,
        'width'                => 200,
        'flex-height'          => true,
        'flex-width'           => true,
        'unlink-homepage-logo' => false,
        'header-text'          => [ 'site-title', 'site-description' ],
    ] );

    // Gutenberg & Block Editor support
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');

    // Editor styles
    add_editor_style('assets/css/main.css');

    // Navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'test-starter-theme'),
        'footer' => __('Footer Menu', 'test-starter-theme'),
        'cta' => __('CTA Menu', 'test-starter-theme'),
        'home' => __('Home Menu', 'test-starter-theme'),
        'about-us' => __('About Us Menu', 'test-starter-theme'),
        'properties' => __('Properties Menu', 'test-starter-theme'),
        'services' => __('Services Menu', 'test-starter-theme'),
        'contact-us' => __('Contact Us Menu', 'test-starter-theme'),
        'footer-links' => __('Footer Links Menu', 'test-starter-theme')
    ]);
}
add_action('after_setup_theme', 'theme_setup');
