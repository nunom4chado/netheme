<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta charset="<?php bloginfo('charset'); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="offcanvas">
        <i id="icon-close" class="fas fa-times link link--dark"></i>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation'
            ));
        ?>
    </div>
    <div class="offcanvas-overlay"></div>

    <header class="navbar">
        <div class="navbar__inner">
            <div class="navbar__brand">
                <a href="<?php echo esc_url(site_url()) ?>">
                    <img
                        class="navbar__logo"
                        src="<?php echo get_template_directory_uri(); ?>/img/ne-logo-test.svg"
                        alt="logo"
                    />
                </a>
            </div>

            <nav class="navbar__nav">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'headerMenuLocation'
                    ));
                ?>
            </nav>
            <i id="icon-menu" class="icon-menu"></i>
            <i id="icon-search" class="icon-magnifier"></i>
        </div>
</header>
