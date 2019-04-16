<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="ne-sub-header ne-sub-header__alimento">
                <div class="section-normal">
                    <h1 class="ne-sub-header__title"><?php the_title(); ?></h1>
                    <p class="ne-sub-header__category">Define category here</p>
                </div>
            </div>
            <div class="section-normal breadcrumb-container">
                <div class="ne-breadcrumbs ne-breadcrumbs__alimento">
                    <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo site_url(); ?>">Home</a>
                    <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo site_url('alimentos'); ?>">Alimentos</a>
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
                            <p>sazonalidade</p>
                            <?php the_field('sazonalidade'); ?>
                            <div class="ne-blog-post__content"><?php the_content(); ?></div>
                            <?php
                                $mainNutrients = get_field('nutrientes_principais');

                                if ($mainNutrients) {
                                    echo '<h2>Nutrientes Principais</h2>';
                                    echo '<ul>';
                                    foreach($mainNutrients as $nutrient) { ?>
                                        <li><a href="<?php echo get_the_permalink($nutrient) ?>"><?php echo get_the_title($nutrient); ?></a></li>
                                    <?php }
                                    echo '</ul>';
                                }
                            ?>
                        </article>

                    </div> <!-- /.column-with-sidebar__main -->
                    <aside class="column-with-sidebar__sidebar">

                        <?php
                            $mainNutrients = get_field('nutrientes_principais');

                            if ($mainNutrients) {
                                echo '<section class="ne-aside__container">';
                                echo '<h3 class="ne-aside__title">Nutrientes Principais</h3>';
                                echo '<ul>';
                                foreach($mainNutrients as $nutrient) { ?>
                                    <li><a href="<?php echo get_the_permalink($nutrient) ?>"><?php echo get_the_title($nutrient); ?></a></li>
                                <?php }
                                echo '</ul>';
                                echo '</section>';
                            }
                        ?>

                        <section class="ne-aside__container">
                            <h3 class="ne-aside__title">Distribuição Nutricional</h3>
                        </section>

                        <section class="ne-aside__container">
                            <h3 class="ne-aside__title">Sazonalidade</h3>
                        </section>

                        <section class="ne-aside__container">
                            <h3 class="ne-aside__title">Receitas com este Alimento</h3>
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