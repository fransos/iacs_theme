<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package iacs
 */

?>

<article id="post-<?php the_ID(); ?>" <?php
$usr_classes = get_post_custom_values('add_css_class')[0];
$usr_classes = explode(PHP_EOL, esc_html($usr_classes));
post_class($usr_classes);
?>>
	<header class="entry-header">
	</header><!-- .entry-header -->

	<?php iacs_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'iacs' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<?php if ( is_front_page() ): ?>
		<div id="twitter">
		<a class="twitter-timeline"
		   href="https://twitter.com/iacscryo?ref_src=twsrc%5Etfw"
			 data-tweet-limit="3"
			 data-chrome="nofooter, noborders, transparent, noscrollbar"
			 data-width="545px">
			 Tweets by iacscryo</a>
		<script async src="https://platform.twitter.com/widgets.js"
		        charset="utf-8"></script>
		</div>
	<?php endif; ?>

  <?php
	$hide_footer = esc_html(get_post_custom_values('hide_footer')[0]);
	if ($hide_footer!='true'): ?>
	<p id="footer_info">
	<?php
		$updated_date = '<strong>'.get_the_modified_time('F jS, Y').'</strong>';
		$updated_time = '<strong>'.get_the_modified_time('h:i a').'</strong>';
		echo 'Last updated on '. $updated_date . ' at '. $updated_time .' | ';
	?> <a href="mailto:webmaster@cryosphericsciences.org" target="_blank">IACS Webmaster</a></p>
<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
