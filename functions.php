<?php
/**
 * iacs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package iacs
 */

if ( ! function_exists( 'iacs_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function iacs_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on iacs, use a find and replace
		 * to change 'iacs' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'iacs', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'iacs' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'iacs_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'iacs_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function iacs_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'iacs_content_width', 640 );
}
add_action( 'after_setup_theme', 'iacs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function iacs_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'iacs' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'iacs' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'iacs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function iacs_scripts() {
	wp_enqueue_style( 'iacs-style', get_stylesheet_uri() );

	wp_enqueue_script( 'iacs-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'iacs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'iacs_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register menus
 */
 // This theme uses wp_nav_menu() in 1 loction
 register_nav_menus( array(
   'sidebar-menu' => esc_html__( 'sidebar menu', 'iacs' )
 ) );



 class Walker_Quickstart_Menu extends Walker {

     // Tell Walker where to inherit it's parent and id values
     var $db_fields = array(
         'parent' => 'menu_item_parent',
         'id'     => 'db_id'
     );

     /**
      * At the start of each element, output a <li> and <a> tag structure.
      *
      * Note: Menu objects include url and title properties, so we will use those.
      */
     function start_lvl( &$output, $depth = 0, $args = array() ) {
       $output .= sprintf( "\n%s\n",
         '<ul class="submenu">'
       );
     }
     function end_lvl( &$output, $depth = 0, $args = array() ) {
       $output .= sprintf( "\n%s\n",
         '</ul>'
       );
     }
     function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
         $object_id=$item->object_id;
         $is_parent_item=in_array("menu-item-has-children", $item->classes);//( $depth === 0 );
         $output .= sprintf( "\n<li class='%s%s'>%s<%s>%s</%s>\n",
             ( $object_id == get_the_ID() ) ? 'current' : '',
             ( $object_id == wp_get_post_parent_id(get_the_ID())) ? 'current-top' : '',
						 $is_parent_item ? "<input id='$object_id' type='checkbox'>" : '',
             $is_parent_item ? "label for='$object_id'" : "a href='$item->url' ",
             $item->title,
             $is_parent_item ? 'label' : 'a'
         );
     }

     function end_el( &$output, $object, $depth = 0, $args = array() ) {
       $is_parent_item=( $depth === 0 );
       $output .= sprintf( "\n%s\n",
         '</li>'
       );
     }

 }

 add_filter( 'user_can_richedit' , '__return_false', 50 );

 add_filter( 'pdb-private_id_length', function ( $length ) { return 9; } );

 // Add a custom post type called people
function iacs_carte_metaboxes()
{
	add_meta_box(
		'iacs_carte_metaboxes_html',
		'Card values',
		'iacs_carte_metaboxes_html',
		'iacs_carte-de-visite',
		'normal',
		'high'
	);
}

function iacs_carte_metaboxes_html() {
	global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'event_fields' );
	// Get the location data if it's already been entered
	$name = get_post_meta( $post->ID, 'iacscarte_name', true );
	$title = get_post_meta( $post->ID, 'iacscarte_title', true );
	$institute = get_post_meta( $post->ID, 'iacscarte_institute', true );
	$address = get_post_meta( $post->ID, 'iacscarte_address', true );
	$email = get_post_meta( $post->ID, 'iacscarte_email', true );
	$niceweb = get_post_meta( $post->ID, 'iacscarte_niceweb', true );
	$web = get_post_meta( $post->ID, 'iacscarte_web', true );
	$slug = get_post_meta( $post->ID, 'iacscarte_slug', true );
	// Output the field
	echo '<strong>Name:</strong><input type="text" name="iacscarte_name" value="' . esc_textarea( $name )  . '" class="widefat">';
	echo '<strong>Title:</strong><input type="text" name="iacscarte_title" value="' . esc_textarea( $title )  . '" class="widefat">';
	echo '<strong>Institute:</strong><input type="text" name="iacscarte_institute" value="' . esc_textarea( $institute )  . '" class="widefat">';
	echo '<strong>Address:</strong><textarea name="iacscarte_address" rows="3" " class="widefat">' . esc_textarea( $address )  . '</textarea>';
	echo '<strong>E-mail:</strong><input type="text" name="iacscarte_email" value="' . esc_textarea( $email )  . '" class="widefat">';
	echo '<strong>Display Web:</strong><input type="text" name="iacscarte_niceweb" value="' . esc_textarea( $niceweb )  . '" class="widefat">';
	echo '<strong>Web:</strong><input type="text" name="iacscarte_web" value="' . esc_textarea( $web )  . '" class="widefat">';
  echo '<strong>URL slug:</strong><input type="text" name="iacscarte_slug" value="' . esc_textarea( $slug )  . '" class="widefat">';
  echo '<p></p>'; echo 'Permalink: <strong>' . get_permalink() . '</strong>';
}

function iacs_save_meta( $post_id, $post ) {
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['iacscarte_name'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta = array(
		'iacscarte_name' => esc_textarea( $_POST['iacscarte_name'] ),
		'iacscarte_title' => esc_textarea( $_POST['iacscarte_title'] ),
		'iacscarte_institute' => esc_textarea( $_POST['iacscarte_institute'] ),
		'iacscarte_address' => esc_textarea( $_POST['iacscarte_address'] ),
		'iacscarte_email' => esc_textarea( $_POST['iacscarte_email'] ),
		'iacscarte_niceweb' => esc_textarea( $_POST['iacscarte_niceweb'] ),
		'iacscarte_web' => esc_textarea( $_POST['iacscarte_web'] ),
		'iacscarte_slug' => esc_textarea( $_POST['iacscarte_slug'] )
	);
	// Cycle through the $events_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $events_meta as $key => $value ) :
		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'iacs_save_meta', 1, 2 );

function iacs_custom_post_type()
{
    register_post_type('iacs_carte-de-visite',
                       array(
                           'labels'  => array(
                               'name'          => __('Cartes de visite'),
                               'singular_name' => __('Carte de visite'),
                           ),
                           'public'      => true,
													 'supports' => array('title' => 'false',
												                        'editor' => 'false',
																							  'thumbnail'),
													 'menu_icon'   => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" id="svg8" version="1.1" viewBox="0 0 5.2916665 5.2916668" height="20" width="20"> <defs id="defs2" /> <metadata id="metadata5"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" /> <dc:title></dc:title> </cc:Work> </rdf:RDF> </metadata> <g transform="translate(0,-291.70832)" id="layer1"> <path id="rect30" d="m 0.00137663,293.626 0.58107081,2.57098 4.70746266,-1.09256 -0.5810708,-2.57098 z m 2.92107377,-0.3427 c 0.08143,-0.0189 0.1620419,-0.0253 0.2421698,-0.0198 0.080152,0.006 0.1601093,0.0236 0.2394579,0.0532 l 0.086667,0.38348 c -0.083365,-0.0443 -0.1621574,-0.0724 -0.2362749,-0.0849 -0.074111,-0.0124 -0.1483851,-0.01 -0.2232953,0.008 -0.1341946,0.0311 -0.2274267,0.1104 -0.2796022,0.2375 -0.052173,0.12712 -0.056848,0.28648 -0.01344,0.47854 0.04322,0.19123 0.1158465,0.33252 0.2174151,0.42397 0.1015676,0.0915 0.2195383,0.12165 0.3537353,0.0905 0.07496,-0.017 0.1428378,-0.048 0.2042287,-0.0918 0.061391,-0.0438 0.1202379,-0.10398 0.1762825,-0.1806 l 0.086666,0.38346 c -0.058766,0.0615 -0.1230696,0.11293 -0.1927465,0.1535 -0.069681,0.0406 -0.1450921,0.0701 -0.2265222,0.089 -0.2429833,0.0565 -0.4551218,0.0151 -0.636059,-0.12425 -0.1811193,-0.14007 -0.3049054,-0.35802 -0.3717012,-0.65356 -0.066983,-0.29636 -0.049144,-0.54719 0.053954,-0.75233 0.1029099,-0.20599 0.2760866,-0.33697 0.5190749,-0.39335 z m 1.1324284,-0.26284 c 0.080111,-0.0187 0.1641231,-0.0294 0.2522694,-0.0341 0.088073,-0.005 0.1808261,-0.003 0.2783033,0.008 l 0.088702,0.39246 c -0.090421,-0.027 -0.1762396,-0.0435 -0.257699,-0.0489 -0.081458,-0.006 -0.1561717,-1.6e-4 -0.2239283,0.0155 -0.089878,0.0211 -0.1527771,0.0517 -0.18866,0.0931 -0.035883,0.0415 -0.046411,0.0953 -0.031447,0.16146 0.011219,0.0497 0.034474,0.0856 0.069495,0.10709 0.03549,0.0205 0.093356,0.0318 0.1740668,0.034 l 0.1696513,0.004 c 0.1715617,0.004 0.3009218,0.0403 0.388413,0.10889 0.087489,0.0686 0.1490418,0.18025 0.1842177,0.33589 0.046214,0.20447 0.032795,0.36787 -0.040327,0.49026 -0.07266,0.12142 -0.2070517,0.2052 -0.4031355,0.25072 -0.092516,0.0214 -0.1876999,0.0317 -0.2858924,0.0311 -0.098205,-7.1e-4 -0.1990322,-0.0118 -0.3021053,-0.0342 l -0.091276,-0.40384 c 0.1073796,0.0413 0.2082014,0.0678 0.30214,0.0801 0.094405,0.0112 0.1820471,0.008 0.2628301,-0.0111 0.082089,-0.019 0.1409304,-0.051 0.1767241,-0.0959 0.035794,-0.0449 0.046445,-0.0994 0.031846,-0.16404 -0.013098,-0.058 -0.038146,-0.0992 -0.075221,-0.12372 -0.036427,-0.0247 -0.1017774,-0.0395 -0.1959904,-0.0438 l -0.1551478,-0.007 c -0.1549015,-0.006 -0.275974,-0.0445 -0.3633691,-0.11571 -0.086744,-0.0713 -0.1466462,-0.18054 -0.1799497,-0.32789 -0.041723,-0.18462 -0.026872,-0.3377 0.044484,-0.45881 0.071355,-0.12112 0.1950782,-0.20191 0.3709669,-0.24274 z m -3.77557628,0.9117 0.37607734,-0.0872 0.41898344,1.85383 -0.37607722,0.0872 z m 0.93784448,-0.21766 0.448569,-0.10415 0.9592388,1.72844 -0.3779463,0.0877 -0.1685301,-0.31658 -0.5879705,0.13642 -0.016699,0.35957 -0.3779463,0.0877 z m 0.323228,0.38245 -0.033973,0.78411 0.3999255,-0.0929 z" style="fill:#000000;fill-opacity:1;stroke:none;stroke-width:0.24732614" /> </g></svg>'
                           ),
													 'register_meta_box_cb' => 'iacs_carte_metaboxes'
                        ));
}
add_action('init', 'iacs_custom_post_type');

function modify_post_title( $data )
{
	if($data['post_type'] == 'iacs_carte-de-visite')
	{
		if (isset($_POST['iacscarte_name']))
		{
			$data['post_title'] = $_POST['iacscarte_name'];
		}
		if (isset($_POST['iacscarte_slug']))
		{
			$data['post_name'] = $_POST['iacscarte_slug'];
		}
	}
	return $data;
}
add_filter( 'wp_insert_post_data' , 'modify_post_title' , '99', 1 ); // Grabs the inserted post data so you can modify it.

// Remove unnessesary menu items from wp-admin
function custom_menu_page_removing() {
	remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'edit-comments.php' );          //Comments
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

function custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the mimes array as below
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
    return $existing_mimes;
}
add_filter('upload_mimes', 'custom_upload_mimes');
