<?php
/**
 * The template for displaying all single pages
 */
?>
<div class="link-to-plugin" style="position: fixed; top: 0; left: 0; right: 0; height: 100px; background: #666666; display: flex; justify-content: center; align-items: center; z-index:9999;">
    <a href="/wp-content/plugins/loggy-woggy/inc/dashboard.php">GO TO DASHBOARD</a>
</div>
<?php
get_header(); 

    /* Page Content */
    if ( have_posts() ) : while ( have_posts() ): the_post(); ?>

        <div id="page-<?php the_ID(); ?>" class="page-content">
            
            <div class="page-title">
                <h1><?php the_title(); ?></h1>
            </div>

            <div class="the-content">
                <?php the_content(); ?>
            </div>
            
        </div>

    <?php endwhile; endif;

get_footer(); ?>