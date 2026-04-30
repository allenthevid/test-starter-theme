<?php
/**
 * Enqueue theme assets with proper versioning and dependencies
 * 
 * NOTE: Main CSS is compiled from Tailwind CSS
 * Run `npm run dev` during development or `npm run build` for production
 */
function theme_enqueue_assets() {
    $theme = wp_get_theme();
    $version = $theme->get('Version');
    $template_uri = get_template_directory_uri();

    // Google Fonts - Urbanist
    wp_enqueue_style(
        'google-font-urbanist',
        'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        [],
        '6.4.0'
    );

    // Main stylesheet (compiled from Tailwind CSS)
    wp_enqueue_style(
        'test-starter-main',
        $template_uri . '/assets/css/main.css',
        ['google-font-urbanist'],
        $version
    );

    // Main script with proper dependency handling
    wp_enqueue_script(
        'test-starter-main',
        $template_uri . '/assets/js/main.js',
        [],
        $version,
        true // Load in footer
    );

    // Localize script for PHP-to-JS data passing
    wp_localize_script(
        'test-starter-main',
        'themeSettings',
        [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'templateUri' => $template_uri,
            'restUrl' => rest_url(),
        ]
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

/**
 * Enqueue block editor assets for custom block styles
 */
function theme_enqueue_block_editor_assets() {
    $theme = wp_get_theme();
    $version = $theme->get('Version');
    $template_uri = get_template_directory_uri();

    // Use compiled Tailwind CSS in editor
    wp_enqueue_style(
        'test-starter-editor',
        $template_uri . '/assets/css/main.css',
        [],
        $version
    );
}
add_action('enqueue_block_editor_assets', 'theme_enqueue_block_editor_assets');
