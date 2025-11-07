<?php
/**
 * Template Name: Home
 * The main template file
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <!-- Heroセクション -->
    <section class="hero">
        <div class="hero__content">
            <h2 class="hero__title">Anju Kazuya</h2>
            <p class="hero__subtitle">Portfolio</p>
        </div>
    </section>

    <!-- Serviceセクション -->
    <section class="section section--gray">
        <div class="container">
            <h2 class="section__title">Service</h2>
            <div class="service-grid">
                <div class="service-item">
                    <div class="service-item__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/service-design.png'); ?>" alt="デザイン" class="service-item__img">
                    </div>
                    <h3 class="service-item__title">デザイン</h3>
                    <p class="service-item__description">
                        Webサイトのデザインをさせていただきます。<br>
                        サイトの目的・要望等ヒアリングさせていただき、ご希望に沿ったデザインを提案します。
                    </p>
                </div>
                <div class="service-item">
                    <div class="service-item__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/service-coding.png'); ?>" alt="コーディング" class="service-item__img">
                    </div>
                    <h3 class="service-item__title">コーディング</h3>
                    <p class="service-item__description">
                        デザインをもとにHTML/CSS、jQuery、WordPressを使用したコーディングをさせていただきます。
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- セクション1: Aboutプレビュー -->
    <section class="section">
        <div class="container">
            <h2 class="section__title">About</h2>
            <div class="section__image">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about.jpg'); ?>" alt="About" class="section__img">
            </div>
            <p class="section__text">スキル、経歴についてご紹介します。</p>
            <div class="section__button">
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--link">詳しく見る →</a>
            </div>
        </div>
    </section>

    <!-- セクション2: Worksプレビュー -->
    <section class="section section--gray">
        <div class="container">
            <h2 class="section__title">Works</h2>
            <div class="works-preview-grid">
                <div class="works-preview-item">
                    <div class="works-preview-item__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/agreedImg.png'); ?>" alt="株式会社アグリード岩手" class="works-preview-item__img">
                    </div>
                    <h3 class="works-preview-item__title">株式会社アグリード岩手 様</h3>
                </div>
                <div class="works-preview-item">
                    <div class="works-preview-item__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/daikichiImg.png'); ?>" alt="有限会社大吉建設" class="works-preview-item__img">
                    </div>
                    <h3 class="works-preview-item__title">有限会社大吉建設 様</h3>
                </div>
                <div class="works-preview-item">
                    <div class="works-preview-item__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/goliraImg.png'); ?>" alt="ゴリラクリニック" class="works-preview-item__img">
                    </div>
                    <h3 class="works-preview-item__title">ゴリラクリニック 様</h3>
                </div>
                <div class="works-preview-item">
                    <div class="works-preview-item__image">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/portfolioImg.png'); ?>" alt="安重 一弥 ポートフォリオサイト" class="works-preview-item__img">
                    </div>
                    <h3 class="works-preview-item__title">安重 一弥 ポートフォリオサイト 様</h3>
                </div>
            </div>
            <div class="section__button">
                <a href="<?php echo esc_url(home_url('/works/')); ?>" class="btn btn--link">詳しく見る →</a>
            </div>
        </div>
    </section>

    <!-- セクション3: Blogプレビュー -->
    <section class="section">
        <div class="container">
            <h2 class="section__title">Blog</h2>
            <div class="blog-preview-list">
                <?php
                $blog_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                ?>
                    <a href="<?php the_permalink(); ?>" class="blog-card blog-card--preview blog-card--link">
                        <div class="blog-card__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'blog-card__img', 'alt' => get_the_title())); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog1.jpg'); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card__img">
                            <?php endif; ?>
                        </div>
                        <div class="blog-card__content">
                            <time class="blog-card__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y年n月j日'); ?></time>
                            <h3 class="blog-card__title"><?php the_title(); ?></h3>
                            <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                        </div>
                    </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p>ブログ記事がまだありません。</p>
                <?php endif; ?>
            </div>
            <div class="section__button">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--link">詳しく見る →</a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>

