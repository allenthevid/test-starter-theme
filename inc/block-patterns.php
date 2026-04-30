<?php
/**
 * Register block patterns for the theme
 */
function register_block_patterns() {
    // Register hero pattern
    register_block_pattern(
        'test-starter/hero-section',
        [
            'title' => __('Hero Section', 'test-starter-theme'),
            'description' => __('A hero section with title and description', 'test-starter-theme'),
            'content' => '<!-- wp:heading {"align":"center","level":1} --><h1 class="has-text-align-center">Welcome to Our Site</h1><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Add your hero content here</p><!-- /wp:paragraph -->',
            'categories' => ['featured', 'hero'],
            'keywords' => ['hero', 'banner', 'title'],
            'viewportWidth' => 1200,
        ]
    );

    // Register testimonial pattern
    register_block_pattern(
        'test-starter/testimonial',
        [
            'title' => __('Testimonial', 'test-starter-theme'),
            'description' => __('A testimonial section with quote and author', 'test-starter-theme'),
            'content' => '<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.5em"}}} --><p style="font-size:1.5em">\"This is a great testimonial.\"</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>- Client Name</strong></p><!-- /wp:paragraph -->',
            'categories' => ['featured', 'testimonials'],
            'keywords' => ['testimonial', 'quote', 'client'],
            'viewportWidth' => 800,
        ]
    );

    // Register call-to-action pattern
    register_block_pattern(
        'test-starter/cta-section',
        [
            'title' => __('Call to Action', 'test-starter-theme'),
            'description' => __('A call-to-action section with button', 'test-starter-theme'),
            'content' => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}}} --><div class="wp-block-group" style="padding-top:60px;padding-bottom:60px"><!-- wp:heading {"align":"center"} --><h2 class="has-text-align-center">Ready to Get Started?</h2><!-- /wp:heading --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Click Here</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
            'categories' => ['featured', 'call-to-action'],
            'keywords' => ['cta', 'call', 'action', 'button'],
            'viewportWidth' => 1200,
        ]
    );
}
add_action('init', 'register_block_patterns');

/**
 * Register block pattern categories
 */
function register_block_pattern_categories() {
    register_block_pattern_category(
        'featured',
        [
            'label' => __('Featured', 'test-starter-theme'),
        ]
    );

    register_block_pattern_category(
        'hero',
        [
            'label' => __('Hero Sections', 'test-starter-theme'),
        ]
    );

    register_block_pattern_category(
        'testimonials',
        [
            'label' => __('Testimonials', 'test-starter-theme'),
        ]
    );

    register_block_pattern_category(
        'call-to-action',
        [
            'label' => __('Call to Action', 'test-starter-theme'),
        ]
    );
}
add_action('init', 'register_block_pattern_categories');
