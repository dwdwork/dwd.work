<?php 

/**
 * Functions that affect admin pages 
 * 
 * Set up as constructor to easily add and remove individual functions and determine call order
 */

class dwdAdminFunctions {

    // Call all functions and determine desired order
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_menu_image_scripts'));
        add_action('wp_nav_menu_item_custom_fields', array($this, 'add_menu_item_image_field'), 10, 4);
        add_action('wp_update_nav_menu_item', array($this, 'save_menu_item_image_field'), 10, 3 );
        add_filter('walker_nav_menu_start_el', array($this, 'render_menu_item_image'), 10, 4);
        add_filter('upload_mimes', array($this, 'cc_mime_types'));
    }
    
    // Enqueue necessary scripts and styles for media uploader
    public function enqueue_menu_image_scripts() {
        wp_enqueue_media();
    }

    // Add custom fields to menu item settings
    public function add_menu_item_image_field( $item_id, $item, $depth, $args ) {
        $image_url = get_post_meta( $item_id, '_menu_item_image_url', true ); ?>

        <p class="field-image-url description-wide">
            <label for="edit-menu-item-image-url-<?php echo esc_attr( $item_id ); ?>">
                <?php esc_html_e( 'Menu Item Image', 'text-domain' ); ?><br>
                <input type="text" class="widefat menu-item-image-url" id="edit-menu-item-image-url-<?php echo esc_attr( $item_id ); ?>" name="menu-item-image-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $image_url ); ?>">
            </label>
        </p>
    <?php }

    // Save custom field value when updating menu item
    public function save_menu_item_image_field( $menu_id, $menu_item_db_id, $args ) {
        if ( isset( $_REQUEST['menu-item-image-url'][ $menu_item_db_id ] ) ) {
            $image_url = sanitize_text_field( $_REQUEST['menu-item-image-url'][ $menu_item_db_id ] );
            update_post_meta( $menu_item_db_id, '_menu_item_image_url', $image_url );
        }
    }

    // Render the image in the menu item
    public function render_menu_item_image( $item_output, $item, $depth, $args ) {
        $image_url = get_post_meta( $item->ID, '_menu_item_image_url', true );
        if ( ! empty( $image_url ) ) {
            $item_output = '<a target="_blank" href="' . $item->url . '">' . '<img src="' . esc_url( $image_url ) . '" alt="' . $item->title . ' icon">' . '</a>';
        }
        return $item_output;
    }

    // Allow SVG uploads
    public function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}

new dwdAdminFunctions();

?>