<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

/* In the future it might be worth doing some refactoring here to reduce
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
<TITLE>503 Service Temporarily Unavailable « SKGB</TITLE>
<STYLE TYPE="text/css">
@import url( /extensions/themes/skgb5/style.css );
</STYLE>
<!--[if lte IE 7]><SCRIPT SRC="/extensions/themes/skgb5/ie7.js" type="text/javascript"></SCRIPT><![endif]-->
<LINK REV="made" HREF="mailto:webmaster@skgb.de" TITLE="SKGB">

<H1 ID="layout-masthead"><SPAN><BIG>Segel- und Kanugemeinschaft</BIG> Brucher Talsperre <IMG SRC="/extensions/themes/skgb5/images/logo.gif" ALT="SKGB"></SPAN></H1>

<DIV ID="layout-main">

<H2><IMG SRC="//servo.skgb.de/images/StopAlert.png" WIDTH="64" HEIGHT="64" ALT="Fehler:" STYLE="float: right"> Dienst vorübergehend nicht verfügbar</H2>
<P>Dieser Server ist vorübergehend nicht einsatzbereit aufgrund von Wartungsarbeiten oder Kapazitätsproblemen. Bitte versuche es später noch einmal.
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>

<P STYLE="margin-top: 2em">Vorschläge:
<UL>

<LI>
<FORM METHOD="GET" ACTION="http://www.google.com/custom">
	<P>Es ist möglich, dass Google eine (evtl. etwas ältere) Kopie dieser Seite im Cache zwischengespeichert hat. Wenn du einen passenden Suchbegriff eingibst und anschließend auf „Cache“ klickst, könntest du u. U. an die von dir gesuchten Informationen herankommen:
	<INPUT TYPE="hidden" NAME="hl" VALUE="de">
	<INPUT TYPE="hidden" NAME="domains" VALUE="skgb.de">
	<INPUT TYPE="hidden" NAME="sitesearch" VALUE="skgb.de">
	<INPUT TYPE="hidden" NAME="cof" VALUE="AH:center;GL:0;S:http://www.skgb.de/;AWFID:7d4c957d83480509;">
	<P><INPUT TYPE="text" NAME="q" MAXLENGTH="255" VALUE="<?php echo $requestSearchTerm; ?>"> <INPUT TYPE="submit" NAME="sa" VALUE="Suchen">
</FORM>

<LI>
<P><A HREF="//intern.skgb.de/">SKGB-intern</A> ist normalerweise nicht betroffen, wenn diese Meldung hier angezeigt wird.

<LI>
<P>E-Mail–Dienste sind normalerweise nicht betroffen, wenn diese Meldung angezeigt wird. Wenn du möchtest, kannst du anstatt des Webs einstweilen E-Mail, Telefon oder Telefax benutzen (Vereinsvorstand: <A HREF="mailto:info@skgb.de">info@skgb.de</A>, Tel./Fax 02261 921886).

</UL>
<ADDRESS>Arne Johannessen</ADDRESS>

</DIV>

<DIV ID="layout-sidebar">
	<UL CLASS="menu">
		<LI><STRONG TITLE="die Seite „Status 503“ wird gerade angezeigt">Status 503</STRONG>
	</UL>
	<UL CLASS="sitemenu">
		<LI><A HREF="//intern.skgb.de/" CLASS="skgb-intern">SKGB<EM>-intern</EM></A>
	</UL>
</DIV>

<DIV ID="layout-footer">
	<P ID="copyright">© 1999–2010 <ABBR TITLE="Segel- und Kanugemeinschaft Bruchertalsperre e. V.">SKGB</ABBR> · <A HREF="mailto:info&#064;skgb.de">info&#064;skgb.de</A>
</DIV>
