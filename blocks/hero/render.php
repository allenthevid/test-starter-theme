<?php
/**
 * Hero Block — Render Template (ACF 6.0+)
 *
 * ACF calls this file directly via block.json "acf.renderTemplate".
 * Displays a premium hero section with dual-column layout, CTA buttons, 
 * featured image, and statistics section.
 *
 * @param array  $block      Block settings and attributes.
 * @param string $content    Inner block HTML (empty for this block).
 * @param bool   $is_preview True when rendering in the editor preview.
 * @param int    $post_id    The current post ID.
 *
 * @package Test_Starter_Theme
 */

defined( 'ABSPATH' ) || exit;

// ---------------------------------------------------------------------------
// Retrieve ACF fields
// ---------------------------------------------------------------------------
$heading              = get_field( 'hero_title' );
$description          = get_field( 'hero_description' );
$featured_image       = get_field( 'hero_featured_image' );
$buttons              = get_field( 'cta_buttons' );
$statistics           = get_field( 'statistics' );
$headingTag           = get_field( 'heading_tag' ) ?: 'h1'; // Default to h1 if not set
$enableRotatingBadge   = get_field( 'rotating_badge' );
$ctaRotatingBadgeLink   = get_field( 'floating_button' );

// ---------------------------------------------------------------------------
// Block wrapper
// ---------------------------------------------------------------------------
$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'test-starter-hero relative overflow-hidden bg-dark',
    ]
);
?>

<section <?php echo $wrapper_attributes; ?>>
    <div class="container mx-auto">
        <div class="lg:flex items-center justify-between flex-col lg:flex-row">
            <div class="left-wrapper outer-wrapper flex py-[144px] lg:w-[calc(50%-20px)] 3xl:w-[calc(50%-40px)]">
                <div class="flex flex-col items-start gap-[40px] lg:gap-[50px] 2xl:gap-[60px] w-full">
                    <div class="headings-wrapper">
                        <<?php echo $headingTag['heading_tags']; ?> class="title"><?php echo esc_html( $heading ); ?></<?php echo $headingTag['heading_tags']; ?>>
                        <div class="description"><?php echo $description; ?></div>
                    </div>
                
                    <div class="cta-buttons flex items-center gap-[20px] flex-wrap w-full">
                        <?php if ( $buttons ) : ?>
                            <?php foreach ( $buttons as $button ) : 
                                $link = $button['button'];
                                $buttonStyle = $button['button_style_cta_btn'] ?: 'btn-primary'; // Default to 'primary' if not set
                                if ( ! $link ) {
                                    continue; // Skip if no link is provided
                                }
                                ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>" 
                                    target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>"
                                    class="cta-button inline-block px-6 py-3 <?php echo esc_attr( $buttonStyle ); ?> text-white text-center rounded-md font-semibold transition-colors w-full md:w-auto">
                                    <?php echo esc_html( $link['title'] ); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($statistics) : ?>
                        <div class="statistics grid grid-cols-2 lg:grid-cols-3 gap-[12px] lg:gap-[20px] w-full">
                            <?php foreach ($statistics as $index => $stat) : 
                                // Split numeric part from suffix (e.g. "200+" → "200" and "+", "10k+" → "10" and "k+")
                                preg_match('/^(\d+)(.*)$/', trim($stat['title']), $matches);
                                $number = $matches[1] ?? $stat['title'];
                                $suffix = $matches[2] ?? '';
                            ?>
                                <div class="stat-item <?php echo ($index === count($statistics) - 1 && count($statistics) % 2 !== 0) ? 'col-span-2 lg:col-span-1' : ''; ?> bg-primary border border-[#262626] rounded-[12px] px-6 py-4">
                                    <h2 class="title mb-[2px]">
                                        <span class="stat-counter" data-target="<?php echo esc_attr($number); ?>" data-suffix="<?php echo esc_attr($suffix); ?>">0<?php echo esc_html($suffix); ?></span>
                                    </h2>
                                    <div class="description text-[#999999] font-medium"><?php echo esc_html($stat['description']); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="right-wrapper lg:w-[calc(50%-20px)] 3xl:w-[calc(50%-40px)] hero-image lg:absolute top-0 right-0 bottom-0 border border-[#262626] rounded-[12px] overflow-hidden lg:rounded-none lg:border-0">
                 <?php if ( $featured_image ) : ?>
                    <img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php echo esc_attr( $featured_image['alt'] ); ?>" class="w-full h-full object-cover object-center">
                <?php endif; ?>  
            </div>
        </div>
        <?php if ( $enableRotatingBadge && $ctaRotatingBadgeLink ) : ?>
            <a href="<?php echo esc_url( $ctaRotatingBadgeLink['url'] ); ?>"
            target="<?php echo esc_attr( $ctaRotatingBadgeLink['target'] ?: '_self' ); ?>"
            class="rotating-badge">

                <div class="badge-arrow">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/arrow.svg' ); ?>"
                        alt="Arrow"
                        class="w-[79px] h-[79px]">
                </div>

                <svg class="badge-text" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <path id="circle-path" d="M 100,100 m -75,0 a 75,75 0 1,1 150,0 a 75,75 0 1,1 -150,0"/>
                    </defs>
                    <circle cx="100" cy="100" r="98" fill="#111118"/>
                    <circle cx="100" cy="100" r="97" fill="none" stroke="#262626" stroke-width="1"/>
                    <text fill="white" font-size="15.5" font-family="inherit" letter-spacing="8.5" font-weight="500">
                        <textPath href="#circle-path" startOffset="0%">
                            <?php echo esc_html( $ctaRotatingBadgeLink['title'] ); ?>
                        </textPath>
                    </text>
                </svg>

            </a>
        <?php endif; ?>
    </div>
</section>
