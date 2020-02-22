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

function SB_path_termine () {
	// find newest post with tag "Termine" and title like "Termine 2019"
	$query = new WP_Query(array(
		'tag' => 'termine',
		'orderby' => 'DESC',
		'ignore_sticky_posts' => TRUE,
		'posts_per_page' => 5,  // typically, there are <= 2 'termine' posts per year
	));
	foreach ($query->get_posts() as $post) {
		if ( preg_match('/^Termine 20[0-9]{2}\b/i', get_the_title($post)) ) {
			// printMenuItem() expects a path reference, not a URI
			return preg_replace('|^https?://www.skgb.de/|', '/', get_permalink($post));
		}
	}
	return '/stichwort/termine';
}

?>
<!-- begin sidebar -->
<DIV ID="layout-sidebar">

<UL CLASS="menu">
	<LI><?php printMenuItem('front', 1, '/', 'Neuigkeiten'); ?>
	<LI><?php printMenuItem('page', 46, '/segelverein', 'Über uns'); ?>
	<LI><?php printMenuItem('page', 42, '/brucher', 'Segelrevier'); ?>
	<LI><?php printMenuItem('page', 2, '/jugend', 'Jugendgruppe'); ?>
	<LI><?php printMenuItem('page', 54, '/mitsegeln', 'Mitgliedschaft'); ?>
	<LI><?php printMenuItem('page', 1638, '/vereinsboote', 'Vereinsboote'); ?>
	<LI><?php printMenuItem('cat', 7, '/ausbildung', 'Segelkurse'); ?>
	<LI><?php printMenuItem('post', 0, SB_path_termine(), 'Termine'); ?>
	<LI><?php printMenuItem('cat', 5, '/regatten', 'Regatten'); ?>
	<!--<LI><?php printMenuItem('cat', 6, '/galerie', 'Fotogalerie'); ?>-->
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
wp_list_pages('title_li=&exclude=2,42,46,49,51,54,190,193,197,1638');
$categoriesList = wp_list_categories('title_li=&exclude=1,5,6,7&hide_empty=0&echo=0');
if (strpos($categoriesList, '<li>' . __('No categories') . '</li>') !== FALSE) {
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
	<LI><?php printMenuItem('', 0, '/2018', 'Archiv'); ?>
<?php if (count(get_bookmark(9)->link_category)) : ?>
	<LI><A HREF="https://intern.skgb.de/digest/" CLASS="skgb-intern">SKGB<EM>-intern</EM></A>
<?php endif; ?>
<?php wp_list_bookmarks('exclude=9&categorize=0&title_li=&title_after=&title_before='); ?>
<?php wp_meta(); ?>
</UL>

</DIV>
<!-- end sidebar -->
