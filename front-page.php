<?php get_header(); ?>

    <div class="page-layout">

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

        <section class="section-normal text-center all-about-nutrition">
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
        


        <section class="section-normal">

            <?php
                $homePagePosts = new WP_Query(array(
                    'posts_per_page' => 2
                ));

                while ($homePagePosts->have_posts()) {
                    $homePagePosts->the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                    <!-- limit content to 5 words -->
                    <p><?php echo wp_trim_words(get_the_content(), 5); ?></p>
                <?php } wp_reset_postdata();
            ?>

        </section>
    </div>

<?php get_footer(); ?>