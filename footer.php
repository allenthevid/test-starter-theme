<footer class="">
    <div class="top-footer py-[50px] lg:py-[60px] bg-[#141414]">
        <div class="container mx-auto">
            <div class="footer-content 2xl:flex items-start justify-between 2xl:gap-[101px] 3xl:gap-[195px]">
                <!-- Branding & Newsletter -->
                <div class="footer-brand 2xl:max-w-[305px] 3xl:max-w-[423px] w-full">
                    <div class="site-branding mb-[20px] lg:mb-[30px]">
                        <?php 
                        $footer_logo = get_field( 'footer_logo', 'option' );
                        if ( $footer_logo ) : 
                            $logo_url = is_array( $footer_logo ) ? $footer_logo['url'] : $footer_logo;
                            $logo_alt = is_array( $footer_logo ) ? $footer_logo['alt'] : '';
                            $logo_width = is_array( $footer_logo ) ? $footer_logo['width'] : '';
                            $logo_height = is_array( $footer_logo ) ? $footer_logo['height'] : '';
                        ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                <img src="<?php echo esc_url( $logo_url ); ?>" 
                                     alt="<?php echo esc_attr( $logo_alt ?: bloginfo( 'name' ) ); ?>" 
                                     width="<?php echo esc_attr( $logo_width ?: 'auto' ); ?>"
                                     height="<?php echo esc_attr( $logo_height ?: 'auto' ); ?>"
                                     class="footer-logo max-w-[113.33px] w-full h-auto lg:max-w-[160px]"
                                     loading="lazy"
                                     decoding="async">
                            </a>
                        <?php else : ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-name text-secondary text-[24px] font-bold" rel="home">
                                <?php bloginfo( 'name' ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="newsletter-form">
                        <?php 
                        $newsletter_shortcode = get_field( 'form_footer', 'option' );
                        if ( $newsletter_shortcode ) {
                            echo do_shortcode( $newsletter_shortcode );
                        }
                        ?>
                    </div>
                </div>

                <!-- Footer Navigation Columns -->
                <div class="footer-links-grid flex-1 pt-[50px] 2xl:pt-0">
                    <div class="columns-2 lg:columns-none lg:flex lg:justify-between">

                        <!-- Home: left col -->
                        <div class="footer-column break-inside-avoid pb-5 relative
                            after:absolute after:bottom-0 after:left-0 after:w-[80%] after:h-px lg:after:hidden after:bg-[#333333]
                            before:absolute before:top-0 before:right-0 before:bottom-0 before:w-px before:bg-[#333333]
                            lg:before:hidden lg:order-1">
                            <h3 class="text-[#999999] text-[20px] font-semibold mb-[16px]">
                                <?php echo esc_html( get_field( 'title_menu_col_1', 'option' ) ?: 'Home' ); ?>
                            </h3>
                            <?php wp_nav_menu( [ 'theme_location' => 'home', 'menu_class' => 'space-y-[8px] lg:space-y-[16px] 2xl:space-y-[20px]', 'container' => false, 'fallback_cb' => false, 'depth' => 2 ] ); ?>
                        </div>

                        <!-- Properties: left col -->
                        <div class="footer-column break-inside-avoid pt-5 pb-5 lg:pt-0 lg:pb-0 relative
                                    after:absolute after:bottom-0 after:left-0 after:w-[80%] lg:after:hidden after:h-px after:bg-[#333333]
                                    before:absolute before:top-0 before:right-0 before:bottom-0 before:w-px before:bg-[#333333]
                                    lg:before:hidden lg:order-3">
                            <h3 class="text-[#999999] text-[20px] font-semibold mb-[16px]">
                                <?php echo esc_html( get_field( 'title_menu_col_3', 'option' ) ?: 'Properties' ); ?>
                            </h3>
                            <?php wp_nav_menu( [ 'theme_location' => 'properties', 'menu_class' => 'space-y-[8px] lg:space-y-[16px] 2xl:space-y-[20px]', 'container' => false, 'fallback_cb' => false, 'depth' => 2 ] ); ?>
                        </div>

                        <!-- Contact Us: left col -->
                        <div class="footer-column break-inside-avoid pt-5 pb-5 lg:pt-0 lg:pb-0 relative
                                    after:absolute after:bottom-0 after:left-0 after:w-[80%] lg:after:hidden after:h-px after:bg-[#333333]
                                    before:absolute before:top-0 before:right-0 before:bottom-0 before:w-px before:bg-[#333333]
                                    lg:before:hidden lg:order-5">
                            <h3 class="text-[#999999] text-[20px] font-semibold mb-[16px]">
                                <?php echo esc_html( get_field( 'title_menu_col_5', 'option' ) ?: 'Contact Us' ); ?>
                            </h3>
                            <?php wp_nav_menu( [ 'theme_location' => 'contact-us', 'menu_class' => 'space-y-[8px] lg:space-y-[16px] 2xl:space-y-[20px]', 'container' => false, 'fallback_cb' => false, 'depth' => 2 ] ); ?>
                        </div>

                        <!-- About Us: right col -->
                        <div class="footer-column break-inside-avoid ml-5 pb-5 lg:pb-0 relative
                                    after:absolute after:bottom-0 after:left-0 after:w-[80%] lg:after:hidden after:h-px after:bg-[#333333]
                                    lg:ml-0 lg:order-2">
                            <h3 class="text-[#999999] text-[20px] font-semibold mb-[16px]">
                                <?php echo esc_html( get_field( 'title_menu_col_2', 'option' ) ?: 'About Us' ); ?>
                            </h3>
                            <?php wp_nav_menu( [ 'theme_location' => 'about-us', 'menu_class' => 'space-y-[8px] lg:space-y-[16px] 2xl:space-y-[20px]', 'container' => false, 'fallback_cb' => false, 'depth' => 2 ] ); ?>
                        </div>

                        <!-- Services: right col -->
                        <div class="footer-column break-inside-avoid ml-5 pt-5 pb-5 lg:pb-0 lg:pt-0 relative
                                    after:absolute after:bottom-0 after:left-0 after:w-[80%] lg:after:hidden after:h-px after:bg-[#333333]
                                    lg:ml-0 lg:order-4">
                            <h3 class="text-[#999999] text-[20px] font-semibold mb-[16px]">
                                <?php echo esc_html( get_field( 'title_menu_col_4', 'option' ) ?: 'Services' ); ?>
                            </h3>
                            <?php wp_nav_menu( [ 'theme_location' => 'services', 'menu_class' => 'space-y-[8px] lg:space-y-[16px] 2xl:space-y-[20px]', 'container' => false, 'fallback_cb' => false, 'depth' => 2 ] ); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer bg-primary py-[20px] 2xl:py-[14px] 3xl:py-[26px]">
        <div class="container mx-auto">
            <div class="inner-wrapper flex flex-col-reverse 2xl:flex-row items-center justify-center 2xl:justify-between gap-[20px]">
                <div class="left-wrapper  2xl:flex items-center gap-[38px]">
                    <p class="text-secondary">&copy; <?php echo date('Y'); ?> <?php the_field('copyright_text', 'option'); ?></p>
                    <div class="footer-bot-links has-[a]:text-secondary flex items-center justify-center 2xl:justify-between gap-[38px]">
                        <?php
                        wp_nav_menu( [
                            'theme_location' => 'footer-links',
                            'menu_class'     => 'footer-links__list',
                            'container'      => false,
                            'fallback_cb'    => false,
                        ] );
                        ?>
                    </div>
                </div>
                <div class="right-wrapper">
                    <?php
                    $social_links = get_field( 'social_media_links', 'option' );
                    
                    if ( ! empty( $social_links ) ) {
                        ?>
                        <div class="social-media-links flex items-center gap-[24px]">
                            <?php
                            foreach ( $social_links as $link ) {
                                $platform = $link['platform'] ?? '';
                                $url      = $link['url'] ?? '';
                                
                                if ( empty( $platform ) || empty( $url ) ) {
                                    continue;
                                }
                                
                                $icon_class = 'social-icon social-icon--' . esc_attr( $platform );
                                $title      = ucfirst( $platform );
                                ?>
                                <a href="<?php echo esc_url( $url ); ?>" 
                                   class="<?php echo esc_attr( $icon_class ); ?>" 
                                   title="<?php echo esc_attr( $title ); ?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   aria-label="Follow us on <?php echo esc_attr( $title ); ?>">
                                    <?php 
                                    $icon_map = [
                                        'facebook'  => 'fab fa-facebook-f',
                                        'twitter'   => 'fab fa-twitter',
                                        'linkedin'  => 'fab fa-linkedin-in',
                                        'instagram' => 'fab fa-instagram',
                                        'youtube'   => 'fab fa-youtube',
                                        'tiktok'    => 'fab fa-tiktok',
                                        'github'    => 'fab fa-github',
                                        'pinterest' => 'fab fa-pinterest-p',
                                    ];
                                    $fa_icon = $icon_map[ $platform ] ?? 'fab fa-link';
                                    ?>
                                    <i class="<?php echo esc_attr( $fa_icon ); ?>"></i>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>