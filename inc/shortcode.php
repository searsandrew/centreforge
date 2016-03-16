<?php

function cf_add_pdficon($atts, $content = null) {
	extract(shortcode_atts(array(
		"width" => '100%',
		"target" => '_NEW'
		), $atts));
	return '<div class="pdf-link" target="'.$target.'" style="width:' . $width .';"><span class="fa fa-pdf-icon-o text-danger"></span> ' . $content . '</div>';
}
add_shortcode('pdf-icon', 'cf_add_pdficon');


/* ** Since: Centreforge v2.0.2 
 * Updated: Centreforge v2.1.8 ** 
 * DEPRECIATED IN 2.2.1 - Use [bs-row][bs-column] pattern instead
 */
function cf_bs_columns($atts, $content = null) {
	extract(shortcode_atts(array(
		"col" => '12',
		"size" => 'md',
		"class" => 'shortcode',
		"row" => ''
		), $atts));
	return ($row == 'first'?'<div class="row">':'').'<div class="col-'.$size.'-'.$col.' '.$class.'">' . do_shortcode($content) . '</div>'.($row == 'last'?'</div>':'');
}
add_shortcode('bs-columns', 'cf_bs_columns'); //Remove in Centreforge 3.0
add_shortcode('class', 'cf_bs_columns'); //Remove in Centreforge 3.0

/* ** Since: Centreforge v2.1.3
 * Updated: Centreforge v2.1.4 ** */
function cf_bs_media($atts, $content = null){
	extract(shortcode_atts(array(
		"list" => FALSE,
		"title" => 'Title',
		"url" => '#',
		"img" => '#',
		"horizontal" => 'left', //left, right
		"vertical" => 'top', //top, middle, bottom
		"heading" => '4'
		), $atts));
	return '<'.($list?'li':'div').' class="media">'.($horizontal == 'left'?'<div class="media-left"><a href="'.$url.'"><img class="media-object" src="'.$img.'" alt="'.$title.'"></a></div>':'').'<div class="media-body"><h'.$heading.' class="media-heading">'.$title.'</h'.$heading.'>'.do_shortcode($content).'</div>'.($horizontal == 'right'?'<div class="media-right"><a href="'.$url.'"><img class="media-object" src="'.$img.'" alt="'.$title.'"></a></div>':'').'</'.($list?'li':'div').'>';
}
add_shortcode('media', 'cf_bs_media');

/* ** Since: Centreforge v2.1.4 ** */
function cf_bs_list($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'Title',
		"first" => 'false',
		"last" => 'false'
		), $atts));
	return ($first == 'true'?'<ul class="list-group">':'').
		'<li class="list-group-item">
			<h4 class="list-group-item-heading">'.$title.'</h4>
			<p class="list-group-item-text">'.do_shortcode($content).'</p>
		</li>'.
	($last == 'true'?'</ul>':'');
}
add_shortcode('list-group', 'cf_bs_list');

/* ** Since: Centreforge v2.1.4 ** */
function cf_bs_button($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '#',
		"class" => 'default',
		"size" => 'md',
		"style" => '',
		"version" => 'deprecated' //Remove in Centreforge 3.0
		), $atts));
	return '<a href="'.$url.'" class="btn btn-'.($version == 'deprecated'?$class:$version).' '.(strpos($size,'btn-') === FALSE?'btn-':'').$size.'" style="'.$style.'">'.do_shortcode($content).'</a>';
}
add_shortcode('button', 'cf_bs_button');

/* ** Since: Centreforge v2.1.4 
 * Updated: Centreforge v2.1.8 ** */
function cf_bs_modal($atts, $content = null){
	extract(shortcode_atts(array(
        "button" => 'Click to Open',
        "btnopenclass" => 'default',
        "title" => '',
        "btncloseclass" => 'default',
        "footer" => '',
        "modalsize" => '',
        "modalid" => 'modal-1',
        "class" => 'deprecated', //Remove in Centreforge 3.0
        "closebtn" => 'deprecated', //Remove in Centreforge 3.0
        "size" => 'deprecated', //Remove in Centreforge 3.0 
        "id" => 'deprecated' //Remove in Centreforge 3.0
    ), $atts, 'modal'));
	return '<button type="button" class="btn btn-'.($class == 'deprecated'?$btnopenclass:$class).'" data-toggle="modal" data-target="#'.($id == 'deprecated'?$modalid:'modal-'.$id).'">'.$button.'</button><div id="'.($id == 'deprecated'?$modalid:'modal-'.$id).'" class="modal fade"><div class="modal-dialog '.($size == 'deprecated'?$modalsize:'modal-'.$size).'"><div class="modal-content">'.($title != ''?'<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">'.$title.'</h4></div>':'').'<div class="modal-body">'.do_shortcode($content).'</div>'.($footer != ''?'<div class="modal-footer">'.$footer.'<button type="button" class="btn btn-'.($closebtn == 'deprecated'?$btncloseclass:$closebtn).'" data-dismiss="modal">Close</button></div>':'').'</div></div></div>';
    
}
add_shortcode('modal','cf_bs_modal');

/* ** Since: Centreforge v2.1.4 ** */
function cf_bs_caption($output, $attr, $content){
	if ( is_feed() )
		return $output;

	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set up the attributes for the caption <div>. */
	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="thumbnail ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	/* Open the caption <div>. */
	$output = '<div' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<div class="caption"><p class="wp-caption-text margin-no-bottom">' . $attr['caption'] . '</p></div>';

	/* Close the caption </div>. */
	$output .= '</div>';

	/* Return the formatted, clean caption. */
	return $output;
}
add_filter( 'img_caption_shortcode', 'cf_bs_caption', 10, 3 );

