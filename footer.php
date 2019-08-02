    <footer class="site-footer">
      <div class="site-footer__inner">

        <!-- Sobre nós -->
        <div class="site-footer__col1">
          <img src="<?php echo get_template_directory_uri(); ?>/img/ne-logo-test.svg" alt="nutriente essencial logo">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui atque aspernatur accusamus
            animi ad? In ea praesentium, illo repudiandae natus, id aliquam deserunt tempore, laborum
            tenetur perspiciatis beatae eveniet sint!</p>
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

        <!-- Third col -->
        <div class="site-footer__col2">
          <h3 class="site-footer__title">Nutriente Essencial</h3>
          <ul>
            <li><a href="#" class="footer-link">Sobre Mim</a></li>
            <li><a href="#" class="footer-link">Políticas de Cookies</a></li>
            <li><a href="#" class="footer-link">GDPR</a></li>
          </ul>
          <h3 class="site-footer__title">Blog</h3>
          <?php
            $categories = get_categories();

            if ($categories) { ?>
                <ul>
                  <?php
                    foreach($categories as $category) {
                        echo '<li><a class="footer-link" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                    }
                  ?>
                </ul>
            <?php }
          ?>
        </div>

        <!-- Alimentos -->
        <div class="site-footer__col3">
          <h3 class="site-footer__title">Alimentos</h3>
          <?php
              $terms = get_terms( 'categoria_alimento' );
              
              echo '<ul>';
                echo '<li><a class="footer-link" href="' . esc_url(site_url('alimentos')) . '">Todos</a></li>';
              
            foreach ( $terms as $term ) {
                // The $term is an object, so we don't need to specify the $taxonomy.
                $term_link = get_term_link( $term );
                // If there was an error, continue to the next term.
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }
                // We successfully got a link. Print it out.
                echo '<li><a class="footer-link" href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
            }
              
            echo '</ul>';
          ?>
        </div>

        <!-- Nutrientes -->
        <div class="site-footer__col3">
          <h3 class="site-footer__title">Nutrientes</h3>
          <?php
              $terms = get_terms( 'categoria_nutriente' );
              
              echo '<ul>';
                echo '<li><a class="footer-link" href="' . esc_url(site_url('nutrientes')) . '">Todos</a></li>';
              
            foreach ( $terms as $term ) {
                // The $term is an object, so we don't need to specify the $taxonomy.
                $term_link = get_term_link( $term );
                // If there was an error, continue to the next term.
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }
                // We successfully got a link. Print it out.
                echo '<li><a class="footer-link" href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
            }
              
            echo '</ul>';
          ?>
        </div>
        
      </div>
      <div class="site-footer__copy">
        <p>Nutriente Essencial &copy; <?php echo date("Y"); ?></p>
      </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>