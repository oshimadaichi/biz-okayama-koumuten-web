<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li aria-current="page">お宅拝見レポート一覧</li>
            </ul>
        </div><!-- /.topicpath -->
        <header class="modTitle01 modTitle01_report">
            <h1 class="title">お宅拝見レポート一覧</h1>
        </header>
        <div class="modBlockInner">
            <div class="modList01Wrap">
                <div class="modList01 modList01_type02 modList01_column04">
                    <?php the_list_report(); ?>
                </div>
            </div>
            <div class="modPager">
                <?php the_pager(); ?>
            </div>
        </div>
    </div><!-- /.container -->
</main>