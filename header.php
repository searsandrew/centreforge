<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->

<?php get_template_part('head','code'); ?>

<?php wp_enqueue_script('jquery');
wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<?php do_action( 'before' ); 
	get_template_part('header','masthead'); ?>
		
	<?php /* Since 2.2.0, allow user to hide primary menu */
    $cfMenuOptions = get_option('cf_menu_options');
    if(array_key_exists('show_menu', $cfMenuOptions)) {
        $showMenu = $cfMenuOptions['show_menu'];
    } else {
        $showMenu = 1;
    }
    
    if($showMenu){
        $cfNavOption = get_option('cf_navText');
        /* Since 2.2.0 - give the theme a default option in case the user doesn't provide one */
        if($cfNavOption == '') {
            $cfNavOption = 'bootstrap';
        }
        get_template_part('nav',$cfNavOption); 
    } ?>