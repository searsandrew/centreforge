<?php
/**
 * The sidebar containing the main widget area
 *
 */

if ( is_active_sidebar( 'sidebar-page' )  ) : ?>
    <div id="sidebar" class="col-md-4">
        <?php dynamic_sidebar( 'sidebar-page' ); ?>
    </div>
<?php endif; ?>