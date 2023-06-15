<?php 

function enqueue_block_assets() {
  wp_enqueue_script(
    'your-block-script',
    get_template_directory_uri() . '/blocks/project-block/block.js',
    array('wp-blocks', 'wp-element')
  );

  wp_enqueue_style(
    'your-block-style',
    get_template_directory_uri() . '/blocks/project-block/block.css'
  );
}
add_action('enqueue_block_editor_assets', 'enqueue_block_assets');

?>