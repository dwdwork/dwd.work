<?php

// include 'dwd-functions.php';

function bsimple_scripts() {
    wp_enqueue_style( 'bsimple-style', get_stylesheet_uri() );
    wp_enqueue_style( 'bsimple-clean', get_template_directory_uri() . '/css/clean-blog.min.css' );
    wp_enqueue_style( 'bsimple-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bsimple-fontawesome', get_template_directory_uri() . '/css/fa-all.min.css' );
    wp_enqueue_style( 'bsimple-font1', "https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" );
    wp_enqueue_style( 'bsimple-font2', "https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );

    wp_enqueue_script( 'bsimple-jq', get_template_directory_uri() . '/js/jquery.min.js');
    wp_enqueue_script( 'bsimple-bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js');
    wp_enqueue_script( 'bsimple-clean', get_template_directory_uri() . '/js/clean-blog.min.js');
    wp_enqueue_script( 'bsimple-js', get_template_directory_uri() . '/js/clean-blog.min.js');
    wp_enqueue_script( 'dwd-js', get_template_directory_uri() . '/js/dwd.js');
}    
add_action( 'wp_enqueue_scripts', 'bsimple_scripts' );

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