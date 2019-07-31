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
        


        <div class="section-normal">

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

        </div>
    </div>

<?php get_footer(); ?>