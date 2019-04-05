<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="section-normal">
                <div class="column-with-sidebar">
                    <div class="column-with-sidebar__main ne-blog-post">
                        <article class="ne-blog-post__container">
                            <p class="ne-blog-post__category"><?php echo get_the_category_list(', '); ?></p>
                            <h1 class="ne-blog-post__title"><?php the_title(); ?></h1>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                } 
                            ?>
                            <p>sazonalidade</p>
                            <?php the_field('sazonalidade'); ?>
                            <div class="ne-blog-post__content"><?php the_content(); ?></div>
                        </article>
                        <div class="ne-blog-post__share">
                            <div class="ne-blog-post__share-container">
                                <a href="#" class="ne-blog-post__share-icons">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="ne-blog-post__share-icons">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="ne-blog-post__share-icons">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="ne-blog-post__share-icons">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="ne-blog-post__share-icons">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <aside class="column-with-sidebar__sidebar">
                        <img src="https://nutrienteessencial.pt/wp-content/uploads/2019/03/AD.jpg" alt="custom ad">
                        <section class="ne-recent-posts">
                            <h3 class="ne-recent-posts__title">Artigos Recentes</h3>
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
                    </aside>
                </div>
            </div>
        </div>

    <?php }

    get_footer();
?>