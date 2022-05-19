<?php
/**
 * Basic index
 */

get_header(); ?>

    <?php
    if ( have_posts() ) : while ( have_posts() ): the_post(); ?>

    <div id="post-<?php the_ID();?>" class="post_block">
        <div class="page-title"><h2><?php the_title(); ?></h2></div>
        <div class="post-content"><?php the_content(); ?></div>
    </div>

    <?php endwhile;
    endif;
    ?>

<?php get_footer(); ?>
