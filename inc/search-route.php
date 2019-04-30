<?php

add_action('rest_api_init', 'neRegisterSearch');

function neRegisterSearch()
{
    register_rest_route('ne/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'neSearchResults'
    ));
}

function neSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'alimento', 'nutriente'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'artigos' => array(),
        'alimentos' => array(),
        'nutrientes' => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if (get_post_type() == 'post') {
            array_push($results['artigos'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        if (get_post_type() == 'alimento') {
            array_push($results['alimentos'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        if (get_post_type() == 'nutriente') {
            array_push($results['nutrientes'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
    }

    return $results;
}