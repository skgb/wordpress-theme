<?php
/*
 * $Id$
 * SKGB-Web 5.0d
 */

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<DIV <?php post_class() ?> ID="post-<?php the_ID(); ?>">
	<H2 CLASS="storytitle"><?php the_title(); ?></H2>
	
	<p>(zu: <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a>)</p>
	
	<div class="storycontent">
	<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo preg_replace( '/(width|height)="[^"]*"/i', '', wp_get_attachment_image($post->ID, 'large') ); ?></a></p>
	<div class="caption"><?php if ( !empty($post->post_excerpt) ) { the_excerpt(); }  // this is the "caption" ?></div>
	<?php the_content(__('(more...)')); ?>
	
	</div>
	
	<div class="navigation">
		<div class="alignleft"><?php previous_image_link() ?></div>
		<div class="alignright"><?php next_image_link() ?></div>
	</div>

<?php
$feedbackLink = ! is_singular() && (comments_open() || get_comments_number());
# wp_link_pages();
?>	

	<ADDRESS><!--<?php the_author() ?>, --><?php the_time('j. F Y') ?> <A HREF="<?php the_permalink() ?>" TITLE="Permalink" REL="bookmark">#</A> <?php if ($feedbackLink) { echo '· '; comments_popup_link('Kommentar schreiben', '<STRONG>1 Kommentar</STRONG>', '<STRONG>% Kommentare</STRONG>'); } ?> <?php edit_post_link('Bearbeiten', ' · ') ?></ADDRESS>
	
</DIV>

<?php if (! is_attachment()) { comments_template(); }  // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
