<?php

function ne_files() {
    wp_enqueue_script('main_js', get_theme_file_uri('js/main.js'), NULL, microtime(), true);
    wp_enqueue_style('font-montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500');
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css');
    wp_enqueue_style('main_css', get_stylesheet_uri(), NULL, microtime());
}

add_action('wp_enqueue_scripts', 'ne_files');

function ne_features() {
    // insert title tag in header
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'ne_features');