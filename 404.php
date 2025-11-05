<?php
/**
 * 404 Template
 * 404エラーページテンプレート
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <section class="section">
        <div class="container">
            <div class="error-message" style="text-align: center; padding: 4rem 0;">
                <h1 class="error-message__title" style="font-size: 4rem; font-weight: bold; margin-bottom: 1rem;">404</h1>
                <p class="error-message__text" style="font-size: 1.5rem; margin-bottom: 1rem;">ページが見つかりません</p>
                <p class="error-message__description" style="margin-bottom: 2rem;">
                    お探しのページは、移動または削除された可能性があります。<br>
                    トップページから再度お探しください。
                </p>
                <div class="error-message__buttons">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">トップページに戻る</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

