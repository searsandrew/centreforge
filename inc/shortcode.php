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
 * Updated: Centreforge v2.1.8 ** */
function cf_bs_columns($atts, $content = null) {
	extract(shortcode_atts(array(
		"col" => '12',
		"size" => 'md',
		"class" => 'shortcode',
		"row" => ''
		), $atts));
	return ($row == 'first'?'<div class="row">':'').'<div class="col-'.$size.'-'.$col.' '.$class.'">' . do_shortcode($content) . '</div>'.($row == 'last'?'</div>':'');
}
add_shortcode('bs-columns', 'cf_bs_columns');
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