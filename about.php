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
                    <?php
                    // 名前とふりがなをカスタムフィールドから取得
                    $name = get_post_meta(get_the_ID(), 'name', true);
                    $name_furigana = get_post_meta(get_the_ID(), 'name_furigana', true);
                    ?>
                    <?php if (!empty($name)): ?>
                    <h2 class="about-content__name">
                        <?php echo esc_html($name); ?>
                        <?php if ($name_furigana): ?>
                            <small class="about-content__name-furigana"><?php echo esc_html($name_furigana); ?></small>
                        <?php endif; ?>
                    </h2>
                    <?php endif; ?>
                    <div class="about-content__description">
                        <?php
                        // 固定ページのコンテンツを表示（WordPressエディタで編集可能）
                        the_content();
                        ?>
                    </div>

                    <!-- スキルセット -->
                    <?php
                    // スキルセットをカスタムフィールドから取得
                    $skills_text = get_post_meta(get_the_ID(), 'skills', true);
                    // カンマ区切りを配列に変換
                    $skills = !empty($skills_text) ? array_map('trim', explode(',', $skills_text)) : array();
                    $skills = array_filter($skills); // 空の要素を削除
                    ?>
                    <?php if (!empty($skills)): ?>
                    <div class="skills">
                        <h3 class="skills__title">スキルセット</h3>
                        <ul class="skills__list">
                            <?php foreach ($skills as $skill): ?>
                                <li class="skills__item"><?php echo esc_html($skill); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- 経歴 -->
                    <?php
                    // 経歴をカスタムフィールドから取得（JSON形式）
                    $career_json = get_post_meta(get_the_ID(), 'career', true);
                    $career_items = !empty($career_json) ? json_decode($career_json, true) : array();
                    if (empty($career_items) || !is_array($career_items)) {
                        $career_items = [];
                    }
                    ?>
                    <?php if (!empty($career_items)): ?>
                    <div class="career">
                        <h3 class="career__title">経歴</h3>
                        <?php foreach ($career_items as $career_item): ?>
                            <div class="career__item">
                                <p class="career__period"><?php echo esc_html($career_item['period'] ?? ''); ?></p>
                                <p class="career__description"><?php echo esc_html($career_item['description'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

