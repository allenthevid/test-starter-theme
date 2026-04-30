<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if( get_field('poup_banner_title', 'option') ): 
        $banner_link = get_field('popup_banner_link', 'option');
        $bgImageBanner = get_field('background_image_popup_banner', 'option');
        $bgImageUrl = is_array($bgImageBanner) ? $bgImageBanner['url'] : $bgImageBanner;
    ?>
    <div id="siteBanner" class="site-banner w-full bg-[#1a1a1a] text-secondary text-left lg:text-center py-[1rem] px-[1rem] md:px-[32px] relative flex flex-wrap items-center justify-start md:justify-center gap-2" style="<?php echo $bgImageUrl ? 'background-image: url(' . esc_url($bgImageUrl) . '); background-size: cover; background-position: center;' : ''; ?>">
        <p class="text-secondary text-[12px] lg:text-[14px]"><?php echo esc_html( get_field('poup_banner_title', 'option') ); ?></p>
          <?php if( $banner_link ): ?>
            <a href="<?php echo esc_url( $banner_link['url'] ); ?>" 
                target="<?php echo esc_attr( $banner_link['target'] ?: '_self' ); ?>"
                class="underline text-secondary text-[12px] lg:text-[14px] font-semibold hover:opacity-80 transition-opacity">
                <?php echo esc_html( $banner_link['title'] ); ?>
            </a>
        <?php endif; ?>
        <button id="closeBanner" class="absolute right-[1rem] md:right-[32px] top-1/2 -translate-y-1/2 text-secondary bg-[#FFFFFF1A] p-[6px] rounded-[50%] h-[26px] w-[26px] md:w-[32px] md:h-[32px] transition-opacity flex items-center justify-center" aria-label="Close banner">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/close.svg' ); ?>" alt="Close" class="h-[9px] w-[9px] md:h-[12px] md:w-[12px]">
        </button>
    </div>
<?php endif; ?>
<header class="site-header bg-[#1A1A1A]" role="banner">
    <div class="container mx-auto py-5 flex items-center justify-between">

        <!-- Site branding: logo or site name fallback -->
        <div class="site-branding">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-name" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>
        </div>

        <!-- Primary navigation -->
        <nav class="site-nav hidden lg:block" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'test-starter-theme' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_class'     => 'site-nav__list',
                'container'      => false,
                'fallback_cb'    => false,
            ] );
            ?>
        </nav>

        <div class="cta-wrapper hidden lg:block">
            <?php
            wp_nav_menu( [
                'theme_location' => 'cta',
                'menu_class'     => 'cta-nav__list',
                'container'      => false,
                'fallback_cb'    => false,
            ] );
            ?>
        </div>

        <!-- Hamburger Menu Button -->
        <button class="lg:hidden hamburger-menu-btn" id="hamburgerMenuBtn" aria-label="Toggle menu" aria-expanded="false">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hamburger-icon.svg' ); ?>" alt="Menu" class="hamburger-icon">
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu hidden lg:hidden" id="mobileMenu">
        <div class="container mx-auto py-5">
            <nav class="mobile-nav" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'test-starter-theme' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-nav__list',
                    'container'      => false,
                    'fallback_cb'    => false,
                ] );
                ?>
            </nav>

            <!-- CTA Menu in Mobile -->
            <div class="mobile-cta-wrapper border-t border-[#262626] pt-4 mt-4">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'cta',
                    'menu_class'     => 'mobile-cta__list',
                    'container'      => false,
                    'fallback_cb'    => false,
                ] );
                ?>
            </div>
        </div>
        
    </div>
</header>