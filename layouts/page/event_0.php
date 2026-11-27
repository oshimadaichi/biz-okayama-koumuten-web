<main id="contents">
<!-- iemiru event vue start -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <?php get_template_part('parts/search'); ?>
    <div class="container">
        <div class="topicpath">
            <ul>
                <li class="home"><a href="/">ホーム</a></li>
                <li aria-current="page">イベント一覧</li>
            </ul>
        </div><!-- /.topicpath -->
        <header class="modTitle01 modTitle01_event">
            <h1 class="title">イベント一覧</h1>
        </header>


        <div class="modBlockInner">
        
        <!-- // KC event tag -->
            <div class="event_list">
                <div id="js-iemiru-cms-index-page">
                    <div id="iemiru-cms-index-page" class="">
                        <a v-for="event in events" class="index-page__events-event is-horizontal" :href="event.url + (event.url.indexOf('?') != -1 ? '&' : '?') + 'kc_source=' + 'www.ok-expo.jp' + '&utm_store_kc=true'">
                            <div class="index-page__events-event-image-wrapper">
                                <div class="index-page__events-event-image" :style="{ backgroundImage: 'url(' + event.image_url + ')' }"></div>
                            </div>
                            <div class="index-page__events-event-content">
                                <div class="index-page__events-event-labels">
                                    <span class="label label-default label-event label-event-kansei">{{ event.event_type }}</span>
                                    <span class="label label-default label-yoyaku label-yoyaku-open">{{ event.event_format_string }}</span>
                                </div>
                                <div class="index-page__events-event-date">
                                    {{ event.event_open_date_from_to_string }}
                                </div>
                                <div class="index-page__events-event-name" style="height: 19px;">
                                    {{ event.name }}
                                </div>
                                <div class="index-page__events-event-description">
                                </div>
                                <div class=".index-page__events-event-company" style="height: 19px;">
                                    {{ event.eventer_name }}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
          <!-- // KC event tag -->

        </div>

    </div><!-- /.container -->
</main>



<script>
var app = new Vue({
  el: '#js-iemiru-cms-index-page',
  data: {
    events: []
  },
  mounted :function(){
    axios.get('https://www.ie-miru.jp/api/v1/events?token=8a7e77ee-1850-4b06-b3a5-6e8528e941d7&per=32')
          .then(response => this.events = response.data.events)
          .catch(response => console.log(response))
  }
})
</script>

