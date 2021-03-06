<?php get_header(); ?>

    <div class="page-layout">
        <!-- NE Subheader -->
        <div class="ne-sub-header ne-sub-header__alimento">
            <div class="section-normal">
                <h1 class="ne-sub-header__title"><?php the_archive_title(); ?></h1>
                <p class="ne-sub-header__category">Blog</p>
            </div>
        </div>
        <div class="section-normal breadcrumb-container">
            <div class="ne-breadcrumbs ne-breadcrumbs__alimento">
                <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo esc_url(site_url()); ?>">Home</a>
                <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo esc_url(site_url('blog')); ?>">Blog</a>
                <span class="ne-breadcrumbs__current"><?php the_archive_title(); ?></span>
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

                        <?php } ?>
                    </div>

                    <div class="ne-pagination">
                        <?php echo paginate_links(); ?>
                    </div>
                </div><!-- /.column-with-sidebar__main -->

                <aside class="column-with-sidebar__sidebar">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/nead.png" alt="custom ad">
                    
                    <section class="ne-aside__container">
                        <div class="ne-aside__border-b">
                            <h3 class="ne-aside__title">Categorias</h3>
                        </div>
                        <?php ne_posts_categories(); ?>
                    </section>

                    <section class="ne-aside__container">
                        <div class="ne-aside__border-b">
                            <h3 class="ne-aside__title">Artigos Recentes</h3>
                        </div>
                        <?php ne_recent_posts(); ?>
                    </section>
                </aside>

            </div><!-- /.column-with-sidebar -->
        </div><!-- /.section-normal -->
    </div><!-- /.page-layout -->

<?php get_footer(); ?>