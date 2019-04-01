<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="section-normal">
                <div class="column-with-sidebar">
                    <div class="column-with-sidebar__main ne-blog-post">
                        <article class="ne-blog-post__content">
                            <h2><?php the_title(); ?></h2>
                            <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                            <div class=""><?php the_content(); ?></div>
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
                    </aside>
                </div>
            </div>
        </div>

    <?php }

    get_footer();
?>