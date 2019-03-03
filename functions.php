<?php
/**
 * Chikorita157 Anime Blog 5.0 Theme
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Chikorita157 Anime Blog 5.0 Theme
 * @author  chikorita157
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Chikorita157 Anime Blog 5.0 Theme' );
define( 'CHILD_THEME_URL', 'https://chikorita157.com' );
define( 'CHILD_THEME_VERSION', '4.0' );

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
//require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
//require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
//require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style(
		'fonts',
		'//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700',
		array(),
		CHILD_THEME_VERSION
	);

	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'genesis-sample-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	wp_enqueue_script(
		'genesis-sample',
		get_stylesheet_directory_uri() . '/js/genesis-sample.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

}

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Adds support for HTML5 markup structure.
add_theme_support( 'html5', genesis_get_config( 'html5' ) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', genesis_get_config( 'accessibility' ) );

// Adds viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Adds custom logo in Customizer > Site Identity.
add_theme_support( 'custom-logo', genesis_get_config( 'custom-logo' ) );

// Renames primary and secondary navigation menus.
add_theme_support( 'genesis-menus', genesis_get_config( 'menus' ) );

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Removes header right widget area.
//unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header and front page breadcrumb settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	unset( $config['genesis']['sections']['genesis_breadcrumbs']['controls']['breadcrumb_front_page'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

add_filter('genesis_footer_backtotop_text', 'custom_footer_backtotop_text');

function custom_footer_backtotop_text($backtotop) {

    $backtotop = '[footer_backtotop] <br /> ' . get_num_queries() . ' queries : ' . timer_stop() . 's <img src="' .get_bloginfo('stylesheet_directory'). '/images/ninjask.png" alt="ninjask" style="height:12px;width:auto;" />';

    return $backtotop;

}


/**
 * Adds separate comment and trackback counts
 */

function commentCount($type = 'comments'){



	if($type == 'comments'):



		$typeSql = 'comment_type = ""';

		$oneText = '1 Comment';

		$moreText = '% Comments';

		$noneText = 'No Comments';



	elseif($type == 'pings'):



		$typeSql = 'comment_type != ""';

		$oneText = '1 Trackback';

		$moreText = '% Trackbacks';

		$noneText = 'No Trackbacks';



	elseif($type == 'trackbacks'):



		$typeSql = 'comment_type = "trackback"';

		$oneText = '1 Trackback';

		$moreText = '% Trackbacks';

		$noneText = 'No Trackbacks';



	elseif($type == 'pingbacks'):



		$typeSql = 'comment_type = "pingback"';

		$oneText = '1 Trackback';

		$moreText = '% Trackbacks';

		$noneText = 'No Trackbacks';



	endif;



	global $wpdb;



    $result = $wpdb->get_var('

        SELECT

            COUNT(comment_ID)

        FROM

            '.$wpdb->comments.'

        WHERE

            '.$typeSql.' AND

            comment_approved="1" AND

            comment_post_ID= '.get_the_ID()

    );



	if($result == 0):



		echo str_replace('%', $result, $noneText);



	elseif($result == 1): 



		echo str_replace('%', $result, $oneText);



	elseif($result > 1): 



		echo str_replace('%', $result, $moreText);



	endif;



}

/** Modify the author box title */

add_filter( 'genesis_author_box_title', 'child_author_box_title' );

function child_author_box_title() {

ob_start();

	the_author_posts_link();

$title = ob_get_clean();

$title = sprintf( '<strong>This post was handcrafted by…</strong><br /> %s - who has written <i><b>%s</b></i> posts.', $title, number_format_i18n( get_the_author_posts() ) );;

return $title;

}


add_action( 'genesis_before_comment_form', 'single_post_comment_policy' );

/**
 * Adding comment policy to single posts.
 *
 * @author Remkus de Vries
 * @link http://dev.studiopress.com/comment-policy-box.htm
 */

function single_post_comment_policy() {

    if ( is_single() ) {

    ?>

<?php if ( comments_open() ) : ?>

    <div class="comment-policy-box">

        <p class="comment-policy"><b>New Here?</b> Review the <a href="http://chikorita157.com/about/commenting-policy/">Commenting Policy</a> before adding a comment.</p>

    </div>

 <?php else : // comments are closed ?>

 <?php endif; ?>

    <?php

    }

}

add_filter('genesis_comment_form_args', 'custom_comment_form_args');

/**
 * Modify speak your mind text in comments
 *
 * @author Brian Gardner
 * @link http://dev.studiopress.com/modify-speak-your-mind.htm
 */

function custom_comment_form_args($args) {

    $args['title_reply'] = 'Leave a Comment';

    return $args;

}


/** Modify comments header text in comments */

add_filter('genesis_title_comments', 'custom_genesis_title_comments');

function custom_genesis_title_comments() {

	// Correctly present the respond link if comments are allowed

	if ( ( ! genesis_get_option( 'comments_posts' ) || ! comments_open() )) {

	$respond = '. Comments for this entry are closed.';

	}

	else {

	$respond = ' or <a href="#respond">add your own</a>.';

	}

    ob_start();

    	commentCount('comments');

    $title = ob_get_clean();

    $title = sprintf('<h3 class="headlinetext">%s… <span style="font-size:14px;"> read them%s</span></h3>', $title, $respond);

    return $title;

}

/** Modify trackbacks header text in comments */

add_filter( 'genesis_title_pings', 'custom_title_pings' );

function custom_title_pings() {

	ob_start();

	commentCount('pings'); 

	$title = ob_get_clean();

	$title = sprintf('<h3 class="headlinetext">%s</h3>', $title);

	return $title;

}

