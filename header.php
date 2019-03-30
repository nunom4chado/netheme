<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php wp_head(); ?>
</head>
<body>
    <div class="offcanvas">
        <i id="icon-close" class="icon-close link link--dark"></i>
        <ul class="offcanvas__links">
            <li><a href="#" class="link link--dark">Artigos</a></li>
            <li><a href="#" class="link link--dark">Receitas</a></li>
            <li><a href="#" class="link link--dark">Alimentos</a></li>
            <li><a href="#" class="link link--dark">Nutrientes</a></li>
        </ul>
    </div>
    <div class="offcanvas-overlay"></div>

    <nav class="navbar">
        <div class="navbar__inner">
            <a href="<?php echo site_url() ?>" class="navbar__logo-link">
                <img
                    class="navbar__logo"
                    src="https://sunlightmedia.org/wp-content/uploads/2018/06/node-sass-1-680x510.png"
                    alt="logo"
                />
            </a>
            <ul class="navbar__links">
                <li><a href="#" class="link link--dark">Artigos</a></li>
                <li><a href="#" class="link link--dark">Receitas</a></li>
                <li><a href="#" class="link link--dark">Alimentos</a></li>
                <li><a href="#" class="link link--dark">Nutrientes</a></li>
            </ul>
            <i id="icon-menu" class="icon-menu link link--dark"></i>
            <i id="icon-search" class="icon-magnifier link link--dark"></i>
        </div>
    </nav>
