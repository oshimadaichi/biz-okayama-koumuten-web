<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li><a href="/modelhouse/">モデルハウス紹介</a></li>
                <li aria-current="page"><?php the_modelhouse_name(); ?></li>
            </ul>
        </div><!-- /.topicpath -->

        <?php the_company_navi(); ?>

        <?php the_modelhouse_header(); ?>

        <div class="modBlockColumn02">
            <div class="mainBlock">
                <?php the_modelhouse_lead(); ?>
                <?php the_modelhouse_check(); ?>
                <?php the_modelhouse_info(); ?>

                <div class="modBlockMap">
                    <?php the_map(); ?>
                </div>

                <!-- p class="modBtnBox modBtnBox_full"><a href="#" class="modBtn01 modBtn01_color04">このモデルハウスを見学予約する</a></p -->
            </div><!-- /.mainBlock -->
            <aside class="sideBlock">
                <?php the_side_ex(); ?>
            </aside><!-- /.sideBlock -->
        </div><!-- .modBlockColumn02 -->

    </div><!-- /.container -->
</main>