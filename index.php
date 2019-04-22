<?php get_header(); ?>

    <div class="page-layout">
        <!-- NE Subheader -->
        <div class="ne-sub-header ne-sub-header__alimento">
            <div class="section-normal">
                <h1 class="ne-sub-header__title">Blog</h1>
                <p class="ne-sub-header__category">Subtitle goes here</p>
            </div>
        </div>
        <div class="section-normal breadcrumb-container">
            <div class="ne-breadcrumbs ne-breadcrumbs__alimento">
                <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo site_url(); ?>">Home</a>
                <span class="ne-breadcrumbs__current">Blog</span>
            </div>
        </div>

        <div class="section-normal">
            <div class="column-with-sidebar">
                <div class="column-with-sidebar__main">
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
                </div><!-- /.column-with-sidebar__main -->

                <aside class="column-with-sidebar__sidebar">
                    <img src="https://nutrienteessencial.pt/wp-content/uploads/2019/03/AD.jpg" alt="custom ad">
                    
                    <section class="ne-aside__container">
                        <h3 class="ne-aside__title">Artigos Recentes</h3>
                        <?php ne_recent_posts(); ?>
                    </section>
                    
                    <section class="ne-aside__container">
                        <h3 class="ne-aside__title">Categorias</h3>
                        <?php ne_posts_categories(); ?>
                    </section>
                </aside>

            </div><!-- /.column-with-sidebar -->
        </div><!-- /.section-normal -->
    </div><!-- /.page-layout -->

<?php get_footer(); ?>