<style>
    #iemiru-cms-index-page {
    max-width: 1024px;
    margin: auto;
    display:flex;
    flex-wrap:wrap;
    clear: both; }
    #iemiru-cms-index-page body, #iemiru-cms-index-page div, #iemiru-cms-index-page span, #iemiru-cms-index-page object, #iemiru-cms-index-page iframe, #iemiru-cms-index-page h1, #iemiru-cms-index-page h2, #iemiru-cms-index-page h3, #iemiru-cms-index-page h4, #iemiru-cms-index-page h5, #iemiru-cms-index-page h6, #iemiru-cms-index-page p, #iemiru-cms-index-page blockquote, #iemiru-cms-index-page pre, #iemiru-cms-index-page abbr, #iemiru-cms-index-page address, #iemiru-cms-index-page cite, #iemiru-cms-index-page code, #iemiru-cms-index-page del, #iemiru-cms-index-page dfn, #iemiru-cms-index-page em, #iemiru-cms-index-page img, #iemiru-cms-index-page ins, #iemiru-cms-index-page kbd, #iemiru-cms-index-page q, #iemiru-cms-index-page samp, #iemiru-cms-index-page small, #iemiru-cms-index-page strong, #iemiru-cms-index-page sub, #iemiru-cms-index-page sup, #iemiru-cms-index-page var, #iemiru-cms-index-page b, #iemiru-cms-index-page i, #iemiru-cms-index-page dl, #iemiru-cms-index-page dt, #iemiru-cms-index-page dd, #iemiru-cms-index-page ol, #iemiru-cms-index-page ul, #iemiru-cms-index-page li, #iemiru-cms-index-page fieldset, #iemiru-cms-index-page form, #iemiru-cms-index-page label, #iemiru-cms-index-page legend, #iemiru-cms-index-page table, #iemiru-cms-index-page caption, #iemiru-cms-index-page tbody, #iemiru-cms-index-page tfoot, #iemiru-cms-index-page thead, #iemiru-cms-index-page tr, #iemiru-cms-index-page th, #iemiru-cms-index-page td, #iemiru-cms-index-page article, #iemiru-cms-index-page aside, #iemiru-cms-index-page canvas, #iemiru-cms-index-page details, #iemiru-cms-index-page figcaption, #iemiru-cms-index-page figure, #iemiru-cms-index-page footer, #iemiru-cms-index-page header, #iemiru-cms-index-page hgroup, #iemiru-cms-index-page menu, #iemiru-cms-index-page nav, #iemiru-cms-index-page section, #iemiru-cms-index-page summary, #iemiru-cms-index-page time, #iemiru-cms-index-page mark, #iemiru-cms-index-page audio, #iemiru-cms-index-page video {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
        word-break: break-word;
        font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", "Yu Gothic", YuGothic, Verdana, Meiryo, "M+ 1p"; }
    #iemiru-cms-index-page body {
        line-height: 1.3;
        background: #fff; }
    #iemiru-cms-index-page article, #iemiru-cms-index-page aside, #iemiru-cms-index-page details, #iemiru-cms-index-page figcaption, #iemiru-cms-index-page figure, #iemiru-cms-index-page footer, #iemiru-cms-index-page header, #iemiru-cms-index-page hgroup, #iemiru-cms-index-page menu, #iemiru-cms-index-page nav, #iemiru-cms-index-page section {
        display: block; }
    #iemiru-cms-index-page nav ul {
        list-style: none; }
    #iemiru-cms-index-page blockquote, #iemiru-cms-index-page q {
        quotes: none; }
    #iemiru-cms-index-page blockquote:before, #iemiru-cms-index-page blockquote:after {
        content: "";
        content: none; }
    #iemiru-cms-index-page q:before, #iemiru-cms-index-page q:after {
        content: "";
        content: none; }
    #iemiru-cms-index-page a {
        margin: 0;
        padding: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent; }
    #iemiru-cms-index-page ins {
        background-color: #ff9;
        color: #000;
        text-decoration: none; }
    #iemiru-cms-index-page mark {
        background-color: #ff9;
        color: #000;
        font-style: italic;
        font-weight: bold; }
    #iemiru-cms-index-page del {
        text-decoration: line-through; }
    #iemiru-cms-index-page abbr[title], #iemiru-cms-index-page dfn[title] {
        border-bottom: 1px dotted;
        cursor: help; }
    #iemiru-cms-index-page table {
        border-collapse: collapse;
        border-spacing: 0; }
    #iemiru-cms-index-page hr {
        display: block;
        height: 1px;
        border: 0;
        border-top: 1px solid #cccccc;
        margin: 1em 0;
        padding: 0; }
    #iemiru-cms-index-page input, #iemiru-cms-index-page select {
        vertical-align: middle; }
    #iemiru-cms-index-page ul {
        list-style-type: none; }
    #iemiru-cms-index-page:after {
        content: " ";
        clear: both;
        display: block; }
    #iemiru-cms-index-page .index-page__events-event {
        padding: 20px;
        /* border: 1px solid #ccc; */
        border-radius: 5px;
        box-sizing: border-box;
        text-align: left;
        text-decoration: none;
        display: block;
        background: #ffffff; }
    #iemiru-cms-index-page .index-page__events-event:hover {
        background: #ffffe6; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-image {
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        display: inline-block; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-labels {
        margin-bottom: 10px; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-name {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #000;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-description {
        margin-bottom: 20px;
        font-size: 14px;
        color: #333; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-description span {
            text-decoration: underline;
            color: #2aa6e2; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-date {
        margin-bottom: 5px;
        font-size: 14px;
        line-height: 1.3em;
        color: #333; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-address {
        font-size: 14px;
        color: #333; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-address > img {
            width: auto;
            height: 20px;
            vertical-align: middle; }
    #iemiru-cms-index-page .index-page__events-event .index-page__events-event-company {
        height: 2em;
        font-size: 14px;
        color: #333;
        padding-bottom: 10px; }
    #iemiru-cms-index-page .index-page__events-event.is-vertical {
        width: 100%;
        margin-bottom: 20px;
        min-height: 140px; }
    @media screen and (max-width: 479px) {
    #iemiru-cms-index-page .index-page__events-event.is-vertical .index-page__events-event-image-wrapper {
            width: 100%;
            position: relative; }
    #iemiru-cms-index-page .index-page__events-event.is-vertical .index-page__events-event-image-wrapper:before {
                content: "";
                display: block;
                padding-top: 66.6%; } }
    #iemiru-cms-index-page .index-page__events-event.is-vertical .index-page__events-event-image {
            width: 180px;
            height: 120px;
            float: left; }
    @media screen and (max-width: 479px) {
    #iemiru-cms-index-page .index-page__events-event.is-vertical .index-page__events-event-image {
                width: 100%;
                height: auto;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0; } }
    #iemiru-cms-index-page .index-page__events-event.is-vertical .index-page__events-event-content {
            margin-left: 200px; }
            @media screen and (max-width: 479px) {
            #iemiru-cms-index-page .index-page__events-event.is-vertical .index-page__events-event-content {
                float: none;
                margin-top: 10px;
                margin-left: 0; } }
        #iemiru-cms-index-page .index-page__events-event.is-horizontal {
