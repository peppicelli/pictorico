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
				<h1 class="site-title"><img class="site-title" src="<?php echo get_bloginfo('template_directory');?>/world.gif"/><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><span class="screen-reader-text"><?php _e( 'Menu', 'pictorico' ); ?></span></h1>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'pictorico' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
			<div class="social-media">
                <a id="twitter" target="_blank" href="<?php echo get_theme_mod('twitter_url', 'https://twitter.com'); ?>"><i class="fa fa-twitter fa-1x"></i></a>
                <a id="flickr" target="_blank" href="<?php echo get_theme_mod('flickr_url', 'https://flickr.com'); ?>"><i class="fa fa-flickr fa-1x"></i></a>
                <a id="youtube" target="_blank" href="<?php echo get_theme_mod('youtube_url', 'https://youtube.com'); ?>"><i class="fa fa-youtube fa-1x"></i></a>
                <a href="mailto:<?php echo get_bloginfo ( 'admin_email' ); ?>"><i class="fa fa-envelope-o fa-1x"></i></a>
            </div>
            <div class="languages">
            <?php
            global $polylang;
            foreach ($polylang->get_languages_list() as $language) {
                $url = esc_url($polylang->get_translation_url($language));
                $language = esc_js($language->slug);
                $active = (pll_current_language('slug') == $language) ? 'class="active"' : '';
                echo '<a href="'.$url.'" '.$active.'>'.$language.'</a>';
            }
            ?>
            </div>
		</div>
	</header><!-- #masthead -->
	<?php
	if (function_exists('get_custom_title')) {
		pictorio_get_header_with_title(get_custom_title());
	}
	else {
		pictorio_get_header_with_title();
	}
	?>
	<div class="overlay overlay-hugeinc">
		<h1 id="overlay-title">Title</h1>
		<span class="fa fa-times fa-2x overlay-close"></span>
		<div class="overlay-container"></div>
		<h2 id="overlay-link" class="overlay-link"></h2>
	</div>
	<div id="content" class="site-content">
