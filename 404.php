<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

/* There are several possible error situations:
 * (1) the URL has changed, we do a 301 to the new location
 * (2) the content has been removed, we do a 410
 * (3) the content is archived, we do a 307 to archiv.skgb.de
 * (4) there is no known information, we do a 404
 * 
 * The 301s and 410s should /additionally/ be configured in
 * the server config if the content is assumed to be accessed
 * frequently.
 */


function _ERgetStatusCode ($status) {
	static $statusCodesByKeyword = array(
			'permanent' => 301,
			'found' => 302,
			'seeother' => 303,
			'temporary' => 307,
			'forbidden' => 403,
			'not-found' => 404,
			'gone' => 410,
			'server-error' => 500,
			'not-implemented' => 501,
			'maintenance' => 503);
	
	if (is_numeric($status)) {
		return intval($status);
	}
	else if (array_key_exists($status, $statusCodesByKeyword)) {
		return $statusCodesByKeyword[$status];
	}
	else {
		return NULL;
	}
}


function _ERfindRedirect () {
	if (! array_key_exists('REDIRECT_URL', $_SERVER)) {
		return array(404, NULL);  // no redirect can possibly be found
	}
	$redirects = parse_ini_file(dirname(__FILE__).'/404.ini', TRUE);
	reset($redirects);
	while (list($host, $redirect) = each($redirects)) {
		if ($host != $_SERVER['SERVER_NAME']) {
			continue;
		}
		reset($redirect);
		while (list($old, $new) = each($redirect)) {
			// does this particular redirect rule apply to the current url?
			$identical = $_SERVER['REDIRECT_URL'] == $old || $_SERVER['REDIRECT_URL'].'/' == $old;
			$subdirLocations = FALSE;
			if (! $identical) {
				$subdirLocations = strpos($_SERVER['REDIRECT_URL'], $old) === 0 && substr($old, -1) == '/' && (substr($new, -1) == '/' || strpos($new, '?') > 0);
				if (! $subdirLocations) {
					continue;
				}
			}
			// determine redirect properties
			$status = 301;
			$location = NULL;
			if (_ERgetStatusCode($new) !== NULL) {
				// no location
				// e. g.  ... = 410  or  ... = gone
				$status = $new;
			}
			else {
				if ($subdirLocations) {
					// location with possible subdirs
					//  .../ = .../  or  .../ = ...?...
					$new .= substr($_SERVER['REDIRECT_URL'], strlen($old));
				}
				if (strpos($new, ':') > 0) {
					// location with specific status code // *or* full URL
					// e. g.  ... = 303:...  or  ... = seeother:... // or  ... = http://...
					list($status, $new) = explode(':', $new);
				}
				$location = 'http:'.((substr($new, 0, 2) == '//') ? '' : '//'.$host).$new;
			}
			$status = _ERgetStatusCode($status);
			if ($status === NULL) {
				// an illegal status code is a server setup error
				$status = 500;
				$location = NULL;
			}
			return array($status, $location);
		}
	}
	return array(404, NULL);  // no redirect could be found
}


list($status, $contentLocation) = _ERfindRedirect();


