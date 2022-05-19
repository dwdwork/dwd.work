<?php
/**
 * The template for displaying all single posts
 */

get_header();



/* Page Content */
    if ( have_posts() ) : while ( have_posts() ): the_post(); ?>

        <div id="post-<?php the_ID(); ?>" class="post_block">
            <div class="page-title"><h2><?php the_title(); ?></h2></div>
            <div class="post-content"><?php the_content(); ?></div>
        </div>

    <?php endwhile;
    endif;

/* 
* Post Content 
* Start the Loop 
*/
while ( have_posts() ) :
	the_post();


	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
endwhile; // End of the loop.

get_footer();
