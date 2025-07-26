<?php
/**
 * 網站頭部模板
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/header.php
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="汽車科技, 電動車, 智能駕駛, 汽車配件">
    <meta name="author" content="<?php bloginfo('name'); ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/og-image.jpg">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/og-image.jpg">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="main-header">
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
            </div>
            
            <div class="nav-menu">
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-links',
                    'container' => false,
                    'fallback_cb' => 'car_theme_default_menu'
                )); 
                ?>
            </div>
            
            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
</header>

<?php
// 預設導航菜單
function car_theme_default_menu() {
    echo '<ul class="nav-links">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">首頁</a></li>';
    echo '<li><a href="#products">產品</a></li>';
    echo '<li><a href="#services">服務</a></li>';
    echo '<li><a href="#about">關於我們</a></li>';
    echo '<li><a href="#contact">聯絡我們</a></li>';
    echo '</ul>';
}
?>