<?php
/**
 * Footer template partial
 */
?>

</main><!-- main#index-main -->

<footer>
  <div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="social-nav">
                <?php wp_nav_menu(array(
                  'menu' => 'footer',
                  'items_wrap'=>'%3$s',
                  'container' => false,
                  'list_item_class' => "nav-item",
                  'link_class' => "nav-link",
                )); ?>
            </ul>
        </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>