<?php get_header(); ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <div id="primary" class="site-content col-md-<?= (is_active_sidebar( 'sidebar-page' )) ? '8' : '12'; ?>">
                    <div id="content" role="main">
                        <header class="page-header">
                            <h1>404 - Page not found</h1>
                        </header><!-- .page-header -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <p>Sorry, the page you were looking for could not be found.  Please use the navigation links above to get back on track or try searching.</p>
                            <?php get_search_form(); ?>
                        </article>
                    </div><!-- #content -->
                </div><!-- #primary .site-content -->
                <?php get_sidebar(); ?>  
            </div>
        </div>
    </div>
<?php get_footer(); ?>