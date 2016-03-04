<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <footer>
            <?php var_dump(get_the_terms(get_the_ID(), 'portfolio_tag')) ?>
            <?php
            wp_link_pages(array(
                'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>'
            ));
            ?>
        </footer>
        <?php comments_template('/templates/comments.php'); ?>
    </article>
<?php endwhile;
