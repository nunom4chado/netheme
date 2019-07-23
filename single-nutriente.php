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
                            
                            <!-- General Description -->
                            <div class="grid-1-2">
                                <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail();
                                    } 
                                ?>
                                <div>
                                    <h2 class="ne-h3-title">Descrição Geral</h2>
                                    
                                    <div class="ne-post-content">
                                        <?php the_field('conteudo_principal'); ?>
                                    </div>
                                </div>

                            </div>



                            <!-- Beneficios e Conservação -->
                            <div class="grid-3-fit grid-3-fit--300min">
                                <?php
                                    if (get_field('nutriente_beneficios')) { ?>
                                        <div class="alimento-pros-cons">
                                            <h2>Benefícios</h2>
                                            <?php the_field('nutriente_beneficios'); ?>
                                        </div>
                                    <?php }

                                ?>

                                <?php
                                    if (get_field('nutriente_hipovitaminose')) { ?>
                                        <div class="alimento-pros-cons">
                                            <h2>Hipovitaminose</h2>
                                            <?php the_field('nutriente_hipovitaminose'); ?>
                                        </div>
                                    <?php }

                                ?>

                                <?php
                                    if (get_field('nutriente_hipervitaminose')) { ?>
                                        <div class="alimento-pros-cons">
                                            <h2>Hipervitaminose</h2>
                                            <?php the_field('nutriente_hipervitaminose'); ?>
                                        </div>
                                    <?php }

                                ?>
                            </div>

                            <!-- Alimentos ricos em este Nutriente -->
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
                                    echo '<div class="grid-3-fit grid-3-fit--200max">';
                                    while ($foodsWithNutrient->have_posts()) {
                                        $foodsWithNutrient->the_post(); ?>
                                        
                                            <a href="<?php the_permalink(); ?>" class="card-post-nutriente">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                                <div class="card-post-nutriente__details">
                                                    <h2 class="card-post-nutriente__details-title"><?php the_title(); ?></h2>
                                                    <!-- Show custom taxonomy -->
                                                    <?php 
                                                        $terms = get_the_terms( $post->ID, 'categoria_alimento' );
                                                        if ($terms) {
                                                            foreach($terms as $term) {
                                                                $termlinks = get_term_link($term);
                                                                echo '<p class="card-post-nutriente__details-categories">' . $term->name . '</p>';
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </a>
                                        
                                    <?php } wp_reset_postdata();
                                    echo '</div>';
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
                                    
                                        <div class="ne-more-nutrients">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail(); ?>
                                            </a>
                                            <div class="ne-more-nutrients__details">
                                                <a class="ne-more-nutrients__title-link" href="<?php the_permalink(); ?>">
                                                    <h4 class="ne-more-nutrients__title"><?php the_title(); ?></h4>
                                                </a>
                                                <p class="ne-more-nutrients__date">
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