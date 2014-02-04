<?php
/**
 * castroytagle functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, castroytagle_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'castroytagle_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run castroytagle_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'castroytagle_setup' );

if ( ! function_exists( 'castroytagle_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override castroytagle_setup() in a child theme, add your own castroytagle_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	// Create Theme Logotype Options Page
    require_once ( get_template_directory() . '/theme-admin/theme-options.php' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'castroytagle', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'castroytagle' ),
	) );
	
	register_nav_menus( array(
		'secondary' => __( 'Secondary Navigation', 'castroytagle' ),
	) );
	
	// This theme allows users to set a custom background
	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) 
     	add_theme_support( 'custom-background' ); 
    else
	add_custom_background( $args );
	
	// This theme allows users to set a custom header
	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) )
		add_theme_support( 'custom-header' );
	else
		add_custom_image_header( $args );
		
	$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/back/back.jpg',
	'random-default'         => false,
	'width'                  => 1200,
	'height'                 => 800,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );
	}
endif;

if ( ! function_exists( 'castroytagle_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in castroytagle_setup().
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function castroytagle_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'castroytagle' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'castroytagle' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'castroytagle' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'castroytagle_filter_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'castroytagle_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function castroytagle_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'castroytagle_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function castroytagle_continue_reading_link() {
	return;
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and castroytagle_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function castroytagle_auto_excerpt_more( $more ) {
	return ' &hellip;' . castroytagle_continue_reading_link();
}
add_filter( 'excerpt_more', 'castroytagle_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function castroytagle_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= castroytagle_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'castroytagle_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function castroytagle_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'castroytagle_remove_gallery_css' );

if ( ! function_exists( 'castroytagle_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own castroytagle_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">dice:</span>', 'castroytagle' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'castroytagle' ); ?></em>
				<br />
			<?php endif; ?>
			<footer class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'castroytagle' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'castroytagle' ), ' ' );
				?>
			</footer><!-- .comment-meta .commentmetadata -->
			<div class="comment-body"><?php comment_text(); ?></div>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-##  -->
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'castroytagle' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'castroytagle'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override castroytagle_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function castroytagle_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'castroytagle' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Main Sidebar Widget', 'castroytagle' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'castroytagle' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'castroytagle' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );


}
/** Register sidebars by running castroytagle_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'castroytagle_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'castroytagle_remove_recent_comments_style' );

if ( ! function_exists( 'castroytagle_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_posted_on() {
	// BP: slight modification to Twenty Ten function, converting single permalink to multi-archival link
	// Y = 2012
	// F = September
	// m = 01–12
	// j = 1–31
	// d = 01–31
printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'castroytagle' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'castroytagle' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'castroytagle_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function castroytagle_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s.', 'castroytagle' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s.', 'castroytagle' );
	} else {
		$posted_in = __( 'Bookmark the <a href="/%3$s/" rel="bookmark">permalink</a>.', 'castroytagle' );
	}

	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*	Begin castroytagle */
	// Add Admin
		require_once(TEMPLATEPATH . '/theme-admin/general-options.php');

	// remove version info from head and feeds (http://digwp.com/2009/07/remove-wordpress-version-number/)
		function castroytagle_complete_version_removal() {
			return '';
		}
		add_filter('the_generator', 'castroytagle_complete_version_removal');
/*	End castroytagle */

// change Search Form input type from "text" to "search" and add placeholder text
	function castroytagle_search_form ( $form ) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
		<input type="search" placeholder="Search for..." value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
		</div>
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'castroytagle_search_form' );

// added per WP upload process request
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/**
 *  Adds excerpt on pages
 */
 
add_post_type_support( 'page', 'excerpt');



/**
********************* Post Custom Project*****************
*/
 
add_action('init', 'project_register');
 
function project_register () {
 
$labels = array(
'name' => _x('Proyectos en Venta', 'post type general name'),
'singular_name' => _x('Proyecto', 'post type singular name'),
'add_new' => _x('Añadir nuevo proyecto', 'proyecto item'),
'add_new_item' => __('Añadir nuevo proyecto'),
'edit_item' => __('Editar proyecto'),
'new_item' => __('Nueva proyecto'),
'view_item' => __('Ver proyecto'),
'search_items' => __('Buscar proyecto'),
'not_found' => __('No se ha encontrado nada'),
'not_found_in_trash' => __('No se ha encontrado nada en la papelera'),
'parent_item_colon' => ''
);
 
$args = array(
'labels' => $labels,
'public' => true,
'has_archive' => true,
'publicly_queryable' => true,
'show_ui' => true,
'query_var' => true,
'rewrite' => array('slug' => 'ciudades'),
'capability_type' => 'page',
'hierarchical' => false,
'menu_position' => null,
'supports' => array('title','editor','thumbnail','excerpt', 'page-attributes'),
'menu_icon'            => get_template_directory_uri() . '/images/elements/house.png'
);
 
     register_post_type( 'projectsale', $args );
     flush_rewrite_rules();
}

