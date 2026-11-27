<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li><a href="/report/">工務店一覧</a></li>
                <li aria-current="page"><?php the_title();?></li>
            </ul>
        </div><!-- /.topicpath -->

        <?php the_company_navi(); ?>
        <header class="modTitlePage02">
            <p class="date"><?php the_time('Y/m/d'); ?></p>
            <h2 class="title"><?php the_title(); ?></h2>
        </header>

        <div class="modBlockColumn02">
            <div class="mainBlock">
                <?php the_report_main_image(); ?>
                <section class="modBox01">
                    <h2 class="modTitle02 modTitle02_report">お宅拝見レポート </h2>
                    <div class="modPartsWysiwyg">
                        <!-- WYSIWYGここから▽ -->
                        <?php the_report_contents(); ?>
                        <!-- WYSIWYGここまで△ -->
                    </div>
                </section>
                <?php the_report_profile(); ?>
                <?php the_report_spec(); ?>

            </div><!-- /.mainBlock -->
            <aside class="sideBlock">
                <?php the_side_ex(); ?>
            </aside><!-- /.sideBlock -->

        </div><!-- .modBlockColumn02 -->
    </div><!-- /.container -->
</main>