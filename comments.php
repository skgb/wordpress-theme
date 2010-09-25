<?php
/*
 * $Id$
 * SKGB-Web 4.5
 */
?>

<?php
if ( post_password_required() ) : ?>
<P><?php _e('Enter your password to view comments.'); ?></P>
<?php return; endif; ?>

<H3 STYLE="margin-top: 0" ID="comments"><?php comments_number('Kommentare', '1 Kommentar', '% Kommentare'); ?>
<?php if ( comments_open() ) : ?>
	<A HREF="#postcomment" TITLE="<?php _e("Leave a comment"); ?>">&raquo;</A>
<?php endif; ?>
</H3>

<?php if ( $comments ) : ?>
<OL ID="commentlist">

<?php foreach ($comments as $comment) : ?>
	<LI <?php comment_class(); ?> ID="comment-<?php comment_ID() ?>">
	<?php # echo get_avatar( $comment, 32 ); ?>
	<?php comment_text() ?>
	<ADDRESS><?php comment_type('', 'Trackback:', 'Pingback:') ?> <?php comment_author_link() ?>, <?php comment_date() ?> <?php comment_time() ?> Uhr <A HREF="#comment-<?php comment_ID() ?>" TITLE="Permalink zu diesem Kommentar">#</A> <?php edit_comment_link('[bearbeiten]', ' · '); ?></ADDRESS>
	</LI>

<?php endforeach; ?>

</OL>

<?php elseif ( comments_open() ) : // If there are no comments yet ?>
	<P><?php _e('No comments yet.'); ?></P>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<P><A HREF="<?php echo get_post_comments_feed_link() ?>/atom" TYPE="application/atom+xml" TITLE="Kommentare-Feed zu diesem Artikel (Atom 1.0)">Kommentare abonnieren</A></P>

<h4 id="postcomment">Kommentar schreiben</h4>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
<?php else : ?>

<FORM ACTION="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" METHOD="post" ID="commentform">

<?php if ( $user_ID ) : ?>

<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>

<?php else : ?>

<?php if (! $req) echo '<P>Alle Angaben sind freiwillig.</P>'; ?>

<P><LABEL><INPUT TYPE="text" NAME="author" VALUE="<?php echo $comment_author; ?>" SIZE="22" TABINDEX="1"> Name</LABEL></P>

<P><LABEL><INPUT TYPE="text" NAME="email" VALUE="<?php echo $comment_author_email; ?>" SIZE="22" TABINDEX="2"> E-Mail (wird nicht veröffentlicht)</LABEL></P>

<P><LABEL><INPUT TYPE="text" NAME="url" VALUE="<?php echo $comment_author_url; ?>" SIZE="22" TABINDEX="3"> URL (optional)</LABEL></P>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p>-->

<P><TEXTAREA NAME="comment" COLS="70" ROWS="7" TABINDEX="4"></TEXTAREA></P>

<P><INPUT TYPE="submit" TABINDEX="5" VALUE="<?php echo esc_attr(__('Submit Comment')); ?>">
<INPUT TYPE="hidden" NAME="comment_post_ID" VALUE="<?php echo $id; ?>">

<?php do_action('comment_form', $post->ID); ?>

</FORM>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<P>Kommentare sind geschlossen.</P>
<?php endif; ?>
