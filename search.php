<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Pictorico
 */
function get_custom_title() {
	return sprintf( __( 'Search Results for: %s', 'pictorico' ), '<span>' . get_search_query() . '</span>' );
}
get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'home' ); ?>

			<?php endwhile; ?>

			<?php pictorico_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
