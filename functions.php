<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

if (defined('SB_TIMING') && SB_TIMING) {
	global $SB_timingStartTime;
	printProfilingEstimate($SB_timingStartTime, 'l10n');
	$SB_timingStartTime = gettimeofday();
}

/*
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));
}
*/

function new_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');

function remheadlink() {
//	remove_action('wp_head', 'rsd_link');  // XML-RPC
	remove_action('wp_head', 'wlwmanifest_link');  // Windows Live Writer
}
add_action('init', 'remheadlink');

/*
function moreLink ($content){
	return str_replace('[...]', '<A HREF="' . get_permalink() . '" CLASS="more-link">' . __('(more...)') . '</A>', $content);
}
add_filter('get_the_excerpt', 'moreLink');
*/

?>
