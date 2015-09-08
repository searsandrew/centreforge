<?php 

    class cf_walker_comments extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		// constructor – wrapper for the comments list
		function __construct() { ?>

			<ul class="comments-list media-list">

		<?php }

		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
			
			<div class="media child-comments">

		<?php }
	
		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>

			</div>

		<?php }

		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
			if ( 'article' == $args['style'] ) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			} ?>

            <li <?php comment_class(empty( $args['has_children'] ) ? 'media' :'parent media') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
                <div class="media-left">
                    <a href="#">
                        <?php if(function_exists('get_avatar')) {
                            if( get_comment_author_url() !='' ) echo '<a href="' . get_comment_author_url() .'">' . get_avatar($comment, '40') .'</a>';
                            else echo get_avatar($comment, '40');
                        } ?>
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a></h4>
                    <time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished">
                        <?php comment_date('jS F Y') ?>, <a href="#comment-<?php comment_ID() ?>" itemprop="url"><?php comment_time() ?></a>
                    </time>
					<?php edit_comment_link('<p class="comment-meta-item">Edit this comment</p>','',''); ?>
                </div>
                <div class="comment-content post-content">
                    <?php if ($comment->comment_approved == '0') : ?>
					   <p class="comment-meta-item">Your comment is awaiting moderation.</p>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
                
		<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

			</li>

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct() { ?>

			</ul>
		
		<?php }

	}

?>