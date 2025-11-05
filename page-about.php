<?php
/**
 * Template Name: About
 * About ページテンプレート
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">About</h1>
            <p class="page-header__subtitle">自己紹介</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="about-content">
                <!-- プロフィール画像 -->
                <div class="about-content__image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about.jpg'); ?>" alt="プロフィール写真" class="profile-image">
                </div>

                <!-- プロフィール情報 -->
                <div class="about-content__text">
                    <h2 class="about-content__name">安重 一弥</h2>
                    <p class="about-content__description">
                        こちらにプロフィールの説明文を記載します。技術力、実績、人柄などを効果的に伝える内容にしてください。
                    </p>

                    <!-- スキルセット -->
                    <div class="skills">
                        <h3 class="skills__title">スキルセット</h3>
                        <ul class="skills__list">
                            <li class="skills__item">HTML/CSS</li>
                            <li class="skills__item">JavaScript</li>
                            <li class="skills__item">jQuery</li>
                            <li class="skills__item">WordPress</li>
                        </ul>
                    </div>

                    <!-- 経歴 -->
                    <div class="career">
                        <h3 class="career__title">経歴</h3>
                        <div class="career__item">
                            <p class="career__period">20XX年 - 現在</p>
                            <p class="career__description">フリーランスエンジニア</p>
                        </div>
                        <div class="career__item">
                            <p class="career__period">20XX年 - 20XX年</p>
                            <p class="career__description">前職の経歴</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

