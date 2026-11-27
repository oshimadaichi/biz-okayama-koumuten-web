<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li aria-current="page">モデルハウス紹介</li>
            </ul>
        </div><!-- /.topicpath -->
        <h1 class="modTitlePage03">モデルハウス紹介</h1>

        <div class="modBlockInner">
            <?php the_list_modelhouse(); ?>
        </div>


    </div><!-- /.container -->
</main>