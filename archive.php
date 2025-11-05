<?php
/**
 * Archive Template
 * ブログ一覧ページテンプレート
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Blog</h1>
            <p class="page-header__subtitle">技術記事・学習記録</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="blog-list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="blog-card">
                            <div class="blog-card__image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'blog-card__img', 'alt' => get_the_title())); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/blog1.jpg'); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card__img">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="blog-card__content">
                                <time class="blog-card__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y年n月j日'); ?></time>
                                <h2 class="blog-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="blog-card__link">続きを読む →</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>ブログ記事がまだありません。</p>
                <?php endif; ?>
            </div>

            <!-- ページネーション -->
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '« 前へ',
                'next_text' => '次へ »',
                'screen_reader_text' => 'ページネーション',
            ));
            ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>

