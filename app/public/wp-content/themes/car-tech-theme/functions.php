<?php
/**
 * Speedy Car Tech Theme Functions
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
    add_image_size('category-thumb', 300, 200, true);
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
        'name' => '改裝產品',
        'singular_name' => '改裝產品',
        'add_new' => '新增產品',
        'add_new_item' => '新增改裝產品',
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
    $installation_time = get_post_meta($post->ID, '_car_product_installation_time', true);
    $material = get_post_meta($post->ID, '_car_product_material', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="car_product_price">產品價格 (NT$)</label></th>
            <td><input type="text" id="car_product_price" name="car_product_price" value="<?php echo esc_attr($price); ?>" placeholder="例: 25000" /></td>
        </tr>
        <tr>
            <th><label for="car_product_featured">精選產品</label></th>
            <td><input type="checkbox" id="car_product_featured" name="car_product_featured" <?php checked($featured, 'yes'); ?> value="yes" /></td>
        </tr>
        <tr>
            <th><label for="car_product_material">材質</label></th>
            <td><input type="text" id="car_product_material" name="car_product_material" value="<?php echo esc_attr($material); ?>" placeholder="例: ABS塑料、碳纖維、FRP" /></td>
        </tr>
        <tr>
            <th><label for="car_product_installation_time">安裝時間</label></th>
            <td><input type="text" id="car_product_installation_time" name="car_product_installation_time" value="<?php echo esc_attr($installation_time); ?>" placeholder="例: 2-3小時" /></td>
        </tr>
        <tr>
            <th><label for="car_product_specifications">產品規格</label></th>
            <td><textarea id="car_product_specifications" name="car_product_specifications" rows="5" style="width:100%;" placeholder="詳細規格說明..."><?php echo esc_textarea($specifications); ?></textarea></td>
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

    if (isset($_POST['car_product_material'])) {
        update_post_meta($post_id, '_car_product_material', sanitize_text_field($_POST['car_product_material']));
    }

    if (isset($_POST['car_product_installation_time'])) {
        update_post_meta($post_id, '_car_product_installation_time', sanitize_text_field($_POST['car_product_installation_time']));
    }

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
    $phone = sanitize_text_field($_POST['phone']);
    $car_brand = sanitize_text_field($_POST['car_brand']);
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
    $to = 'cyl5656@yahoo.com.tw'; // Speedy 的郵件地址
    $email_subject = '[Speedy競速] 改裝諮詢: ' . $subject;
    $email_message = "<h3>來自網站的改裝諮詢</h3>";
    $email_message .= "<p><strong>姓名:</strong> $name</p>";
    $email_message .= "<p><strong>電子郵件:</strong> $email</p>";
    $email_message .= "<p><strong>聯絡電話:</strong> $phone</p>";
    $email_message .= "<p><strong>車款品牌:</strong> $car_brand</p>";
    $email_message .= "<p><strong>改裝需求:</strong> $subject</p>";
    $email_message .= "<p><strong>詳細說明:</strong></p>";
    $email_message .= "<p>$message</p>";
    $email_message .= "<hr>";
    $email_message .= "<p><small>此訊息來自 Speedy 競速車業改裝網站</small></p>";

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Speedy競速網站 <noreply@speedy168.com>',
        'Reply-To: ' . $email
    );

    if (wp_mail($to, $email_subject, $email_message, $headers)) {
        wp_send_json_success('諮詢訊息發送成功！我們會儘快與您聯繫。');
    } else {
        wp_send_json_error('發送失敗，請直接撥打電話 (02)8988-3180 或加入 LINE @speedyvip');
    }
}
add_action('wp_ajax_contact_form', 'handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'handle_contact_form');

// 自定義摘要長度
function car_theme_excerpt_length($length) {
    return 25;
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
        'title' => 'Speedy 競速主題選項',
        'priority' => 10,
    ));

    // 聯絡資訊區段
    $wp_customize->add_section('contact_info', array(
        'title' => '聯絡資訊',
        'panel' => 'car_theme_options',
    ));

    // 門市地址
    $wp_customize->add_setting('contact_address', array(
        'default' => '新北市林口區文化北路二段550巷30弄6號',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_address', array(
        'label' => '門市地址',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // 電話號碼 1
    $wp_customize->add_setting('contact_phone_1', array(
        'default' => '(02)8988-3180',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone_1', array(
        'label' => '電話號碼 1',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // 電話號碼 2
    $wp_customize->add_setting('contact_phone_2', array(
        'default' => '(02)8285-7932',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('contact_phone_2', array(
        'label' => '電話號碼 2',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // 電子郵件
    $wp_customize->add_setting('contact_email', array(
        'default' => 'cyl5656@yahoo.com.tw',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => '電子郵件',
        'section' => 'contact_info',
        'type' => 'email',
    ));

    // 營業時間
    $wp_customize->add_setting('business_hours', array(
        'default' => '週一至週六 09:00 ~ 19:00 (週六採預約制)',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('business_hours', array(
        'label' => '營業時間',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // LINE 官方 ID
    $wp_customize->add_setting('line_official_id', array(
        'default' => '@speedyvip',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('line_official_id', array(
        'label' => 'LINE 官方 ID',
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // LINE ID
    $wp_customize->add_setting('line_id', array(
        'default' => 'speedyclub',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('line_id', array(
        'label' => 'LINE ID',
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
        'label' => 'Facebook 粉絲頁',
        'section' => 'social_media',
        'type' => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('instagram_url', array(
        'label' => 'Instagram',
        'section' => 'social_media',
        'type' => 'url',
    ));

    // YouTube
    $wp_customize->add_setting('youtube_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('youtube_url', array(
        'label' => 'YouTube 頻道',
        'section' => 'social_media',
        'type' => 'url',
    ));

    // LINE
    $wp_customize->add_setting('line_url', array(
        'default' => 'https://line.me/ti/p/@speedyvip',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('line_url', array(
        'label' => 'LINE 官方帳號連結',
        'section' => 'social_media',
        'type' => 'url',
    ));

    // 網站設定區段
    $wp_customize->add_section('site_settings', array(
        'title' => '網站設定',
        'panel' => 'car_theme_options',
    ));

    // 公司名稱
    $wp_customize->add_setting('company_name', array(
        'default' => 'Speedy 競速車業改裝',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_name', array(
        'label' => '公司名稱',
        'section' => 'site_settings',
        'type' => 'text',
    ));

    // 公司標語
    $wp_customize->add_setting('company_slogan', array(
        'default' => '專業空力套件改裝 × 客製化設計 × 全車系服務',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('company_slogan', array(
        'label' => '公司標語',
        'section' => 'site_settings',
        'type' => 'text',
    ));

    // 公司簡介
    $wp_customize->add_setting('company_description', array(
        'default' => '專業改裝不只是升級，更是風格態度的展現。我們提供歐日空力套件品牌代理、客製化改裝設計、專業安裝施工等一站式服務。',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('company_description', array(
        'label' => '公司簡介',
        'section' => 'site_settings',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'car_theme_customize_register');

// 獲取聯絡資訊的輔助函數
function get_contact_info($field) {
    $defaults = array(
        'address' => '新北市林口區文化北路二段550巷30弄6號',
        'phone_1' => '(02)8988-3180',
        'phone_2' => '(02)8285-7932',
        'email' => 'cyl5656@yahoo.com.tw',
        'business_hours' => '週一至週六 09:00 ~ 19:00 (週六採預約制)',
        'line_official_id' => '@speedyvip',
        'line_id' => 'speedyclub'
    );
    
    return get_theme_mod('contact_' . $field, $defaults[$field] ?? '');
}

// 獲取社群媒體連結的輔助函數
function get_social_url($platform) {
    $defaults = array(
        'instagram' => 'https://line.me/ti/p/@speedyvip',
        'fb' => 'https://line.me/ti/p/@speedyvip',
        'youtube' => 'https://line.me/ti/p/@speedyvip',
        'line' => 'https://line.me/ti/p/@speedyvip',
    );
    
    return get_theme_mod($platform . '_url', $defaults[$platform] ?? '');
}

// 獲取網站設定的輔助函數
function get_site_setting($field) {
    $defaults = array(
        'company_name' => 'Speedy 競速車業改裝',
        'company_slogan' => '專業空力套件改裝 × 客製化設計 × 全車系服務',
        'company_description' => '專業改裝不只是升級，更是風格態度的展現。我們提供歐日空力套件品牌代理、客製化改裝設計、專業安裝施工等一站式服務。'
    );
    
    return get_theme_mod($field, $defaults[$field] ?? '');
}

// 添加後台管理樣式
function car_theme_admin_styles() {
    wp_enqueue_style('car-theme-admin', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'car_theme_admin_styles');

// 創建預設分類和品牌
function create_default_terms() {
    // 創建預設產品分類
    $categories = array(
        '前保桿套件' => '各車系前保桿改裝套件',
        '後保桿套件' => '後保桿與尾段改裝設計',
        '側裙套件' => '車身側面空力套件',
        '尾翼改裝' => '各式尾翼與擾流板',
        '寬體套件' => '全套寬體改裝方案',
        '碳纖維套件' => '輕量化碳纖維部件',
        '輪拱套件' => '輪拱加寬與造型改裝',
        '客製化改裝' => '專屬客製化改裝服務'
    );

    foreach ($categories as $name => $description) {
        if (!term_exists($name, 'car_category')) {
            wp_insert_term($name, 'car_category', array(
                'description' => $description
            ));
        }
    }

    // 創建預設汽車品牌
    $brands = array(
        'BMW' => '德系豪華運動房車改裝',
        'Mercedes-Benz' => '賓士全車系改裝套件',
        'Audi' => '奧迪運動化改裝方案',
        'Tesla' => '電動車專用改裝套件',
        'Porsche' => '保時捷性能提升改裝',
        'Lexus' => '凌志豪華改裝服務',
        'Toyota' => '豐田全車系改裝',
        'Honda' => '本田運動化套件',
        'Nissan' => '日產性能改裝方案',
        'Mazda' => '馬自達外觀改裝',
        'Subaru' => '速霸陸性能套件',
        'Mitsubishi' => '三菱運動改裝'
    );

    foreach ($brands as $name => $description) {
        if (!term_exists($name, 'car_brand')) {
            wp_insert_term($name, 'car_brand', array(
                'description' => $description
            ));
        }
    }
}
add_action('after_switch_theme', 'create_default_terms');

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
    if (is_front_page()) {
        // 首頁結構化數據 - 汽車改裝服務
        $schema = array(
            '@context' => 'https://schema.org/',
            '@type' => 'AutomotiveBusiness',
            'name' => get_site_setting('company_name'),
            'description' => get_site_setting('company_description'),
            'url' => home_url(),
            'telephone' => get_contact_info('phone_1'),
            'email' => get_contact_info('email'),
            'address' => array(
                '@type' => 'PostalAddress',
                'streetAddress' => get_contact_info('address'),
                'addressLocality' => '林口區',
                'addressRegion' => '新北市',
                'addressCountry' => 'TW'
            ),
            'openingHours' => 'Mo-Sa 09:00-19:00',
            'priceRange' => '$',
            'paymentAccepted' => '現金, 信用卡, 銀行轉帳',
            'currenciesAccepted' => 'TWD'
        );
        
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
    }
    
    if (is_singular('car_product')) {
        global $post;
        $price = get_post_meta($post->ID, '_car_product_price', true);
        $material = get_post_meta($post->ID, '_car_product_material', true);
        
        $schema = array(
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'image' => get_the_post_thumbnail_url($post->ID, 'large'),
            'brand' => array(
                '@type' => 'Brand',
                'name' => get_site_setting('company_name')
            ),
            'category' => 'Automotive Parts'
        );
        
        if ($price) {
            $schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $price,
                'priceCurrency' => 'TWD',
                'availability' => 'https://schema.org/InStock'
            );
        }
        
        if ($material) {
            $schema['material'] = $material;
        }
        
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
    }
}
add_action('wp_head', 'add_structured_data');

// 自定義登入頁面標誌
function custom_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/speedy-logo.png);
            height: 80px;
            width: 320px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
        .login {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        }
        .login form {
            background: rgba(26, 26, 26, 0.9);
            border: 1px solid #333;
        }
        .login label {
            color: #b0b0b0;
        }
        .login input[type=text], .login input[type=password] {
            background: #1a1a1a;
            border: 1px solid #333;
            color: #fff;
        }
        .wp-core-ui .button-primary {
            background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
            border-color: #00d4ff;
            text-shadow: none;
            box-shadow: none;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'custom_login_logo');

// 修改登入頁面連結
function custom_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

function custom_login_logo_url_title() {
    return get_site_setting('company_name');
}
add_filter('login_headertext', 'custom_login_logo_url_title');

?>