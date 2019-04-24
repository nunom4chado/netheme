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
            <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo site_url(); ?>">Home</a>
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
                <img src="https://nutrienteessencial.pt/wp-content/uploads/2019/03/AD.jpg" alt="custom ad">
                <section class="ne-aside__container">
                    <h3 class="ne-aside__title">Artigos Recentes</h3>
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
                
                <?php
                    $categories = get_categories();

                    if ($categories) { ?>
                        <section class="ne-aside__container">
                            <h3 class="ne-aside__title">Categorias</h3>
                            <ul class="ne-categories-list">
                                <?php
                                    foreach($categories as $category) {
                                        echo '<li><a class="ne-categories-list__link" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </section>
                    <?php }
                ?>
            </aside>

          </div>
      </div>
    </div>

<?php get_footer(); ?>