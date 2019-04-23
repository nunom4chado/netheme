<?php

// Post Categories Widget
function ne_posts_categories() {
    $categories = get_categories();

    if ($categories) { ?>
        <ul class="ne-categories-list">
            <?php
                foreach($categories as $category) {
                    echo '<li><a class="ne-categories-list__link" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                }
            ?>
        </ul>
    <?php }
}

// Recent Posts Widget
function ne_recent_posts($args = NULL) {
    if (!$args['show']) {
        $args['show'] = 4;
    }

    global $post;
    $homePagePosts = new WP_Query(array(
        'posts_per_page' => $args['show'],
        'post__not_in' => array( $post->ID )
    ));

    while ($homePagePosts->have_posts()) {
        $homePagePosts->the_post(); ?>
        <div class="ne-recent-post-item">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
            <div class="ne-recent-post-item__details">
                <a class="ne-recent-post-item__title-link" href="<?php the_permalink(); ?>">
                    <h4 class="ne-recent-post-item__title"><?php the_title(); ?></h4>
                </a>
                <p class="ne-recent-post-item__date"><?php the_time('j \d\e F, Y'); ?></p>
            </div>
        </div>
    <?php } wp_reset_postdata();
}



function ne_files() {
    wp_enqueue_script('fancybox_js', get_theme_file_uri('js/jquery.fancybox.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('main_js', get_theme_file_uri('js/main.js'), array('jquery'), microtime(), true);
    
    // Styles
    wp_enqueue_style('font-montserrat', '//fonts.googleapis.com/css?family=Montserrat:300,400,600,700');
    wp_enqueue_style('font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,700');
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.8.1/css/all.css');
    wp_enqueue_style('fancybox_css', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css');
    wp_enqueue_style('main_css', get_stylesheet_uri(), NULL, microtime());
}

add_action('wp_enqueue_scripts', 'ne_files');

function ne_features() {
    // register nav hook
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    // insert title tag in header
    add_theme_support('title-tag');

    // Add theme support for Featured Images
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'ne_features');