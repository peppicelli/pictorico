<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Pictorico
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-header-inner">
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><span class="screen-reader-text"><?php _e( 'Menu', 'pictorico' ); ?></span></h1>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'pictorico' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<div class="social-media">
            	<a id="twitter" target="_blank" href="<?php echo get_theme_mod('twitter_url', 'https://twitter.com'); ?>"><i class="fa fa-twitter fa-1x"></i></a>
            	<a id="instagram" target="_blank" href="<?php echo get_theme_mod('instagram_url', 'https://instagram.com'); ?>"><i class="fa fa-instagram fa-1x"></i></a>
            	<a id="youtube" target="_blank" href="<?php echo get_theme_mod('youtube_url', 'https://youtube.com'); ?>"><i class="fa fa-youtube fa-1x"></i></a>
            	<a href="mailto:<?php echo get_bloginfo ( 'admin_email' ); ?>"><i class="fa fa-envelope-o fa-1x"></i></a>
            </div>
		</div>
	</header><!-- #masthead -->
	<?php if ( is_home() && pictorico_has_featured_posts( 1 ) ) : ?>
		<?php get_template_part( 'content', 'featured' ); ?>
	<?php elseif ( get_header_image() && ( is_home() || is_archive() || is_search() ) ) : ?>
		<div class="hentry has-thumbnail">
			<div class="entry-header">
				<div class="header-image" style="background-image: url(<?php header_image(); ?>)">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="overlay overlay-hugeinc">
		<button type="button" class="overlay-close">Close</button>
	</div>
	<div id="content" class="site-content">