add_action('genesis_after_comment_form', 'custom_post_nav');

function custom_post_nav(){?>

    <div class="post-nav">

    <div class="prev-post-nav">

     <?php previous_post_link('<span class="prev">Previous Post:</span> %link', '%title'); ?>

    </div>

    <div class="next-post-nav">

 <?php next_post_link('<span class="next">Next Post:</span> %link', '%title'); ?>

    </div>

    </div>

<?php }

add_filter('genesis_search_text', 'custom_search_text');

/**
 * Customize search form text
 *
 * @author Brian Gardner
 * @link http://dev.studiopress.com/customize-search-form.htm
 */

function custom_search_text($text) {

    return esc_attr('Search');

}

/** Customize the post meta function */

add_filter('genesis_post_meta', 'post_meta_filter');

function post_meta_filter($post_meta) {

if (!is_page()) {

    $post_meta = '[post_categories]<br />[post_tags sep="," before="Tagged With: "]';

    return $post_meta;

}}

add_action( 'genesis_after_header', 'sk_blog_banner' );
/**
 * Full Width Banner Image on Posts page
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/
 */
function sk_blog_banner() { ?>

	<div class="blog-banner">
	<a href="/"><img src="<?php header_image(); ?>" alt="" /></a>
	</div>

	<?php
}

add_theme_support( 'custom-header', array(
	'header_image'    => '',
	'header-selector' => '.blog-banner a',
	'header-text'     => false,
	'height'          => 230,
	'width'           => 1140,
	'header-text'     => false,
) );

add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {

 $creds = '[footer_copyright first="2009"] James M. All rights reserved.<br />All text on this page is licensed under <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">CC BY-NC 4.0</a>.<br />This blog uses [footer_genesis_link] and <a href="http://wptouch.com/wptouch/">WPTouch Mobile Suite</a>. <a href="https://github.com/chikorita157/Chikorita157AnimeBlogTheme-5.0">Source Code</a><br /> ' . get_num_queries() . ' queries : ' . timer_stop() . 's <img src="' .get_bloginfo('stylesheet_directory'). '/images/espeon.png" alt="espeon" style="height:16px;width:auto;" />';

 return  $creds;

}

// First remove the genesis_default_list_comments function
remove_action( 'genesis_list_comments', 'genesis_default_list_comments' );
 
// Now add our own and specify our custom callback
add_action( 'genesis_list_comments', 'child_default_list_comments' );
function child_default_list_comments() {
 
    $args = array(
        'type'          => 'comment',
        'avatar_size'   => 54,
        'callback'      => 'child_comment_callback',
    );
 
    $args = apply_filters( 'genesis_comment_list_args', $args );
 
    wp_list_comments( $args );
 
}
 
// This is where you customize the HTML output
function child_comment_callback( $comment, $args, $depth ) {
 
    $GLOBALS['comment'] = $comment; ?>
 
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
         
        <?php do_action( 'genesis_before_comment' ); ?>
         
        <div class="comment-left">
 
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, $size = $args['avatar_size'] ); ?>
                <?php printf( __( '<cite class="fn">%s</cite> <span class="says">%s:</span>', 'genesis' ), get_comment_author_link(), apply_filters( 'comment_author_says_text', __( 'says', 'genesis' ) ) ); ?>
            </div><!-- end .comment-author -->
     
            <div class="comment-meta commentmetadata">
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'genesis' ), get_comment_date(), get_comment_time() ); ?></a>
<?php if (function_exists('comment_counter'))  {comment_counter('email','&bull; <span class="comment-counter">Magical Level: ','</span> ');} ?>
                <?php edit_comment_link( __( 'Edit', 'genesis' ), g_ent( '&bull; ' ), '' ); ?>
            </div><!-- end .comment-meta -->
             
        </div>
         
        <div class="comment-right">   
     
            <div class="comment-content">
                <?php if ($comment->comment_approved == '0') : ?>
                    <p class="alert"><?php echo apply_filters( 'genesis_comment_awaiting_moderation', __( 'Your comment is awaiting moderation.', 'genesis' ) ); ?></p>
                <?php endif; ?>
     
                <?php comment_text(); ?>
            </div><!-- end .comment-content -->
     
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
             
        </div>    
 
        <?php do_action( 'genesis_after_comment' );
 
    /** No ending </li> tag because of comment threading */
 
}

add_filter( 'genesis_ping_list_args', 'child_ping_list_args' );

/**
 * Take the existing arguments, and one that specifies a custom callback.
 *
 * @author Gary Jones
 * @link http://dev.studiopress.com/change-trackback-format.htm
 *
 * Tap into the list of arguments applied at genesis/lib/functions/comments.php:136
 * @param array $args
 * @return type
 */

function child_ping_list_args( $args ) {

    $args['callback'] = 'child_list_pings';

    return $args;

}


/**
 * Build how the trackbacks / pings will look.
 *
 * @author Gary Jones
 * @link http://dev.studiopress.com/change-trackback-format.htm
 *
 * @param mixed $comment
 * @param array $args
 * @param integer $depth
 */

function child_list_pings( $comment, $args, $depth ) {

    $GLOBALS['comment'] = $comment;

    ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

        <div id="comment-<?php comment_ID(); ?>">

            <div class="comment-author vcard">

                <?php echo get_avatar( $comment, $size = '48', $default = '<path_to_url>' ); ?>

                <?php printf( __( '<cite class="fn">%s</cite>' ), get_comment_author_link() ) ?>

            </div>

        </div>

    </li>

    <?php

}

