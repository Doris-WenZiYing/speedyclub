<?php
/**
 * 網站頁腳模板 - Speedy 競速車業改裝
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/footer.php
 */
?>

<footer class="main-footer">
    <div class="footer-content">
        <div class="container">
            <div class="footer-sections">
                <div class="footer-section">
                    <h3 class="footer-title"><?php echo get_site_setting('company_name') ?: 'Speedy 競速車業改裝'; ?></h3>
                    <p class="footer-description">
                        <?php echo get_site_setting('company_description') ?: '專業改裝不只是升級，更是風格態度的展現。我們提供歐日空力套件品牌代理、客製化改裝設計、專業安裝施工等一站式服務。'; ?>
                    </p>
                    <div class="social-links">
                        <?php if (get_social_url('fb')) : ?>
                            <a href="<?php echo esc_url(get_social_url('fb')); ?>" class="social-link" aria-label="Facebook" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M22.675 0H1.325C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.494V14.708h-3.13v-3.622h3.13V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24h-1.917c-1.504 0-1.796.715-1.796 1.764v2.313h3.59l-.467 3.622h-3.123V24h6.116C23.407 24 24 23.407 24 22.674V1.326C24 .593 23.407 0 22.675 0z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_social_url('instagram')) : ?>
                            <a href="<?php echo esc_url(get_social_url('instagram')); ?>" class="social-link" aria-label="Instagram" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_social_url('youtube')) : ?>
                            <a href="<?php echo esc_url(get_social_url('youtube')); ?>" class="social-link" aria-label="YouTube" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if (get_social_url('line')) : ?>
                            <a href="<?php echo esc_url(get_social_url('line')); ?>" class="social-link" aria-label="Line" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.017 0C5.396 0 .029 4.285.029 9.568c0 4.518 4.008 8.295 9.435 9.437.515-.36.976-.814 1.352-1.34.411-.578.77-1.213 1.048-1.886.051-.125.098-.252.143-.379.344-.97.535-2.008.535-3.079 0-1.071-.191-2.109-.535-3.079-.045-.127-.092-.254-.143-.379-.278-.673-.637-1.308-1.048-1.886C10.454.814 9.993.36 9.478 0H12.017zm-5.982 13.397c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5zm11.965 0c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5z"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">快速連結</h3>
                    <?php 
                    if (has_nav_menu('footer')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class' => 'footer-links',
                            'container' => false,
                            'fallback_cb' => false
                        ));
                    } else {
                        echo '<ul class="footer-links">';
                        echo '<li><a href="' . esc_url(home_url('/')) . '">首頁</a></li>';
                        echo '<li><a href="#products">改裝產品</a></li>';
                        echo '<li><a href="#services">專業服務</a></li>';
                        echo '<li><a href="#about">關於我們</a></li>';
                        echo '<li><a href="#contact">聯絡我們</a></li>';
                        echo '<li><a href="' . esc_url(get_post_type_archive_link('car_product')) . '">產品目錄</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">改裝分類</h3>
                    <ul class="footer-links">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'car_category',
                            'hide_empty' => false,
                            'number' => 6
                        ));
                        
                        if (!empty($categories) && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                            }
                        } else {
                            // 預設分類
                            echo '<li><a href="#contact">前保桿套件</a></li>';
                            echo '<li><a href="#contact">後保桿套件</a></li>';
                            echo '<li><a href="#contact">側裙套件</a></li>';
                            echo '<li><a href="#contact">尾翼改裝</a></li>';
                            echo '<li><a href="#contact">寬體套件</a></li>';
                            echo '<li><a href="#contact">客製化改裝</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">聯絡資訊</h3>
                    <div class="footer-contact">
                        <div class="contact-item">
                            <span class="contact-icon">📍</span>
                            <span><?php echo esc_html(get_contact_info('address')); ?></span>
                        </div>
                        
                        <div class="contact-item">
                            <span class="contact-icon">📞</span>
                            <span>
                                <?php echo esc_html(get_contact_info('phone_1')); ?>
                                <?php if (get_contact_info('phone_2')) : ?>
                                    <br><?php echo esc_html(get_contact_info('phone_2')); ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <div class="contact-item">
                            <span class="contact-icon">✉️</span>
                            <span><?php echo esc_html(get_contact_info('email')); ?></span>
                        </div>
                        
                        <div class="contact-item">
                            <span class="contact-icon">🕒</span>
                            <span><?php echo esc_html(get_contact_info('business_hours')); ?></span>
                        </div>
                        
                        <div class="contact-item line-info">
                            <span class="contact-icon">💬</span>
                            <span>
                                LINE 官方: <?php echo esc_html(get_contact_info('line_official_id')); ?><br>
                                LINE ID: <?php echo esc_html(get_contact_info('line_id')); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p>&copy; <?php echo date('Y'); ?> <?php echo get_site_setting('company_name') ?: 'Speedy 競速車業改裝'; ?>. 版權所有.</p>
                <div class="footer-bottom-links">
                    <a href="#privacy">隱私政策</a>
                    <a href="#terms">服務條款</a>
                    <a href="#sitemap">網站地圖</a>
                    <a href="https://www.speedy168.com" target="_blank">官方網站</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* 頁腳增強樣式 */
.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 15px;
    line-height: 1.6;
}

.contact-icon {
    font-size: 1.1rem;
    margin-top: 2px;
    flex-shrink: 0;
}

.line-info {
    background: rgba(0, 212, 255, 0.1);
    padding: 12px;
    border-radius: 8px;
    border-left: 3px solid var(--primary-color);
}

.line-link {
    background: #00c300 !important;
}

.line-link:hover {
    background: #00a000 !important;
    transform: translateY(-3px);
}

.social-links .social-link {
    transition: all 0.3s ease;
}

.social-links .social-link:hover {
    transform: translateY(-3px) scale(1.1);
}

/* 響應式頁腳 */
@media (max-width: 768px) {
    .footer-sections {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .contact-item {
        font-size: 0.9rem;
    }
    
    .social-links {
        justify-content: center;
        margin-top: 20px;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>