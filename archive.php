<?php get_header(); ?>
    <div id="primary" class="site-content col-md-<?= (is_active_sidebar( 'sidebar-page' )) ? '8' : '12'; ?>">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

                <?php comments_template( '', true ); ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary .site-content -->

    <?php get_sidebar(); ?>
<?php get_footer(); ?>