<?php
/**
 * The template for displaying all single pages
 */

get_header();

/* Page Content */
if ( have_posts() ) : while ( have_posts() ): the_post(); ?>

    <div id="page-<?php the_ID(); ?>" class="page-content">
        <div class="page-title">
            <h1><?php the_title(); ?></h1>
        </div>
        <section class="section">
            <div class="wrapper">
                <?php the_content(); ?>
            </div>
        </section>         
    </div>

<?php endwhile; endif;

get_footer();

?>