<?php
/**
 * Template part for displaying the right hand sidebar
 *
 *
 *
 * @package iacs
 */

$page_cat = the_title('', '', false);
$catexists = term_exists($page_cat, 'category'); // returns the cat name if it exists
$has_cat = (0 !== $catexists && null !== $catexists);

if ( $has_cat ): ?>
  <aside id="rh_sidebar">
    <div class="news">
    <?php

    $query_cat = $page_cat;

    $wp_query = new WP_Query( array(
              'post_type' => 'post',
              'category_name' => $query_cat
          ) );

    if ( $wp_query->have_posts() ) {
  	  // The 2nd Loop
  	  while ( $wp_query->have_posts() ) {
    		$wp_query->the_post(); ?>
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>
        <hr>
    	<?php }

  	  // Restore original Post Data
  	  wp_reset_postdata();
    }
    ?>

    </div>
  </aside>
<?php endif; ?>
