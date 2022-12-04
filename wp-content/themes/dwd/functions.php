<?php

function dwd_setup() {

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
		'first_level' => esc_html__('First Level Navigation', 'dwd'),
		'primary_menu' => esc_html__('Primary Menu', 'dwd'),
		'converge_navigation_2021' => esc_html__('Converge 2021', 'dwd'),
		'footer_navigation' => esc_html__('Footer Links', 'dwd'),
		'footer_col_2' => esc_html__('Footer Links Column 2', 'dwd'),
		'footer_col_3' => esc_html__('Footer Links Column 3', 'dwd'),
		'footer_col_4' => esc_html__('Footer Links Column 4', 'dwd'),
	));

}
add_action('after_setup_theme', 'dwd_setup');

function dwd_content_width() {
	$GLOBALS['content_width'] = apply_filters('dwd_content_width', 640);
}
add_action('after_setup_theme', 'dwd_content_width', 0);

function dwd_scripts() {
	// Remove unwanted assets enqueued by WP and plugins
	function remove_sf_styles(){
		wp_dequeue_style('search-filter-plugin-styles');
		wp_dequeue_style('search-filter-chosen-styles');
	} add_action('wp_print_styles', 'remove_sf_styles', 100);
	wp_dequeue_style('bcct_style');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	wp_deregister_script('comment-reply');

	// Enqueue styles.
    wp_enqueue_style('dwd-style', get_stylesheet_uri());
    wp_enqueue_style('dwd-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('dwd-baskerville', "https://use.typekit.net/bhc3nlz.css");
    wp_enqueue_style('dwd-font1', "https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic");
    wp_enqueue_style('dwd-font2', "https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800");

    // Enqueue js.
    wp_enqueue_script('dwd-bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js');
    wp_enqueue_script('dwd-scripts', get_template_directory_uri() . '/js/dwd.js', array( 'jquery' ), null, true);
}
add_action('wp_enqueue_scripts', 'dwd_scripts');

// Dequeue jQuery migrate
function dwd_remove_jquery_migrate($scripts) {
    if(!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), null);
    }
}
add_filter('wp_default_scripts', 'dwd_remove_jquery_migrate');

// Remove empty elements
function is_element_empty($element) {
	$element = trim($element);
	return empty($element) ? false : true;
}

// Add classes to body 
function dwd_body_classes($classes) {
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
add_filter('body_class', 'dwd_body_classes');

// Prevent landing confirmation pages from being indexed by search engines.
add_filter('wpseo_robots', 'confPageNoIndex', 999);
function confPageNoIndex($string= "") {
    if (is_page_template('page-confirmation.php'))  {
        $string= "noindex,nofollow";
    }
    return $string;
}

// Display featured post thumbnails in RSS feeds
function dwd_rss_thumbs($content) {
    global $post;
    if(has_post_thumbnail($post->ID)) {
        $content = '<figure>' . get_the_post_thumbnail($post->ID, 'thumb') . '</figure>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'dwd_rss_thumbs');
add_filter('the_content_feed', 'dwd_rss_thumbs');

// Prevent password-protected posts from appearing in list views
function dwd_password_post_filter($where = '') {
    if (!is_page() && !is_single() && !is_admin()) {
        $where .= " AND post_password = ''";
    }
    return $where;
}
add_filter('posts_where', 'dwd_password_post_filter');

// Add acf functions.
require get_template_directory() . '/inc/acf.php';

// Add custom post types.
require get_template_directory() . '/inc/custom-post-types.php';

// Add dashboard modifications
require get_template_directory() . '/inc/dashboard.php';

// Disable comments
require get_template_directory() . '/inc/disable-comments.php';

if(!function_exists('dynamic_header')){

    function dynamic_header(){
    
        global $post;
    
        ?>
    
        <?php if (is_front_page()){ ?>
    
            <script>
                console.log('front page');
            </script>
    
        <?php } else if (is_home()){ ?>
    
            <script>
                console.log('home page');
            </script>
    
        <?php } else if (is_page()){ ?>
    
            <script>
                console.log('page');
            </script>
    
        <?php } else if (is_single()){ ?>
    
            <script>
                console.log('single');
            </script>
    
        <?php } else { ?>
    
            <script>
                console.log('post');
            </script>
    
        <?php }
    }
    
    }
    

?>