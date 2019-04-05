<?php get_header(); ?>


    <div class="page-layout">
      <div class="section-normal">
      <h1>Alimentos</h1>

        <?php while(have_posts()) {
            the_post(); ?>

            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
            <?php the_excerpt(); ?>
            <p><a href="<?php the_permalink(); ?>">Continue Reading</a></p>
            <hr />

        <?php } 
        
        echo paginate_links();
        
        ?>

        </div>
    </div>

<?php get_footer(); ?>