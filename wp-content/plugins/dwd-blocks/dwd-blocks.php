<?php
/**
 * Plugin Name:       Dwd Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       dwd-blocks
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

 function dwd_blocks_portfolio_cateogry( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'portfolio',
                'title' => __( 'Portfolio', 'portfolio' ),
            ],
        ]
    );
}
add_action( 'block_categories', 'dwd_blocks_portfolio_cateogry', 10, 2 );

function create_block_dwd_blocks_block_init() {
	register_block_type( __DIR__ . '/build/block-a' );
	register_block_type( __DIR__ . '/build/block-b' );
}
add_action( 'init', 'create_block_dwd_blocks_block_init' );
