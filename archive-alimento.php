<?php get_header(); ?>


    <div class="page-layout">
      <div class="ne-sub-header ne-sub-header__alimento">
        <div class="section-normal">
            <h1 class="ne-sub-header__title">Alimentos</h1>
            <p class="ne-sub-header__category">Consulte a nossa lista de alimentos</p>
        </div>
      </div>
      <div class="section-normal breadcrumb-container">
        <div class="ne-breadcrumbs ne-breadcrumbs__alimento">
            <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo esc_url(site_url()); ?>">Home</a>
            <span class="ne-breadcrumbs__current">Alimentos</span>
        </div>
      </div>
      <div class="section-normal">
        <div class="column-with-sidebar">
            <div class="column-with-sidebar__main">
                <div class="grid-3-fit">
                    <?php while(have_posts()) {
                        the_post(); ?>

                        <a class="card-post-nutriente" href="<?php the_permalink(); ?>">
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

                    <?php } ?>
                </div>

                <div class="ne-pagination">
                    <?php echo paginate_links(); ?>
                </div>
            </div>

            <aside class="column-with-sidebar__sidebar">

                <?php
                    $terms = get_terms( 'categoria_alimento' );
                    
                    echo '<section class="ne-aside__container">';
                        echo '<div class="ne-aside__border-b">';
                            echo '<h3 class="ne-aside__title">Categorias</h3>';
                        echo '</div>';
                        echo '<ul class="ne-categories-list">';
                    
                    foreach ( $terms as $term ) {
                        // The $term is an object, so we don't need to specify the $taxonomy.
                        $term_link = get_term_link( $term );
                        // If there was an error, continue to the next term.
                        if ( is_wp_error( $term_link ) ) {
                            continue;
                        }
                        // We successfully got a link. Print it out.
                        echo '<li><a class="ne-categories-list__link" href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
                    }
                    
                        echo '</ul>';
                    echo '</section>';
                ?>

                <section class="ne-aside__container">
                    <div class="ne-aside__border-b">
                        <h3 class="ne-aside__title">Artigos Recentes</h3>
                    </div>
                    <?php
                        $homePagePosts = new WP_Query(array(
                            'posts_per_page' => 4,
                            'post__not_in' => array( $post->ID )
                        ));

                        while ($homePagePosts->have_posts()) {
                            $homePagePosts->the_post(); ?>
                            <div class="ne-recent-post-item">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(); ?>
                                </a>
                                <div class="ne-recent-post-item__details">
                                    <a class="ne-recent-post-item__title-link" href="<?php the_permalink(); ?>">
                                        <h4 class="ne-recent-post-item__title"><?php the_title(); ?></h4>
                                    </a>
                                    <p class="ne-recent-post-item__date"><?php the_time('j \d\e F, Y'); ?></p>
                                </div>
                            </div>
                        <?php } wp_reset_postdata();
                    ?>
                </section>

                <img src="<?php echo get_template_directory_uri(); ?>/img/nead.png" alt="custom ad">
            </aside>

          </div>
      </div>
    </div>

<?php get_footer(); ?>