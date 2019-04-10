<?php get_header(); ?>


    <div class="page-layout">
      <div class="section-normal">
        <div class="column-with-sidebar">
            <div class="column-with-sidebar__main">
                <h1 class="page-title">Blog</h1>
                <div class="grid-2-col">

                <?php while(have_posts()) {
                    the_post(); ?>

                    <div class="card-post">
                        <a class="card-post__img-link" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <div class="card-post__details">
                            <p class="card-post__details-categories"><?php echo get_the_category_list(', '); ?></p>
                            <h2 class="card-post__details-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <ul class="card-post__details-meta">
                                <li><?php the_time('j \d\e F, Y'); ?></li>
                                <li><i class="icon-clock"></i> <?php the_field('tempo_leitura'); ?>min para ler</li>
                            </ul>
                            <p class="card-post__details-excerpt"><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                        </div>
                    </div>

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