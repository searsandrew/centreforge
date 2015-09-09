<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if(is_single()){ ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	<?php } else { ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
	<?php } ?>
	
</article>
<?php // If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif; ?>