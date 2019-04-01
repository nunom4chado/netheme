<?php get_header(); ?>


    <div class="page-layout">
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