<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="ne-sub-header ne-sub-header__nutriente">
                <div class="section-normal">
                    <h1 class="ne-sub-header__title"><?php the_title(); ?></h1>
                    <p class="ne-sub-header__category">
                        <?php
                        
                        // get custom taxonomy link and name from 'categoria_alimento'
                        $terms = wp_get_post_terms( $post->ID, 'categoria_nutriente');
                        foreach ($terms as $term) {
                            echo '<a class="ne-link--white" href="'.get_term_link($term->slug, 'categoria_nutriente').'">'.$term->name.'</a>';
                        }
                        
                        ?>
                    </p>
                </div>
            </div>
            <div class="section-normal breadcrumb-container">
                <div class="ne-breadcrumbs ne-breadcrumbs__nutriente">
                    <a class="ne-breadcrumbs__link ne-breadcrumbs__link-nutriente" href="<?php echo esc_url(site_url()); ?>">Home</a>
                    <a class="ne-breadcrumbs__link ne-breadcrumbs__link-nutriente" href="<?php echo esc_url(site_url('nutrientes')); ?>">Nutrientes</a>
                    <span class="ne-breadcrumbs__current"><?php the_title(); ?></span>
                </div>
            </div>
            <div class="section-normal">
                <div class="column-with-sidebar">
                    <div class="column-with-sidebar__main">
                        <!-- Post section -->
                        <article class="ne-blog-post__container">
                            <p class="ne-blog-post__category"><?php echo get_the_category_list(', '); ?></p>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                } 
                            ?>
                            <div class="ne-blog-post__content"><?php the_field('conteudo_principal'); ?></div>
                            <?php
                                
                                $foodsWithNutrient = new WP_Query(array(
                                    'posts_per_page' => -1,
                                    'post_type' => 'alimento',
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'meta_query' => array(
                                        array(
                                            'key' => 'nutrientes_principais',
                                            'compare' => 'LIKE',
                                            'value' => '"' . get_the_ID() . '"'
                                        )
                                     )
                                ));

                                if ($foodsWithNutrient->have_posts()) {
                                    echo '<h2>Alimentos ricos em ' . get_the_title() . '</h2>';

                                    while ($foodsWithNutrient->have_posts()) {
                                        $foodsWithNutrient->the_post(); ?>
                                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php } wp_reset_postdata();
                                }

                            ?>
                        </article>
                    </div> <!-- /.column-with-sidebar__main -->
                    <aside class="column-with-sidebar__sidebar">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/nead.png" alt="custom ad">
                        <section class="ne-aside__container">
                            <?php
                                // get the custom post type's taxonomy terms
                                $custom_taxterms = wp_get_object_terms( $post->ID, 'categoria_nutriente', array('fields' => 'ids') );
                        
                                $args = array(
                                    'post_type' => 'nutriente',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 5,
                                    'post__not_in' => array ( $post->ID ),
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'categoria_nutriente',
                                            'field' => 'id',
                                            'terms' => $custom_taxterms
                                        )
                                    )
                                );
                                $related_items = new WP_Query( $args );
                                // loop over query
                                if ( $related_items->have_posts() ) : ?>
                                    <div class="ne-aside__border-b">
                                        <h3 class="ne-aside__title">Mais <?php
                        
                                        // get custom taxonomy link and name from 'categoria_alimento'
                                        $terms = wp_get_post_terms( $post->ID, 'categoria_nutriente');
                                        foreach ($terms as $term) {
                                            echo $term->name;
                                        }
                                        
                                        ?></h3>
                                    </div>
                        
                                    <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
                                    
                                        <div class="ne-recent-post-item">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail(); ?>
                                            </a>
                                            <div class="ne-recent-post-item__details">
                                                <a class="ne-recent-post-item__title-link" href="<?php the_permalink(); ?>">
                                                    <h4 class="ne-recent-post-item__title"><?php the_title(); ?></h4>
                                                </a>
                                                <p class="ne-recent-post-item__date">
                                                    <?php the_terms( $post->ID, 'categoria_nutriente' ); ?>
                                                </p>
                                            </div>
                                        </div>
                        
                                    <?php endwhile; ?>
                                <?php endif;
                                // Reset Post Data
                                wp_reset_postdata();
                            ?>
                        </section>
                    </aside>
                </div>
            </div>
        </div>

    <?php }

    get_footer();
?>