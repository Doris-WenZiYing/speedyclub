<?php
/**
 * 網站頁腳模板
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/footer.php
 */
?>

<footer class="main-footer">
    <div class="footer-content">
        <div class="container">
            <div class="footer-sections">
                <div class="footer-section">
                    <h3 class="footer-title"><?php bloginfo('name'); ?></h3>
                    <p class="footer-description">
                        <?php echo esc_html(get_bloginfo('description') ?: '專業的汽車科技解決方案提供商，致力於創新與卓越。'); ?>
                    </p>
                    <div class="social-links">
                        <?php if (get_social_url('facebook')) : ?>
                            <a href="<?php echo esc_url(get_social_url('facebook')); ?>" class="social-link" aria-label="Facebook" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
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
                        
                        <?php if (get_social_url('linkedin')) : ?>
                            <a href="<?php echo esc_url(get_social_url('linkedin')); ?>" class="social-link" aria-label="LinkedIn" target="_blank" rel="noopener">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
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
                        echo '<li><a href="#products">產品展示</a></li>';
                        echo '<li><a href="#services">專業服務</a></li>';
                        echo '<li><a href="#about">關於我們</a></li>';
                        echo '<li><a href="#contact">聯絡我們</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">產品類別</h3>
                    <ul class="footer-links">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'car_category',
                            'hide_empty' => false,
                            'number' => 5
                        ));
                        
                        if (!empty($categories) && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                            }
                        } else {
                            // 預設類別
                            echo '<li><a href="#">電動系統</a></li>';
                            echo '<li><a href="#">智能配件</a></li>';
                            echo '<li><a href="#">安全設備</a></li>';
                            echo '<li><a href="#">性能升級</a></li>';
                            echo '<li><a href="#">客製化服務</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">聯絡資訊</h3>
                    <div class="footer-contact">
                        <p><?php echo esc_html(get_contact_info('address') ?: '台北市信義區信義路五段7號'); ?></p>
                        <p>電話: <?php echo esc_html(get_contact_info('phone') ?: '+886-2-1234-5678'); ?></p>
                        <p>郵件: <?php echo esc_html(get_contact_info('email') ?: 'info@cartech.com'); ?></p>
                        <p>營業時間: 週一至週五 9:00-18:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 版權所有.</p>
                <div class="footer-bottom-links">
                    <a href="#">隱私政策</a>
                    <a href="#">使用條款</a>
                    <a href="#">網站地圖</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>