<?php 

/**
 * Set up a dynamic header to display different content per page type
 */

class dynamicHeader {

    // Call all functions and determine desired order
    public function __construct() {
        // Add additional hooks here
    }
}

if(!function_exists('dynamic_header')){

    function dynamic_header() {
    
        global $post;

        $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    
        if(strpos($url, '.local') !== false) {

            if (is_front_page()) { 
            
                ?><script>
                    console.log('front page');
                </script><?php 
        
            } else if (is_home()) {
        
                ?><script>
                    console.log('home page');
                </script><?php 
    
            } else if (is_page()) { 
    
                ?><script>
                    console.log('page');
                </script><?php 
    
            } else if (is_single()) { 
    
                ?><script>
                    console.log('single');
                </script><?php 
    
            } else { 
    
                ?><script>
                    console.log('post');
                </script><?php 
            }
        }
    }  
}