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
                            <div class="ne-blog-post__content"><?php the_field('conteudo_principal'); ?></div>
                        </article>

                    </div> <!-- /.column-with-sidebar__main -->
                    <aside class="column-with-sidebar__sidebar">

                        <?php
                            $mainNutrients = get_field('nutrientes_principais');

                            if ($mainNutrients) {
                                echo '<section class="ne-aside__container">';
                                echo '<h3 class="ne-aside__title">Nutrientes Principais</h3>';
                                echo '<ul class="ne-main-nutrients">';
                                foreach($mainNutrients as $nutrient) { ?>
                                    <li class="ne-main-nutrients__item">
                                        <a class="ne-main-nutrients__item-link" href="<?php echo get_the_permalink($nutrient) ?>">
                                            <?php 
                                                echo get_the_post_thumbnail( $nutrient, array(35,35));
                                                echo "<span class='ne-main-nutrients__item-title'>";
                                                    echo get_the_title($nutrient);
                                                echo "</span>";
                                            ?>
                                        </a>
                                    </li>
                                <?php }
                                echo '</ul>';
                                echo '</section>';
                            }
                        ?>

                        <section class="ne-aside__container">
                            <h3 class="ne-aside__title">Distribuição Nutricional</h3>
                            <div class="ne-nutrition-distribution">
                                <div id="ne-food-chart" class="ne-nutrition-distribution__chart"></div>
                            </div>
                        </section>
                        
                        <!-- Sazonalidade -->
                        <section class="ne-aside__container">
                            <h3 class="ne-aside__title">Sazonalidade</h3>
                            <!-- get field array and convert to string with spaces
                                 if a class its added here the item will be active -->
                            <div class="ne-season <?php echo implode(" ", get_field('sazonalidade')); ?>">
                                <div class="ne-season__item ne-season__item--jan">
                                    <div class="ne-season__content">
                                        <span>Jan</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--fev">
                                    <div class="ne-season__content">
                                        <span>Fev</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--mar">
                                    <div class="ne-season__content">
                                        <span>Mar</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--abr">
                                    <div class="ne-season__content">
                                        <span>Abr</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--mai">
                                    <div class="ne-season__content">
                                        <span>Mai</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--jun">
                                    <div class="ne-season__content">
                                        <span>Jun</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--jul">
                                    <div class="ne-season__content">
                                        <span>Jul</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--ago">
                                    <div class="ne-season__content">
                                        <span>Ago</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--set">
                                    <div class="ne-season__content">
                                        <span>Set</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--out">
                                    <div class="ne-season__content">
                                        <span>Out</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--nov">
                                    <div class="ne-season__content">
                                        <span>Nov</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--dez">
                                    <div class="ne-season__content">
                                        <span>Dez</span>
                                    </div>
                                </div>
                            </div>
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