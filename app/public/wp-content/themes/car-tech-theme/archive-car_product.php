<?php
/**
 * 產品列表頁面模板
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/archive-car_product.php
 */

get_header(); ?>

<main class="archive-products-page">
    <!-- 頁面標題區塊 -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">汽車產品</h1>
            <p class="page-subtitle">探索我們的全系列汽車科技產品</p>
        </div>
    </section>
    
    <!-- 產品篩選區塊 -->
    <section class="products-filter">
        <div class="container">
            <div class="filter-tabs">
                <button class="filter-btn active" data-filter="all">全部產品</button>
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'car_category',
                    'hide_empty' => true
                ));
                
                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        echo '<button class="filter-btn" data-filter="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
                    }
                }
                ?>
            </div>
            
            <div class="filter-controls">
                <select id="sortBy" class="sort-select">
                    <option value="date">最新產品</option>
                    <option value="title">產品名稱</option>
                    <option value="price_low">價格低到高</option>
                    <option value="price_high">價格高到低</option>
                </select>
                
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </button>
                    <button class="view-btn" data-view="list">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </div>