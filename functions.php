<?php

function ne_files() {
    wp_enqueue_script('main_js', get_theme_file_uri('js/main.js'), NULL, microtime(), true);
    wp_enqueue_style('font-montserrat', '//fonts.googleapis.com/css?family=Montserrat:300,400,600');
    wp_enqueue_style('font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,700');
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css');
    wp_enqueue_style('main_css', get_stylesheet_uri(), NULL, microtime());
}

add_action('wp_enqueue_scripts', 'ne_files');

function ne_features() {
    // register nav hook
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // insert title tag in header
    add_theme_support('title-tag');

    // Add theme support for Featured Images
    add_theme_support('post-thumbnails', array(
        'post',
        'page',
        'custom-post-type-name',
    ));
}

add_action('after_setup_theme', 'ne_features');