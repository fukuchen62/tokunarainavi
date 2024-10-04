<?php get_header(); ?>

<main>
    <section class="container_bread-crumb">
        <div class="bread-crumb">
            <p><a href="<?php echo home_url(); ?>">TOP</a> &gt;
                <span class="under-line">404</span>
            </p>
        </div>
    </section>

    <section class="section">
        <div class="section_inner">
            <div class="section_header">
                <h2 class="heading heading-primary"><span>エラー</span>404 Not Found</h2>
            </div>


            <div class="content">
                <p>お探しのページが見つかりませんでした。</p>
                <p>申し訳ございませんが、<a href="<?php echo home_url(); ?>">こちらのリンク</a>からトップページにお戻りください。</p>
            </div>
        </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
