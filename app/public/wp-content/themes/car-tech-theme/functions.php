<?php
/**
 * Car Tech Theme Functions
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/functions.php
 */

// 防止直接訪問
if (!defined('ABSPATH')) {
    exit;
}

// 主題設定
function car_theme_setup() {
    // 添加主題支持
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    
    // 註冊導航菜單
    register_nav_menus(array(
        'primary' => '主要導航',
        'footer' => '頁腳導航'
    ));
    
    // 添加圖片尺寸
    add_image_size('product-thumb', 400, 300, true);
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('brand-logo', 200, 100, true);
}
add_action('after_setup_theme', 'car_theme_setup');

// 載入樣式和腳本
function car_theme_scripts() {
    // 載入 Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap', array(), null);
    
    // 載入主題樣式
    wp_enqueue_style('car-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // 載入 JavaScript
    wp_enqueue_script('car-theme-script', get_template_directory_uri() . '/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);
    
    // 本地化腳本
    wp_localize_script('car-theme-script', 'carTheme', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('car_theme_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'car_theme_scripts');

// 註冊小工具區域
function car_theme_widgets_init() {
    register_sidebar(array(
        'name' => '頁腳小工具區域',
        'id' => 'footer-widgets',
        'description' => '頁腳區域的小工具',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'car_theme_widgets_init');

// 自定義文章類型 - 汽車產品
function create_car_product_post_type() {
    $labels = array(
        'name' => '汽車產品',
        'singular_name' => '汽車產品',
        'add_new' => '新增產品',
        'add_new_item' => '新增汽車產品',
        'edit_item' => '編輯產品',
        'new_item' => '新產品',
        'view_item' => '查看產品',
        'search_items' => '搜索產品',
        'not_found' => '找不到產品',
        'not_found_in_trash' => '回收站中找不到產品'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-car',
        'rewrite' => array('slug' => 'products'),
        'show_in_rest' => true,
        'capability_type' => 'post'
    );

    register_post_type('car_product', $args);
}
add_action('init', 'create_car_product_post_type');

// 自定義分類 - 汽車品牌
function create_car_brand_taxonomy() {
    $labels = array(
        'name' => '汽車品牌',
        'singular_name' => '汽車品牌',
        'search_items' => '搜索品牌',
        'all_items' => '所有品牌',
        'parent_item' => '上級品牌',
        'parent_item_colon' => '上級品牌:',
        'edit_item' => '編輯品牌',
        'update_item' => '更新品牌',
        'add_new_item' => '新增品牌',
        'new_item_name' => '新品牌名稱',
        'menu_name' => '汽車品牌',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'brand'),
        'show_in_rest' => true,
    );

    register_taxonomy('car_brand', array('car_product'), $args);
}
add_action('init', 'create_car_brand_taxonomy');

// 自定義分類 - 產品類別
function create_car_category_taxonomy() {
    $labels = array(
        'name' => '產品類別',
        'singular_name' => '產品類別',
        'search_items' => '搜索類別',
        'all_items' => '所有類別',
        'parent_item' => '上級類別',
        'parent_item_colon' => '上級類別:',
        'edit_item' => '編輯類別',
        'update_item' => '更新類別',
        'add_new_item' => '新增類別',
        'new_item_name' => '新類別名稱',
        'menu_name' => '產品類別',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'category'),
        'show_in_rest' => true,
    );

    register_taxonomy('car_category', array('car_product'), $args);
}
add_action('init', 'create_car_category_taxonomy');

// 添加自定義元欄位
function add_car_product_meta_boxes() {
    add_meta_box(
        'car_product_details',
        '產品詳細資訊',
        'car_product_meta_callback',
        'car_product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_car_product_meta_boxes');

// 自定義元欄位回調函數
function car_product_meta_callback($post) {
    wp_nonce_field('car_product_meta_nonce', 'car_product_meta_nonce_field');
    
    $price = get_post_meta($post->ID, '_car_product_price', true);
    $featured = get_post_meta($post->ID, '_car_product_featured', true);
    $specifications = get_post_meta($post->ID, '_car_product_specifications', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="car_product_price">產品價格</label></th>
            <td><input type="text" id="car_product_price" name="car_product_price" value="<?php echo esc_attr($price); ?>" /></td>
        </tr>
        <tr>
            <th><label for="car_product_featured">精選產品</label></th>
            <td><input type="checkbox" id="car_product_featured" name="car_product_featured" <?php checked($featured, 'yes'); ?> value="yes" /></td>
        </tr>
        <tr>
            <th><label for="car_product_specifications">產品規格</label></th>
            <td><textarea id="car_product_specifications" name="car_product_specifications" rows="5" style="width:100%;"><?php echo esc_textarea($specifications); ?></textarea></td>
        </tr>
    </table>
    <?php
}

// 保存自定義元欄位
function save_car_product_meta($post_id) {
    if (!isset($_POST['car_product_meta_nonce_field']) || !wp_verify_nonce($_POST['car_product_meta_nonce_field'], 'car_product_meta_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['car_product_price'])) {
        update_post_meta($post_id, '_car_product_price', sanitize_text_field($_POST['car_product_price']));
    }

    $featured = isset($_POST['car_product_featured']) ? 'yes' : 'no';
    update_post_meta($post_id, '_car_product_featured', $featured);

    if (isset($_POST['car_product_specifications'])) {
        update_post_meta($post_id, '_car_product_specifications', sanitize_textarea_field($_POST['car_product_specifications']));
    }
}
add_action('save_post', 'save_car_product_meta');

// 處理聯絡表單 AJAX
function handle_contact_form() {
    check_ajax_referer('car_theme_nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // 驗證
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error('請填寫所有必填欄位');
        return;
    }

    if (!is_email($email)) {
        wp_send_json_error('請輸入有效的電子郵件地址');
        return;
    }

    // 發送郵件
    $to = get_option('admin_email');
    $email_subject = '來自網站的聯絡: ' . $subject;
    $email_message = "姓名: $name\n";
    $email_message .= "電子郵件: $email\n";
    $email_message .= "主題: $subject\n\n";
    $email_message .= "訊息:\n$message";

    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (wp_mail($to, $email_subject, nl2br($email_message), $headers)) {
        wp_send_json_success('訊息發送成功！我們會儘快回覆您。');
    } else {
        wp_send_json_error('發送失敗，請稍後再試。');
    }
}
add_action('wp_ajax_contact_form', 'handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'handle_contact_form');

// 自定義摘要長度
function car_theme_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'car_theme_excerpt_length');

// 自定義摘要結尾
function car_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'car_theme_excerpt_more');

// 添加主題自定義設定
function car_theme_customize_register($wp_customize) {
    // 添加主題選項面板
    $wp_customize->add_panel('car_theme_options', array(
        'title' => 'Car Tech 主題選項',
        'priority' => 10,
    ));

    // 聯絡資訊區段
    $wp_customize->add_section('contact_info', array(
        'title' => '聯絡資訊',
        'panel' => 'car_theme_options',
    ));

    // 電話號碼
    $wp_customize->add_setting('contact_phone', array(
        'default' => '+886-2-1234-5678',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone', array(
        'label' => '電話號碼',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // 電子郵件
    $wp_customize->add_setting('contact_email', array(
        'default' => 'info@cartech.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => '電子郵件',
        'section' => 'contact_info',
        'type' => 'email',
    ));

    // 地址
    $wp_customize->add_setting('contact_address', array(
        'default' => '台北市信義區信義路五段7號',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => '地址',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // 社群媒體區段
    $wp_customize->add_section('social_media', array(
        'title' => '社群媒體',
        'panel' => 'car_theme_options',
    ));

    // Facebook
    $wp_customize->add_setting('facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('facebook_url', array(
        'label' => 'Facebook URL',
        'section' => 'social_media',
        'type' => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('instagram_url', array(
        'label' => 'Instagram URL',
        'section' => 'social_media',
        'type' => 'url',
    ));

    // LinkedIn
    $wp_customize->add_setting('linkedin_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('linkedin_url', array(
        'label' => 'LinkedIn URL',
        'section' => 'social_media',
        'type' => 'url',
    ));
}
add_action('customize_register', 'car_theme_customize_register');

// 獲取聯絡資訊的輔助函數
function get_contact_info($field) {
    return get_theme_mod('contact_' . $field, '');
}

// 獲取社群媒體連結的輔助函數
function get_social_url($platform) {
    return get_theme_mod($platform . '_url', '');
}

// 添加後台管理樣式
function car_theme_admin_styles() {
    wp_enqueue_style('car-theme-admin', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'car_theme_admin_styles');

// 移除不需要的 WordPress 功能
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

// 優化 WordPress 性能
function car_theme_remove_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'car_theme_remove_version_strings');
add_filter('style_loader_src', 'car_theme_remove_version_strings');

// 添加結構化數據
function add_structured_data() {
    if (is_singular('car_product')) {
        global $post;
        $price = get_post_meta($post->ID, '_car_product_price', true);
        $schema = array(
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'image' => get_the_post_thumbnail_url($post->ID, 'large'),
        );
        
        if ($price) {
            $schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $price,
                'priceCurrency' => 'TWD'
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'add_structured_data');

?>