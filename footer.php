    <footer class="site-footer">
      <div class="site-footer__inner">

        <!-- Sobre nós -->
        <div class="site-footer__col1">
          <h3 class="site-footer__title">Sobre Nutriente Essencial</h3>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui atque aspernatur accusamus
            animi ad? In ea praesentium, illo repudiandae natus, id aliquam deserunt tempore, laborum
            tenetur perspiciatis beatae eveniet sint!</p>
        </div>

        <!-- Third col -->
        <div class="site-footer__col2">
          <h3 class="site-footer__title">Navegação</h3>
          <div>  
            <ul>
              <li>Home</li>
              <li>Blog</li>
              <li>Alimentos</li>
              <li>Nutrientes</li>
              <li>Contactos</li>
            </ul>
            <ul>
              <li>Cookies</li>
              <li>Privacidade</li>
            </ul>
          </div>
        </div>

        <!-- Artigos Recentes -->
        <div class="site-footer__col3">
          <h3 class="site-footer__title">Artigos Recentes</h3>
          <?php
            $homePagePosts = new WP_Query(array(
                'posts_per_page' => 3,
                'post__not_in' => array( $post->ID )
            ));

            while ($homePagePosts->have_posts()) {
                $homePagePosts->the_post(); ?>
                <div class="ne-recent-post-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('thumbnail'); ?>
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
        </div>
        
      </div>
      <div class="site-footer__copy">
        <div class="site-footer__copy-inner">
          <div>Nutriente Essencial &copy; <?php echo date("Y"); ?></div>
          <div>
            <a href="#" class="site-footer__social-link">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="site-footer__social-link">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" class="site-footer__social-link">
              <i class="fab fa-pinterest-p"></i>
            </a>
            <a href="#" class="site-footer__social-link">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
    </footer>

    <!-- Search -->
    <div class="search-overlay">
      <div class="search-overlay__top">
        <div class="search-overlay__inner">
          <i class="icon-magnifier search-overlay__icon" aria-hidden="true"></i>
          <input type="text" id="search-term" class="search-term" placeholder="O que procura?">
          <i class="icon-close search-overlay__close" aria-hidden="true"></i>
        </div>
      </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>