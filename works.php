<?php
/**
 * Template Name: Works
 * Works ページテンプレート
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Works</h1>
            <p class="page-header__subtitle">制作実績</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="works-grid">
                <!-- 実績カード1: 株式会社アグリード岩手 -->
                <a href="https://revolution.aglead-iwate.com/" class="work-card" target="_blank" rel="noopener noreferrer">
                    <div class="work-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/agreedImg.png'); ?>" alt="株式会社アグリード岩手" class="work-card__img">
                    </div>
                    <div class="work-card__content">
                        <h2 class="work-card__title">株式会社アグリード岩手 様</h2>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">担当業務</h3>
                            <p class="work-card__description">コーディング / jQueryプログラミング / WordPress実装 / サイトリリース</p>
                        </div>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">コメント</h3>
                            <p class="work-card__description">FVのアニメーション、ヘッダー追従機能、セクション毎のフェードアップなどのUIを実装しました。また、WordPressも実装し、リリース作業まで担当しました。</p>
                        </div>
                    </div>
                </a>

                <!-- 実績カード2: 有限会社大吉建設 -->
                <a href="https://daikichikensetsu.jp/" class="work-card" target="_blank" rel="noopener noreferrer">
                    <div class="work-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/daikichiImg.png'); ?>" alt="有限会社大吉建設" class="work-card__img">
                    </div>
                    <div class="work-card__content">
                        <h2 class="work-card__title">有限会社大吉建設 様</h2>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">担当業務</h3>
                            <p class="work-card__description">コーディング / jQueryプログラミング / WordPress実装</p>
                        </div>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">コメント</h3>
                            <p class="work-card__description">ホーム画面、お知らせ、コンセプトのページのコーディングをし、jQueryでフェードアップ、ハンバーガーメニューの実装をしました。</p>
                        </div>
                    </div>
                </a>

                <!-- 実績カード3: ゴリラクリニック -->
                <a href="https://gorilla.clinic/operation/epilation/lp/008/b/" class="work-card" target="_blank" rel="noopener noreferrer">
                    <div class="work-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/goliraImg.png'); ?>" alt="ゴリラクリニック" class="work-card__img">
                    </div>
                    <div class="work-card__content">
                        <h2 class="work-card__title">ゴリラクリニック 様</h2>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">担当業務</h3>
                            <p class="work-card__description">コーディング / jQueryプログラミング / WordPress機能改修 / サイトリリース</p>
                        </div>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">コメント</h3>
                            <p class="work-card__description">LPサイトの改修を担当しました。jQueryにてクライアント様のご用件に沿った動きを表現しました。また、表示崩れが生じているページのプログラムを読み取り、修正しました。</p>
                        </div>
                    </div>
                </a>

                <!-- 実績カード4: 安重 一弥 ポートフォリオサイト -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="work-card">
                    <div class="work-card__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/portfolioImg.png'); ?>" alt="安重 一弥 ポートフォリオサイト" class="work-card__img">
                    </div>
                    <div class="work-card__content">
                        <h2 class="work-card__title">安重 一弥 ポートフォリオサイト 様</h2>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">担当業務</h3>
                            <p class="work-card__description">デザイン / コーディング / jQueryプログラミング / WordPress実装 / サイトリリース</p>
                        </div>
                        <div class="work-card__section">
                            <h3 class="work-card__subtitle">コメント</h3>
                            <p class="work-card__description">実績をメインに伝えるサイトとして、シンプルで伝わりやすい構成で制作しました。</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

