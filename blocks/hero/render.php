<?php
/**
 * Hero Block — Render Template (ACF 6.0+)
 *
 * @package Test_Starter_Theme
 */

defined( 'ABSPATH' ) || exit;

// ---------------------------------------------------------------------------
// Retrieve ACF fields
// ---------------------------------------------------------------------------
$heading             = get_field( 'hero_title' );
$description         = get_field( 'hero_description' );
$featured_image      = get_field( 'hero_featured_image' );
$buttons             = get_field( 'cta_buttons' );
$statistics          = get_field( 'statistics' );
$headingTag          = get_field( 'heading_tag' );
$enableRotatingBadge = get_field( 'rotating_badge' );
$ctaRotatingBadgeLink = get_field( 'floating_button' );

// ---------------------------------------------------------------------------
// Block wrapper
// ---------------------------------------------------------------------------
$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'test-starter-hero relative overflow-hidden bg-dark pt-[40px] lg:pt-0',
    ]
);
?>

<section <?php echo $wrapper_attributes; ?>>
    <div class="container mx-auto">
        <div class="flex items-center justify-between flex-col-reverse lg:flex-row">

            <div class="left-wrapper outer-wrapper flex py-[40px] lg:py-[144px] lg:w-[calc(50%-20px)] 3xl:w-[calc(50%-40px)]">
                <div class="flex flex-col items-start gap-[40px] lg:gap-[50px] 2xl:gap-[60px] w-full">

                    <?php if ( $heading || $description ) : ?>
                        <div class="headings-wrapper">
                            <?php if ( $heading ) : ?>
                                <<?php echo esc_attr( $headingTag['heading_tags'] ); ?> class="title">
                                    <?php echo esc_html( $heading ); ?>
                                </<?php echo esc_attr( $headingTag['heading_tags'] ); ?>>
                            <?php endif; ?>
                            <?php if ( $description ) : ?>
                                <div class="description"><?php echo wp_kses_post( $description ); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $buttons ) : ?>
                        <div class="cta-buttons flex items-center gap-[20px] flex-wrap w-full">
                            <?php foreach ( $buttons as $button ) :
                                $link        = $button['button'];
                                $buttonStyle = $button['button_style_cta_btn'] ?: 'btn-primary';
                                if ( ! $link ) {
                                    continue;
                                }
                            ?>
                                <a href="<?php echo esc_url( $link['url'] ); ?>"
                                   target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>"
                                   class="cta-button inline-block <?php echo esc_attr( $buttonStyle ); ?> text-white text-center w-full md:w-auto">
                                    <?php echo esc_html( $link['title'] ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $statistics ) : ?>
                        <div class="statistics grid grid-cols-2 lg:grid-cols-3 gap-[12px] lg:gap-[20px] w-full">
                            <?php foreach ( $statistics as $index => $stat ) :
                                preg_match( '/^(\d+)(.*)$/', trim( $stat['title'] ), $matches );
                                $number = $matches[1] ?? $stat['title'];
                                $suffix = $matches[2] ?? '';
                                $is_last_odd = ( $index === count( $statistics ) - 1 && count( $statistics ) % 2 !== 0 );
                            ?>
                                <div class="stat-item <?php echo $is_last_odd ? 'col-span-2 lg:col-span-1' : ''; ?> bg-primary border border-[#262626] rounded-[12px] px-6 py-4">
                                    <h2 class="title mb-[2px]">
                                        <span class="stat-counter"
                                              data-target="<?php echo esc_attr( $number ); ?>"
                                              data-suffix="<?php echo esc_attr( $suffix ); ?>">
                                            0<?php echo esc_html( $suffix ); ?>
                                        </span>
                                    </h2>
                                    <div class="description text-[#999999] font-medium">
                                        <?php echo esc_html( $stat['description'] ); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <?php if ( $featured_image ) : ?>
                <div class="right-wrapper lg:w-[calc(50%-20px)] 3xl:w-[calc(50%-40px)] hero-image relative lg:absolute top-0 right-0 bottom-0 border border-[#262626] rounded-[12px] lg:overflow-hidden lg:rounded-none lg:border-0">
                    <img src="<?php echo esc_url( $featured_image['url'] ); ?>"
                         alt="<?php echo esc_attr( $featured_image['alt'] ); ?>"
                         class="w-full h-full object-cover object-center">

                    
                    <?php if ( $enableRotatingBadge && $ctaRotatingBadgeLink ) : ?>
                        <a href="<?php echo esc_url( $ctaRotatingBadgeLink['url'] ); ?>"
                            target="<?php echo esc_attr( $ctaRotatingBadgeLink['target'] ?: '_self' ); ?>"
                            class="rotating-badge lg:hidden">

                                <div class="absolute inset-0 flex items-center justify-center z-[2] pointer-events-none">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/arrow.svg' ); ?>"
                                        alt=""
                                        class="w-[79px] h-[79px]">
                                </div>

                                <svg class="badge-text" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="175" height="175">
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
            <?php endif; ?>

        </div>

        <?php if ( $enableRotatingBadge && $ctaRotatingBadgeLink ) : ?>
            <a href="<?php echo esc_url( $ctaRotatingBadgeLink['url'] ); ?>"
               target="<?php echo esc_attr( $ctaRotatingBadgeLink['target'] ?: '_self' ); ?>"
               class="rotating-badge hidden lg:block">

                <div class="absolute inset-0 flex items-center justify-center z-[2] pointer-events-none">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/arrow.svg' ); ?>"
                         alt=""
                         class="w-[79px] h-[79px]">
                </div>

                <svg class="badge-text" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="175" height="175">
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
