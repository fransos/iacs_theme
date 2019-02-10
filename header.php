<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package iacs
 */

?>
<!doctype html>
<html <?php
$bgcolor = esc_html(get_post_custom_values('page_color')[0]);
$style = "style=\"";

if ($bgcolor!='') { // if not empty
  $style = $style."--contentbg:".$bgcolor.";";
}

$textcolor = esc_html(get_post_custom_values('text_color')[0]);
if ($textcolor!='') {
	$style = $style."--textcolor:".$textcolor.";";
}

$style = $style."\"";
echo $style;

language_attributes(); ?>
>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

	<?php wp_head();
  /*$captcha = esc_html(get_post_custom_values('activate_recaptcha')[0]);
  if ($captcha=='true') : ?>
    <script src='https://www.google.com/recaptcha/api.js?render=6LfLnooUAAAAAOmJcxh2BVFqP_-200D2l7hHzYF9'></script>
  <?php endif; */?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

  <?php get_sidebar(); ?>

	<header id="masthead" class="site-header">
		<div class="site-branding">
      <div class="site-banner" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		    <div class="banner-img"> <?php the_header_image_tag();?> </div>
        <div id="another_logo">
          <img
          src="<?php
          echo get_bloginfo('template_url') ?>/img/logo_iugg.png"
          alt="IUGG-logo"></div>
        <div class="banner-logo"> <?php
				// The logo consists of 3 parts
        // part 3 in sidebar.php?>

				<a href="<?php get_home_url(); ?>" class="custom-logo-link"
				  rel="home" itemprop="url">
					<img src="<?php
					     echo get_bloginfo('template_url') ?>/img/logo_ice.png"
					     class="custom-logo"
							 alt="IACS" itemprop="logo"
							 ></a>

				<div id="logo_text_horiz">  <!-- 2. the horizontal text -->
			    <img
			      src="<?php
			      echo get_bloginfo('template_url') ?>/img/logo_text.png"
			      alt="text-part of IACS-logo">
			  </div>


				</div>
        <?php
  			$iacs_description = get_bloginfo( 'description', 'display' );
  			if ( $iacs_description || is_customize_preview() ) :
  				?>
  		  <div class="site-description outline"><?php echo $iacs_description;?></div>
  			<?php endif; ?>
      </div>

		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
