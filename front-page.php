<?php get_header(); ?>
<?php
wp_enqueue_style('test', get_template_directory_uri() . '/assets/css/test.css');
wp_enqueue_script('test_js', get_template_directory_uri() . '/assets/js/test.js');
?>
<link href="../../assets/css/searchpopup.css" rel="stylesheet" />
<main>
    <div class="inner__main">
        <section class="landing">
            <div class="inner__landing">
                <div class="wrap__kv">
                    <div class="container__kv-Mo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_mo.png" alt="kv_mobile">
                    </div>
                    <div class="container__kv-Pc">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_p.png" alt="kv_pc">
                    </div>
                </div>
                <div class="about">
                    <?php
                    $args = [
                        'post_type' => 'page',
                        'post__in' => ['174'], // サーバ環境用
                    ];
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()):
                        while ($the_query->have_posts()): $the_query->the_post();
                    ?>
                            <div class="container__about">
                                <div class="note__about">
                                    <?php echo the_excerpt(); ?>
                                </div>
                                <div class="image__about">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="about">
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif ?>
                </div>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- search -->
        <section class="search">
            <div class="container__search">
                <div class="title__search">
                    <h1>SERACH</h1>
                    <p>検索</p>
                    <img src="<?php echo get_template_directory_uri();  ?>/assets/images/matcha.png" alt="みどり円">
                </div>
                <div class="options__search">
                    <button class="option__search" onclick="togglePopup('popup_area')">エリアを選ぶ</button>
                    <div class="overlay" style="display: none;"></div>
                    <div class="search_container" id="popup_area" style="display: none;">
                        <div class="close_button" onclick="closePopup()">×</div>
                        <div class="search_header">
                            <h1>エリアを選ぶ</h1>
                        </div>
                        <div class="search_options">
                            <label class="accordion_item full_width">
                                <input type="checkbox" onclick="selectAll('tokushima', this);">徳島市全域
                            </label>
                            <div id="tokushima" class="single_column">
                                <?php
                                $parent_term = get_term_by('slug', 'area01', 'area');
                                $child_terms = get_terms(array(
                                    'taxonomy' => 'area',
                                    'parent' => $parent_term->term_id,
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                //  print_r($child_terms);
                                if (! empty($child_terms) && ! is_wp_error($child_terms)):
                                    foreach ($child_terms as $child_term) :
                                ?>
                                        <label class="accordion_item">
                                            <input type="checkbox" value=" <?php echo $child_term->name; ?>" onclick="selectItem(this)">
                                            <?php echo $child_term->name; ?>
                                        </label>
                                <?php
                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                            <label class="accordion_item full_width">
                                <input type="checkbox" onclick="selectAll('itano', this);">板野郡全域
                            </label>
                            <div id="itano" class="double_column">
                                <?php
                                $parent_term = get_term_by('slug', 'area02', 'area');
                                $child_terms = get_terms(array(
                                    'taxonomy' => 'area',
                                    'parent' => $parent_term->term_id,
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                if (!empty($child_terms) && ! is_wp_error($child_terms)):
                                    foreach ($child_terms as $child_term) :

                                ?>
                                        <label class="accordion_item">
                                            <input type="checkbox" value="<?php echo $child_term->name; ?>" onclick="selectItem(this)">
                                            <?php echo $child_term->name; ?>
                                        </label>
                                <?php

                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                            <div class="double_column">
                                <?php
                                $terms = get_terms(array(
                                    'taxonomy' => 'area',
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',

                                ));
                                if (!empty($terms) && ! is_wp_error($terms)):
                                    foreach ($terms as $term):
                                        if ($term->parent == 0):
                                            if ($term->slug == 'area01' || $term->slug == 'area02') {
                                                continue;
                                            }
                                ?>
                                            <label class="accordion_item">
                                                <input type="checkbox" value="<?php echo $term->name; ?>" onclick="selectItem(this)">
                                                <?php echo $term->name; ?>
                                            </label>
                                <?php
                                        endif;
                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <div class="additional-buttons">
                                    <button onclick="toggleAgePopup()">年齢も選ぶ</button>
                                    <button onclick="toggleGenrePopup()">ジャンルも選ぶ</button>
                                </div>
                                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                            </div>
                        </div>
                    </div>
                    <button class="option__search" onclick="togglePopup('popup_age')">年齢を選ぶ</button>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_age" style="display: none;">
                        <div class="close_button" onclick="closePopup()">×</div>
                        <div class="search_header">
                            <h1>年齢を選ぶ</h1>
                        </div>
                        <div class="search_options">
                            <div class="double_column">
                                <?php
                                $terms = get_terms(array(
                                    'taxonomy' => 'age_type',
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                if (!empty($terms)):
                                    foreach ($terms as $term) :
                                ?>
                                        <label class="accordion_item">
                                            <input type="checkbox" value="ベビー" onclick="selectItem(this)">
                                            <?php echo $term->name; ?>
                                        </label>
                                <?php
                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="search_actions">
                            <button class="search_button">この条件で検索する</button>
                            <div class="additional-buttons">
                                <button onclick="toggleAreaPopup()">エリアも選ぶ</button>
                                <button onclick="toggleGenrePopup()">ジャンルも選ぶ</button>
                            </div>
                            <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                        </div>
                    </div>
                    <button class="option__search" onclick="togglePopup('popup_genre')">ジャンルを選ぶ</button>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_genre" style="display: none;">
                        <div class="close_button" onclick="closePopup()">×</div>
                        <div class="search_header">
                            <h1>ジャンルを選ぶ</h1>
                        </div>
                        <div class="search_options">
                            <?php
                            $parent_terms = get_terms(array(
                                'taxonomy' => 'classtype',
                                'hide_empty' => false,
                                'orderby' => 'slug',
                                'order' => 'ASC',
                            ));

                            if (!empty($parent_terms) && !is_wp_error($parent_terms)):
                                foreach ($parent_terms as $parent_term):
                                    if ($parent_term->parent == 0): // 只获取父分类
                            ?>
                                        <button class="search_option_suboption" onclick="toggleAccordion('<?php echo $parent_term->slug; ?>')">
                                            <?php echo $parent_term->name; ?>
                                            <span class="plus">+</span>
                                        </button>
                                        <div id="<?php echo $parent_term->slug; ?>" class="accordion_content">

                                            <label class="accordion_item full_width">
                                                <input type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);">
                                                <?php echo $parent_term->name; ?> をすべて選択
                                            </label>
                                            <div id="<?php echo $parent_term->slug; ?>_list" class="double_column">
                                                <?php
                                                $child_terms = get_terms(array(
                                                    'taxonomy' => 'classtype',
                                                    'parent' => $parent_term->term_id,
                                                    'hide_empty' => false,
                                                    'orderby' => 'slug',
                                                    'order' => 'ASC',
                                                ));

                                                if (!empty($child_terms) && !is_wp_error($child_terms)):
                                                    foreach ($child_terms as $child_term):
                                                ?>
                                                        <label class="accordion_item">
                                                            <input type="checkbox" value="<?php echo esc_attr($child_term->name); ?>" onclick="selectItem(this)">
                                                            <?php echo esc_html($child_term->name); ?>
                                                        </label>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                            <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                            <div class="search_actions">
                                <button class="search_button" onclick="">この条件で検索する</button>
                                <div class="additional-buttons">
                                    <button onclick="toggleAreaPopup()">エリアも選ぶ</button>
                                    <button onclick="toggleAgePopup()">年齢も選ぶ</button>
                                </div>
                                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                            </div>
                        </div>


                    </div>
                    <button class="detail__search" onclick="window.location.href='<?php echo home_url(); ?>/?s='">詳細検索ページへ</button>
                    <div class="box__search">
                        <div class="inner__search-box">
                            <input class="window__search" type="search" placeholder="キーワードを入力してください">
                            <button class="btn__search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <button class="button__more-search">
                        <a href="<?php echo home_url(); ?>/?s=">詳細検索は<br>こちら</a>
                    </button> -->
            </div>
        </section>

        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- ランキング -->
        <section class="ranking">
            <div class="inner__ranking">
                <div class="title__ranking">
                    <h1>RANKING</h1>
                    <p>アクセスランキング</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム円">
                </div>
                <div class="order__ranking">
                    <ul>
                        <?php
                        $args = [
                            'taxonomy'   => 'classtype',
                            'meta_key'   => 'view_count',        // view _ countメタデータを使用したソート
                            'orderby'    => 'meta_value_num',    // 数値でソート
                            'order'      => 'DESC',              // 降順に並べる
                            'hide_empty' => false,               // 関連付けられていない記事の分類を表示
                            'number'     => 5,                   // 上位5分類のみ表示
                        ];
                        $argc = [
                            'taxonomy'   => 'classtype',
                            'orderby' => 'slug',
                        ];

                        $terms = get_terms($args);
                        if (!empty($terms) && !is_wp_error($terms)) :
                            $number = 0;
                            foreach ($terms as $term) {
                                if (strpos($term->slug, 'class') !== false) {
                                    continue;
                                }
                                $number++;
                                $view_count = get_term_meta($term->term_id, 'view_count', true);
                                // $term_link = get_term_link($term); // 分類リンクの取得
                                $search_link = get_search_link($term->name);

                                if (!is_wp_error($search_link)) :
                        ?>
                                    <li class="order">
                                        <a href="<?php echo esc_url($search_link); ?>"><?php echo  esc_html($term->name); ?>

                                            <?php
                                            echo '回数: ' . esc_html($view_count);
                                            ?></a>
                                    </li>
                                <?php endif; ?>
                        <?php
                            }

                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- とくしまの習いごとアンケート -->
        <section class="survey-results">
            <div class="inner__survey">
                <div class="banner__survey">
                    <a href="">とくしまの習いごとアンケート</a>
                </div>
            </div>
        </section>
        <!-- column -->

        <section class="column">
            <div class="inner__column">
                <div class="title__column">
                    <h1>COLUMN</h1>
                    <p>コラム</p>
                </div>
                <!-- スライダー ここから -->
                <div class="slider">
                    <div class="auto-slider">
                        <?php
                        $args = [
                            'post_type' => 'column',
                            'posts_per_page'     => 5,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ];
                        $column_query = new WP_query($args);
                        if ($column_query->have_posts()):
                        ?>
                            <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                                <?php get_template_part('template-parts/loop', 'column'); ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif ?>
                    </div>
                </div>
                <!-- スライダー ここまで -->
                <button class="button__more-column">
                    <a href="<?php echo home_url('/column'); ?>">コラムを<br>もっと見る</a>
                </button>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>

        <!-- NEWS -->
        <section class="news">
            <div class="title__news">
                <h1>NEWS</h1>
                <p>新着情報</p>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム円">
            </div>
            <!-- ここからニュース記事 -->
            <?php if (have_posts()) : ?>
                <div class="wrap__news">
                    <div class="container__news">
                        <div class="items__news">
                            <ul>
                                <?php
                                $news = get_term_by('slug', 'news', 'category');
                                $news_link = get_term_link($news, 'category');
                                ?>
                                <?php while (have_posts()) : the_post(); ?>
                                    <?php get_template_part('template-parts/loop', 'news'); ?>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </ul>
                        </div>
                        <button class="button__more-news">
                            <a href="<?php echo $news_link; ?>">新着情報を<br>もっと見る</a>
                        </button>
                    </div>
                </div>
            <?php endif ?>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- end news -->

    </div>
</main>
<?php get_footer(); ?>
