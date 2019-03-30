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
        <i id="icon-close" class="icon-close link link--dark"></i>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation'
            ));
        ?>
    </div>
    <div class="offcanvas-overlay"></div>

    <header class="navbar">
        <div class="navbar__inner">
            <a href="<?php echo site_url() ?>" class="navbar__logo-link">
                <img
                    class="navbar__logo"
                    src="https://sunlightmedia.org/wp-content/uploads/2018/06/node-sass-1-680x510.png"
                    alt="logo"
                />
            </a>

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
