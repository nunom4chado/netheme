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
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'thumbnail'),
                'date' => get_the_time('j \d\e F, Y')
            ));
        }

        if (get_post_type() == 'alimento') {
            array_push($results['alimentos'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'thumbnail')
            ));
        }

        if (get_post_type() == 'nutriente') {
            array_push($results['nutrientes'], array(
                'id' => get_the_id(),
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'thumbnail')
            ));
        }
    }

    if ($results['nutrientes']) {

        $nutrienteMetaQuery = array('relation' => 'OR');

        foreach($results['nutrientes'] as $item) {
            array_push($nutrienteMetaQuery, array(
                'key' => 'nutrientes_principais',
                'compare' => 'LIKE',
                'value' => '"' . $item['id'] . '"'
            ));
        }

        $nutrienteRelationshipQuery = new WP_Query(array(
            'post_type' => 'alimento',
            'meta_query' => $nutrienteMetaQuery
        ));

        while ($nutrienteRelationshipQuery->have_posts()) {
            $nutrienteRelationshipQuery->the_post();

            if (get_post_type() == 'alimento') {
                array_push($results['alimentos'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'thumbnail')
                ));
            }
        }

        $results['alimentos'] = array_values(array_unique($results['alimentos'], SORT_REGULAR));
    }

    return $results;
}