/*
        width: 30%;
        margin-left: 1.5%;
        margin-right: 1.5%;
*/
        margin-bottom: 10px;
        min-height: 140px;
        width: 25%;
/*        float: left;*/
/*        min-width: 220px; */}
        #iemiru-cms-index-page .index-page__events-event.is-horizontal .index-page__events-event-image-wrapper {
            width: 100%;
            position: relative; }
            #iemiru-cms-index-page .index-page__events-event.is-horizontal .index-page__events-event-image-wrapper:before {
            content: "";
            display: block;
            padding-top: 66.6%; }
        #iemiru-cms-index-page .index-page__events-event.is-horizontal .index-page__events-event-image {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0; }
        #iemiru-cms-index-page .index-page__events-event.is-horizontal .index-page__events-event-content {
            margin-top: 10px; }
        #iemiru-cms-index-page .index-page__events-event.is-horizontal .index-page__events-event-date {
            height: 30px; }
        #iemiru-cms-index-page .index-page__events-event.is-horizontal .index-page__events-event-name {
            margin: 0 0 10px;
            white-space: normal;
            text-overflow: ellipsis; }
        @media screen and (max-width: 799px) {
            #iemiru-cms-index-page .index-page__events-event.is-horizontal {
            width: 33%; } }
        @media screen and (max-width: 479px) {
            #iemiru-cms-index-page .index-page__events-event.is-horizontal {
            width: 50%;
            margin: 0 0 10px; } }
    #iemiru-cms-index-page.is-middle .index-page__events-event.is-horizontal {
        width: 47% !important; }
    #iemiru-cms-index-page.is-small .index-page__events-event.is-vertical .index-page__events-event-image-wrapper {
        width: 100% !important;
        position: relative !important; }
        #iemiru-cms-index-page.is-small .index-page__events-event.is-vertical .index-page__events-event-image-wrapper:before {
        content: "" !important;
        display: block !important;
        padding-top: 66.6% !important; }
    #iemiru-cms-index-page.is-small .index-page__events-event.is-vertical .index-page__events-event-image {
        width: 100% !important;
        height: auto !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important; }
    #iemiru-cms-index-page.is-small .index-page__events-event.is-vertical .index-page__events-event-content {
        float: none !important;
        margin-top: 10px !important;
        margin-left: 0 !important; }
    #iemiru-cms-index-page.is-small .index-page__events-event.is-horizontal {
        width: 100% !important;
        margin: 0 0 20px !important; }
    #iemiru-cms-index-page .label-event {
        color: #fff;
        font-weight: normal;
        padding: 5px 10px;
        border-radius: 0;
        text-align: center;
        display: inline-block;
        font-size: 12px;
        line-height: 1;
        white-space: nowrap;
        vertical-align: baseline; }
        #iemiru-cms-index-page .label-event-finished {
        background: #b3b3b3; }
        #iemiru-cms-index-page .label-event-tenjikai {
        background: #000000; }
        #iemiru-cms-index-page .label-event-kansei {
        background: #00508e; }
        #iemiru-cms-index-page .label-event-kouzou {
        background: #ea9b54; }
        #iemiru-cms-index-page .label-event-seminor {
        background: #29ac6d; }
        #iemiru-cms-index-page .label-event-show {
        background: #e73939; }
        #iemiru-cms-index-page .label-event-model {
        background: #ea545d; }
        #iemiru-cms-index-page .label-event-tateuri {
        background: #2fa8b5; }
        #iemiru-cms-index-page .label-event-tochi {
        background: #B2B200; }
        #iemiru-cms-index-page .label-event-obtei {
        background: #e4b948; }
        #iemiru-cms-index-page .label-event-other {
        background: #b3b3b3; }
        #iemiru-cms-index-page .label-event-syukuhaku {
        background: #11345c; }
        #iemiru-cms-index-page .label-event-soudankai {
        background: #e464c7; }
    #iemiru-cms-index-page .label-yoyaku {
        color: #4d4d4d !important;
        border: 1px solid #737373;
        background: #fff;
        padding: 4px 10px;
        font-weight: normal;
        border-radius: 0;
        text-align: center;
        display: inline-block;
        font-size: 12px;
        line-height: 1;
        white-space: nowrap;
        vertical-align: baseline; }
</style>
<!-- iemiru event vue end -->