/**
********************* Custom Taxonomy Project Sale*****************
*/
add_action( 'init', 'create_book_tax', 0 );

function create_book_tax() {

	$labels = array(
		'name'                       => _x( 'Tipos en Venta', 'Taxonomy General Name', 'castroytagle' ),
		'singular_name'              => _x( 'Tipo', 'Taxonomy Singular Name', 'castroytagle' ),
		'menu_name'                  => __( 'Tipos de Propiedad', 'castroytagle' ),
		'all_items'                  => __( 'Todos los tipos', 'castroytagle' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'types', 'projectsale', $args );

}

add_action( 'init', 'create_book_city', 0 );

function create_book_city() {

	$labels = array(
		'name'                       => _x( 'Ciudades', 'Taxonomy General Name', 'castroytagle' ),
		'singular_name'              => _x( 'Ciudad', 'Taxonomy Singular Name', 'castroytagle' ),
		'menu_name'                  => __( 'Ciudades', 'castroytagle' ),
		'all_items'                  => __( 'Todas las ciudades', 'castroytagle' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'cities', 'projectsale', $args );

}

/**
********************* Post Custom Project Ready *****************
*/
 
add_action('init', 'project_register_two');
 
function project_register_two () {
 
$labels = array(
'name' => _x('Proyectos Realizados', 'post type general name'),
'singular_name' => _x('Proyecto', 'post type singular name'),
'add_new' => _x('Añadir nuevo proyecto', 'proyecto item'),
'add_new_item' => __('Añadir nuevo proyecto'),
'edit_item' => __('Editar proyecto'),
'new_item' => __('Nueva proyecto'),
'view_item' => __('Ver proyecto'),
'search_items' => __('Buscar proyecto'),
'not_found' => __('No se ha encontrado nada'),
'not_found_in_trash' => __('No se ha encontrado nada en la papelera'),
'parent_item_colon' => ''
);
 
$args = array(
'labels' => $labels,
'public' => true,
'has_archive' => true,
'publicly_queryable' => true,
'show_ui' => true,
'query_var' => true,
'capability_type' => 'page',
'hierarchical' => false,
'menu_position' => null,
'supports' => array('title','editor','thumbnail','excerpt', 'page-attributes'),
'menu_icon'            => get_template_directory_uri() . '/images/elements/house.png'
);
 
     register_post_type( 'projectready', $args );
     flush_rewrite_rules();
}

/**
********************* Custom Taxonomy Project Ready*****************
*/
add_action( 'init', 'create_book_tax_two', 0 );

function create_book_tax_two() {

	$labels = array(
		'name'                       => _x( 'Tipos Realizados', 'Taxonomy General Name', 'castroytagle' ),
		'singular_name'              => _x( 'Tipo', 'Taxonomy Singular Name', 'castroytagle' ),
		'menu_name'                  => __( 'Tipos de Propiedad', 'castroytagle' ),
		'all_items'                  => __( 'Todos los tipos', 'castroytagle' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'types_two', 'projectready', $args );

}

/**
********************* Custom Taxonomy Project Ready*****************
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
//get the name "[posttitle mypagelink] en mensaje [_post_title]"
	function wpcf7_postlink_shortcode_handler( $tag ) {
		global $wpcf7_contact_form;
		global $wpdb;
		
		if ( ! is_array( $tag ) )
			return '';
			
			$type = $tag['type'];
			$name = $tag['name'];
			
			$post = get_the_ID();
			
			$querystr = "SELECT * FROM $wpdb->posts WHERE ID = $post ";
			$pageposts = $wpdb->get_row($querystr, ARRAY_A);
			
			$html = '<input type="text" name="'. $name .'" value="'.$pageposts['post_title'].'" />';
			
			$html = $pageposts['post_title'];
			return $html;
	}
	
	wpcf7_add_shortcode( 'posttitle', 'wpcf7_postlink_shortcode_handler', true );
	
	function wpcf7_postlink_validation_filter( $result, $tag ) {
		global $wpcf7_contact_form;
		
		$type = $tag['type'];
		$name = $tag['name'];
		
		return $result;
	}
	
	add_filter( 'wpcf7_validate_pagelink', 'wpcf7_pagelink_validation_filter', 10, 2 );
}

/**** Admin menu custom************/
$editor = get_role('editor');
// add $cap capability to this role object
$editor->add_cap('edit_theme_options');
$editor->remove_cap('manage_links');

function edit_admin_menus() {
	global $menu;

	remove_menu_page('edit-comments.php'); // Remove the Tools Menu
	remove_menu_page('edit.php'); // Remove the Tools Menu
}
add_action( 'admin_menu', 'edit_admin_menus' );

?>