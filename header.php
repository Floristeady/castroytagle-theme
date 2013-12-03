<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * boilerplate_filter_wp_title() in functions.php.
			 */
			wp_title( '|', true, 'right' );
		?></title>
			
	    <meta name="description" content="<?php echo '' . get_bloginfo ( 'description' );  ?>">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fontello.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css" />
	    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		
<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>
	
		<div class="clearfix" id="container">
				
			<header id="header" role="banner">
				<div class="inner">
				
				<?php global $castroytagle_options;
					$castroytagle_settings = get_option( 'castroytagle_options', $castroytagle_options ); ?>
					
				<div id="site-title">
				
				<?php if( $castroytagle_settings['custom_logo'] ) : ?>
					<h1><a href="<?php echo bloginfo('url'); ?>" class="logo"><img src="<?php echo $castroytagle_settings['custom_logo']; ?>" alt="<?php bloginfo('name'); ?>" /> </a></h1>
				<?php  else : ?>
					<h1><a href="<?php echo bloginfo('url'); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif; ?>
			  
					<h2><?php bloginfo( 'description' ); ?></h2>
				</div>
				
				<nav id="access" role="navigation" class="clearfix">
				  	<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #access -->
				
				<?php get_sidebar('contact'); ?>
				</div>
			</header>

			<section id="main" role="main">
			