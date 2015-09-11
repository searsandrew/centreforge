<?php get_header(); ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <div id="primary" class="site-content col-md-<?= (is_active_sidebar( 'sidebar-page' )) ? '8' : '12'; ?>">
                    <div id="content" role="main">

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'content', 'page' ); ?>

                        <?php endwhile; // end of the loop. ?>

                    </div><!-- #content -->
                </div><!-- #primary .site-content -->

                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>