if ($status == 301) {  // case (1) [301]
	header('HTTP/1.0 301 Permanent Redirect');
	header("Location: $contentLocation");
	
}
elseif ($status == 410) {  // case (2) [410]
	header('HTTP/1.0 410 Gone');
	get_header();
?>
<H2><IMG SRC="//servo.skgb.de/images/StopAlert.png" WIDTH="64" HEIGHT="64" ALT="Fehler:" STYLE="float: right"> Seite entfernt</H2>
<P>Die unter der angeforderten Adresse <B><?php echo esc_html($_SERVER['REQUEST_URI']); ?></B> früher verfügbaren Inhalte wurden von diesem Server dauerhaft gelöscht. Bitte entferne alle Verweise auf diese Adresse.
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>
<?php
	get_footer();
	
}
elseif ($status != 404) {
	header('HTTP/1.0 ' . intval($status));
	get_header();
?>
<H2>Fehler <?php echo intval($status); ?></H2>
<P>Beim Abruf der Adresse <B><?php echo esc_html($_SERVER['REQUEST_URI']); ?></B> ist ein unerwarteter Fehler aufgetreten.
<P><?php echo esc_html($contentLocation); ?>
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>
<?php
	get_footer();
	
}
else {
	// 404.ini says this actually is a 404
	
	// determine whether content exists on archiv.skgb.de (case (3) [307])
	define('SB_ARCHIV_ROOT_PATH', '/srv/skgb.archiv');
	define('SB_ARCHIV_ROOT_URI', 'http://archiv.skgb.de');
	$contentArchived = FALSE;
	$fileTypeExtensions = array('', '.shtml', '.html', '.php', '.pdf', '.jpeg', '.jpg', '.gif');
	foreach ($fileTypeExtensions as $fileTypeExtension) {
		if (file_exists(SB_ARCHIV_ROOT_PATH . $_SERVER['REDIRECT_URL'] . $fileTypeExtension)) {
			$contentArchived = TRUE;
			break;
		}
	}
	if ($contentArchived) {  // case (3) [307]
		$contentLocation = SB_ARCHIV_ROOT_URI . $_SERVER['REQUEST_URI'];
		header('HTTP/1.0 307 Temporary Redirect');
		header("Location: $contentLocation");
		
	}
	else {  // case (4) [404]
//		require_once(dirname(__FILE__) . '/index.php');
		
		$requestSearchTermList = NULL;
		preg_match_all('/[\w\pL\pN]+/u', urldecode($_SERVER['REQUEST_URI']), $requestSearchTermList);
		$requestSearchTerm = '';
		foreach ($requestSearchTermList[0] as $requestSearchTermPart) {
			$requestSearchTerm .= ' ' . $requestSearchTermPart;
		}
		$requestSearchTerm = esc_html(substr($requestSearchTerm, 1));
?>

<?php get_header(); ?>

<H2><IMG SRC="//servo.skgb.de/images/StopAlert.png" WIDTH="64" HEIGHT="64" ALT="Fehler:" STYLE="float: right"> Seite nicht gefunden</H2>
<P>Unter der angeforderten Adresse <B><?php echo esc_html($_SERVER['REQUEST_URI']); ?></B> konnte leider nichts gefunden werden.
<ADDRESS><?php echo $_SERVER['SERVER_SIGNATURE']; ?></ADDRESS>

<P STYLE="margin-top: 2em">Vorschläge:
<UL>

<LI>
<FORM METHOD="GET" ACTION="http://www.google.com/custom">
	<INPUT TYPE="hidden" NAME="hl" VALUE="de">
	<INPUT TYPE="hidden" NAME="domains" VALUE="skgb.de">
	<INPUT TYPE="hidden" NAME="sitesearch" VALUE="skgb.de">
	<INPUT TYPE="hidden" NAME="cof" VALUE="AH:center;GL:0;S:http://www.skgb.de/;AWFID:7d4c957d83480509;">
	<P><LABEL>skgb.de mit Google durchsuchen: <INPUT TYPE="text" NAME="q" MAXLENGTH="255" VALUE="<?php echo $requestSearchTerm; ?>"></LABEL> <INPUT TYPE="submit" NAME="sa" VALUE="Suchen">
</FORM>

<LI>
<FORM METHOD="GET" ACTION="/">
	<INPUT TYPE="hidden" NAME="r" VALUE="404">
	<INPUT TYPE="hidden" NAME="l" VALUE="<?php echo esc_html(urldecode($_SERVER['REQUEST_URI'])); ?>">
	<P><LABEL>skgb.de lokal durchsuchen: <INPUT TYPE="text" NAME="s" VALUE="<?php echo $requestSearchTerm; ?>"></LABEL> <INPUT TYPE="submit" VALUE="Suchen">
</FORM>

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

<?php get_footer(); ?>

<?php
	}  // endif
}  // endif
?>
