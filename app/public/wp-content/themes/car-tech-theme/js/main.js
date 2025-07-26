/**
 * Car Tech Theme Main JavaScript
 * 檔案路徑: app/public/wp-content/themes/car-tech-theme/js/main.js
 */

// DOM 載入完成後執行
document.addEventListener('DOMContentLoaded', function() {
    
    // 導航欄功能
    initNavigation();
    
    // 滾動效果
    initScrollEffects();
    
    // 平滑滾動
    initSmoothScroll();
    
    // 載入動畫
    initLoadAnimations();
    
    // 聯絡表單
    initContactForm();
    
    // 移動端菜單
    initMobileMenu();
    
    // 產品卡片效果
    initProductCardEffects();
    
    // 數字計數動畫
    initCounterAnimation();
    
    // 滾動進度條
    addScrollProgress();
});

// 導航欄功能
function initNavigation() {
    const navbar = document.querySelector('.navbar');
    const header = document.querySelector('.main-header');
    
    if (!navbar || !header) return;
    
    // 滾動時改變導航欄樣式
    window.addEventListener('scroll', throttle(function() {
        if (window.scrollY > 100) {
            header.style.background = 'rgba(10, 10, 10, 0.98)';
            navbar.style.padding = '15px 0';
        } else {
            header.style.background = 'rgba(10, 10, 10, 0.95)';
            navbar.style.padding = '20px 0';
        }
    }, 16));
    
    // 導航鏈接高亮
    const navLinks = document.querySelectorAll('.nav-links a');
    const sections = document.querySelectorAll('section[id]');
    
    if (navLinks.length > 0 && sections.length > 0) {
        window.addEventListener('scroll', throttle(function() {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 200;
                if (pageYOffset >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');
                if (href === '#' + current) {
                    link.classList.add('active');
                }
            });
        }, 16));
    }
}

// 滾動效果
function initScrollEffects() {
    // 滾動指示器
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const productsSection = document.querySelector('#products');
            if (productsSection) {
                productsSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
        
        // 滾動時隱藏指示器
        window.addEventListener('scroll', throttle(function() {
            if (window.scrollY > 200) {
                scrollIndicator.style.opacity = '0';
                scrollIndicator.style.visibility = 'hidden';
            } else {
                scrollIndicator.style.opacity = '1';
                scrollIndicator.style.visibility = 'visible';
            }
        }, 16));
    }
    
    // 回到頂部按鈕
    createBackToTopButton();
}

// 創建回到頂部按鈕
function createBackToTopButton() {
    const backToTop = document.createElement('div');
    backToTop.innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="18,15 12,9 6,15"></polyline>
        </svg>
    `;
    backToTop.className = 'back-to-top';
    backToTop.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 0 8px 25px rgba(0, 212, 255, 0.2);
    `;
    
    backToTop.querySelector('svg').style.cssText = `
        width: 24px;
        height: 24px;
        color: white;
    `;
    
    document.body.appendChild(backToTop);
    
    // 顯示/隱藏按鈕
    window.addEventListener('scroll', throttle(function() {
        if (window.scrollY > 500) {
            backToTop.style.opacity = '1';
            backToTop.style.visibility = 'visible';
        } else {
            backToTop.style.opacity = '0';
            backToTop.style.visibility = 'hidden';
        }
    }, 16));
    
    // 點擊回到頂部
    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // 懸停效果
    backToTop.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 12px 35px rgba(0, 212, 255, 0.3)';
    });
    
    backToTop.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '0 8px 25px rgba(0, 212, 255, 0.2)';
    });
}

