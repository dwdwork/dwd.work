<?php
/**
 * The template for displaying all single pages
 */

get_header();

/* Page Content */
if ( have_posts() ) : while ( have_posts() ): the_post(); ?>

    <div id="page-<?php the_ID(); ?>" class="page-content">

        <?php if(!is_front_page()): ?>
            <div class="page-title">
                <h1><?php the_title(); ?></h1>
            </div>
        <?php endif;  ?>

        <div class="the-content">
            <?php the_content(); ?>
        </div>
          
    </div>

<?php endwhile; endif;

get_footer();

?>