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
                            <path d="M12.017 0C5.396 0 .029 4.285.029 9.568c0 4.518 4.008 8.295 9.435 9.437.515-.36.976-.814 1.352-1.34.411-.578.77-1.213 1.048-1.886.051-.125.098-.252.143-.379.344-.97.535-2.008.535-3.079 0-1.071-.191-2.109-.535-3.079-.045-.127-.092-.254-.143-.379-.278-.673-.637-1.308-1.048-1.886C10.454.814 9.993.36 9.478 0H12.017zm-5.982 13.397c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm11.965 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5z"/>
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

<style>
/* 頭部增強樣式 */
.site-title a {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    text-decoration: none;
    line-height: 1;
}

.brand-main {
    font-family: var(--font-primary);
    font-size: 2rem;
    font-weight: 900;
    color: var(--primary-color);
    letter-spacing: 2px;
}

.brand-sub {
    font-family: var(--font-secondary);
    font-size: 0.8rem;
    color: var(--text-secondary);
    font-weight: 500;
    margin-top: -2px;
    letter-spacing: 1px;
}

.nav-contact {
    display: flex;
    align-items: center;
    gap: 15px;
}

.contact-quick {
    display: flex;
    gap: 15px;
    align-items: center;
}

.phone-link, .line-link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 15px;
    background: rgba(0, 212, 255, 0.1);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 20px;
    color: var(--text-primary);
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.phone-link:hover, .line-link:hover {
    background: var(--primary-color);
    color: var(--bg-dark);
    transform: translateY(-2px);
}

.line-link {
    background: rgba(0, 195, 0, 0.1);
    border-color: rgba(0, 195, 0, 0.3);
}

.line-link:hover {
    background: #00c300;
    color: white;
}

.phone-link svg, .line-link svg {
    width: 16px;
    height: 16px;
}

/* 響應式導航 */
@media (max-width: 1024px) {
    .nav-contact {
        display: none;
    }
}

@media (max-width: 768px) {
    .brand-main {
        font-size: 1.5rem;
    }
    
    .brand-sub {
        font-size: 0.7rem;
    }
    
    .nav-menu {
        position: fixed;
        top: 80px;
        left: 0;
        width: 100%;
        height: calc(100vh - 80px);
        background: rgba(10, 10, 10, 0.98);
        backdrop-filter: blur(20px);
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: 999;
        opacity: 0;
        visibility: hidden;
    }
    
    .nav-menu.active {
        transform: translateX(0);
        opacity: 1;
        visibility: visible;
    }
    
    .nav-menu .nav-links {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        gap: 30px;
        padding: 0 20px;
    }
    
    .nav-menu .nav-links a {
        font-size: 1.2rem;
        font-weight: 600;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        width: 100%;
        text-align: center;
    }
    
    /* 移動端快速聯絡 */
    .nav-menu .nav-links::after {
        content: '';
        display: block;
        width: 100%;
        margin: 30px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .mobile-menu-toggle {
        display: flex;
    }
    
    body.menu-open {
        overflow: hidden;
    }
}

@media (max-width: 480px) {
    .brand-main {
        font-size: 1.3rem;
    }
    
    .brand-sub {
        font-size: 0.6rem;
    }
}

/* 導航動畫增強 */
.navbar {
    transition: all 0.3s ease;
}

.navbar.scrolled {
    background: rgba(10, 10, 10, 0.98);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border-color);
}

.nav-links a {
    position: relative;
    overflow: hidden;
}

.nav-links a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: var(--gradient-primary);
    transition: left 0.3s ease;
}

.nav-links a:hover::before,
.nav-links a.active::before {
    left: 0;
}

/* 搜尋功能 */
.nav-search {
    position: relative;
}

.search-toggle {
    background: none;
    border: none;
    color: var(--text-primary);
    font-size: 1.2rem;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.search-toggle:hover {
    background: rgba(0, 212, 255, 0.1);
    color: var(--primary-color);
}

.search-form {
    position: absolute;
    top: 100%;
    right: 0;
    width: 300px;
    background: var(--bg-card);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transform: translateY(-10px);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

.search-form.active {
    transform: translateY(0);
    opacity: 1;
    visibility: visible;
}

.search-form input {
    width: 100%;
    padding: 12px 15px;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    color: var(--text-primary);
    font-size: 14px;
}

.search-form input:focus {
    outline: none;
    border-color: var(--primary-color);
}
</style>

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