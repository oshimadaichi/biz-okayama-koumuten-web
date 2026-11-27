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