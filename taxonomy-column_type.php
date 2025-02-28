<?php
$column_slug = get_query_var('column_type');
$column = get_term_by('slug', $column_slug, 'column_type');
?>

<?php get_header(); ?>
<main>
    <div class="breadCrumb__wrap">
        <div class="breadCrumb">
            <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
    </div>
    <div class="inner__main">
        <!-- メニュー -->
        <div class="archive">


            <!-- コラム一覧カード -->
            <div class="column__area">
                <div class="column__title">
                    <h1>COLUMN</h1>
                    <p><?php single_term_title('');
                        ?></p>
                </div>
                <!-- ↓体験レポートとインタビューのボタン -->
                <div class="archive_category">
                    <ul class="archive__list">
                        <?php
                        $all_link = home_url('/column');
                        echo '<li><a href="' . $all_link . '">All</a></li>';

                        $terms = get_terms(array(
                            'taxonomy' => 'column_type',
                            'hide_empty' => false,
                        ));

                        if (!empty($terms) && !is_wp_error($terms)) {

                            foreach ($terms as $term) {
                                echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!-- スライダー ここから -->
                <div class="inner__column-area">
                    <?php
                    if (have_posts()):
                    ?>
                        <?php while (have_posts()): the_post(); ?>
                            <div class="wrap__column-card">
                                <?php get_template_part('template-parts/loop', 'column'); ?>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="column__footer">
                <div class="container__page-num">
                    <?php if (function_exists('wp_pagenavi')):  ?>
                        <div class="column_page-num">
                            <?php wp_pagenavi(); ?>
                        </div>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
</main>

<?php get_footer(); ?>
