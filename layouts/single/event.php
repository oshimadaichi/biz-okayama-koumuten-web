<main id="contents" class="contents_color02">

    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li><a href="/event/">イベント一覧</a></li>
                <li aria-current="page"><?php the_title();?></li>
            </ul>
        </div><!-- /.topicpath -->

        <?php the_company_navi(); ?>

        <?php
            $token = get_field('token');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.ie-miru.jp/api/v1/events?token={$token}");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            $json = json_decode($res, true);
        ?>
        
        <!-- // KC event tag -->
        <div>
            <ul class="modListEvent">
                <?php 
                    foreach($json['events'] as $event) {
                        get_event($event);
                    }
                ?>
            </ul>
        </div>
        <!-- // KC event tag -->
    </div><!-- /.container -->
</main>