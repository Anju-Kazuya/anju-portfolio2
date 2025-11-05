<?php
/**
 * Template Name: Contact Thanks
 * Contact Thanks ページテンプレート
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">送信完了</h1>
            <p class="page-header__subtitle">Thanks</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="contact-thanks-wrapper" style="text-align: center; padding: 3rem 0;">
                <p style="font-size: 1.1rem; margin-bottom: 2rem;">
                    お問い合わせありがとうございました。<br>
                    内容を確認次第、ご連絡させていただきます。
                </p>
                <div class="section__button">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--link">トップページに戻る</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

