<?php
/**
 * @package Pictorico
 */

$format = get_post_format();
$formats = get_theme_support( 'post-formats' );
$postclass = 'animate zoomIn';

if ( ! has_post_thumbnail() )
	$postclass .= ' no-thumbnail';
?>
 <?php echo pictorico_get_marker_add(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $postclass ); ?> <?php echo pictorico_get_map_actions(); ?>>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'pictorico-home' ); ?>
		<?php endif; ?>
		</a>
	</div>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php pictorico_date(); ?>
		</div><!-- .entry-meta -->
		<a class="entry-format" title="<?php echo the_title_attribute(); ?>"><span class="screen-reader-text"><?php echo get_post_format_string( $format ); ?></span></a>
		<?php endif; ?>

		<?php 	// Remove the widont filter because of the limited space for entry titles.
			$restore_widont = remove_filter( 'the_title', 'widont' );
		?>

		<?php   // Get the country code if any.
			$country_flag_html = "";
			if (array_key_exists('country', get_post_custom())) {
				$country_flag_html = '<span class="flag-icon flag-icon-'.get_post_custom()['country'][0].'"></span>';
			}

		 ?>

		<?php if ( 'link' == $format ) : ?>
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( pictorico_get_link_url() ) . '" rel="bookmark">', $country_flag_html.'</a></h1>' ); ?>
		<?php else : ?>
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', $country_flag_html.'</a></h1>' ); ?>
		<?php endif; ?>

		<?php 	// If the widont filter is successfully removed add it back for the rest of the blog.
				if ( $restore_widont ) {
					add_filter( 'the_title', 'widont' );
				}
		?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'pictorico' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
