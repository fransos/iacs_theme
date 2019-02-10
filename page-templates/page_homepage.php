<?php
/**
 * Template Name: homepage
 *
 * @package iacs
 */
?>

<?php
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main homepage">


		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.

    get_template_part( 'template-parts/rhsidebar' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
