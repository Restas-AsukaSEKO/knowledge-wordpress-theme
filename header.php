<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/destyle.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" />
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="l_header">
    <div class="l_header-inner">
      <h1 class="l_header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="l_header_logo_link">KNOWLEDGE <br>
        <span class="l_header_sub_logo"><span class="l_header_sub-hyphen">-</span> Grocery Store <span class="l_header_sub-hyphen">-</span></span></a></h1>
      <nav class="l_header_nav js-menu">
        <?php
        $args = [
          'menu' => 'global-navigation',
          'menu_class' => 'l_header_nav_list',
          'container' => false,
        ];
        wp_nav_menu($args);
        ?>
      </nav>
      
      <button class="m_hamburger js-menu-icon">
        <span class="m_hamburger-bar"></span>
        <span class="m_hamburger-bar"></span>
        <span class="m_hamburger-bar"></span>
      </button>
    </div>
  </header>  
  <div class="m_nav-overlay"></div>
