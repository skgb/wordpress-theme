<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

function printMenuItem ($type, $id, $uri, $text, $args = '') {
	$currentPageItem = "<STRONG TITLE=\"die Seite „{$text}“ wird gerade angezeigt\"{$args}>$text</STRONG>\n";
	$otherPageItem = "<A HREF=\"$uri\"{$args}>$text</A>\n";
	if ($type == 'front') {
		if (is_front_page() && ! is_paged()) {
			echo $currentPageItem;
		}
		else {
			echo $otherPageItem;
		}
	}
	elseif ($type == 'page') {
		if (is_page($id)) {
			echo $currentPageItem;
		}
		else {
			echo $otherPageItem;
		}
	}
	elseif ($type == 'cat') {
		if (is_category() && in_category($id) && ! is_paged()) {
			echo $currentPageItem;
		}
		else {
			echo $otherPageItem;
		}
	}
	else {
		if (array_key_exists('REDIRECT_URL', $_SERVER) && $_SERVER['REDIRECT_URL'] == $uri) {
			echo $currentPageItem;
		}
		else {
			echo $otherPageItem;
		}
	}
}

?>
<!-- begin sidebar -->
<DIV ID="layout-sidebar">

<UL CLASS="menu">
<!--
	<?php # cat   1 ?><LI><A HREF="/">Neuigkeiten</A>
	<?php # page 46 ?><LI><?php if (is_page(46)) { ?><STRONG>Über uns</STRONG><?php } else { ?><A HREF="/segelverein">Über uns</A><?php } echo "\n"; ?>
	<?php # page 42 ?><LI><A HREF="/brucher">Segelrevier</A>
	<?php # page  2 ?><LI><A HREF="/jugend">Jugendgruppe</A>
	<?php # page 54 ?><LI><A HREF="/mitsegeln">Mitsegeln</A>
	<?php # cat   7 ?><LI><A HREF="/ausbildung">Segelkurse</A>
	<?php # page 51 ?><LI><A HREF="/termine">Termine</A>
	<?php # cat   5 ?><LI><A HREF="/regatten">Regatten</A>
	<?php # cat   6 ?><LI><A HREF="/galerie">Fotogalerie</A>
	<?php # page 49 ?><LI><A HREF="/kontakt">Kontakt</A>
-->
	<LI><?php printMenuItem('front', 1, '/', 'Neuigkeiten'); ?>
	<LI><?php printMenuItem('page', 46, '/segelverein', 'Über uns'); ?>
	<LI><?php printMenuItem('page', 42, '/brucher', 'Segelrevier'); ?>
	<LI><?php printMenuItem('page', 2, '/jugend', 'Jugendgruppe'); ?>
	<LI><?php printMenuItem('page', 54, '/mitsegeln', 'Mitsegeln'); ?>
	<LI><?php printMenuItem('cat', 7, '/ausbildung', 'Segelkurse'); ?>
	<LI><?php printMenuItem('post', 0, '/allgemein/2014/termine-2014', 'Termine'); ?>
	<LI><?php printMenuItem('cat', 5, '/regatten', 'Regatten'); ?>
	<LI><?php printMenuItem('cat', 6, '/galerie', 'Fotogalerie'); ?>
	<LI><?php printMenuItem('page', 49, '/kontakt', 'Kontakt'); ?>
<?php
/* We're mixing links to categories and pages here because we
 * really want to define our own order in the menu. We don't
 * use categories like they were intended by Wordpress. To
 * achieve a minimal amount of compatibility, we simply make
 * a list of all pages and categories here that we don't
 * explicitly link to above. Additionally, we exclude some
 * pages we only link to from elsewhere:
 * - page 190: /segelanweisungen
 * - page 193: /ausbildungsprogramm
 * - page 197: /sitemap
 */
// :TODO: make the link list above somehow independent of slug names and/or IDs
wp_list_pages('title_li=&exclude=2,42,46,49,51,54,190,193,197');
$categoriesList = wp_list_categories('title_li=&exclude=1,5,6,7&hide_empty=0&echo=0');
if (strpos($categoriesList, '<li>' . __('No categories') . '</li>') === FALSE) {
	echo $categoriesList;
}
$searchValue = esc_attr(get_search_query());
if (strlen($searchValue) > 0) {
	$searchValue = " VALUE=\"$searchValue\"";
}
?>
</UL>
<UL CLASS="sitemenu">
	<LI><FORM ID="searchform" METHOD="get" ACTION="<?php bloginfo('url'); ?>"><DIV><INPUT TYPE="text" NAME="s"<?php echo $searchValue; ?> TABINDEX="1" CLASS="placeholder"> <INPUT TYPE="submit" VALUE="<?php _e('Search'); ?>"></DIV></FORM>
	<LI><?php printMenuItem('page', 197, '/sitemap', 'Alles auf einen Blick', ' id="menuitem-197"'); ?>
	<LI><?php printMenuItem('', 0, '/2012', 'Archiv'); ?>
<?php if (count(get_bookmark(9)->link_category)) : ?>
	<LI><A HREF="//intern.skgb.de/" CLASS="skgb-intern">SKGB<EM>-intern</EM></A>
<?php endif; ?>
<?php wp_list_bookmarks('exclude=9&categorize=0&title_li=&title_after=&title_before='); ?>
<?php wp_meta(); ?>
</UL>
<DIV CLASS="follow-buttons">
	<SPAN>Folge uns mit …</SPAN>
	<A HREF="https://twitter.com/bruchersegler" TITLE="folge uns auf Twitter!" CLASS="twitter"><SPAN>Twitter</SPAN></A>
	<A HREF="https://facebook.com/skgb.de" TITLE="folge uns bei Facebook!" CLASS="facebook"><SPAN>Facebook</SPAN></A>
	<A HREF="/feed" TITLE="folge unserem RSS-Feed!" CLASS="feed"><SPAN>RSS-Feed</SPAN></A>
</DIV>

</DIV>
<!-- end sidebar -->
