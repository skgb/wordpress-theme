<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

/* This file is not usually used, since the Wordpress core is supposed to
 * handle all requests for non-existing resources through mod_rewrite. The only
 * times when that's not the case are
 * (1) when a Redirect 404 (or equivalent) is explicitly configured or
 * (2) when an abnormal condition occurs.
 * In these situations we basically want to emulate the skgb5-template's
 * handling of a 404, except that we can skip the search for redirections.
 * 
 * In the future it might be worth doing some refactoring here to reduce
 * redundancies between the various error handling pages.
 */


$requestSearchTermList = NULL;
preg_match_all('/[\w\pL\pN]+/u', urldecode($_SERVER['REQUEST_URI']), $requestSearchTermList);
$requestSearchTerm = '';
foreach ($requestSearchTermList[0] as $requestSearchTermPart) {
	$requestSearchTerm .= ' ' . $requestSearchTermPart;
}
$requestSearchTerm = htmlspecialchars(substr($requestSearchTerm, 1));

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML LANG="de">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=UTF-8">
<TITLE>404 Not Found « SKGB</TITLE>
<STYLE TYPE="text/css">
@import url( /extensions/themes/skgb5/style.css );
</STYLE>
<!--[if lte IE 7]><SCRIPT SRC="/extensions/themes/skgb5/ie7.js" type="text/javascript"></SCRIPT><![endif]-->
<SCRIPT SRC="/extensions/themes/skgb5/skgb.js" type="text/javascript"></SCRIPT>
<LINK REV="made" HREF="mailto:webmaster@skgb.de" TITLE="SKGB">

<H1 ID="layout-masthead"><SPAN><BIG>Segel- und Kanugemeinschaft</BIG> Brucher Talsperre <IMG SRC="/extensions/themes/skgb5/images/logo.gif" ALT="SKGB"></SPAN></H1>

<DIV ID="layout-main">

<H2><IMG SRC="//servo.skgb.de/images/StopAlert.png" WIDTH="64" HEIGHT="64" ALT="Fehler:" STYLE="float: right"> Seite nicht gefunden</H2>
<P>Unter der angeforderten Adresse <B><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></B> konnte leider nichts gefunden werden.
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>

<P STYLE="margin-top: 2em">Vorschläge:
<UL>

<!--
<LI>
<FORM METHOD="GET" ACTION="http://www.google.com/custom">
	<INPUT TYPE="hidden" NAME="hl" VALUE="de">
	<INPUT TYPE="hidden" NAME="domains" VALUE="skgb.de">
	<INPUT TYPE="hidden" NAME="sitesearch" VALUE="skgb.de">
	<INPUT TYPE="hidden" NAME="cof" VALUE="AH:center;GL:0;S:http://www.skgb.de/;AWFID:7d4c957d83480509;">
	<P><LABEL>skgb.de mit Google durchsuchen: <INPUT TYPE="text" NAME="q" MAXLENGTH="255" VALUE="<?php echo $requestSearchTerm; ?>"></LABEL> <INPUT TYPE="submit" NAME="sa" VALUE="Suchen">
</FORM>
-->

<LI>
<FORM METHOD="GET" ACTION="/">
	<INPUT TYPE="hidden" NAME="r" VALUE="404">
	<INPUT TYPE="hidden" NAME="l" VALUE="<?php echo htmlspecialchars(urldecode($_SERVER['REQUEST_URI'])); ?>">
	<P><LABEL>skgb.de lokal durchsuchen: <INPUT TYPE="text" NAME="s" VALUE="<?php echo $requestSearchTerm; ?>"></LABEL> <INPUT TYPE="submit" VALUE="Suchen">
</FORM>

<LI>
<P>skgb.de mit <A HREF="http://www.google.de/search?q=site:skgb.de">Google</A> durchsuchen

<LI>
<P>Sitemap von skgb.de anschauen: <A HREF="/sitemap">Alles auf einen Blick</A>

<LI>
<P>Archiv von skgb.de anschauen: <A HREF="/2009">datiertes Archiv</A>

<LI>
<P>In 2009 haben wir im Zuge eines Softwarewechsels einige ältere Seiten archiviert. Langfristig möchten wir alle diese Inhalte in die neue Software überführen. Wenn du Informationen aus der Zeit vor 2009 suchst, magst du vielleicht in den alten Seiten blättern, bis wir damit fertig sind: <A HREF="//archiv.skgb.de/">archiv.skgb.de</A>

<LI>
<P>Wenn du Inhalte nicht findest, die deiner Meinung nach unter dieser Adresse existieren sollten, oder du über einen Hyperlink von einer anderen Seite hierher gekommen bist, melde das Problem bitte dem Vereinsvorstand (→ <A HREF="/kontakt">Kontakt</A>).

</UL>
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
	<P ID="copyright">© 1999–<?php echo date('Y'); ?> <ABBR TITLE="Segel- und Kanugemeinschaft Bruchertalsperre e. V.">SKGB</ABBR> · <A HREF="mailto:info&#064;skgb.de">info&#064;skgb.de</A>
</DIV>