// 平滑滾動
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = document.querySelector('.main-header')?.offsetHeight || 80;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// 載入動畫
function initLoadAnimations() {
    // 創建 Intersection Observer
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                
                // 為卡片添加延遲動畫
                if (entry.target.classList.contains('stagger-animation')) {
                    const cards = entry.target.querySelectorAll('.product-card, .brand-card, .service-card');
                    cards.forEach((card, index) => {
                        setTimeout(() => {
                            card.classList.add('fade-in', 'visible');
                        }, index * 150);
                    });
                }
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // 觀察所有需要動畫的元素
    const animateElements = document.querySelectorAll('.section-header, .about-content, .contact-content');
    animateElements.forEach(el => {
        el.classList.add('fade-in');
        observer.observe(el);
    });
    
    // 為網格容器添加錯開動畫類
    const grids = document.querySelectorAll('.products-grid, .brands-grid, .services-grid');
    grids.forEach(grid => {
        grid.classList.add('stagger-animation');
        observer.observe(grid);
    });
}

// 聯絡表單功能
function initContactForm() {
    const contactForm = document.querySelector('#contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // 獲取表單數據
            const formData = new FormData(this);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            
            // 表單驗證
            if (validateForm(formObject)) {
                // 顯示載入狀態
                showFormLoading(this);
                
                // 發送 AJAX 請求
                const ajaxData = new FormData();
                ajaxData.append('action', 'contact_form');
                ajaxData.append('nonce', carTheme.nonce);
                for (const [key, value] of formData.entries()) {
                    ajaxData.append(key, value);
                }
                
                fetch(carTheme.ajaxurl, {
                    method: 'POST',
                    body: ajaxData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showFormSuccess(data.data);
                        this.reset();
                    } else {
                        showFormError(data.data);
                    }
                })
                .catch(error => {
                    showFormError('發送失敗，請稍後再試。');
                })
                .finally(() => {
                    resetSubmitButton();
                });
            }
        });
        
        // 即時驗證
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearFieldError(this);
            });
        });
    }
}

// 表單驗證
function validateForm(formData) {
    let isValid = true;
    const form = document.querySelector('#contactForm');
    
    // 清除之前的錯誤
    clearFormErrors(form);
    
    // 驗證姓名
    if (!formData.name || formData.name.trim().length < 2) {
        showFieldError(form.querySelector('[name="name"]'), '請輸入有效的姓名');
        isValid = false;
    }
    
    // 驗證郵件
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!formData.email || !emailRegex.test(formData.email)) {
        showFieldError(form.querySelector('[name="email"]'), '請輸入有效的電子郵件地址');
        isValid = false;
    }
    
    // 驗證主題
    if (!formData.subject || formData.subject.trim().length < 3) {
        showFieldError(form.querySelector('[name="subject"]'), '請輸入主題');
        isValid = false;
    }
    
    // 驗證訊息
    if (!formData.message || formData.message.trim().length < 10) {
        showFieldError(form.querySelector('[name="message"]'), '訊息內容至少需要10個字符');
        isValid = false;
    }
    
    return isValid;
}

// 驗證單個欄位
function validateField(field) {
    const value = field.value.trim();
    let isValid = true;
    
    switch (field.name) {
        case 'name':
            if (value.length < 2) {
                showFieldError(field, '姓名至少需要2個字符');
                isValid = false;
            }
            break;
        case 'email':
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                showFieldError(field, '請輸入有效的電子郵件地址');
                isValid = false;
            }
            break;
        case 'subject':
            if (value.length < 3) {
                showFieldError(field, '主題至少需要3個字符');
                isValid = false;
            }
            break;
        case 'message':
            if (value.length < 10) {
                showFieldError(field, '訊息內容至少需要10個字符');
                isValid = false;
            }
            break;
    }
    
    return isValid;
}

// 顯示欄位錯誤
function showFieldError(field, message) {
    field.style.borderColor = '#ff4757';
    
    // 移除舊的錯誤訊息
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    
    // 添加新的錯誤訊息
    const errorElement = document.createElement('div');
    errorElement.className = 'field-error';
    errorElement.style.cssText = `
        color: #ff4757;
        font-size: 0.9rem;
        margin-top: 5px;
        animation: shake 0.3s ease-in-out;
    `;
    errorElement.textContent = message;
    field.parentNode.appendChild(errorElement);
    
    // 添加搖晃動畫
    if (!document.querySelector('#shake-animation')) {
        const style = document.createElement('style');
        style.id = 'shake-animation';
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);
    }
}

