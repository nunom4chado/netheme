<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="section-normal">
                <div class="column-with-sidebar">
                    <div class="column-with-sidebar__main">
                        <div class="ne-blog-post">
                            <!-- Post section -->
                            <article class="ne-blog-post__container">
                                <p class="ne-blog-post__category"><?php echo get_the_category_list(', '); ?></p>
                                <h1 class="ne-blog-post__title"><?php the_title(); ?></h1>
                                <ul class="ne-blog-post__meta">
                                    <li><?php the_time('j \d\e F, Y'); ?></li>
                                    <li><i class="icon-clock"></i> <?php the_field('tempo_leitura'); ?>min para ler</li>
                                    <li><i class="icon-bubble"></i> <?php comments_number( '0 comentários', '1 comentário', '% comentários' ); ?></li>
                                </ul>
                                <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail();
                                    } 
                                ?>
                                <div class="ne-blog-post__content"><?php the_content(); ?></div>
                            </article>

                            <!-- Social Share icons -->
                            <div class="ne-blog-post__share">
                                <?php
                                    // Get current page URL 
                                    $nePostURL = urlencode(get_permalink());
                            
                                    // Get current page title
                                    $nePostTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
                                    
                                    // Get Post Thumbnail for pinterest
                                    $nePostThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                            
                                    // Construct sharing URL without using any script
                                    $twitterURL = 'https://twitter.com/intent/tweet?text=' . $nePostTitle . '&amp;url=' . $nePostURL . '&amp;via=NutrienteEssencial';
                                    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$nePostURL;
                                    $googleURL = 'https://plus.google.com/share?url='.$nePostURL;
                                    $bufferURL = 'https://bufferapp.com/add?url='.$nePostURL.'&amp;text='.$nePostTitle;
                                    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$nePostURL.'&amp;title='.$nePostTitle;
                                    $whatsappURL = 'whatsapp://send?text='.$nePostTitle . ' ' . $nePostURL;
                                    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$nePostURL.'&amp;media='.$nePostThumbnail[0].'&amp;description='.$nePostTitle;
                                    
                                ?>

                                <div class="ne-blog-post__share-container">
                                    <a href="<?php $twitterURL ?>" class="ne-blog-post__share-icons" target="_blank" rel="nofollow">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="<?php $facebookURL ?>" class="ne-blog-post__share-icons" target="_blank" rel="nofollow">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="<?php $googleURL ?>" class="ne-blog-post__share-icons" target="_blank" rel="nofollow">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                    <a href="<?php $bufferURL ?>" class="ne-blog-post__share-icons" target="_blank" rel="nofollow">
                                        <i class="fab fa-buffer"></i>
                                    </a>
                                    <a href="<?php $linkedInURL ?>" class="ne-blog-post__share-icons" target="_blank" rel="nofollow">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="<?php $whatsappURL ?>" class="ne-blog-post__share-icons" target="_blank" rel="nofollow">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="<?php $pinterestURL ?>" class="ne-blog-post__share-icons" data-pin-custom="true" target="_blank" rel="nofollow">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </div>
                            </div><!-- /.ne-blog-post__share -->
                        </div><!-- /.ne-blog-post -->

                        <!-- Show Related Posts -->
                        <?php 
                            $orig_post = $post;
                            global $post;

                            $categories = get_the_category($post->ID);

                            if ($categories) {

                                $category_ids = array();
                                foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

                                $args=array(
                                    'category__in' => $category_ids,
                                    'post__not_in' => array($post->ID),
                                    'posts_per_page'=> 3, // Number of related posts that will be shown.
                                    'caller_get_posts'=>1
                                );

                                $neRelatedPosts = new wp_query( $args );
                                if( $neRelatedPosts->have_posts() ) { ?>
                                    
                                    <div class="ne-related-posts">
                                        <h2 class="ne-related-posts__title">Artigos Relacionados</h2>
                                        <ul class="ne-related-posts__list">
                                                
                                        <?php while( $neRelatedPosts->have_posts() ) {
                                            $neRelatedPosts->the_post();?>

                                            <li class="ne-related-posts__item">
                                                <a class="ne-related-posts__item-link-img" href="<? the_permalink()?>">
                                                    <?php the_post_thumbnail(); ?>
                                                </a>
                                                <h4 class="ne-related-posts__item-title"><a href="<? the_permalink()?>"><?php the_title(); ?></a></h4>
                                                <p class="ne-related-posts__item-date"><?php the_time('j \d\e F, Y'); ?></p>
                                            </li>
                                        <?php } ?>

                                        </ul>
                                    </div>
                                <?php }
                            }
                            $post = $orig_post;
                            wp_reset_query();
                        ?>



                        <?php 
                            // Show comments if enabled or exist any comment already
                            if (comments_open() || get_comments_number()) {
                                echo "<section class='ne-comment-section'>";
                                comments_template();
                                echo "</section>";
                            }
                        ?>

                    </div> <!-- /.column-with-sidebar__main -->
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
                </div>
            </div>
        </div>

    <?php }

    get_footer();
?>