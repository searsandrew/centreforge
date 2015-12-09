<div class="main-container">
	<div id="page" class="hfeed site">
        <?php if ( display_header_text() ) { ?>
            <header id="masthead" class="site-header" role="banner">
                <div class="container">
                    <hgroup>

                        <h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

                    </hgroup>
                </div>
            </header><!-- #masthead .site-header -->
        <?php } ?>