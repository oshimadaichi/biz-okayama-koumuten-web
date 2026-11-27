<main id="contents" class="contents_color02">
    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li aria-current="page"><?php the_title();?></li>
            </ul>
        </div><!-- /.topicpath -->

        <header class="modTitlePage">
            <div class="info">
                <h1 class="title"><?php the_title();?></h1>
            </div>
            <p class="contact">
                <a href="#" class="modBtn01 modBtn01_color02 modBtn01_left modBtn01_large">資料請求･<br class="pc">お問い合わせ</a>
            </p>
        </header>


        <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        endif;
        ?>
    </div><!-- /.container -->
</main>