<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li><a href="/company/">工務店一覧</a></li>
                <li aria-current="page"><?php the_title();?></li>
            </ul>
        </div><!-- /.topicpath -->

        <?php the_company_navi(); ?>

        <?php the_company_lead(); ?>

        <?php the_company_contents(); ?>


    </div><!-- /.container -->
</main>