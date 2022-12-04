<?php
/**
 * dwd post template
 */

get_header(); ?>

    <div class="homepage-content">
        <?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
    </div>
    <?php endwhile; endif; ?>

<?php get_footer(); ?>