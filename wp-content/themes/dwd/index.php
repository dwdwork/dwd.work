<?php
/**
 * The template for displaying all single pages
 */

get_header(); ?>
    
    <main id="index-main" clas="index-main">
    
    <?php /* Page Content */
    if ( have_posts() ) : while ( have_posts() ): the_post(); ?>

        <div id="page-<?php the_ID(); ?>" class="page-content">
            
            <div class="page-title">
                <h1><?php the_title(); ?></h1>
            </div>

            <div class="the-content">
                <?php the_content(); ?>
            </div>
            
        </div>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>