/* ** Since: Centreforge v2.1.4 ** */
function cf_bs_loggedin($atts, $content = null){
	extract(shortcode_atts(array(
		"no" => '',
	), $atts));
	if ( is_user_logged_in() ) {
		return do_shortcode($content);
	} else {
		return do_shortcode($no);
	}
}
add_shortcode('loggedin','cf_bs_loggedin');


/* New BS shortcodes
 * Added - 2.2.1
 */

function cf_bs_alert( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        "type"          => false,
        "dismissable"   => false,
        "xclass"        => false,
        "data"          => false
    ), $atts );

    $class  = 'alert';
    $class .= ( $atts['type'] )         ? ' alert-' . $atts['type'] : ' alert-success';
    $class .= ( $atts['dismissable']   == 'true' )  ? ' alert-dismissable' : '';
    $class .= ( $atts['xclass'] )       ? ' ' . $atts['xclass'] : '';

    $dismissable = ( $atts['dismissable'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : '';

    $data_props = cf_parse_data_attributes( $atts['data'] );

    return sprintf( 
        '<div class="%s"%s>%s%s</div>',
        esc_attr( $class ),
        ( $data_props )  ? ' ' . $data_props : '',
        $dismissable,
        do_shortcode( $content )
    );
}

add_shortcode('bs-alert', 'cf_bs_alert');


function cf_bs_row( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        "xclass" => false,
        "data"   => false
    ), $atts );

    $class  = 'row';      
    $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';

    $data_props = cf_parse_data_attributes( $atts['data'] );

    return sprintf( 
        '<div class="%s"%s>%s</div>',
        esc_attr( $class ),
        ( $data_props ) ? ' ' . $data_props : '',
        do_shortcode( $content )
    );
}

add_shortcode('bs-row', 'cf_bs_row');

function cf_bs_column( $atts, $content = null ) {

    $atts = shortcode_atts( array(
        "lg"          => false,
        "md"          => false,
        "sm"          => false,
        "xs"          => false,
        "offset_lg"   => false,
        "offset_md"   => false,
        "offset_sm"   => false,
        "offset_xs"   => false,
        "pull_lg"     => false,
        "pull_md"     => false,
        "pull_sm"     => false,
        "pull_xs"     => false,
        "push_lg"     => false,
        "push_md"     => false,
        "push_sm"     => false,
        "push_xs"     => false,
        "xclass"      => false,
        "data"        => false
    ), $atts );

    $class  = '';
    $class .= ( $atts['lg'] )			                                ? ' col-lg-' . $atts['lg'] : '';
    $class .= ( $atts['md'] )                                           ? ' col-md-' . $atts['md'] : '';
    $class .= ( $atts['sm'] )                                           ? ' col-sm-' . $atts['sm'] : '';
    $class .= ( $atts['xs'] )                                           ? ' col-xs-' . $atts['xs'] : '';
    $class .= ( $atts['offset_lg'] || $atts['offset_lg'] === "0" )      ? ' col-lg-offset-' . $atts['offset_lg'] : '';
    $class .= ( $atts['offset_md'] || $atts['offset_md'] === "0" )      ? ' col-md-offset-' . $atts['offset_md'] : '';
    $class .= ( $atts['offset_sm'] || $atts['offset_sm'] === "0" )      ? ' col-sm-offset-' . $atts['offset_sm'] : '';
    $class .= ( $atts['offset_xs'] || $atts['offset_xs'] === "0" )      ? ' col-xs-offset-' . $atts['offset_xs'] : '';
    $class .= ( $atts['pull_lg']   || $atts['pull_lg'] === "0" )        ? ' col-lg-pull-' . $atts['pull_lg'] : '';
    $class .= ( $atts['pull_md']   || $atts['pull_md'] === "0" )        ? ' col-md-pull-' . $atts['pull_md'] : '';
    $class .= ( $atts['pull_sm']   || $atts['pull_sm'] === "0" )        ? ' col-sm-pull-' . $atts['pull_sm'] : '';
    $class .= ( $atts['pull_xs']   || $atts['pull_xs'] === "0" )        ? ' col-xs-pull-' . $atts['pull_xs'] : '';
    $class .= ( $atts['push_lg']   || $atts['push_lg'] === "0" )        ? ' col-lg-push-' . $atts['push_lg'] : '';
    $class .= ( $atts['push_md']   || $atts['push_md'] === "0" )        ? ' col-md-push-' . $atts['push_md'] : '';
    $class .= ( $atts['push_sm']   || $atts['push_sm'] === "0" )        ? ' col-sm-push-' . $atts['push_sm'] : '';
    $class .= ( $atts['push_xs']   || $atts['push_xs'] === "0" )        ? ' col-xs-push-' . $atts['push_xs'] : '';
    $class .= ( $atts['xclass'] )                                       ? ' ' . $atts['xclass'] : '';

    $data_props = cf_parse_data_attributes( $atts['data'] );

    return sprintf( 
        '<div class="%s"%s>%s</div>',
        esc_attr( $class ),
        ( $data_props ) ? ' ' . $data_props : '',
        do_shortcode( $content )
    );
}

add_shortcode('bs-column', 'cf_bs_column');

// Used to parse out any data attributes the user may add to a shortcode
function cf_parse_data_attributes( $data ) {

    $data_props = '';

    if( $data ) {
        $data = explode( '|', $data );

        foreach( $data as $d ) {
            $d = explode( ',', $d );
            $data_props .= sprintf( 'data-%s="%s" ', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
        }
    } else { 
        $data_props = false;
    }
    
    return $data_props;
}

// Intelligently remove extra P and BR tags around shortcodes that WordPress likes to add
function cf_bs_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']',
        ']<br>' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'cf_bs_fix_shortcodes');