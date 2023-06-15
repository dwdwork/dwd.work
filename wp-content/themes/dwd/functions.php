<?php

/**
 * Main functions file used to get all other functions in theme
 * 
 * Set up as constructor to easily add and remove individual functions and determine call order
 */

class dwdFunctions {

    // Call all functions and determine desired order
    public function __construct() {
        add_action('after_setup_theme', array($this, 'initialize_theme'));
        add_action('wp_print_styles', array($this, 'remove_scripts_styles'));
        add_action('wp_enqueue_scripts', array($this, 'theme_styles_scripts'));
        add_filter('body_class', array($this, 'theme_body_classes'));
        add_filter('wpseo_robots', array($this, 'confPageNoIndex'));
        add_filter('the_excerpt_rss', array($this, 'feed_rss_thumbs'));
        add_filter('the_content_feed', array($this, 'feed_rss_thumbs'));
        add_filter('posts_where', array($this, 'feed_post_password_filter'));
    }

    // Initialize basic theme setup
    public function initialize_theme() {
        load_theme_textdomain('dwd', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form',
            'gallery',
            'caption',
        ));
        // This theme uses wp_nav_menu() in these locations.
        register_nav_menus(array(
            'primary_menu' => esc_html__('Primary Menu', 'dwd'),
            'footer_menu' => esc_html__('Footer Menu', 'dwd'),
        ));
    }

    // Remove unwanted assets enqueued by WP and plugins
    public function remove_scripts_styles() {
        wp_dequeue_style('search-filter-plugin-styles');
        wp_dequeue_style('search-filter-chosen-styles');
        wp_dequeue_style('bcct_style');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        wp_deregister_script('comment-reply');
    }

    // Add theme's styles and scripts
    public function theme_styles_scripts() {
        // Enqueue styles.
        wp_enqueue_style('dwd-styles', get_stylesheet_uri());
        wp_enqueue_style('dwd-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css');
        wp_enqueue_style('dwd-adobe-fonts', "https://use.typekit.net/bhc3nlz.css");
        wp_enqueue_style('dwd-font1', "https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic");
        wp_enqueue_style('dwd-font2', "https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800");

        // Enqueue js.
        wp_enqueue_script('dwd-scripts', get_template_directory_uri() . '/build/js/scripts.js', array( 'jquery' ), null, true);
    }
    
    // Remove empty elements
    public function is_element_empty($element) {
        $element = trim($element);
        return empty($element) ? false : true;
    }

    // Add classes to body 
    public function theme_body_classes($classes) {
        global $post;
        // page-slug
        if (isset($post)) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }
        // browser
        global $is_chrome, $is_edge, $is_gecko, $is_IE, $is_safari ;
        if($is_chrome) $classes[] = 'chrome';
        elseif($is_edge) $classes[] = 'edge';
        elseif($is_gecko) $classes[] = 'firefox';
        elseif($is_IE) $classes[] = 'ie';
        elseif($is_safari) $classes[] = 'safari';
        // is mobile
        if (wp_is_mobile()) {
            $classes[] = 'mobile';
        }
        return $classes;
    }

    // Prevent landing confirmation pages from being indexed by search engines.
    public function confPageNoIndex($string= "") {
        if (is_page_template('page-confirmation.php'))  {
            $string= "noindex,nofollow";
        }
        return $string;
    }

    // Display featured post thumbnails in RSS feeds
    public function feed_rss_thumbs($content) {
        global $post;
        if(has_post_thumbnail($post->ID)) {
            $content = '<figure>' . get_the_post_thumbnail($post->ID, 'thumb') . '</figure>' . $content;
        }
        return $content;
    }

    // Prevent password-protected posts from appearing in list views
    public function feed_post_password_filter($where = '') {
        if (!is_page() && !is_single() && !is_admin()) {
            $where .= " AND post_password = ''";
        }
        return $where;
    }
}

new dwdFunctions();

/**
 * Include additional files outisde of class & constructor
 */
include get_template_directory() . '/inc/dynamic-header.php';
include get_template_directory() . '/inc/acf.php';
include get_template_directory() . '/inc/custom-post-types.php';
include get_template_directory() . '/inc/dashboard.php';
include get_template_directory() . '/inc/disable-comments.php';

?>