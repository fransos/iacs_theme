<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package iacs
 */

?>

<label for="toggle-mobile-menu" id="menu-icon" class="menu-toggle">
  <div></div>
  <div></div>
  <div></div>
</label>
<input id="toggle-mobile-menu" type="checkbox" />

<aside id="sidebar" class="widget-area">
  <div class="vl"></div>

  <div id="logo_text_vert">
    <img
      src="<?php
      echo get_bloginfo('template_url') ?>/img/logo_text_vert.png"
      alt="text-part of IACS-logo">
  </div>

  <?php
    wp_nav_menu( array(
      'theme_location' => 'sidebar-menu',
      'menu_id'        => 'sidebarmenu',
      'walker'  => new Walker_Quickstart_Menu() //use our custom walker
    ) );
  ?>
  <div id="iugg_logo_complete">
    <img
      src="<?php
      echo get_bloginfo('template_url') ?>/img/iugg_logo_complete.png"
      alt="Oficial IUGG logo">
  </div>
</aside><!-- #secondary -->
