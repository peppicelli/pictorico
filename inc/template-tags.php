<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pictorico
 */

if ( ! function_exists( 'pictorico_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function pictorico_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'pictorico' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'pictorico' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'pictorico' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pictorico_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function pictorico_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'pictorico' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav"></span> %title', 'Previous post link', 'pictorico' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav"></span>', 'Next post link',     'pictorico' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pictorico_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pictorico_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( '<span class="posted-on">%1$s</span><span class="byline"><span class="sep"> &bull; </span>%2$s</span>',
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

if ( ! function_exists( 'pictorico_date' ) ) :
/**
 * Prints HTML with date information
 */
function pictorico_date() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span>', 'pictorico' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pictorico_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'pictorico_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pictorico_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pictorico_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pictorico_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pictorico_categorized_blog.
 */
function pictorico_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'pictorico_categories' );
}
add_action( 'edit_category', 'pictorico_category_transient_flusher' );
add_action( 'save_post',     'pictorico_category_transient_flusher' );

/**
 * Returns the URL from the post.
 *
 * @uses get_the_link() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string URL
 */
function pictorico_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

function pictorico_get_video_url() {
	$content = get_the_content();

	if ( empty( $content ) ) {
		return false;
	}

	$lytes_regexp="/http(s|v):\/\/([a-zA-Z0-9\-\_]+\.|)(youtube|youtu)(\.com|\.be)\/embed\/(((watch(\?v\=|\/v\/)|.+?v\=|)([a-zA-Z0-9\-\_]{11}))|(playlist\?list\=([a-zA-Z0-9\-\_]*)))([^\s<]*)/";
	// https://www.youtube.com/embed/g0H_djP6mvY
	if ( preg_match($lytes_regexp, $content, $matches ) ) {
		return "https://www.youtube.com/embed/".$matches[9];
	}

	return false;
}

function pictorico_get_map_actions() {
	if (array_key_exists('longitude', get_post_custom()) &&
	    array_key_exists('latitude', get_post_custom())) {
		return "onmouseenter=\"activateMarker(".get_the_ID().");flyTo(".get_post_custom()['longitude'][0].",".get_post_custom()['latitude'][0].")\" onmouseleave=\"deactivateMarker(".get_the_ID().")\"";
	}
}

function get_url_from_post_type() {
	if (get_post_format() == "video") {
		return esc_url(pictorico_get_video_url());
	}
	else if (get_post_format() == "gallery") {
		return get_post_custom()['flickr gallery id'][0];
	}
	else {
		return get_permalink();
	}
}

function pictorico_get_marker_add() {
	if (array_key_exists('longitude', get_post_custom()) &&
	    array_key_exists('latitude', get_post_custom())) {
		return "<script type=\"text/javascript\">waitAndAddMarker(".get_post_custom()['longitude'][0].",".get_post_custom()['latitude'][0].",".get_the_ID().",'".get_post_format()."','".the_title_attribute(array( 'echo' => false ))."','".get_url_from_post_type()."','".get_permalink()."','".__( 'Leave a comment', 'pictorico' )."')</script>";
	}
}

function pictorico_get_videoclick() {
	if (get_post_format() == "video") {
		return "onclick=\"displayVideo('".esc_url(pictorico_get_video_url())."','".the_title_attribute(array( 'echo' => false ))."','".get_permalink()."','".__( 'Leave a comment', 'pictorico' )."')\"";
	}
}

function pictorico_get_flickrclick() {
	if (array_key_exists('flickr gallery id', get_post_custom())) {
		return "onclick=\"displayFlickrGallery('".get_post_custom()['flickr gallery id'][0]."','".the_title_attribute(array( 'echo' => false ))."','".get_permalink()."','".__( 'Leave a comment', 'pictorico' )."')\"";
	}
}

function pictorio_get_header_image() {
	$default = get_header_image();
	$headers = get_uploaded_header_images();
	if (is_404()) {
		return pictorio_find_special_header($default, $headers, '404');
	}
	elseif (is_search()) {
		return pictorio_find_special_header($default, $headers, 'search');
	}
	return $default;
}

function pictorio_find_special_header($default, $headers, $name) {
	foreach ( $headers as $header_key => $header ) {
        $header_alt_text = empty( $header['alt_text'] ) ? $header_desc : $header['alt_text'];
        if ($header_alt_text == $name) {
             return $header['url'];
        }
    }
    return $default;
}

function pictorio_get_header_with_title($title = '') {
	$title_html = '';
	if ($title != '') {
		$title_html = "<h1 class='entry-title'>".remove_accents($title)."</h1>";
	}

	if ( is_home() && pictorico_has_featured_posts( 1 ) ) {
		get_template_part( 'content', 'featured' );
	}
	elseif ( get_header_image()  && ( is_home() || is_archive()) || is_404() || is_search()) {
		?><div class="hentry has-thumbnail">
				<?php if ( is_home() || is_archive() ): ?>
					<div class="entry-header">
						<div class="header-image" style="background-image: url(<?php echo pictorio_get_header_image(); ?>); opacity:0.9">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a>
						</div>
						<?php echo $title_html; ?>
					</div>
					<div class="entry-map" id="map"></div>
					<script type="text/javascript">
						var now = new Date();
						var end = new Date('04/01/2016 10:1 AM');
						var distance = end - now;
						var days = Math.floor(distance / (1000 * 60 * 60 * 24));

						var messages = [
							"<h1><?php echo get_bloginfo( false, 'name' ) ?></h1>",
							"<h2><?php echo __( 'A video blog about our journey . . .', 'pictorico' ) ?></h2>",
							"<h2><?php echo __( '. . . from Turkey to Australia and farther', 'pictorico' ) ?></h2>",
							"<h1><?php echo __( 'Departure planned in', 'pictorico' ) ?> " + days + " <?php echo __( 'days', 'pictorico' ) ?></h1>",

						];
					</script>
					<div class="entry-text" id="entry-text"></div>
						<div class="entry-newsletter">
							<form action="<?php echo get_theme_mod('mailchimp_subscribe_url', ''); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<input type="email" placeholder="<?php echo __( 'Get regular news by email', 'pictorico' ) ?>" value="" name="EMAIL" class="required email" id="mce-EMAIL" size="25">
								<input type="submit" value="<?php echo __( 'Subscribe', 'pictorico' ) ?>" name="subscribe" id="mc-embedded-subscribe" class="button">
							</form>
						</div>
					</div>



				<?php else: ?>
					<div class="entry-header reduced-title">
						<div class="header-image" style="background-image: url(<?php echo pictorio_get_header_image(); ?>)">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span></a>
						</div>
						<?php echo $title_html; ?>
					</div>
				<?php endif; ?>
		</div><?php
	}
}

