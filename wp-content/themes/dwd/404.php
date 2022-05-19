<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

	<div class="error-404 not-found default-max-width">
		<div class="page-content">
			<h1 class="page-title"><h1>This URL did not connect to anything.</h1>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'danwilderdesign' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .page-content -->
	</div><!-- .error-404 -->

<?php
get_footer();