<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'centreforge' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>
		<ul class="comments-list">
			<?php
	            wp_list_comments( array(
	                'short_ping'    => true,
	                'avatar_size'   => 56,
	                'callback' => null,
	                'end-callback' => null,
	                'type' => 'all',
	                'page' => null,
	            ) );
	        ?>
		</ul>
        
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'centreforge' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->