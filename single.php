<?php get_header(); ?>
    <div id="primary" class="site-content col-md-<?= (is_active_sidebar( 'sidebar-page' )) ? '8' : '12'; ?>">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

                <?php // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif; ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary .site-content -->

    <?php get_sidebar(); ?>
<?php get_footer(); ?>