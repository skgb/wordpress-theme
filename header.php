<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

@header('Content-Style-Type: text/css; charset=UTF-8');

if (defined('SB_TIMING') && SB_TIMING) {
	global $SB_timingStartTime;
	printProfilingEstimate($SB_timingStartTime, 'start/query');
	$SB_timingStartTime = gettimeofday();
}

require(TEMPLATEPATH . '/assert_dependencies.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML <?php language_attributes(); ?>>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=<?php bloginfo('charset'); ?>">
<TITLE><?php wp_title('&laquo;', true, 'right'); ?> SKGB</TITLE> <!--?php bloginfo('name'); ?-->
<STYLE TYPE="text/css">
@import url( <?php bloginfo('stylesheet_url'); ?> );
</STYLE>
<!--[if lte IE 7]><SCRIPT SRC="<?php bloginfo('template_url'); ?>/ie7.js" type="text/javascript"></SCRIPT><![endif]-->
<SCRIPT SRC="<?php bloginfo('template_url'); ?>/skgb.js" type="text/javascript"></SCRIPT>
<LINK REL="icon" HREF="<?php bloginfo('template_url'); ?>/images/icon.png">

<LINK REL="alternate" TYPE="application/atom+xml" TITLE="Newsfeed mit allen SKGB-Artikeln" HREF="<?php bloginfo('atom_url'); ?>">
<LINK REL="alternate" TYPE="application/atom+xml" TITLE="Kommentare-Feed zu allen SKGB-Artikeln" HREF="<?php bloginfo('comments_atom_url'); ?>">
<LINK REL="pingback" HREF="<?php bloginfo('pingback_url'); ?>">

<META NAME="ICBM" CONTENT="51.0747, 7.5620">
<META NAME="geo.position" CONTENT="51.0747;7.5620">
<META NAME="geo.region" CONTENT="DE-NW">
<META NAME="geo.placename" CONTENT="Brucher Talsperre, Marienheide">
<META NAME="keywords" CONTENT="Brucher, Bruchertalsperre, Bruchersee, Segeln, Gummersbach, lernen, Segelführerschein, Segelsport, Liegeplätze, Regatta">
<LINK REV="made" HREF="mailto:info@skgb.de" TITLE="SKGB">

<?php # wp_get_archives('type=yearly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php wp_head(); ?>

<H1 ID="layout-masthead"><SPAN><BIG>Segel- und Kanugemeinschaft</BIG> Brucher Talsperre <IMG SRC="<?php bloginfo('template_url'); ?>/images/logo.gif" ALT="SKGB"></SPAN></H1>

<DIV ID="layout-main">

<!-- end header -->
