<?php get_header(); ?>
    <div id="main">
        <div class="container">
            <div class="row">
                <div id="primary" class="site-content col-md-<?= (is_active_sidebar( 'sidebar-page' )) ? '8' : '12'; ?>">
                    <div id="content" role="main">

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'content', 'blog' ); ?>

                        <?php endwhile; // end of the loop. ?>

                        <?php $paginationLinks = paginate_links( array(
                            'current'   => max( 1, get_query_var('paged') ),
                            'total'     => $wp_query->max_num_pages,
                            'next_text' => 'Older Posts &rarr;',
                            'prev_text' => '&larr; Newer Posts',
                            'type'      => 'array'
                        )); 

                        if(!empty($paginationLinks > 0)){
                            echo '<ul class="pager">';
                            foreach($paginationLinks as $link){
                                 echo '<li>'.$link.'</li>';   
                            }
                            echo '</ul>';
                        } ?>

                    </div><!-- #content -->
                </div><!-- #primary .site-content -->

                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>