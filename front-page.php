<?php get_header(); ?>

    <div class="page-layout">

        <!-- HOME TOP SECTION -->
        <section class="ne-home-top">
            <div class="section-normal full-height">
                <div class="ne-home-top__inner">
                    <div class="ne-home-top__text">
                        <h1>Saiba como cuidar do seu corpo</h1>
                        <p>Duis sollicitudin nibh et libero rhoncus ultricies. Maecenas risus ipsum, imperdiet ac luctus sit amet, volutpat nec libero.</p>
                        <a class="ne-home-top__btn" href="#">Saiba mais</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ALL ABOUT NUTRITION -->
        <section class="section-thin text-center all-about-nutrition">
            <h2>Tudo sobre nutrição</h2>
            <div class="all-about-nutrition__inner">
                <div class="all-about-nutrition__card">
                    <img class="all-about-nutrition__img" src="<?php echo get_template_directory_uri(); ?>/img/all-about--article.svg" alt="">
                    <h3 class="all-about-nutrition__card-title">Artigos</h3>
                    <p class="all-about-nutrition__card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet, nunc et accumsan cursus, neque eros sodales</p>
                </div>
                <div class="all-about-nutrition__card">
                    <img class="all-about-nutrition__img" src="<?php echo get_template_directory_uri(); ?>/img/all-about--article.svg" alt="">
                    <h3 class="all-about-nutrition__card-title">Alimentos</h3>
                    <p class="all-about-nutrition__card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet, nunc et accumsan cursus, neque eros sodales</p>
                </div>
                <div class="all-about-nutrition__card">
                    <img class="all-about-nutrition__img" src="<?php echo get_template_directory_uri(); ?>/img/all-about--article.svg" alt="">
                    <h3 class="all-about-nutrition__card-title">Nutrientes</h3>
                    <p class="all-about-nutrition__card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet, nunc et accumsan cursus, neque eros sodales</p>
                </div>
            </div>
        </section>

        <!-- RECENT ARTICLES -->
        <section class="section-normal home-recent-posts">
            <h2>Artigos Recentes</h2>

            <div class="grid-3-sm">
                <?php 
                    $homePagePosts = new WP_Query(array(
                        'posts_per_page' => 3
                    ));

                    while ($homePagePosts->have_posts()) {
                    $homePagePosts->the_post(); ?>

                    <div class="card-post">
                        <a class="card-post__img-link" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <p class="card-post__details-categories"><?php echo get_the_category_list(', '); ?></p>
                        <div class="card-post__details">
                            
                            <h2 class="card-post__details-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <ul class="card-post__details-meta">
                                <li><?php the_time('j \d\e F, Y'); ?></li>
                                <li><i class="icon-clock"></i> <?php the_field('tempo_leitura'); ?>min para ler</li>
                            </ul>
                            <p class="card-post__details-excerpt"><?php echo wp_trim_words(get_the_content(), 17); ?></p>
                        </div>
                    </div>

                <?php } wp_reset_postdata(); ?>
            </div>
        </section>
    </div>

<?php get_footer(); ?>