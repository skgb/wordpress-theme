<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

/* This file is not usually used, since the Wordpress core is supposed to
 * handle all requests for non-existing resources through mod_rewrite and the
 * redirection ini search. The only time when that's not the case is when a
 * Redirect 410 is explicitly configured.
 * In this situation we basically want to emulate the skgb5-template's
 * handling of a 410, except that we can skip the search for redirections.
 * 
 * In the future it might be worth doing some refactoring here to reduce
 * redundancies between the various error handling pages.
 */


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML LANG="de">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=UTF-8">
<TITLE>410 Gone « SKGB</TITLE>
<STYLE TYPE="text/css">
@import url( /extensions/themes/skgb5/style.css );
</STYLE>
<!--[if lte IE 7]><SCRIPT SRC="/extensions/themes/skgb5/ie7.js" type="text/javascript"></SCRIPT><![endif]-->
<SCRIPT SRC="/extensions/themes/skgb5/skgb.js" type="text/javascript"></SCRIPT>
<LINK REV="made" HREF="mailto:webmaster@skgb.de" TITLE="SKGB">

<H1 ID="layout-masthead"><SPAN><BIG>Segel- und Kanugemeinschaft</BIG> Brucher Talsperre <IMG SRC="/extensions/themes/skgb5/images/logo.gif" ALT="SKGB"></SPAN></H1>

<DIV ID="layout-main">

<H2><IMG SRC="//servo.skgb.de/images/StopAlert.png" WIDTH="64" HEIGHT="64" ALT="Fehler:" STYLE="float: right"> Seite entfernt</H2>
<P>Die unter der angeforderten Adresse <B><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></B> früher verfügbaren Inhalte wurden von diesem Server dauerhaft gelöscht. Bitte entferne alle Verweise auf diese Adresse.
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>

</DIV>

<DIV ID="layout-sidebar">
	<UL CLASS="menu">
		<LI><A HREF="/">Neuigkeiten</A>
		<LI><A HREF="/segelverein">Über uns</A>
		<LI><A HREF="/brucher">Segelrevier</A>
		<LI><A HREF="/jugend">Jugendgruppe</A>
		<LI><A HREF="/mitsegeln">Mitsegeln</A>
		<LI><A HREF="/ausbildung">Segelkurse</A>
		<LI><A HREF="/termine">Termine</A>
		<LI><A HREF="/regatten">Regatten</A>
		<LI><A HREF="/galerie">Fotogalerie</A>
		<LI><A HREF="/kontakt">Kontakt</A>
	</UL>
	<UL CLASS="sitemenu">
		<LI><FORM ID="searchform" METHOD="get" ACTION="http://www.skgb.de"><DIV><INPUT TYPE="text" NAME="s" TABINDEX="1" CLASS="placeholder"> <INPUT TYPE="submit" VALUE="Suchen"></DIV></FORM>
		<LI><A HREF="/sitemap">Alles auf einen Blick</A>
		<LI><A HREF="/2009">Archiv</A>
		<LI><A HREF="//intern.skgb.de/" CLASS="skgb-intern">SKGB<EM>-intern</EM></A>
	</UL>
</DIV>

<DIV ID="layout-footer">
	<P ID="copyright">© 1999–<?php echo date('Y'); ?> <ABBR TITLE="Segel- und Kanugemeinschaft Bruchertalsperre e. V.">SKGB</ABBR> · <A HREF="mailto:info&#064;skgb.de">info&#064;skgb.de</A>
</DIV>
