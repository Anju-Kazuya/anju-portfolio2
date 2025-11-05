// ハンバーガーメニュー
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.header__hamburger');
    const nav = document.querySelector('.header__nav');
    
    if (hamburger && nav) {
        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('is-active');
            nav.classList.toggle('is-active');
            
            // aria-expanded属性を更新
            const isExpanded = hamburger.classList.contains('is-active');
            hamburger.setAttribute('aria-expanded', isExpanded);
        });
        
        // メニューアイテムをクリックしたらメニューを閉じる
        const navLinks = document.querySelectorAll('.nav-list__item a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                hamburger.classList.remove('is-active');
                nav.classList.remove('is-active');
                hamburger.setAttribute('aria-expanded', 'false');
            });
        });

        // メニューが開いている時に画面外をクリックしたらメニューを閉じる
        document.addEventListener('click', function(event) {
            const isClickInsideNav = nav.contains(event.target);
            const isClickOnHamburger = hamburger.contains(event.target);
            
            if (!isClickInsideNav && !isClickOnHamburger && nav.classList.contains('is-active')) {
                hamburger.classList.remove('is-active');
                nav.classList.remove('is-active');
                hamburger.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ページネーション機能
    const blogCards = document.querySelectorAll('.blog-card');
    const pageLinks = document.querySelectorAll('.pagination__link--page');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (blogCards.length > 0 && pageLinks.length > 0) {
        let currentPage = 1;
        const itemsPerPage = 3;
        const totalPages = Math.ceil(blogCards.length / itemsPerPage);

        // ページ切り替え関数
        function showPage(page) {
            currentPage = page;
            
            // すべての記事を非表示
            blogCards.forEach((card, index) => {
                const pageNum = Math.floor(index / itemsPerPage) + 1;
                if (pageNum === page) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });

            // ページネーションのアクティブ状態を更新
            pageLinks.forEach((link, index) => {
                const linkPage = index + 1;
                if (linkPage === page) {
                    link.classList.add('pagination__link--active');
                } else {
                    link.classList.remove('pagination__link--active');
                }
            });

            // 前へ/次へボタンの表示制御
            if (prevBtn) {
                if (currentPage === 1) {
                    prevBtn.style.opacity = '0.5';
                    prevBtn.style.pointerEvents = 'none';
                } else {
                    prevBtn.style.opacity = '1';
                    prevBtn.style.pointerEvents = 'auto';
                }
            }

            if (nextBtn) {
                if (currentPage === totalPages) {
                    nextBtn.style.opacity = '0.5';
                    nextBtn.style.pointerEvents = 'none';
                } else {
                    nextBtn.style.opacity = '1';
                    nextBtn.style.pointerEvents = 'auto';
                }
            }
        }

        // ページリンクのクリックイベント
        pageLinks.forEach((link, index) => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = parseInt(this.getAttribute('data-page'));
                showPage(page);
            });
        });

        // 前へボタンのクリックイベント
        if (prevBtn) {
            prevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    showPage(currentPage - 1);
                }
            });
        }

        // 次へボタンのクリックイベント
        if (nextBtn) {
            nextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentPage < totalPages) {
                    showPage(currentPage + 1);
                }
            });
        }

        // 初期表示（1ページ目）
        showPage(1);
    }
});