// 清除欄位錯誤
function clearFieldError(field) {
    field.style.borderColor = '#333333';
    const error = field.parentNode.querySelector('.field-error');
    if (error) {
        error.remove();
    }
}

// 清除所有表單錯誤
function clearFormErrors(form) {
    const errors = form.querySelectorAll('.field-error');
    errors.forEach(error => error.remove());
    
    const fields = form.querySelectorAll('input, textarea');
    fields.forEach(field => {
        field.style.borderColor = '#333333';
    });
}

// 顯示表單載入狀態
function showFormLoading(form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = `
        <svg style="width: 20px; height: 20px; animation: spin 1s linear infinite; margin-right: 8px;" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path>
        </svg>
        發送中...
    `;
    
    // 添加旋轉動畫CSS
    if (!document.querySelector('#spin-animation')) {
        const style = document.createElement('style');
        style.id = 'spin-animation';
        style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    }
}

// 重置提交按鈕
function resetSubmitButton() {
    const submitBtn = document.querySelector('#contactForm button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = '發送訊息';
    }
}

// 顯示表單成功狀態
function showFormSuccess(message) {
    showNotification(message, 'success');
}

// 顯示表單錯誤狀態
function showFormError(message) {
    showNotification(message, 'error');
}

// 顯示通知
function showNotification(message, type) {
    const notification = document.createElement('div');
    const bgColor = type === 'success' ? 'linear-gradient(135deg, #00d4ff, #0099cc)' : 'linear-gradient(135deg, #ff4757, #ff3742)';
    
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 30px;
        background: ${bgColor};
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        z-index: 10000;
        transform: translateX(400px);
        transition: transform 0.3s ease;
        max-width: 400px;
    `;
    
    const icon = type === 'success' ? 
        '<polyline points="20,6 9,17 4,12"></polyline>' : 
        '<line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>';
    
    notification.innerHTML = `
        <div style="display: flex; align-items: center; gap: 10px;">
            <svg style="width: 24px; height: 24px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                ${icon}
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // 顯示通知
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // 隱藏通知
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 4000);
}

// 移動端菜單
function initMobileMenu() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
        
        // 點擊菜單項目關閉菜單
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });
        
        // 點擊外部關閉菜單
        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                mobileToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    }
}

// 產品卡片懸停效果
function initProductCardEffects() {
    const productCards = document.querySelectorAll('.product-card, .brand-card, .service-card');
    
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// 數字計數動畫
function initCounterAnimation() {
    const counters = document.querySelectorAll('.stat-number');
    
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.textContent);
                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target + '+';
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.ceil(current) + '+';
                    }
                }, 20);
                
                observer.unobserve(counter);
            }
        });
    });
    
    counters.forEach(counter => {
        observer.observe(counter);
    });
}

// 添加滾動進度條
function addScrollProgress() {
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(135deg, #00d4ff 0%, #0099cc 100%);
        z-index: 10000;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);
    
    window.addEventListener('scroll', throttle(() => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        progressBar.style.width = scrolled + '%';
    }, 16));
}

// 添加鍵盤導航支持
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        // 關閉移動端菜單
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (mobileToggle && navMenu && navMenu.classList.contains('active')) {
            mobileToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    }
});

// 性能優化：節流函數
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// 延遲載入圖片
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// 初始化延遲載入
window.addEventListener('load', function() {
    initLazyLoading();
});

// 處理視窗大小變更
window.addEventListener('resize', throttle(function() {
    // 重置移動端菜單狀態
    if (window.innerWidth > 768) {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (mobileToggle && navMenu) {
            mobileToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    }
}, 100));