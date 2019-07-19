<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

        <div class="page-layout">
            <div class="ne-sub-header ne-sub-header__alimento">
                <div class="section-normal">
                    <h1 class="ne-sub-header__title"><?php the_title(); ?></h1>
                    <p class="ne-sub-header__category">
                        <?php
                        $terms = get_terms( 'categoria_alimento' );
                                
                        foreach ( $terms as $term ) {
                        
                            // The $term is an object, so we don't need to specify the $taxonomy.
                            $term_link = get_term_link( $term );
                            
                            // If there was an error, continue to the next term.
                            if ( is_wp_error( $term_link ) ) {
                                continue;
                            }
                        
                            // We successfully got a link. Print it out.
                            echo '<a class="ne-link--white" href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
                        } ?>
                    </p>
                </div>
            </div>
            <div class="section-normal breadcrumb-container">
                <div class="ne-breadcrumbs ne-breadcrumbs__alimento">
                    <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo esc_url(site_url()); ?>">Home</a>
                    <a class="ne-breadcrumbs__link ne-breadcrumbs__link-alimento" href="<?php echo esc_url(site_url('alimentos')); ?>">Alimentos</a>
                    <span class="ne-breadcrumbs__current"><?php the_title(); ?></span>
                </div>
            </div>
            <div class="section-normal">
                <div class="column-with-sidebar">
                    <div class="column-with-sidebar__main">
                        <!-- Post section -->
                        <article class="ne-blog-post__container">
                            <?php
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail();
                                } 
                            ?>
                            <div class="ne-blog-post__content"><?php the_field('conteudo_principal'); ?></div>

                            <!-- 
                                // --------------------------------------
                                // FOOD NUTTRITION TABLE
                                // --------------------------------------
                            -->
                            <div class="ne-nutrition-table">
                                <div class="ne-nutrition-table__main-header">
                                    <div class="ne-nutrition-table__main-header-title">
                                        <h2>Tabela Nutricional</h2>
                                        <p>Valores por <span id="grams-based-val">100</span>g</p>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label for="change-grams">Recalcular valores <span>(g):</span></label>
                                        <input id="change-grams" type="number" min="1">
                                    </div>
                                </div>

                                <!-- 
                                    // Calorias ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="calories-table" type="checkbox" class="ne-hide-input" name="ne-nt-input" checked>
                                    <label for="calories-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div class="ne_nutrition-table-tab__header ne-nutrition-table__element" data-name="calorias" data-value="<?php the_field('calorias'); ?>">
                                        <p class="ne_nutrition-table-tab__header-name">Energia</p>
                                        <div class="ne_nutrition-table-tab__header-quantities">
                                            <span class="ne-nutrition-table__element-quantity"><?php the_field('calorias'); ?></span>
                                            <span>kcal</span>
                                        </div>
                                        <p class="ne_nutrition-table-tab__header-ddr"><span class="ne-nutrition-table__element-ddr"></span> (DDR)</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">

                                            <table class="ne-inner-table">

                                                <?php ne_nutrition_table_inner('calorias_grupo'); ?>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                    // Hidratos de Carbono ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="hc-table" type="checkbox" class="ne-hide-input" name="ne-nt-input">
                                    <label for="hc-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div id="ne-nt-hc" class="ne_nutrition-table-tab__header ne-nutrition-table__element" data-name="hidratos_carbono" data-value="<?php the_field('hidratos_carbono'); ?>">
                                        <p class="ne_nutrition-table-tab__header-name">Hidratos de Carbono</p>
                                        <div class="ne_nutrition-table-tab__header-quantities">
                                            <span class="ne-nutrition-table__element-quantity"><?php the_field('hidratos_carbono'); ?></span>
                                            <span>g</span>
                                        </div>
                                        <p class="ne_nutrition-table-tab__header-ddr"><span class="ne-nutrition-table__element-ddr"></span> (DDR)</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">

                                            <table class="ne-inner-table">
                                                
                                                <?php ne_nutrition_table_inner('hidratos_carbono_grupo'); ?>
                                                
                                            </table>
                                    
                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                    // Lípidos ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="lipidos-table" type="checkbox" class="ne-hide-input" name="ne-nt-input">
                                    <label for="lipidos-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div id="ne-nt-lip" class="ne_nutrition-table-tab__header ne-nutrition-table__element" data-name="lipidos" data-value="<?php the_field('lipidos'); ?>">
                                        <p class="ne_nutrition-table-tab__header-name">Lípidos</p>
                                        <div class="ne_nutrition-table-tab__header-quantities">
                                            <span class="ne-nutrition-table__element-quantity"><?php the_field('lipidos'); ?></span>
                                            <span>g</span>
                                        </div>
                                        <p class="ne_nutrition-table-tab__header-ddr"><span class="ne-nutrition-table__element-ddr"></span> (DDR)</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">


                                            <table class="ne-inner-table">
                                                
                                                <?php ne_nutrition_table_inner('lipidos_grupo');
                                                

                                                    // Colesterol
                                                    if (get_field('colesterol')) { ?>
                                                        <tr class="ne-nutrition-table__element" data-name="colesterol" data-value="<?php the_field('colesterol'); ?>">
                                                            <td>Colesterol</td>
                                                            <td><span class="ne-nutrition-table__element-quantity"><?php the_field('colesterol'); ?></span> mg</td>
                                                            <td class="ne-nutrition-table__element-ddr"></td>
                                                        </tr>
                                                    <?php }
                                            
                                                ?>

                                            </table>
                                    
                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                    // Proteínas ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="proteina-table" type="checkbox" class="ne-hide-input" name="ne-nt-input">
                                    <label for="proteina-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div id="ne-nt-prot" class="ne_nutrition-table-tab__header ne-nutrition-table__element" data-name="proteina" data-value="<?php the_field('proteina'); ?>">
                                        <p class="ne_nutrition-table-tab__header-name">Proteína</p>
                                        <div class="ne_nutrition-table-tab__header-quantities">
                                            <span class="ne-nutrition-table__element-quantity"><?php the_field('proteina'); ?></span>
                                            <span>g</span>
                                        </div>
                                        <p class="ne_nutrition-table-tab__header-ddr"><span class="ne-nutrition-table__element-ddr"></span> (DDR)</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">


                                            <table class="ne-inner-table">
                                                
                                                <?php ne_nutrition_table_inner('proteina_grupo'); ?>

                                            </table>
                                    
                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                    // Vitaminas ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="vitaminas-table" type="checkbox" class="ne-hide-input" name="ne-nt-input">
                                    <label for="vitaminas-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div class="ne_nutrition-table-tab__header">
                                        <p class="ne_nutrition-table-tab__header-name">Vitaminas</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">


                                            <table class="ne-inner-table">
                                            
                                                <?php ne_nutrition_table_inner('vitaminas_grupo'); ?>

                                            </table>
                                    
                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                    // Minerais ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="minerais-table" type="checkbox" class="ne-hide-input" name="ne-nt-input">
                                    <label for="minerais-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div class="ne_nutrition-table-tab__header">
                                        <p class="ne_nutrition-table-tab__header-name">Minerais</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">


                                            <table class="ne-inner-table">
                                            
                                                <?php ne_nutrition_table_inner('minerais_grupo'); ?>
                                                
                                            </table>
                                    
                                        </div>
                                    </div>
                                </div>

                                <!-- 
                                    // Outros ------------
                                -->
                                <div class="ne-nutrition-table-tab">
                                    <!-- Hiden Inputs -->
                                    <input id="outros-table" type="checkbox" class="ne-hide-input" name="ne-nt-input">
                                    <label for="outros-table" class="ne-nt-input-label"></label>
                                    
                                    <!-- Tab Header -->
                                    <div class="ne_nutrition-table-tab__header">
                                        <p class="ne_nutrition-table-tab__header-name">Outros</p>
                                    </div>
                                    
                                    <!-- Tab Content -->
                                    <div class="ne_nutrition-table-tab__content">
                                        <div class="ne_nutrition-table-tab__content-container">


                                            <table class="ne-inner-table">
                                            
                                                <?php ne_nutrition_table_inner('outros_grupo'); ?>

                                            </table>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.ne-nutrition-table -->


                        </article>

                    </div> <!-- /.column-with-sidebar__main -->
                    <aside class="column-with-sidebar__sidebar">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/nead.png" alt="custom ad">

                        <?php
                            $mainNutrients = get_field('nutrientes_principais');

                            if ($mainNutrients) { ?>
                                <section class="ne-aside__container">
                                <div class="ne-aside__border-b">
                                    <h3 class="ne-aside__title">Nutrientes Principais</h3>
                                </div>
                                <ul class="ne-main-nutrients">
                                <?php foreach($mainNutrients as $nutrient) { ?>
                                    <li class="ne-main-nutrients__item">
                                        <a class="ne-main-nutrients__item-link" href="<?php echo get_the_permalink($nutrient) ?>">
                                            <?php echo get_the_post_thumbnail( $nutrient, array(35,35)); ?>
                                            <span class='ne-main-nutrients__item-details'>
                                                <span class='ne-main-nutrients__item-title'>
                                                    <?php echo get_the_title($nutrient); ?>
                                                </span>
                                                <span class='ne-main-nutrients__item-category'>
                                                    <?php $terms = get_the_terms( $nutrient->ID , 'categoria_nutriente' );
                                                    foreach ( $terms as $term ) {
                                                        echo $term->name;
                                                    } ?>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                <?php }
                                echo '</ul>';
                                echo '</section>';
                            }
                        ?>

                        <section class="ne-aside__container">
                            <div class="ne-aside__border-b">
                                <h3 class="ne-aside__title">Distribuição Nutricional</h3>
                            </div>
                            <div class="ne-nutrition-distribution">
                                <div id="ne-food-chart" class="ne-nutrition-distribution__chart"></div>
                            </div>
                        </section>
                        
                        <!-- Sazonalidade -->
                        <section class="ne-aside__container">
                            <div class="ne-aside__border-b">
                                <h3 class="ne-aside__title">Sazonalidade</h3>
                            </div>
                            <!-- get field array and convert to string with spaces
                                 if a class its added here the item will be active -->
                            <div class="ne-season <?php echo implode(" ", get_field('sazonalidade')); ?>">
                                <div class="ne-season__item ne-season__item--jan">
                                    <div class="ne-season__content">
                                        <span>Jan</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--fev">
                                    <div class="ne-season__content">
                                        <span>Fev</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--mar">
                                    <div class="ne-season__content">
                                        <span>Mar</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--abr">
                                    <div class="ne-season__content">
                                        <span>Abr</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--mai">
                                    <div class="ne-season__content">
                                        <span>Mai</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--jun">
                                    <div class="ne-season__content">
                                        <span>Jun</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--jul">
                                    <div class="ne-season__content">
                                        <span>Jul</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--ago">
                                    <div class="ne-season__content">
                                        <span>Ago</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--set">
                                    <div class="ne-season__content">
                                        <span>Set</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--out">
                                    <div class="ne-season__content">
                                        <span>Out</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--nov">
                                    <div class="ne-season__content">
                                        <span>Nov</span>
                                    </div>
                                </div>
                                <div class="ne-season__item ne-season__item--dez">
                                    <div class="ne-season__content">
                                        <span>Dez</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="ne-aside__container">
                            <div class="ne-aside__border-b">
                                <h3 class="ne-aside__title">Receitas com este Alimento</h3>
                            </div>
                            <?php
                                $homePagePosts = new WP_Query(array(
                                    'posts_per_page' => 4,
                                    'post__not_in' => array( $post->ID )
                                ));

                                while ($homePagePosts->have_posts()) {
                                    $homePagePosts->the_post(); ?>
                                    <div class="ne-recent-post-item">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail(); ?>
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
                        </section>
                    </aside>
                </div>
            </div>
        </div>

    <?php }

    get_footer();
?>