<div class="container main-container">
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<hgroup>
		
		        <?php if ( of_get_option('logo_uploader') ) { ?>
		        <img src="<?php echo of_get_option('logo_uploader'); ?>" />
		        <?php } ?>
		
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		
			</hgroup>
		
		</header><!-- #masthead .site-header -->
		<div id="main" class="row">