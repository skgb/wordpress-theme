<?php
/*
 * $Id$
 * SKGB-Web 5.0
 */

get_header();
?>

<?php if ( is_category() ) : ?>
<?php
$categoryDescriptionBackgroundImageUri = get_bloginfo('template_url') . '/images/';
if (in_category('ausbildung')) {
	$categoryDescriptionBackgroundImageUri .= 'ausbildung.jpeg';
}
elseif (in_category('galerie')) {
	$categoryDescriptionBackgroundImageUri .= 'galerie.jpeg';
}
else {
	$categoryDescriptionBackgroundImageUri .= 'regatten.jpeg';
}
?>
<DIV ID="template-description" CLASS="category" STYLE="background-image: url(<?php echo $categoryDescriptionBackgroundImageUri; ?>)">
<H2><?php single_cat_title(); ?></H2><?php # :BUG: this heading level is supposed to be in-between H1 and the individual post's level. ?>
<?php echo category_description(); ?>
</DIV>
<?php elseif ( is_date() ) : ?>
<DIV ID="template-description">
<H2>Archiv</H2><?php # :BUG: this heading level is supposed to be in-between H1 and the individual post's level. ?>
<?php if ( function_exists('bhCalendarchives') ) { bhCalendarchives('num'); } ?>
<?php # where args can be 'num', 'first', 'short'. ?>
<P>Unsere <A HREF="//archiv.skgb.de/">alte Website</A> wurde auf dem Stand von Anfang 2009 eingefroren (<A HREF="//archiv.skgb.de/">archiv.skgb.de</A>).
</DIV>
<?php elseif ( is_tag() ) : ?>
<DIV ID="template-description">
<H2>Stichwort „<?php single_tag_title(); ?>“</H2><?php # :BUG: this heading level is supposed to be in-between H1 and the individual post's level. ?>
<?php echo tag_description(); ?>
</DIV>
<?php endif; ?>	


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php if (is_front_page() && get_post_meta(get_the_ID(), 'teflon_post', TRUE) == '1') { continue; } # Teflon ?>

<DIV <?php post_class() ?> ID="post-<?php the_ID(); ?>">
<?php if ( /* is_category() || */ is_author() || is_tag() || is_date() || is_search() ) : ?>
	<H2 CLASS="storytitle"><A HREF="<?php the_permalink() ?>" REL="bookmark"><?php the_title(); ?></A></H2>

	<div class="storycontent">
	<?php the_excerpt(); ?>
<?php else : ?>
	<H2 CLASS="storytitle"><?php the_title(); echo has_tag('Pressemitteilung') ? ' <EM>(Pressemitteilung)</EM>' : ''; ?></H2>

	<div class="storycontent">
	
	<?php if (is_attachment() && ! empty($post->post_excerpt)) { the_excerpt(); }  // for attachments, this is the caption ?>
	<?php the_content(__('(more...)')); ?>
<?php endif; ?>	
	</div>
	
<?php
$feedbackLink = ! is_singular() && (comments_open() || get_comments_number());
# wp_link_pages();
?>	

	<ADDRESS><?php the_author() ?>, <?php the_time('j. F Y') ?> <A HREF="<?php the_permalink() ?>" TITLE="Permalink" REL="bookmark">#</A> <?php if ($feedbackLink) { echo '· '; comments_popup_link('Kommentar schreiben', '<STRONG>1 Kommentar</STRONG>', '<STRONG>% Kommentare</STRONG>'); } ?> <?php edit_post_link('Bearbeiten', ' · ') ?></ADDRESS>
	
<?php if (is_single()) : ?>
<?php $tagsCaption = '· Stichwort' . ((count(get_tags()) == 1) ? ': ' : 'e: '); ?>
	<DIV CLASS="meta"><?php _e('Filed under:') ?> <?php the_category(',') ?> <?php the_tags($tagsCaption, ', ') ?></DIV>
<?php endif; ?>	
	
</div>

<?php if (! is_attachment()) { comments_template(); }  // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<P ID="wp_posts_nav"><?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?></P>

<?php get_footer(); ?>
