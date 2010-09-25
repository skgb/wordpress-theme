<?php
/*
 * $Id$
 * SKGB-Web 4.5
 */
?>
<!-- begin sidebar -->

<DIV ID="leftColumn"><DIV ID="menu"><STRONG CLASS="hide">Men&uuml; (<A HREF="#body" TITLE="direkt zum Inhalt dieser Seite springen" ACCESSKEY="2">&uuml;berspringen</A>):<BR></STRONG><DIV ID="menuPicTop">

<DIV>
	<SPAN CLASS="wrap"><A HREF="/">Neuigkeiten</A> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/segelverein">Über uns</A> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/brucher">Segelrevier</A> </SPAN> 
</DIV>
<DIV>
	<SPAN CLASS="wrap"><A HREF="/jugend">Jugendgruppe</A> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/mitsegeln">Mitsegeln</A> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/ausbildung">Segelkurse</A> </SPAN>
</DIV>
<DIV>
	<SPAN CLASS="wrap"><A HREF="/termine">Termine</A> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/regatten">Regatten</A> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/galerie">Fotogalerie</A> </SPAN>
</DIV>
<DIV>
	<SPAN CLASS="wrap"><A HREF="/kontakt">Kontakt</A> </SPAN>
</DIV>
<DIV>
	<form id="searchform" method="get" action="<?php bloginfo('url'); ?>" style="display: inline">
		<input type="text" name="s" value="Suche" style="color: gray; font-size: 83%; width: 7.7em" onfocus="this.style.color = 'black'; if (this.value == 'Suche') { this.value = ''; }" onblur="this.style.color = 'grey'; if (this.value == '') { this.value = 'Suche'; }">
		<input type="submit" value="<?php _e('Search'); ?>" style="display: none">
	</form>
	<SPAN CLASS="wrap"><!--A HREF="/sitemap"-->Alles auf <BR>&nbsp;einen Blick<!--/A--> <SPAN CLASS="hide">|</SPAN></SPAN>
	<SPAN CLASS="wrap"><A HREF="/2009">Archiv</A> </SPAN>
</DIV>
<DIV>
	<SPAN CLASS="wrap"><A HREF="//intern.skgb.de/"><SPAN STYLE="color: black">SKGB</SPAN>-intern</A> </SPAN>
</DIV>

<SPAN ID="end"><SPAN ID="menuPicBottom"></SPAN></SPAN></DIV></DIV><DIV ID="leftColumnBottom">



<div id="sidebar">
<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<P ID="meta" STYLE="margin-bottom: 0"><?php _e('Meta:'); ?>
<UL STYLE="margin-top: 0">
	<?php wp_register(); ?>
	<LI><?php wp_loginout(); ?></LI>
	<?php wp_meta(); ?>
</UL>

<ul style="display: block; margin: 0; padding: 0">
	<?php wp_list_pages('title_li=' . __('Pages:') . '&exclude=2,42,46,49,51,54'); ?>
	<?php wp_list_bookmarks('title_after=&title_before='); ?>
	<?php $categoriesList = wp_list_categories('title_li=' . __('Categories:') . '&exclude=1,3,5,6,7&hide_empty=0&echo=0'); if (strpos($categoriesList, '<li>Keine Kategorien</li>') === FALSE) { echo $categoriesList; } ?>
</ul>
<?php endif; ?>
</div>



</DIV></DIV><HR CLASS="hide">

<!-- end sidebar -->
