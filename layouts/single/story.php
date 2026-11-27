<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li><a href="/story/">企業ストーリー一覧</a></li>
                <li aria-current="page"><?php the_title();?></li>
            </ul>
        </div><!-- /.topicpath -->

        <?php the_company_navi(); ?>

        <div class="modBlockColumn02">
            <div class="mainBlock">
                <section class="modBox01">
                    <h2 class="modTitle02 modTitle02_company"><?php the_title();?></h2>
                    <div class="modBlockBody">
                        <div class="modPartsWysiwyg modPartsWysiwyg_type02 clearfix">
                            <!-- WYSIWYGここから▽ -->

                            <?php the_story_contents(); ?>

                            <!-- WYSIWYGここまで△ -->
                        </div>
                    </div>
                </section>
            </div><!-- /.mainBlock -->
            <aside class="sideBlock">
                <?php the_side_ex(); ?>
            </aside><!-- /.sideBlock -->
        </div><!-- .modBlockColumn02 -->

    </div><!-- /.container -->
</main>