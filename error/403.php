<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

/* In the future it might be worth doing some refactoring here to reduce
 * redundancies between the various error handling pages.
 */


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML LANG="de">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=UTF-8">
<TITLE>403 Forbidden « SKGB</TITLE>
<STYLE TYPE="text/css">
@import url( /extensions/themes/skgb5/style.css );
</STYLE>
<!--[if lte IE 7]><SCRIPT SRC="/extensions/themes/skgb5/ie7.js" type="text/javascript"></SCRIPT><![endif]-->
<SCRIPT SRC="/extensions/themes/skgb5/skgb.js" type="text/javascript"></SCRIPT>
<LINK REV="made" HREF="mailto:webmaster@skgb.de" TITLE="SKGB">

<H1 ID="layout-masthead"><SPAN><BIG>Segel- und Kanugemeinschaft</BIG> Brucher Talsperre <IMG SRC="/extensions/themes/skgb5/images/logo.gif" ALT="SKGB"></SPAN></H1>

<DIV ID="layout-main">

<H2><IMG SRC="//servo.skgb.de/images/StopAlert.png" WIDTH="64" HEIGHT="64" ALT="Fehler:" STYLE="float: right"> Zugriff verboten</H2>
<P>Du hast keine Zugriffsrechte auf die unter der angeforderten Adresse <B><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></B> auf diesem Server verfügbaren Inhalte.
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>

<P STYLE="margin-top: 2em">Wenn du der Meinung bist, dass dir der Zugriff auf die Inhalte unter dieser Adresse erlaubt sein sollte, melde das Problem bitte dem Vereinsvorstand (→ <A HREF="/kontakt">Kontakt</A>).
<ADDRESS>Arne Johannessen</ADDRESS>

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
	<P ID="copyright">© 1999–2010 <ABBR TITLE="Segel- und Kanugemeinschaft Bruchertalsperre e. V.">SKGB</ABBR> · <A HREF="mailto:info&#064;skgb.de">info&#064;skgb.de</A>
</DIV>
