<?php
/**
 * Single Post Template
 * ブログ記事詳細ページテンプレート
 */

get_header();
?>

<!-- メインコンテンツ -->
<main class="main">
    <!-- パンくず -->
    <nav class="breadcrumb">
        <div class="container">
            <ol class="breadcrumb__list">
                <li class="breadcrumb__item"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li class="breadcrumb__item"><a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a></li>
                <li class="breadcrumb__item"><?php the_title(); ?></li>
            </ol>
        </div>
    </nav>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="article">
                <div class="container">
                    <header class="article__header">
                        <time class="article__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y年n月j日'); ?></time>
                        <h1 class="article__title"><?php the_title(); ?></h1>
                    </header>

                    <div class="article__content">
                        <?php if (has_post_thumbnail()) : ?>
                            <!-- 記事のヒーロー画像 -->
                            <div class="article__hero-image">
                                <?php the_post_thumbnail('large', array('class' => 'article__hero-img', 'alt' => get_the_title())); ?>
                            </div>
                        <?php endif; ?>

                        <?php the_content(); ?>
                    </div>

                    <footer class="article__footer">
                        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--link">← ブログ一覧に戻る</a>
                    </footer>
                </div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php
get_footer();
?>

