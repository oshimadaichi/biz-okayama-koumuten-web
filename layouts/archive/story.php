<main id="contents">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li aria-current="page">企業ストーリー一覧</li>
            </ul>
        </div><!-- /.topicpath -->
        <header class="modTitle01 modTitle01_company">
            <h2 class="title">企業ストーリー一覧</h2>
        </header>

        <div class="modBlockInner">
            <div class="modListStoryWrap">
                <div class="modListStory modListStory_column05">

                    <?php the_list_story(); ?>


                </div>
            </div>
        </div>


    </div><!-- /.container -->
</main>