<?php
/*
 * $Id$
 * SKGB-Web 4.5
 */
get_header();
?>

<?php if (
have_posts()) : while (have_posts()) : the_post(); ?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	<h2 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<div class="storycontent">
		<?php the_content(__('(more...)')); ?>
	</div>
	
	<ADDRESS CLASS="meta"><?php the_author() ?>, <?php the_time('j. F Y') ?> <?php edit_post_link('[bearbeiten]', ' · ') ?></ADDRESS>
	
<?php if (is_single()) : ?>	
	<DIV CLASS="meta"><?php _e('Filed under:') ?> <?php the_category(',') ?></DIV>
	<DIV CLASS="meta"><?php the_tags(__('Tags: '), ', ') ?></DIV>
<?php endif; ?>	
<?php if (is_singular()) : ?>	
	
	<HR>
<?php endif; ?>	
	
	<div class="feedback">
		<?php # wp_link_pages(); ?>
<?php
comments_popup_link('Noch kein Kommentar', '1 Kommentar', ' % Kommentare', '', 'Kommentare sind geschlossen');
if (comments_open() && ! is_singular()) {
	?> · <A HREF="<?php the_permalink() ?>#postcomment">Kommentar schreiben</A><?php
}
?>
	</div>
	
</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>

<?php get_footer(); ?>
