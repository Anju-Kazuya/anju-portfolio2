<?php
/**
 * Template Name: Blog
 * Blog ページテンプレート
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
                <?php
                // WordPressの投稿を取得
                // 固定ページテンプレートでは'page'、アーカイブページでは'paged'を使用
                $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
                $blog_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => $paged
                ));

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                ?>
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
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p>ブログ記事がまだありません。</p>
                <?php endif; ?>
            </div>

            <!-- ページネーション -->
            <?php if ($blog_query->max_num_pages > 1) : ?>
                <div class="pagination">
                    <?php
                    // 固定ページテンプレート用のページネーションURL生成
                    $current_url = get_permalink();
                    $page_format = (strpos($current_url, '?') !== false) ? '&paged=%#%' : '?paged=%#%';
                    $base_url = $current_url . $page_format;
                    
                    echo paginate_links(array(
                        'base' => $base_url,
                        'format' => '',
                        'current' => max(1, $paged),
                        'total' => $blog_query->max_num_pages,
                        'mid_size' => 2,
                        'prev_text' => '« 前へ',
                        'next_text' => '次へ »',
                        'type' => 'list',
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>

