<div class="myBlockMainvisual">
    <div class="container">
        <p class="catch"><span>岡山･倉敷</span>の<br>
            工務店で家を建てよう。</p>
        <p class="txt">私たちは工務店ならではの熟練の技術と長年の経験を活かし、<br class="pc">理想の住まいをご提案いたします。</p>
    </div>
</div>
<section class="modBlockInner modBlockInner_color02">
    <div class="container">
        <header class="modTitle01 modTitle01_report">
            <h2 class="title">お宅拝見レポート</h2>
            <p class="txt">家づくりのストーリーや、こだわりのポイントをご紹介</p>
        </header>
        <div class="mySlider">
            <div class="myListReport myJsSlider02">
                <?php the_top_report(); ?>
            </div>
        </div>
        <p class="modBtnBox">
            <a href="/report/" class="modBtn01">
                一覧ページへ
            </a>
        </p>
    </div>
</section>

<section class="modBlockInner">
    <div class="container">
        <header class="modTitle01 modTitle01_ex">
            <h2 class="title">住まいのエキスパート</h2>
            <p class="txt">家づくりのわがままを叶えてくれる各社のスタッフたちをご紹介</p>
        </header>
        <div class="mySlider">
            <div class="myListEx myJsSlider">
                <?php the_top_expert(); ?>
            </div>
        </div>
        <p class="modBtnBox">
            <a href="/expert/" class="modBtn01">
                一覧ページへ
            </a>
        </p>
    </div>
</section>

