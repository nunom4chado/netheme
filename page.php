<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="section-normal">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>

    <?php }

    get_footer();
?>