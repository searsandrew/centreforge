<?php get_header(); ?>
    <div id="primary" class="site-content col-md-<?= (is_active_sidebar( 'sidebar-page' )) ? '8' : '12'; ?>">
        <div id="content" role="main">
			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

	            <?php while ( have_posts() ) : the_post(); ?>
	
	                <?php get_template_part( 'content', 'blog' ); ?>
	
	            <?php endwhile; // end of the loop. ?>
				
			<?php endif; ?>
				
        </div><!-- #content -->
    </div><!-- #primary .site-content -->

    <?php get_sidebar(); ?>
<?php get_footer(); ?>