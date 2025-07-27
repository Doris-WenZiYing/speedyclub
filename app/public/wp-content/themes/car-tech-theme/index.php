<?php
/**
 * 主頁模板 - Speedy 競速車業改裝
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/index.php
 */

get_header(); ?>

<!-- 英雄區塊 + 關於我們 -->
<section class="hero-about-section">
    <div class="hero-background">
        <!-- 背景影片 -->
        <video autoplay muted loop id="hero-video">
            <source src="<?php echo get_template_directory_uri(); ?>/assets/hero-video.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
    </div>
    
    <!-- 動態背景粒子效果 -->
    <div class="particles-container" id="particles-js"></div>
    
    <div class="hero-about-content">
        <div class="container">
            <div class="hero-about-grid">
                <!-- 左側：關於我們內容 -->
                <div class="about-content-hero">
                    <h1 class="hero-title">
                        <span class="title-line">SPEEDY 競速汽車</span>
                        <span class="title-subtitle">全車系空力套件與改裝</span>
                    </h1>
                    
                    <div class="about-features">
                        <div class="feature-row">
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>歐日空力套件品牌代理</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>專業客製化改裝服務</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>汽車百貨精品供應</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>高質感空力設計，匹配各大車系</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>改裝安裝烤漆施工門市配合</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>快速、安心、專業服務</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-bullet">✓</span>
                                <span>全台配送，快速出貨，安心有保障</span>
                            </div>
                            <div class="feature-item highlight">
                                <span class="feature-bullet">✓</span>
                                <span><strong>台北 台中 台南 高雄</strong>可配合施工烤漆安裝服務</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="about-stats">
                        <div class="stat-item">
                            <h3 class="stat-number">15</h3>
                            <p class="stat-label">年專業經驗</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">5000</h3>
                            <p class="stat-label">改裝案例</p>
                        </div>
                        <div class="stat-item">
                            <h3 class="stat-number">50</h3>
                            <p class="stat-label">合作品牌</p>
                        </div>
                    </div>
                    
                    <div class="hero-buttons">
                        <a href="#products" class="btn btn-primary">探索產品</a>
                        <a href="#contact" class="btn btn-secondary">立即諮詢</a>
                    </div>
                </div>
                
                <!-- 右側：圖片 -->
                <div class="about-image-hero">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/speedy-workshop.png" alt="SPEEDY 競速汽車工作室">
                    <div class="about-image-overlay">
                        <div class="about-badge">
                            <span>專業改裝</span>
                            <span>15年經驗</span>
                        </div>
                    </div>
                </div>
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
            <h2 class="section-title">熱門改裝套件</h2>
            <p class="section-subtitle">精選高品質空力套件，打造您的專屬座駕</p>
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
                // 真實的改裝產品資料
                $sample_products = array(
                    array(
                        'title' => 'BMW F30 M Performance 前保桿',
                        'description' => '原廠風格設計，完美融合運動與優雅，提升車輛整體視覺效果',
                        'brand' => 'BMW',
                        'image' => 'bmw-f30-front.jpg'
                    ),
                    array(
                        'title' => 'Tesla Model 3 碳纖維尾翼',
                        'description' => '高品質碳纖維材質，輕量化設計，增強下壓力與視覺衝擊',
                        'brand' => 'Tesla',
                        'image' => 'tesla-model3-spoiler.jpg'
                    ),
                    array(
                        'title' => 'Mercedes C63 AMG 側裙',
                        'description' => '競技風格設計，完美貼合車身線條，展現強烈運動氣息',
                        'brand' => 'Mercedes',
                        'image' => 'mercedes-c63-side.jpg'
                    ),
                    array(
                        'title' => 'Audi RS4 寬體套件',
                        'description' => '全套寬體改裝，包含前後保桿、側裙、輪拱，打造極致視覺效果',
                        'brand' => 'Audi',
                        'image' => 'audi-rs4-widebody.jpg'
                    ),
                    array(
                        'title' => 'Porsche 911 GT3 尾翼',
                        'description' => '賽車級空力設計，提供優異下壓力，兼具美觀與實用性',
                        'brand' => 'Porsche',
                        'image' => 'porsche-911-wing.jpg'
                    ),
                    array(
                        'title' => 'Lexus IS350 前下巴',
                        'description' => '精緻工藝製作，增加前臉層次感，提升整車運動化外觀',
                        'brand' => 'Lexus',
                        'image' => 'lexus-is350-lip.jpg'
                    )
                );
                
                foreach ($sample_products as $product) :
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
                        <div class="product-overlay">
                            <a href="#contact" class="product-link">立即詢價</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><?php echo $product['title']; ?></h3>
                        <p class="product-excerpt"><?php echo $product['description']; ?></p>
                        <div class="product-meta">
                            <span class="product-brand"><?php echo $product['brand']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach;
            endif; ?>
        </div>
        
        <div class="products-cta">
            <a href="<?php echo get_post_type_archive_link('car_product'); ?>" class="btn btn-primary">查看更多產品</a>
        </div>
    </div>