<section class="modBlockInner modBlockInner_color02">
    <div class="container">
        <header class="modTitle01 modTitle01_event">
            <h2 class="title">見学会・イベント情報</h2>
            <p class="txt">参加工務店各社のイベント情報をお知らせいたします。</p>
        </header>
        
        <!-- // KC event tag -->
            <div class="event_list">
                <div id="js-iemiru-cms-index-page">
                    <div id="iemiru-cms-index-page" class="">
                        <a v-for="event in events" class="index-page__events-event is-horizontal" :href="event.url + (event.url.indexOf('?') != -1 ? '&' : '?') + 'kc_source=' + 'www.ok-expo.jp' + '&utm_store_kc=true'">
                            <div class="index-page__events-event-image-wrapper">
                                <div class="index-page__events-event-image">
                                    <img :src="event.image_url" alt="">
                                </div>
                            </div>
                            <div class="index-page__events-event-content">
                                <div class="index-page__events-event-labels">
                                    <span class="label label-default label-event label-event-kansei">{{ event.event_type }}</span>
                                    <span class="label label-default label-yoyaku label-yoyaku-open">{{ event.event_format_string }}</span>
                                </div>
                                <div class="index-page__events-event-date">
                                    {{ event.event_open_date_from_to_string }}
                                </div>
                                <div class="index-page__events-event-name">
                                    {{ event.name }}
                                </div>
                                <div class="index-page__events-event-company">
                                    {{ event.eventer_name }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
          <!-- // KC event tag -->
<!-- iemiru event vue start -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>


<script>
var app = new Vue({
  el: '#js-iemiru-cms-index-page',
  data: {
    events: []
  },
  mounted :function(){
    axios.get('https://www.ie-miru.jp/api/v1/events?token=8a7e77ee-1850-4b06-b3a5-6e8528e941d7&per=8')
          .then(response => this.events = response.data.events)
          .catch(response => console.log(response))
  }
})
</script>
        <p class="modBtnBox">
            <a href="/event/" class="modBtn01">
                一覧ページへ
            </a>
        </p>
    </div>
</section>

<!--section class="modBlockInner">
    <div class="container">
        <header class="modTitle01 modTitle01_company">
            <h2 class="title">企業ストーリー</h2>
            <p class="txt">説明テキストがはいります説明テキストがはいります</p>
        </header>
        <div class="mySlider">
            <div class="modListStory myJsSlider">
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story01.jpg" srcset="<?php the_img_dir(); ?>/common/img_story01.jpg 1x,<?php the_img_dir(); ?>/common/img_story01@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo01.png" srcset="<?php the_img_dir(); ?>/common/logo01.png 1x,<?php the_img_dir(); ?>/common/logo01@2x.png 2x" alt="株式会社アイム・コラボレーションのロゴ">
                        </figure>
                        <p class="name">株式会社アイム・コラボレーション</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story02.jpg" srcset="<?php the_img_dir(); ?>/common/img_story02.jpg 1x,<?php the_img_dir(); ?>/common/img_story02@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo02.png" srcset="<?php the_img_dir(); ?>/common/logo02.png 1x,<?php the_img_dir(); ?>/common/logo02@2x.png 2x" alt="株式会社おかやま住宅工房のロゴ">
                        </figure>
                        <p class="name">株式会社おかやま住宅工房</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story03.jpg" srcset="<?php the_img_dir(); ?>/common/img_story03.jpg 1x,<?php the_img_dir(); ?>/common/img_story03@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo03.png" srcset="<?php the_img_dir(); ?>/common/logo03.png 1x,<?php the_img_dir(); ?>/common/logo03@2x.png 2x" alt="株式会社北屋建設のロゴ">
                        </figure>
                        <p class="name">株式会社北屋建設</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story04.jpg" srcset="<?php the_img_dir(); ?>/common/img_story04.jpg 1x,<?php the_img_dir(); ?>/common/img_story04@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo04.png" srcset="<?php the_img_dir(); ?>/common/logo04.png 1x,<?php the_img_dir(); ?>/common/logo04@2x.png 2x" alt="株式会社木の城いちばんのロゴ">
                        </figure>
                        <p class="name">株式会社木の城いちばん</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story05.jpg" srcset="<?php the_img_dir(); ?>/common/img_story05.jpg 1x,<?php the_img_dir(); ?>/common/img_story05@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo05.png" srcset="<?php the_img_dir(); ?>/common/logo05.png 1x,<?php the_img_dir(); ?>/common/logo05@2x.png 2x" alt="倉敷木材株式会社のロゴ">
                        </figure>
                        <p class="name">倉敷木材株式会社</p>
                    </div>
                </a>
            
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story01.jpg" srcset="<?php the_img_dir(); ?>/common/img_story01.jpg 1x,<?php the_img_dir(); ?>/common/img_story01@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo01.png" srcset="<?php the_img_dir(); ?>/common/logo01.png 1x,<?php the_img_dir(); ?>/common/logo01@2x.png 2x" alt="株式会社アイム・コラボレーションのロゴ">
                        </figure>
                        <p class="name">株式会社アイム・コラボレーション</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story02.jpg" srcset="<?php the_img_dir(); ?>/common/img_story02.jpg 1x,<?php the_img_dir(); ?>/common/img_story02@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo02.png" srcset="<?php the_img_dir(); ?>/common/logo02.png 1x,<?php the_img_dir(); ?>/common/logo02@2x.png 2x" alt="株式会社おかやま住宅工房のロゴ">
                        </figure>
                        <p class="name">株式会社おかやま住宅工房</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story03.jpg" srcset="<?php the_img_dir(); ?>/common/img_story03.jpg 1x,<?php the_img_dir(); ?>/common/img_story03@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo03.png" srcset="<?php the_img_dir(); ?>/common/logo03.png 1x,<?php the_img_dir(); ?>/common/logo03@2x.png 2x" alt="株式会社北屋建設のロゴ">
                        </figure>
                        <p class="name">株式会社北屋建設</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story04.jpg" srcset="<?php the_img_dir(); ?>/common/img_story04.jpg 1x,<?php the_img_dir(); ?>/common/img_story04@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo04.png" srcset="<?php the_img_dir(); ?>/common/logo04.png 1x,<?php the_img_dir(); ?>/common/logo04@2x.png 2x" alt="株式会社木の城いちばんのロゴ">
                        </figure>
                        <p class="name">株式会社木の城いちばん</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/common/img_story05.jpg" srcset="<?php the_img_dir(); ?>/common/img_story05.jpg 1x,<?php the_img_dir(); ?>/common/img_story05@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <figure class="logo">
                            <img src="<?php the_img_dir(); ?>/common/logo05.png" srcset="<?php the_img_dir(); ?>/common/logo05.png 1x,<?php the_img_dir(); ?>/common/logo05@2x.png 2x" alt="倉敷木材株式会社のロゴ">
                        </figure>
                        <p class="name">倉敷木材株式会社</p>
                    </div>
                </a>
            </div>
        </div>
        <p class="modBtnBox">
            <a href="#" class="modBtn01">
                一覧ページへ
            </a>
        </p>
    </div>
</section-->

<!-- section class="modBlockInner modBlockInner_color02 myListCaseWrap">
    <div class="container">
        <header class="modTitle01 modTitle01_case">
            <h2 class="title">実例集</h2>
            <p class="txt">説明テキストがはいります説明テキストがはいります</p>
        </header>
        <div class="myListCase">
            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case01.jpg" srcset="<?php the_img_dir(); ?>/top/img_case01.jpg 1x,<?php the_img_dir(); ?>/top/img_case01@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case02.jpg" srcset="<?php the_img_dir(); ?>/top/img_case02.jpg 1x,<?php the_img_dir(); ?>/top/img_case02@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case03.jpg" srcset="<?php the_img_dir(); ?>/top/img_case03.jpg 1x,<?php the_img_dir(); ?>/top/img_case03@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case04.jpg" srcset="<?php the_img_dir(); ?>/top/img_case04.jpg 1x,<?php the_img_dir(); ?>/top/img_case04@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case05.jpg" srcset="<?php the_img_dir(); ?>/top/img_case05.jpg 1x,<?php the_img_dir(); ?>/top/img_case05@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case06.jpg" srcset="<?php the_img_dir(); ?>/top/img_case06.jpg 1x,<?php the_img_dir(); ?>/top/img_case06@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case07.jpg" srcset="<?php the_img_dir(); ?>/top/img_case07.jpg 1x,<?php the_img_dir(); ?>/top/img_case07@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case08.jpg" srcset="<?php the_img_dir(); ?>/top/img_case08.jpg 1x,<?php the_img_dir(); ?>/top/img_case08@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case09.jpg" srcset="<?php the_img_dir(); ?>/top/img_case09.jpg 1x,<?php the_img_dir(); ?>/top/img_case09@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case10.jpg" srcset="<?php the_img_dir(); ?>/top/img_case10.jpg 1x,<?php the_img_dir(); ?>/top/img_case10@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="item">
                <a href="#" class="body">
                    <figure class="image">
                        <img src="<?php the_img_dir(); ?>/top/img_case11.jpg" srcset="<?php the_img_dir(); ?>/top/img_case11.jpg 1x,<?php the_img_dir(); ?>/top/img_case11@2x.jpg 2x" alt="">
                    </figure>
                    <div class="detail">
                        <div class="inner">
                            <p class="title">高性能かつ低コストな住まい</p>
                            <p class="txt">空間デザイン住宅Soraie/まきび住建</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <p class="modBtnBox">
            <a href="#" class="modBtn01">
                MORE
            </a>
        </p>
    </div>
</section-->
<section class="modBlockInner ">
    <div class="container">
        <header class="modTitle01 modTitle01_shop">
            <h2 class="title">工務店一覧</h2>
            <p class="txt">岡山工務店WEBに参加している工務店をご紹介</p>
        </header>
        <div class="myListShop">
            <?php the_top_company(); ?>
        </div>
    </div>
</section>
