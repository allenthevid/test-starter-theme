<?php
/**
 * Example Template Part: Hero Section with Tailwind CSS
 * 
 * This shows best practices for using Tailwind CSS in WordPress templates
 * 
 * @package Test_Starter_Theme
 */

// Prevent direct file access
defined( 'ABSPATH' ) || exit;

?>

<section class="relative w-full overflow-hidden bg-gradient-to-r from-primary-600 to-primary-800 py-20 md:py-32 lg:py-40">
    <!-- Background pattern (optional) -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 1200 600" preserveAspectRatio="none">
            <defs>
                <pattern id="dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                    <circle cx="20" cy="20" r="2" fill="white"/>
                </pattern>
            </defs>
            <rect width="1200" height="600" fill="url(#dots)"/>
        </svg>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center text-white">
            <?php if ( ! empty( $title ) ) : ?>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 tracking-tight">
                    <?php echo wp_kses_post( $title ); ?>
                </h1>
            <?php endif; ?>

            <?php if ( ! empty( $subtitle ) ) : ?>
                <p class="text-lg md:text-xl lg:text-2xl opacity-90 mb-8 leading-relaxed">
                    <?php echo wp_kses_post( $subtitle ); ?>
                </p>
            <?php endif; ?>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php if ( ! empty( $cta_text ) && ! empty( $cta_url ) ) : ?>
                    <a href="<?php echo esc_url( $cta_url ); ?>" class="inline-block px-8 py-4 rounded-lg bg-white text-primary-600 font-semibold hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <?php echo wp_kses_post( $cta_text ); ?>
                    </a>
                <?php endif; ?>

                <a href="#features" class="inline-block px-8 py-4 rounded-lg border-2 border-white text-white font-semibold hover:bg-white/10 transition-all duration-200">
                    Learn More
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 z-10 mb-4">
        <svg class="w-6 h-6 animate-bounce text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto mb-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Why Choose Us?
            </h2>
            <p class="text-lg text-gray-600">
                Experience the power of modern web development with Tailwind CSS and WordPress
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $features = [
                [
                    'icon' => '⚡',
                    'title' => 'Fast Performance',
                    'description' => 'Optimized CSS with automatic tree-shaking removes unused styles for minimal bundle size.',
                ],
                [
                    'icon' => '🎨',
                    'title' => 'Beautiful Design',
                    'description' => 'Utility-first CSS framework for creating custom designs without leaving your markup.',
                ],
                [
                    'icon' => '📱',
                    'title' => 'Responsive',
                    'description' => 'Mobile-first approach with built-in responsive breakpoints for all screen sizes.',
                ],
            ];

            foreach ( $features as $feature ) :
                ?>
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                    <div class="text-4xl mb-4"><?php echo wp_kses_post( $feature['icon'] ); ?></div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">
                        <?php echo wp_kses_post( $feature['title'] ); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php echo wp_kses_post( $feature['description'] ); ?>
                    </p>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</section>