</section>

<!-- 產品分類區塊 -->
<section class="categories-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">專業套件</h2>
            <p class="section-subtitle">專業改裝套件，滿足不同需求</p>
        </div>
        
        <div class="categories-grid">
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'car_category',
                'hide_empty' => false,
                'number' => 8
            ));
            
            if (!empty($categories) && !is_wp_error($categories)) :
                foreach ($categories as $category) :
            ?>
                <div class="category-card">
                    <div class="category-icon">
                        <?php
                        $category_icon = get_term_meta($category->term_id, 'category_icon', true);
                        if ($category_icon) {
                            echo '<img src="' . esc_url($category_icon) . '" alt="' . esc_attr($category->name) . '">';
                        } else {
                            echo '<div class="category-placeholder">🔧</div>';
                        }
                        ?>
                    </div>
                    <h3 class="category-name"><?php echo esc_html($category->name); ?></h3>
                    <p class="category-description"><?php echo esc_html($category->description ?: '專業改裝套件'); ?></p>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">查看產品</a>
                </div>
            <?php 
                endforeach;
            else :
                // 預設分類
                $sample_categories = array(
                    array('name' => '前保桿套件', 'icon' => '🚗', 'description' => '各車系前保桿改裝'),
                    array('name' => '後保桿套件', 'icon' => '🏁', 'description' => '後保桿與尾段設計'),
                    array('name' => '側裙套件', 'icon' => '⚡', 'description' => '車身側面空力套件'),
                    array('name' => '尾翼改裝', 'icon' => '🎯', 'description' => '各式尾翼與擾流板'),
                    array('name' => '寬體套件', 'icon' => '💪', 'description' => '全套寬體改裝方案'),
                    array('name' => '碳纖維套件', 'icon' => '🖤', 'description' => '輕量化碳纖維部件'),
                    array('name' => '輪拱套件', 'icon' => '⭕', 'description' => '輪拱加寬與造型'),
                    array('name' => '客製化改裝', 'icon' => '🎨', 'description' => '專屬客製化服務')
                );
                
                foreach ($sample_categories as $category) :
            ?>
                <div class="category-card">
                    <div class="category-icon">
                        <div class="category-placeholder"><?php echo $category['icon']; ?></div>
                    </div>
                    <h3 class="category-name"><?php echo $category['name']; ?></h3>
                    <p class="category-description"><?php echo $category['description']; ?></p>
                    <a href="#contact" class="category-link">立即詢價</a>
                </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- 合作品牌區塊 -->
