<?php
/**
 * 單個產品頁面模板
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/single-car_product.php
 */

get_header(); ?>

<main class="single-product-page">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- 產品英雄區塊 -->
        <section class="product-hero">
            <div class="container">
                <div class="product-hero-content">
                    <div class="product-images">
                        <div class="main-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'product-main-img')); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/placeholder-large.jpg" alt="<?php the_title(); ?>" class="product-main-img">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="product-details">
                        <div class="product-breadcrumb">
                            <a href="<?php echo home_url(); ?>">首頁</a>
                            <span>/</span>
                            <a href="<?php echo get_post_type_archive_link('car_product'); ?>">產品</a>
                            <span>/</span>
                            <span><?php the_title(); ?></span>
                        </div>
                        
                        <h1 class="product-title"><?php the_title(); ?></h1>
                        
                        <div class="product-meta">
                            <?php
                            $brands = get_the_terms(get_the_ID(), 'car_brand');
                            if ($brands && !is_wp_error($brands)) {
                                echo '<span class="product-brand">' . esc_html($brands[0]->name) . '</span>';
                            }
                            
                            $categories = get_the_terms(get_the_ID(), 'car_category');
                            if ($categories && !is_wp_error($categories)) {
                                echo '<span class="product-category">' . esc_html($categories[0]->name) . '</span>';
                            }
                            ?>
                        </div>
                        
                        <?php
                        $price = get_post_meta(get_the_ID(), '_car_product_price', true);
                        if ($price) :
                        ?>
                            <div class="product-price">
                                <span class="price">NT$ <?php echo esc_html(number_format($price)); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <div class="product-actions">
                            <a href="#contact" class="btn btn-primary">立即詢價</a>
                            <a href="#specifications" class="btn btn-secondary">查看規格</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- 產品內容 -->
        <section class="product-content">
            <div class="container">
                <div class="content-tabs">
                    <nav class="tab-nav">
                        <button class="tab-btn active" data-tab="description">產品描述</button>
                        <button class="tab-btn" data-tab="specifications">技術規格</button>
                        <button class="tab-btn" data-tab="reviews">客戶評價</button>
                    </nav>
                    
                    <div class="tab-content">
                        <div class="tab-panel active" id="description">
                            <div class="product-description">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        
                        <div class="tab-panel" id="specifications">
                            <div class="product-specifications">
                                <?php
                                $specifications = get_post_meta(get_the_ID(), '_car_product_specifications', true);
                                if ($specifications) {
                                    echo '<div class="specs-content">' . nl2br(esc_html($specifications)) . '</div>';
                                } else {
                                    echo '<p>目前沒有技術規格資訊。</p>';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="tab-panel" id="reviews">
                            <div class="product-reviews">
                                <div class="review-item">
                                    <div class="review-header">
                                        <h4>張先生</h4>
                                        <div class="review-rating">
                                            <span>★★★★★</span>
                                        </div>
                                    </div>
                                    <p>品質非常好，安裝簡單，效果顯著。推薦給大家！</p>
                                </div>
                                
                                <div class="review-item">
                                    <div class="review-header">
                                        <h4>李小姐</h4>
                                        <div class="review-rating">
                                            <span>★★★★☆</span>
                                        </div>
                                    </div>
                                    <p>產品符合期待，客服態度很好，交貨速度快。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- 相關產品 -->
        <section class="related-products">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">相關產品</h2>
                    <p class="section-subtitle">您可能也會喜歡這些產品</p>
                </div>
                
                <div class="products-grid">
                    <?php
                    $related_products = new WP_Query(array(
                        'post_type' => 'car_product',
                        'posts_per_page' => 4,
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'car_brand',
                                'field' => 'term_id',
                                'terms' => wp_get_post_terms(get_the_ID(), 'car_brand', array('fields' => 'ids'))
                            )
                        )
                    ));
                    
                    if ($related_products->have_posts()) :
                        while ($related_products->have_posts()) : $related_products->the_post();
                    ?>
                        <div class="product-card">
                            <div class="product-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
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
                            </div>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
</main>

<script>
// 產品頁面標籤切換
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // 移除所有活動狀態
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanels.forEach(p => p.classList.remove('active'));
            
            // 添加活動狀態
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});
</script>

<?php get_footer(); ?>