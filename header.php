<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">


    <?php wp_head(); ?>
    <!-- 必ず書いてください-->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header>
        <div class="inner__header">
            <nav class="gnav">
                <div class="gnav__wrap">
                    <ul class="gnav__menu">
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url(); ?>/?s=">
                                &nbsp;&nbsp;条件検索
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/fushion'); ?>">
                                &nbsp;&nbsp;徳島の習いごと事情
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/column'); ?>">
                                &nbsp;&nbsp;コラム
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/category/news');  ?>">&nbsp;&nbsp;新着情報
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/favor') ?>">&nbsp;&nbsp;お気に入りリスト
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/contact') ?>">&nbsp;&nbsp;お問い合わせ
                            </a>
                        </li>
                        <li>
                            <div class="wrap__sns-logo">
                                <a href="https://www.instagram.com/tokunavi17" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://x.com/tokunavi17" target="_blank">
                                    <i class=" fa-brands fa-x-twitter"></i>
                                </a>

                            </div>

                        </li>
                    </ul>
                </div>
            </nav>

            <div class="logo__header">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/karilogo.png" alt="とくしま習いごとナビ">
                </a>
            </div>

            <div class="wrap__navi">
                <a class="menu">
                    <span class="menu__line menu__line--top"></span>
                    <span class="menu__line menu__line--center"></span>
                    <span class="menu__line menu__line--bottom"></span>
                </a>
            </div>
    </header>