<section class="brands-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">產品分類</h2>
            <p class="section-subtitle">專業服務各大車系改裝需求</p>
        </div>
        
        <div class="brands-grid">
            <?php
            $brands = get_terms(array(
                'taxonomy' => 'car_brand',
                'hide_empty' => false,
                'number' => 12
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
                            echo '<img src="' . get_template_directory_uri() . '/assets/' . strtolower($brand->name) . '.png" alt="' . esc_attr($brand->name) . '">';
                        }
                        ?>
                    </div>
                    <h3 class="brand-name"><?php echo esc_html($brand->name); ?></h3>
                    <p class="brand-description"><?php echo esc_html($brand->description ?: '專業改裝服務'); ?></p>
                </div>
            <?php 
                endforeach;
            else :
                // 真實的汽車品牌
                $car_brands = array(
                    array('name' => 'BMW', 'description' => '德系豪華運動房車改裝'),
                    array('name' => 'Mercedes', 'description' => '賓士全車系改裝套件'),
                    array('name' => 'Audi', 'description' => '奧迪運動化改裝方案'),
                    array('name' => 'Tesla', 'description' => '電動車專用改裝套件'),
                    array('name' => 'Porsche', 'description' => '保時捷性能提升改裝'),
                    array('name' => 'Lexus', 'description' => '凌志豪華改裝服務'),
                    array('name' => 'Toyota', 'description' => '豐田全車系改裝'),
                    array('name' => 'Honda', 'description' => '本田運動化套件'),
                    array('name' => 'Nissan', 'description' => '日產性能改裝方案'),
                    array('name' => 'Mazda', 'description' => '馬自達外觀改裝'),
                    array('name' => 'Subaru', 'description' => '速霸陸性能套件'),
                    array('name' => 'Mitsubishi', 'description' => '三菱運動改裝')
                );
                
                foreach ($car_brands as $brand) :
            ?>
                <div class="brand-card">
                    <div class="brand-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/<?php echo strtolower($brand['name']); ?>.png" 
                             alt="<?php echo $brand['name']; ?>" 
                             onerror="this.src='<?php echo get_template_directory_uri(); ?>/assets/default-brand.png'">
                    </div>
                    <h3 class="brand-name"><?php echo $brand['name']; ?></h3>
                    <p class="brand-description"><?php echo $brand['description']; ?></p>
                </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- 專業服務區塊 -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">專業服務項目</h2>
            <p class="section-subtitle">從設計到安裝，提供一站式改裝服務</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3 class="service-title">歐日空力套件品牌</h3>
                <p class="service-description">代理各大知名品牌空力套件，原廠品質保證，提供多樣化選擇。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <h3 class="service-title">客製化改裝設計</h3>
                <p class="service-description">專業設計團隊提供客製化方案，打造獨一無二的專屬改裝風格。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                    </svg>
                </div>
                <h3 class="service-title">專業安裝施工</h3>
                <p class="service-description">門市專業技師安裝，搭配烤漆施工服務，快速、安心、專業完成。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.27,6.96 12,12.01 20.73,6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>
                <h3 class="service-title">全台配送服務</h3>
                <p class="service-description">全台配送，快速出貨，安心有保障。台北、台中、台南、高雄可配合施工。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M20 7h-9M14 3v4M6 21V9a3 3 0 0 1 3-3h2l2-2h4l2 2h2a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3Z"/>
                    </svg>
                </div>
                <h3 class="service-title">汽車百貨精品</h3>
                <p class="service-description">提供各式汽車百貨精品，高質感設計，匹配各大車系需求。</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                    </svg>
                </div>
                <h3 class="service-title">套件開發量產</h3>
                <p class="service-description">專業套件開發、設計、量產，提供一站式服務解決方案。</p>
            </div>
        </div>
    </div>
</section>

<!-- 簡化的聯絡表單區塊 -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="contact-content">
            <!-- 聯絡資訊和表單 -->
            <div class="contact-form-section">
                <div class="section-header">
                    <h2 class="section-title">聯絡我們</h2>
                    <p class="section-subtitle">讓我們協助您打造夢想中的愛車</p>
                </div>
                
                <!-- 聯絡資訊 -->
                <div class="contact-info-compact">
                    <div class="contact-item-compact">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span><?php echo get_contact_info('address'); ?></span>
                    </div>
                    
                    <div class="contact-item-compact">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                        <span><?php echo get_contact_info('phone_1'); ?> / <?php echo get_contact_info('phone_2'); ?></span>
                    </div>
                    
                    <div class="contact-item-compact">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                        </svg>
                        <span>LINE: @speedyvip</span>
                    </div>
                    
                    <div class="contact-item-compact">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                        <span><?php echo get_contact_info('business_hours'); ?></span>
                    </div>
                </div>
                
                <!-- 聯絡表單 -->
                <form class="contact-form-compact" id="contactForm">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="您的姓名" required>
                        <input type="email" name="email" placeholder="電子郵件" required>
                    </div>
                    <div class="form-row">
                        <input type="tel" name="phone" placeholder="聯絡電話">
                        <select name="car_brand" required>
                            <option value="">選擇車款品牌</option>
                            <option value="BMW">BMW</option>
                            <option value="Mercedes">Mercedes-Benz</option>
                            <option value="Audi">Audi</option>
                            <option value="Tesla">Tesla</option>
                            <option value="Porsche">Porsche</option>
                            <option value="Lexus">Lexus</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Honda">Honda</option>
                            <option value="其他">其他品牌</option>
                        </select>
                    </div>
                    <input type="text" name="subject" placeholder="改裝需求 (例：前保桿套件、寬體改裝等)" required>
                    <textarea name="message" placeholder="詳細說明您的改裝需求" rows="4" required></textarea>
                    <button type="submit" class="btn btn-primary">立即諮詢</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
// 動態粒子背景效果
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    
    // 英雄區塊標題動畫
    animateHeroTitle();
});

function createParticles() {
    const container = document.getElementById('particles-js');
    if (!container) return;
    
    const particleCount = 50;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 4 + 1;
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        const animationDelay = Math.random() * 10;
        const animationDuration = Math.random() * 10 + 10;
        
        particle.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            background: rgba(0, 212, 255, 0.5);
            border-radius: 50%;
            left: ${posX}%;
            top: ${posY}%;
            animation: float ${animationDuration}s infinite linear;
            animation-delay: ${animationDelay}s;
        `;
        
        container.appendChild(particle);
    }
    
    // 添加浮動動畫CSS
    if (!document.querySelector('#particle-animation')) {
        const style = document.createElement('style');
        style.id = 'particle-animation';
        style.textContent = `
            @keyframes float {
                0% {
                    transform: translateY(100vh) rotate(0deg);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100vh) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
}

function animateHeroTitle() {
    const titleLines = document.querySelectorAll('.title-line, .title-subtitle');
    
    titleLines.forEach((line, index) => {
        line.style.opacity = '0';
        line.style.transform = 'translateX(-100%)';
        
        setTimeout(() => {
            line.style.transition = 'all 1s ease-out';
            line.style.opacity = '1';
            line.style.transform = 'translateX(0)';
        }, index * 500 + 500);
    });
}

// 滾動視差效果
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const video = document.getElementById('hero-video');
    
    if (video && scrolled < window.innerHeight) {
        video.style.transform = `translate(-50%, -50%) translateY(${scrolled * 0.5}px)`;
    }
});
</script>

<?php get_footer(); ?>