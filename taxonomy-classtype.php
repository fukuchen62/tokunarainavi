<!-- ランキング用 -->
<?php get_template_part('template-parts/randing'); ?>


<?php get_header(); ?>
<main>
        <?php get_template_part('template-parts/search', 'randing'); ?>

        <?php if (have_posts()): ?>

                <?php
                while (have_posts()): the_post();
                        get_template_part('template-parts/loop', 'classroom');
                endwhile;
                ?>


        <?php endif; ?>
</main>
<?php get_footer(); ?>
