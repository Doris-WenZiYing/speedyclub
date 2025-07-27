<?php
/**
 * 網站頭部模板 - Speedy 競速車業改裝
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/header.php
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo get_site_setting('company_description') ?: '專業汽車改裝服務，空力套件，客製化設計，全車系改裝'; ?>">
    <meta name="keywords" content="汽車改裝, 空力套件, 前保桿, 後保桿, 側裙, 尾翼, BMW改裝, 賓士改裝, 奧迪改裝, 特斯拉改裝, 客製化改裝, 新北林口, Speedy競速">
    <meta name="author" content="<?php echo get_site_setting('company_name'); ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); echo get_site_setting('company_name'); ?>">
    <meta property="og:description" content="<?php echo get_site_setting('company_description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/speedy-og-image.jpg">
    <meta property="og:site_name" content="<?php echo get_site_setting('company_name'); ?>">
    <meta property="og:locale" content="zh_TW">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); echo get_site_setting('company_name'); ?>">
    <meta name="twitter:description" content="<?php echo get_site_setting('company_description'); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/speedy-og-image.jpg">
    
    <!-- 商業資訊 -->
    <meta name="geo.region" content="TW-TPE">
    <meta name="geo.placename" content="新北市林口區">
    <meta name="geo.position" content="25.0776;121.3897">
    <meta name="ICBM" content="25.0776,121.3897">
    
    <!-- 聯絡資訊 -->
    <meta name="contact:phone_number" content="<?php echo get_contact_info('phone_1'); ?>">
    <meta name="contact:email" content="<?php echo get_contact_info('email'); ?>">
    <meta name="contact:address" content="<?php echo get_contact_info('address'); ?>">
    
    <!-- Schema.org Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AutomotiveBusiness",
        "name": "<?php echo get_site_setting('company_name'); ?>",
        "description": "<?php echo get_site_setting('company_description'); ?>",
        "url": "<?php echo home_url(); ?>",
        "telephone": "<?php echo get_contact_info('phone_1'); ?>",
        "email": "<?php echo get_contact_info('email'); ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?php echo get_contact_info('address'); ?>",
            "addressLocality": "林口區",
            "addressRegion": "新北市",
            "postalCode": "244",
            "addressCountry": "TW"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "25.0776",
            "longitude": "121.3897"
        },
        "openingHours": "Mo-Sa 09:00-19:00",
        "priceRange": "$$",
        "paymentAccepted": "現金, 信用卡, 銀行轉帳",
        "currenciesAccepted": "TWD",
        "areaServed": ["台北市", "新北市", "桃園市", "台中市", "台南市", "高雄市"],
        "serviceType": ["汽車改裝", "空力套件安裝", "客製化設計", "烤漆施工"]
    }
    </script>
    
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
                            <span class="brand-main">SPEEDY</span>
                            <span class="brand-sub">競速車業改裝</span>
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
            
            <!-- 快速聯絡資訊 -->
            <div class="nav-contact">
                <div class="contact-quick">
                    <a href="tel:<?php echo str_replace(array('(', ')', '-', ' '), '', get_contact_info('phone_1')); ?>" class="phone-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        <span><?php echo get_contact_info('phone_1'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(get_social_url('line')); ?>" class="line-link" target="_blank">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 10.304c0-5.369-5.383-9.738-12-9.738S0 4.935 0 10.304c0 4.814 4.269 8.846 10.036 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.304"/>
                        </svg>
                        <span>LINE諮詢</span>
                    </a>
                </div>
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
    echo '<li><a href="#products">改裝產品</a></li>';
    echo '<li><a href="#services">專業服務</a></li>';
    echo '<li><a href="#about">關於我們</a></li>';
    echo '<li><a href="#contact">聯絡我們</a></li>';
    if (get_post_type_archive_link('car_product')) {
        echo '<li><a href="' . esc_url(get_post_type_archive_link('car_product')) . '">產品目錄</a></li>';
    }
    echo '</ul>';
}

// 添加滾動時的導航欄樣式
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});
</script>