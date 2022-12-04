<?php
/**
 * Basic header.
 */
 
$blog_info    = get_bloginfo( 'name' );
$description  = get_bloginfo( 'description', 'display' );
$show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
$header_class = $show_title ? 'site-title' : 'screen-reader-text';

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Newsreader&family=Noto+Sans+JP&family=PT+Sans&display=swap" rel="stylesheet"> 

<?php wp_head(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156001826-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-156001826-1');
</script>

</head>

<body <?php body_class(); ?>>

<header id="site-header" class="header">
  <div class="overlay"></div>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-10 mx-auto">
        <div class="site-heading">
          <span class="site-title">
            <a href="/" rel="home" class="logo"><img src="/wp-content/themes/dwd/assets/images/logo.jpg" width="50" height="50"/></a>
          </span>
          <span class="subheading"><?php // echo $description;?></span>
        </div>
      </div>

      <div class="col-lg-6 col-md-10 mx-auto">
        <nav class="site-nav">

          <div class="navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li><a href="mailto: me.dwdwork@gmail.com">Email Me</a></li>
                <li><a href="/wp-content/uploads/2022/04/DanWilder_Resume.pdf" target="_blank">Resume</a></li>
                <?php 
                // wp_nav_menu(array(
                //   'menu' => 'main-nav',
                //   'items_wrap'=>'%3$s',
                //   'container' => false,
                //   'list_item_class' => "nav-item",
                //   'link_class' => "nav-link",
                // )); 
                ?>
            </ul>
          </div>
        </nav>
      </div>

    </div>
  </div>

</header>

<?php dynamic_header(); ?>