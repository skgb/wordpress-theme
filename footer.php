<?php
/*
 * $Id$
 * SKGB-Web 5.0d
 */
?>
<!-- begin footer -->
<?php wp_footer(); ?>

</DIV>

<?php get_sidebar(); ?>

<DIV ID="layout-footer">

<P ID="copyright">© 1999–2010 <ABBR TITLE="Segel- und Kanugemeinschaft Bruchertalsperre e. V.">SKGB</ABBR> · <A HREF="mailto:info&#064;skgb.de">info&#064;skgb.de</A> · <?php wp_register('', ' ·'); ?> <?php wp_loginout(); ?>


</DIV>

<!-- <?php echo __('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?> -->

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->

<?php
if (defined('SAVEQUERIES') && SAVEQUERIES && $wpdb->queries && current_user_can('level_10')) {
	echo "<!--\n";
	print_r($wpdb->queries);
	$totaltime = 0;
	foreach ($wpdb->queries as $query) {
		$totaltime += $query[1];
	}
	echo "Total Database Time: $totaltime\n-->";
}

if (defined('SB_TIMING') && SB_TIMING) {
	global $SB_timingStartTime;
	printProfilingEstimate($SB_timingStartTime, 'template');
}

?>
