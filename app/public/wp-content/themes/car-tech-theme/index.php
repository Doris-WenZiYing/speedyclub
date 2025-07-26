<?php
/**
 * 主頁模板
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/index.php
 */

get_header(); ?>

<!-- 英雄區塊 -->
<section class="hero-section">
    <div class="hero-background">
        <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
        <div class="container">
            <h1 class="hero-title">駕馭未來科技</h1>
            <p class="hero-subtitle">探索最先進的汽車科技與創新解決方案</p>
            <div class="hero-buttons">
                <a href="#products" class="btn btn-primary">探索產品</a>
                <a href="#contact" class="btn btn-secondary">聯絡我們</a>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- 最新產品區塊 -->
<section id="products" class="products-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">最新產品</h2>
            <p class="section-subtitle">體驗頂級汽車科技的極致表現</p>
        </div>
        
        <div class="products-grid">
            <?php
            $products_query = new WP_Query(array(
                'post_type' => 'car_product',
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key' => '_car_product_featured',
                        'value' => 'yes',
                        'compare' => '='
                    )
                )
            ));
            
            if ($products_query->have_posts()) :
                while ($products_query->have_posts()) : $products_query->the_post();
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/placeholder.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="product-overlay">
                            <a href="<?php the_permalink(); ?>" class="product-link">查看詳情</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?php the_title(); ?></h3>
                        <p class="product-excerpt"><?php the_excerpt(); ?></p>
                        <div class="product-meta">
                            <?php
                            $brands = get_the_terms(get_the_ID(), 'car_brand');
                            if ($brands && !is_wp_error($brands)) {
                                echo '<span class="product-brand">' . esc_html($brands[0]->name) . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // 如果沒有產品，顯示示例產品
                for ($i = 1; $i <= 6; $i++) :
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/product-<?php echo $i; ?>.jpg" alt="產品 <?php echo $i; ?>">
                        <div class="product-overlay">
                            <a href="#" class="product-link">查看詳情</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">智能駕駛系統 <?php echo $i; ?></h3>
                        <p class="product-excerpt">先進的自動駕駛技術，為您提供安全舒適的駕駛體驗。</p>
                        <div class="product-meta">
                            <span class="product-brand">Tesla</span>
                        </div>
                    </div>
                </div>
            <?php endfor;
            endif; ?>
        </div>
    </div>
</section>

<!-- 品牌區塊 -->
<section class="brands-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">合作品牌</h2>
            <p class="section-subtitle">與世界頂級汽車品牌攜手合作</p>
        </div>
        
        <div class="brands-grid">
            <?php
            $brands = get_terms(array(
                'taxonomy' => 'car_brand',
                'hide_empty' => false,
                'number' => 8
            ));
            
            if (!empty($brands) && !is_wp_error($brands)) :
                foreach ($brands as $brand) :
            ?>
                <div class="brand-card">
                    <div class="brand-logo">
                        <?php
                        $brand_image = get_term_meta($brand->term_id, 'brand_image', true);
                        if ($brand_image) {
                            echo '<img src="' . esc_url($brand_image) . '" alt="' . esc_attr($brand->name) . '">';
                        } else {
                            echo '<div class="brand-placeholder">' . esc_html($brand->name) . '</div>';
                        }
                        ?>
                    </div>
                    <h3 class="brand-name"><?php echo esc_html($brand->name); ?></h3>
                    <p class="brand-description"><?php echo esc_html($brand->description); ?></p>
                </div>
            <?php 
                endforeach;
            else :
                // 如果沒有品牌，顯示示例品牌
                $sample_brands = array('Tesla', 'BMW', 'Mercedes-Benz', 'Audi', 'Porsche', 'Lexus', 'Toyota', 'Honda');
                foreach ($sample_brands as $brand) :
            ?>
                <div class="brand-card">
                    <div class="brand-logo">
                        <div class="brand-placeholder"><?php echo $brand; ?></div>
                    </div>
                    <h3 class="brand-name"><?php echo $brand; ?></h3>
                    <p class="brand-description">享譽全球的汽車品牌，致力於創新與卓越。</p>
                </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- 服務區塊 -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">專業服務</h2>
            <p class="section-subtitle">提供全方位的汽車科技解決方案</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <h3 class="service-title">電動系統</h3>
                <p class="service-description">最先進的電動驅動系統，提供卓越的性能和效率。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="service-title">智能安全</h3>
                <p class="service-description">先進的安全技術，保障每一次駕駛的安全體驗。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                    </svg>
                </div>
                <h3 class="service-title">客製化調整</h3>
                <p class="service-description">專業的個人化調整服務，滿足每位客戶的獨特需求。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="service-title">售後支援</h3>
                <p class="service-description">全天候的專業技術支援，確保產品最佳運行狀態。</p>
            </div>
        </div>
    </div>
</section>

<!-- 關於我們區塊 -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2 class="section-title">關於我們</h2>
                <p class="about-description">
                    我們是汽車科技領域的先驅者，致力於將最前沿的技術融入每一個產品中。
                    憑藉超過十年的行業經驗，我們不斷推動汽車工業的創新發展。
                </p>
                <div class="about-stats">
                    <div class="stat-item">
                        <h3 class="stat-number">10</h3>
                        <p class="stat-label">年專業經驗</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="stat-number">1000</h3>
                        <p class="stat-label">滿意客戶</p>
                    </div>
                    <div class="stat-item">
                        <h3 class="stat-number">50</h3>
                        <p class="stat-label">合作品牌</p>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/about-image.jpg" alt="關於我們">
            </div>
        </div>
    </div>
</section>

<!-- 聯絡表單區塊 -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">聯絡我們</h2>
            <p class="section-subtitle">讓我們協助您找到最適合的解決方案</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="contact-details">
                        <h3>地址</h3>
                        <p><?php echo esc_html(get_contact_info('address') ?: '台北市信義區信義路五段7號'); ?></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                    </div>
                    <div class="contact-details">
                        <h3>電話</h3>
                        <p><?php echo esc_html(get_contact_info('phone') ?: '+886-2-1234-5678'); ?></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="contact-details">
                        <h3>電子郵件</h3>
                        <p><?php echo esc_html(get_contact_info('email') ?: 'info@cartech.com'); ?></p>
                    </div>
                </div>
            </div>
            
            <form class="contact-form" id="contactForm">
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="您的姓名" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="電子郵件" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="subject" placeholder="主題" required>
                </div>
                <div class="form-group">
                    <textarea name="message" placeholder="您的訊息" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">發送訊息</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>