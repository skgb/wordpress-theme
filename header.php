<?php
/*
 * $Id$
 * SKGB-Web 4.5
 */



// Transforming XHTML into HTML
// <http://www.robertnyman.com/2006/09/20/how-to-deliver-html-instead-of-xhtml-with-wordpress/>
function xml2html($buffer)
{
	$XML = array(' />');
	$HTML = array('>');
	return str_replace($XML, $HTML, $buffer);
}
ob_start('xml2html');



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML <?php language_attributes(); ?>><HEAD>
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=<?php bloginfo('charset'); ?>">
	
	<TITLE><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></TITLE>
	
	<STYLE TYPE="text/css" MEDIA="all">
@import url( <?php bloginfo('stylesheet_url'); ?> );
	</STYLE>
	
	<LINK REL="alternate" TYPE="application/atom+xml" TITLE="Newsfeed mit allen SKGB-Artikeln" HREF="<?php bloginfo('atom_url'); ?>">
	<LINK REL="alternate" TYPE="application/atom+xml" TITLE="Kommentare-Feed zu allen SKGB-Artikeln" HREF="<?php bloginfo('comments_atom_url'); ?>">
	<LINK REL="pingback" HREF="<?php bloginfo('pingback_url'); ?>" />
	
	<META NAME="ICBM" CONTENT="51.0747, 7.5620">
	<META NAME="geo.position" CONTENT="51.0747;7.5620">
	<META NAME="geo.region" CONTENT="DE-NW">
	<META NAME="geo.placename" CONTENT="Brucher Talsperre, Marienheide">
	<META NAME="keywords" CONTENT="Brucher, Bruchertalsperre, Bruchersee, Segeln, Gummersbach, lernen, Segelf&uuml;hrerschein, Segelsport, Liegepl&auml;tze, Regatta">
	<LINK REV="made" HREF="mailto:webmaster@skgb.de" TITLE="Arne Johannessen">
	
<?php wp_get_archives('type=yearly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php wp_head(); ?>
</HEAD>

<BODY>

<DIV ID="head"><DIV ID="headBox">
	<H1><A HREF="<?php bloginfo('url') ?>/"><IMG SRC="<?php bloginfo('template_directory') ?>/images/kopf.gif" WIDTH="572" HEIGHT="90" ALT="Segel- und Kanugemeinschaft Bruchertalsperre e.&nbsp;V.  SKGB"></A></H1>
	<SPAN ID="location">51709 Marienheide, Oberbergischer Kreis, Nordrhein-Westfalen</SPAN> <SPAN ID="infoMail"><A HREF="mailto:info&#064;skgb.de">info&#64;skgb.de</A></SPAN>
</DIV></DIV>

<DIV ID="main">

<?php get_sidebar(); ?>

<DIV ID="body">

<!-- end header -->
