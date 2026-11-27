<?php

// contactform7にURLパラメーターを反映
function expo_form_check_filter($tag) {
    $formName = 'your-constractor';
    if ( ! is_array( $tag ) )
        return $tag;
    if( isset($_GET[$formName]) ) {
        $name = $tag['name'];
        if( $name === $formName ) {
            if( is_array( $tag['values'] ) ) {
                $index = $_GET[$formName];
                if( $index !== false ) {
                    $tag['options'][] = 'default:' . $index;
                }
            }
        }
    }
    return $tag;
}
add_filter( 'wpcf7_form_tag', 'expo_form_check_filter', 11, 2);

//-----------------------------------------------------
// トップスライダー
//-----------------------------------------------------
function the_top_slider(){
	$out = array();
	$slider = array();
	if( have_rows('top_main_repeat', 'option') ){
		/****************************************************************************************
		 * コンテンツ整形
		 ****************************************************************************************/
		while ( have_rows('top_main_repeat', 'option') ) {
			the_row();

			//キャプション
			$caption = get_sub_field('caption');

			//画像
			$imgs = get_acf_images_html(array(
				'field' =>"image",
				'sub' => true,
				'select' => 1,
				'alt' => $caption
			));

			$slider[] = get_html_wrap("wrap=li", $imgs[0]);
		}
		/****************************************************************************************
		 * ラッピング
		 ****************************************************************************************/
		$out[] = implode("\n",array(
			'<div id="mainVisual">',
			'<div class="secSlides">',
		));
		$out[] = get_html_wrap("wrap=ul", implode("\n",$slider));
		$out[] = implode("\n",array(
			'<!-- / .secSlides --></div>',
			'<div class="secCopy">',
			'<p>Road to the World<br>from Okayama</p>',
			'<!-- /.secCopy --></div>',
			'<!-- / #mainVisual --></div>',
		));
		echo implode("\n",$out);
	}
}

/*-----------------------------------------------------------------------------------------
    会社IDを取得
-----------------------------------------------------------------------------------------*/
function get_company_id(){
    global $post_type;
    $company_id = ($post_type == 'company')?get_the_ID():get_field('relation_company')[0];
    return $company_id;
}

//-----------------------------------------------------
// TOP 工務店一覧
//-----------------------------------------------------
function the_top_company(){
    global $post;
    $out = array();
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'company',
        'posts_per_page' => -1,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //URL
            $url = get_permalink();

            //名前
            $name = get_the_title();

            //ロゴ
            $size = "logo";
            $img_logo = (get_field('logo'))?get_acf_images_html(['field' =>"logo",'size' => $size,'srcset' => true])[0]:get_dummy_img($size,'company');


            //コンテンツ生成
            //::Q　target="_blank"でOK？
            $out[] = <<<EOM
            <a href="$url" class="item" target="_blank">
                <p class="name">{$name}</p>
                <figure class="logo">
                    {$img_logo}
                </figure>
            </a>

EOM;

        }
    }
    wp_reset_postdata();
    echo implode("\n",$out);
}

//-----------------------------------------------------
// TOP お宅拝見レポート
//-----------------------------------------------------
function the_top_report(){
    global $post;
    $out = array();
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'report',
        'posts_per_page' => 10,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //会社ID
            $company_id = get_company_id();

            //URL
            $url = get_permalink();

            //会社名
            $company_name = get_the_title($company_id);

            //写真
            $size = 'top_report';
            $imgs = get_acf_images_html(array(
                'field' =>"report_image",
                'size' => $size,
                'width'=> "-1",
                'height'=> "-1",
                'srcset'=> true,
            ));
            $report_main_image = (get_field('report_image'))?$imgs[0]:get_dummy_img($size);

            //キャッチコピー(タイトル)
            $report_catch = txtSubstr(get_the_title());

            //日付
            $report_date = get_the_time('Y.m.d');

            //コンテンツ生成
            $out[] = <<<EOM

                <a href="{$url}" class="item">
                    <figure class="image">
                        {$report_main_image}
                    </figure>
                    <div class="detail">
                        <p class="copmany">{$company_name}</p>
                        <p class="txt">{$report_catch}</p>
                        <p class="date">{$report_date}</p>
                    </div>
                </a>

EOM;

        }
    }
    wp_reset_postdata();
    echo implode("\n",$out);
}

//-----------------------------------------------------
// TOP 住まいのエキスパート
//-----------------------------------------------------
function the_top_expert(){
    global $post;
    $out = array();
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'expert',
        'posts_per_page' => -1,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //URL
            $url = get_permalink();

            //名前
            $name = get_the_title();

            //写真
            $size = "top_expert_face_image";
            $imgs = get_acf_images_html(array(
                'field' =>"expert_face_image",
                'size' => $size,
                'width'=> "-1",
                'height'=> "-1",
            ));
            $expert_face_image = (get_field('expert_face_image'))?$imgs[0]:get_dummy_img($size,'people');

            //職種
            $expert_job = get_field('expert_job')->name;

            //会社名
            $company_id = get_company_id();
            $campany_name = get_the_title($company_id);

            //コンテンツ生成
            $out[] = <<<EOM
                <a href="{$url}" class="item">
                    <figure class="image">
                        {$expert_face_image}
                    </figure>
                    <div class="detail">
                        <p class="job">{$campany_name}</p>
                        <p class="name">{$name}</p>
                    </div>
                </a>


EOM;

        }
    }
    wp_reset_postdata();
    echo implode("\n",$out);
}



//-----------------------------------------------------
// 一覧 住まいのエキスパート
//-----------------------------------------------------
function the_list_expert(){
    global $post ,$the_query;
    $out  = array();
    $list = array();
    $meta_gender_query = array();
    $meta_job_query = array();

    //検索パラメータを取得する
    $expert_gender    = get_query_var( 'expert_gender' );
    $expert_job       = get_query_var( 'expert_job' );

    //性別
    if($expert_gender && $expert_gender != 'all'){
        $meta_gender_query =
            array(
                'key'     => 'expert_gender',
                'value'   => $expert_gender,
                'compare' => 'IN',
        );
    }
    //職種
    if($expert_job && $expert_job != 'all'){
        $meta_job_query =
            array(
                'key'     => 'expert_job',
                'value'   => $expert_job,
                'compare' => 'AND',
        );
    }

    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'expert',
        'posts_per_page' => 8,
        'no_found_rows' => false,  //ページャーを使う時はfalseに。
        'paged' => get_query_var( 'paged' ),
        'meta_query' => array(
            'relation'=>'AND',
            $meta_gender_query,
            $meta_job_query,
        )
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {

        $all_num = $the_query->found_posts;//全件数
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //会社ID
            $company_id = get_company_id();

            //URL
            $url = get_permalink();

            //会社名
            $company_name = get_the_title($company_id);

            //名前
            $name = get_the_title();

            //写真
            $size = "top_expert_face_image";
            $imgs = get_acf_images_html(array(
                'field' =>"expert_face_image",
                'size' => $size,
                'width'=> "-1",
                'height'=> "-1",
            ));
            $expert_face_image = (get_field('expert_face_image'))?$imgs[0]:get_dummy_img($size,'people');

            //キャッチコピー
            $expert_catch = txtSubstr(get_field('expert_catch'));

            //職種
            $expert_job = get_field('expert_job')->name;

            //プロフィール
            $expert_txt = get_field('expert_txt');

            //コンテンツ生成
            $list[] = <<<EOM
					<a href="{$url}" class="item">
						<figure class="image">{$expert_face_image}</figure>
						<div class="detail">
							<p class="company">{$company_name}</p>
							<p class="job">{$expert_job}</p>
							<p class="name">{$name}</p>
							<p class="catch">{$expert_catch}</p>
							<div class="txt">
								<p>{$expert_txt}</p>
							</div>
						</div>
					</a>

EOM;


        }
    }
    wp_reset_postdata();
    $list =  implode("\n",$list);
    $pager = get_pager();

    /*
    $search = get_expert_search();
    $out[] = <<< EOM
            <div class="myBlockSearch">
                {$search}
            </div>
EOM;
*/
    if($all_num) {
        $out[] = <<< EOM

            <div class="modSearchResult">
                <p class="result"><span>{$all_num}</span>件が該当しました</p>
                {$pager}
            </div>
            <div class="myList01">
                {$list}
            </div>
            <div class="modPagerWrap">
                {$pager}
            </div>
EOM;
    }else{
        $out[] = <<< EOM

            <div class="modSearchResult" style="display:block;text-align:center;">
                <p>検索結果がありませんでした。</p>
            </div>
EOM;
    }
    echo implode("\n",$out);

}

//-----------------------------------------------------
// 一覧
//-----------------------------------------------------

function get_expert_search(){



    //チェック
    $gender_checked1 = get_form_checked('expert_gender','all');
    $gender_checked2 = get_form_checked('expert_gender','man');
    $gender_checked3 = get_form_checked('expert_gender','woman');

    $radio_expert_job = get_form_radio('expert_job','li');

    //コンテンツ生成
    $out[] = <<<EOM

    <form action="/expert/" method="get">
        <div class="table">
            <table>
                <tbody>
                <tr>
                    <th>性別</th>
                    <td>
                        <ul class="list">
                            <li><input type="radio" id="expert_gender-1" name="expert_gender" value="all" {$gender_checked1}><label for="expert_gender-1">全て</label></li>
                            <li><input type="radio" id="expert_gender-2" name="expert_gender" value="man" {$gender_checked2}><label for="expert_gender-2">男性</label></li>
                            <li><input type="radio" id="expert_gender-3" name="expert_gender" value="woman" {$gender_checked3}><label for="expert_gender-3">女性</label></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>職種</th>
                    <td>
                        <ul class="list">
                            {$radio_expert_job}
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <p class="modBtnBox">
            <button class="modBtn01 modBtn01_color03 modBtn01_search" type="submit">この条件で探す</button>
        </p>
    </form>


EOM;
    return implode("\n",$out);

}

//-----------------------------------------------------
// 一覧 お宅拝見レポート
//-----------------------------------------------------
function the_list_report(){
    global $post,$the_query;
    $out = array();
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'report',
        'posts_per_page' => 8,
        'no_found_rows' => false,  //ページャーを使う時はfalseに。
        'paged' => get_query_var( 'paged' )
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //会社ID
            $company_id = get_company_id();

            //URL
            $url = get_permalink();

            //会社名
            $company_name = get_the_title($company_id);

            //写真
            $size = 'top_report';
            $imgs = get_acf_images_html(array(
                'field' =>"report_image",
                'size' => $size,
                'width'=> "-1",
                'height'=> "-1",
                'srcset'=> true,
            ));
            $report_main_image = (get_field('report_image'))?$imgs[0]:get_dummy_img($size);

            //キャッチコピー(タイトル)
            $report_catch = txtSubstr(get_the_title());

            //日付
            $report_date = get_the_time('Y.m.d');

            //コンテンツ生成
            $out[] = <<<EOM

						<a href="{$url}" class="item">
							<figure class="image">
								{$report_main_image}
							</figure>
							<div class="detail">
								<p class="copmany">{$company_name}</p>
								<p class="title">{$report_catch}</p>
								<p class="date">{$report_date}</p>
							</div>
						</a>

EOM;
        }
    }
    wp_reset_postdata();
    echo implode("\n",$out);
}




//-----------------------------------------------------
// 一覧 企業ストーリー
//-----------------------------------------------------
function the_list_story()
{
    global $post,$the_query;
    $out = array();
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'story',
        'posts_per_page' => -1,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
    );
    $the_query = new WP_Query( $args );

    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();


            //会社ID
            $company_id = get_company_id();

            if ($company_id) {

                //会社名
                $company_name = get_the_title($company_id);

                //URL
                $url = get_permalink();

                //ロゴ
                $size_logo = "logo";
                $img_logo = (get_field('logo')) ? get_acf_images_html(['field' => "logo", 'size' => $size_logo, 'srcset' => true])[0] : get_dummy_img($size_logo, 'company');

                //ストーリーイメージ（会社背景イメージ）
                $size_story = "img_story";
                $img_story = (get_field('story_main_image')) ? get_acf_images_html(['field' => "story_main_image", 'size' => "img_story", 'srcset' => true])[0] : get_dummy_img($size_story);


                $out[] = <<<EOM
						<a href="{$url}" class="item">
							<figure class="image">
								{$img_story}
							</figure>
							<div class="detail">
								<figure class="logo">
									{$img_logo}
								</figure>
								<p class="name">{$company_name}</p>
							</div>
						</a>
EOM;
            }
        }
        echo implode("\n", $out);
    }

}
//-----------------------------------------------------
// 一覧 モデルハウス
//-----------------------------------------------------
function the_list_modelhouse()
{
    global $post,$the_query;
    $out = array();
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'modelhouse',
        'posts_per_page' => 8,
        'no_found_rows' => false,  //ページャーを使う時はfalseに。
        'paged' => get_query_var( 'paged' )
    );

    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //地図------------
            $img_path = get_img_dir();
            $key = 'AIzaSyDnAPSvcmkoXUNju-zzsAqiznw48TAjN_Y';
            $fields = get_field('map');
            $lat    = $fields['lat'];
            $lng    = $fields['lng'];
            $modelhouse_name = get_modelhouse_name();
            $houses[] = "['{$modelhouse_name}', {$lat}, {$lng}]";

            //URL
            $url = get_permalink();

            //画像
            $images = get_field('modelhouse_image');
            $size  = 'modelhouse_image';
            $image = wp_get_attachment_image( $images[0]['ID'], $size );

            //会社名
            $company_id = get_company_id();
            $campany_name = get_the_title($company_id);

            //モデルハウス名
            $modelhouse_name = get_the_title();



            $lists[] = <<<EOM
                    <a href="{$url}" class="item">
                        <figure class="image">
                            {$image}
                        </figure>
                        <div class="detail">
                            <p class="name">{$campany_name}</p>
                            <p class="title">{$modelhouse_name}</p>
                        </div>
                    </a>
EOM;
        }
        $houses = implode(','."\n", $houses);
        $lists = implode("\n", $lists);
        $pager = get_pager();
    }






    $out[] = <<<EOM
                <div id="map" class="myBlockMap">map
                </div>
				<div class="modList01Wrap">
					<div class="modList01 modList01_column04">
					    {$lists}
					</div>
				</div>
				{$pager}

                <script>

                    function initMap() {
                      var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 12,
                        center: {lat: 34.626304 , lng: 133.807513}//中央
                      });

                      setMarkers(map);
                    }

                    var houses = [
                    {$houses}
                    ];

                    function setMarkers(map) {
                      var image = {
                        url: '{$img_path}common/icon_pin@2x.png',
                        scaledSize: new google.maps.Size(43, 51)
                      };

                      for (var i = 0; i < houses.length; i++) {
                        var house = houses[i];
                        var marker = new google.maps.Marker({
                          position: {lat: house[1], lng: house[2]},
                          map: map,
                          icon: image,
                          title: house[0]
                          // zIndex: house[3]
                        });
                      }
                    }
                </script>
                <script async defer
                src="https://maps.googleapis.com/maps/api/js?key={$key}&callback=initMap">
                </script>

EOM;
    echo implode("\n", $out);
}


function search_query_company(){

    $search = array();
    //検索パラメータを取得する
    $company_area    = get_query_var( 'company_area' );
    $company_tsubo   = get_query_var( 'company_tsubo' );
    $company_kodawari = get_query_var( 'company_kodawari' );

    $search['relation'] = 'AND';

    if($company_area){
        $search[] = array(
            'key'     => 'company_area',
            'value'   => '"' . $company_area . '"',
            'compare' => 'LIKE',
        );
    }
    if($company_tsubo){
        $search[] = array(
            'key'     => 'company_tsubo',
            'value'   => '"' . $company_tsubo . '"',
            'compare' => 'LIKE',
        );
    }
    if($company_kodawari){
        $search[] = array(
            'key'     => 'company_kodawari',
            'value'   => '"' . $company_kodawari . '"',
            'compare' => 'LIKE',
        );
    }

//    $search[] = $keyword;
    return $search;

}

function search_query_keyword(){
    $company_keyword = get_query_var( 'company_keyword' );

    $fields = array(
        'company_words',
        'message_catch',
        'message_txt',
        'message_foot',
        'company_shops_contents_$_body',
        'company_tel',
        'company_txt',
    );
    $keyword['relation'] = 'OR';
    foreach($fields as $field){
        $keyword[] = array(
            'key'     => $field,
            'value'   => $company_keyword,
            'compare' => 'LIKE',
        );
    }
    return $keyword;
}
//-----------------------------------------------------
// 会社紹介一覧
//-----------------------------------------------------
function the_list_company(){
    global $post,$the_query;
    $html = array();
    $out = array();


    //検索クエリ
    $query_company = search_query_company();
    $query_keyword = search_query_keyword();
    $company_keyword = get_query_var( 'company_keyword' );

    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'company',
        'posts_per_page' => -1,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
        '_meta_or_title' => $company_keyword,
//        'tax_query' => array(
//            'relation' => 'AND',
//            array(
//                'taxonomy'=>'company_genre',
//                'terms'=> array($company_keyword),
//                'field'=>'name',
//                'operator'=>'IN'
//            ),
//        ),

        'meta_query' => array(
            'relation' => 'AND',
            $query_company,
            $query_keyword
        ),

    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //ロゴ
            $size_logo = "logo";
            $img_logo = (get_field('logo'))?get_acf_images_html(['field' =>"logo",'size' => $size_logo,'srcset' => true])[0]:get_dummy_img($size_logo,'company');

            //ストーリーイメージ（会社背景イメージ）
            $size_story = "img_story";
            $img_story = (get_field('img_story'))?get_acf_images_html(['field' =>"img_story",'size' => "img_story",'srcset' => true])[0]:get_dummy_img($size_story);

            $html[] = '<a href="'.get_permalink($post).'" class="item">';
            $html[] = get_html_wrap('wrap=figure&class=image',$img_story);

            $html[] = '<div class="detail">';
            $html[] = get_html_wrap('wrap=figure&class=logo',$img_logo);
            $html[] = get_html_wrap("wrap=p&class=name", get_the_title());
            $html[] = '</div>';
            $html[] = '</a>';

        }

        /****************************************************************************************
         * ラッピング
         ****************************************************************************************/
        $out[] = implode("\n",$html);
        echo implode("\n",$out);
    }else{
        $out[] = <<<EOM
        <div class='not_result' style='margin-left:10px;'>検索結果がありませんでした。</div>
EOM;
        echo implode("\n",$out);

    }

}



//-----------------------------------------------------
// 会社紹介 navi
//-----------------------------------------------------
function the_company_navi(){
    global $post;



    $out = array();

    //会社IDを取得
    $company_id = get_company_id();

    //タイトル
    $title   = get_the_title($company_id);

    //電話番号
    $tel = get_field('company_tel',$company_id);

    //ジャンル
    $genre = get_field('company_genre',$company_id)->name;


    //住宅会社ごとにメニューのURLを取得して設定。
    $link_company = '#';
    $link_expert = '#';
    $link_story = '#';
    $link_report = '#';
    $link_modelhouse = '#';
    $link_event = '#';

    $types_name = array(
        'company'     => '会社紹介',
        'expert'      => '住まいのエキスパート',
        'story'       => '企業ストーリー',
        'report'      => 'お宅拝見レポート',
        'modelhouse'  => 'モデルハウス紹介',
        'event'       => 'イベント'
    );

    $types = ["company","expert","story","report","modelhouse","event"];
    foreach($types as $type){
        if($type == "company"){
            $link_company = get_permalink($company_id);
            ${'link_'.$type} = sprintf('<a href="%s" class="link %s">%s</a>',$link_company,$type,$types_name[$type]);
        }else{
            ${'link_'.$type} = '#';
            $args = array(
                // 取得したい投稿の条件
                'post_type' => $type,
                'posts_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key'     => 'relation_company',
                        'value'   => '"' . $company_id . '"',
                        'compare' => 'LIKE',
                    )
                )
            );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ) {
                while( $the_query->have_posts() ) {
                    $the_query->the_post();
                    ${'link_'.$type} = sprintf('<a href="%s" class="link %s">%s</a>',get_permalink(),$type,$types_name[$type]);
                }
                wp_reset_postdata();

            }else{
                ${'link_'.$type} = '';
            }
        }
    }



    $out[] = <<<EOM

<header class="modTitlePage">
	<div class="info">
		<h1 class="title">{$title}</h1>
		<div class="list">
			<dl class="item">
				<dt>電話番号</dt>
				<dd>{$tel}</dd>
			</dl>
			<dl class="item">
				<dt>ジャンル</dt>
				<dd>{$genre}</dd>
			</dl>
		</div>
	</div>
	<p class="contact">
		<a href="/application/?your-constractor={$company_id}" class="modBtn01 modBtn01_color02 modBtn01_left modBtn01_large">資料請求･<br class="pc">お問い合わせ</a>
	</p>
</header>
<div class="modNav01">
    {$link_company}
    {$link_expert}
    {$link_story}
    {$link_report}
    {$link_modelhouse}
    {$link_event}
</div>
EOM;


    echo implode("\n",$out);
}


//-----------------------------------------------------
// 会社紹介 lead
//-----------------------------------------------------
function the_company_lead(){
    global $post;
    $out = array();

    //画像
    $images = get_field('company_images');
    $size = 'company_image';
    if($images){
        foreach($images as $image){
            $company_image[] = get_html_wrap("wrap=div&class=item",wp_get_attachment_image( $image['ID'], $size ));
        }
    }
    $company_image = implode("\n",$company_image);

    //キャッチコピー
    $company_catch = get_field('company_catch');

    //本文
    $company_txt = get_field('company_txt');

    //会社紹介タグ
    $terms = get_the_terms( $post->ID, 'company_tag' );
    if($terms){
        foreach($terms as $term){
            $company_tag[] = get_html_wrap('wrap=span&class=item',$term->name);
        }
        $company_tag = get_html_wrap('wrap=div&class=tagList',implode("\n",$company_tag));


    }

    $out[] = <<<EOM

			<div class="modBlockLead">
				<div class="image">
					<div class="modJsSlider slider">
						{$company_image}
					</div>
				</div>
				<div class="detail">
					<p class="catch">{$company_catch}</p>
					<div class="txt">
						{$company_txt}
					</div>
					{$company_tag}
				</div>
			</div><!-- /.myBlockLead -->

EOM;


    echo implode("\n",$out);
}

//-----------------------------------------------------
// 会社紹介 contents
//-----------------------------------------------------
function the_company_contents(){
    global $post;
    $out = array();


    $company_message = get_company_message();
    $company_shop = get_company_shop();
    $map = get_map();
    $side_ex = get_side_ex();

    $out[] = <<<EOM

			<div class="modBlockColumn02">
				<div class="mainBlock">
					{$company_message}

					{$company_shop}

					<div class="modBlockMap">
						{$map}
					</div>

					<p class="modBtnBox modBtnBox_full"><a href="/application/" class="modBtn01 modBtn01_color02">資料請求･ お問い合わせ</a></p>

				</div><!-- /.mainBlock -->
				<aside class="sideBlock">
			    	{$side_ex}
				</aside><!-- /.sideBlock -->

			</div><!-- .modBlockColumn02 -->

EOM;


    echo implode("\n",$out);
}
function get_company_message(){
    global $post;
    $out = array();

    //キャッチコピー
    $message_catch = get_html_wrap('wrap=p&class=catch',get_field('message_catch'));

    //写真
    $imgs = get_acf_images_html(array(
        'field' =>"message_image",
        'size' => "message_image",
        'width'=> "-1",
        'height'=> "-1",
    ));

    $message_image = '';
    if ($imgs != 'no item' && $imgs != 'no array'){
        $message_image = $imgs[0];
    }

    //メッセージ文
    $message_txt = get_field('message_txt');

    //肩書き・氏名
    $message_foot = get_field('message_foot');


    $out[] = <<<EOM
					<section class="modBox01">
						<h2 class="modTitle02 modTitle02_message">代表者からのメッセージ</h2>
						<div class="modBlockBody">
							<div class="myBlockMessage">
							<figure class="image">
								{$message_image}
							</figure>
							<div class="detail">
								    {$message_catch}
									{$message_txt}
								</div>
								<div class="foot">
									{$message_foot}
								</div>
							</div>
						</div>
					</section>

EOM;


    return implode("\n",$out);
}
function get_company_shop(){
    global $post;
    $out = array();

    //
    $fields = get_field('company_shops_contents');

    if($fields) {



        $tr = array();
        foreach ($fields as $field) {
            $th = get_html_wrap('wrap=th', $field['head']);
            $td = get_html_wrap('wrap=td', url_txt_link($field['body'],'_blank'));
            $tr[] = get_html_wrap('wrap=tr', $th . $td);
        }

        $shops = implode("\n", $tr);


        $out[] = <<<EOM
                <section class="modBox01">
		        	<h2 class="modTitle02 modTitle02_shop">会社情報</h2>
		        	<table class="modTbl modTbl_responsive01">
		        		<tbody>
		        		{$shops}

		        		</tbody>
		        	</table>
		        </section>

EOM;
    }


    return implode("\n",$out);
}

//-----------------------------------------------------
// 住まいのエキスパート lead
//-----------------------------------------------------
function the_expert_lead(){
    global $post;
    $out = array();


    //名前
    $name = get_the_title();

    //会社名
    $company_id = get_company_id();
    $campany_name = get_the_title($company_id);

    //写真
    $size = "expert_face_image";
    $imgs = get_acf_images_html(array(
        'field' =>"expert_face_image",
        'size' => $size,
        'width'=> "-1",
        'height'=> "-1",
    ));
    $expert_face_image = (get_field('expert_face_image'))?$imgs[0]:get_dummy_img($size,'people');

    //キャッチコピー
    $expert_catch = get_field('expert_catch');

    //職種
    $expert_job = get_field('expert_job')->name;

    //プロフィール
    $expert_txt = get_field('expert_txt');

    $out[] = <<<EOM

			<div class="modBlockLead modBlockLead_ex">
				<figure class="image">{$expert_face_image}</figure>
				<div class="detail">
					<p class="catch">{$expert_catch}</p>
					<p class="job">{$expert_job}</p>
					<p class="name">{$name}</p>
					<div class="txt">
						{$expert_txt}
					</div>
					<p class="btn"><a href="/inquiry/?your-expert={$name}さん&your-constractor={$company_id}&your-company={$campany_name}" class="modBtn01 modBtn01_color03 modBtn01_large">{$name}さんに聞いてみる</a></p>
				</div>
			</div><!-- /.myBlockLead -->


EOM;

    echo implode("\n",$out);
}


//-----------------------------------------------------
// 住まいのエキスパート contents
//-----------------------------------------------------
function the_expert_contents(){
    global $post;
    $out = array();

    $name = get_the_title();
    $company_id = get_company_id();
    $campany_name = get_the_title($company_id);

    $expert_ex      = get_expert_ex();
    $expert_message = get_expert_message();
    $side_ex = get_side_ex();

    $out[] = <<<EOM
			<div class="modBlockColumn02">
				<div class="mainBlock">
				    {$expert_ex}
				    {$expert_message}

					<p class="modBtnBox modBtnBox_full"><a href="/inquiry/?your-expert={$name}さん&your-constractor={$company_id}&your-company={$campany_name}" class="modBtn01 modBtn01_color03">{$name}さんに聞いてみる</a></p>
				</div><!-- /.mainBlock -->
				<aside class="sideBlock">
			    	{$side_ex}
				</aside><!-- /.sideBlock -->

			</div><!-- .modBlockColumn02 -->


EOM;


    echo implode("\n",$out);
}


//-----------------------------------------------------
// 住まいのエキスパート ex
// [住まいのエキスパートに質問してみました]
//-----------------------------------------------------
function get_expert_ex(){
    global $post;
    $out = array();

    $contents = get_field('expert_ex_contents');
    foreach($contents as $content){

        //写真
        $size = 'expert_ex_image';
        $expert_ex_image = wp_get_attachment_image( $content['image']['ID'], $size );
        $layout_class = ($content['image_layout'] == 'left')?'modPartsMediaText_mediaLeft':'';
        $el[] = <<<EOM
		<div class="modPartsMediaText {$layout_class}">
			<figure class="image">{$expert_ex_image}</figure>
			<div class="detail">
				<h3 class="modTitle03">{$content['title']}</h3>
			    <p>{$content['txt']}</p>
			</div>
		</div>

EOM;


    }
    $el =  implode("\n",$el);



    $out[] = <<<EOM
        <section class="modBox01">
			<h2 class="modTitle02 modTitle02_ex">住まいのエキスパートに質問してみました </h2>
				<div class="modPartsWysiwyg">
    				{$el}
				</div>
		</section>

EOM;


    return implode("\n",$out);
}

//-----------------------------------------------------
// 住まいのエキスパート ex
// [施主様や社内スタッフからの評判]
//-----------------------------------------------------
function get_expert_message(){
    global $post;
    $out = array();

    $contents = get_field('expert_message_contents');
    if($contents) {

        foreach ($contents as $content) {

            //データ取得
            $name = $content['name'];
            $sub = $content['sub'];
            $title = $content['title'];
            $txt = $content['txt'];

            $el[] = <<<EOM
			<div class="item">
				<div class="info">
					<p class="sub">{$sub}</p>
					<p class="name">{$name}</p>
				</div>
				<div class="detail">
					<p class="modTitle03">{$title}</p>
					<p class="txt">{$txt}</p>
				</div>
			</div>

EOM;


        }
        $el = implode("\n", $el);


        $out[] = <<<EOM
		<section class="modBox01">
			<h2 class="modTitle02 modTitle02_message02">施主様や社内スタッフからの評判</h2>
				<div class="modListValuation">
				    {$el}
				</div>
		</section>

EOM;
    }

    return implode("\n",$out);
}

//-----------------------------------------------------
// お宅拝見レポート メインイメージ
//-----------------------------------------------------
function the_report_main_image(){
    if(get_field('report_image')){

        //写真
        $imgs = get_acf_images_html(array(
            'field' =>"report_image",
            'size' => "report_main_image",
            'width'=> "-1",
            'height'=> "-1",
            'srcset'=> true,
        ));
        $report_main_image = $imgs[0];

        $out[] = <<<EOM
                <figure class="modBlockImage">
                    {$report_main_image}
                </figure>

EOM;
        echo implode("\n",$out);
    }
}

//-----------------------------------------------------
// お宅拝見レポート contents
//-----------------------------------------------------
function the_report_contents(){
    global $post;
    $out = array();

    $contents = get_field('report_contents');
    foreach($contents as $content){

        //タイトル
        $title = $content['title'];
        $body   = $content['body'];

        $out[] = <<<EOM
                        <div class="modPartsBox">
                            <h3 class="modTitle03">{$title}</h3>
                            <div class="txt">
                            {$body}
                            </div>
                        </div>
EOM;

    }
    echo implode("\n",$out);
}

//-----------------------------------------------------
// お宅拝見レポート profile
//-----------------------------------------------------
function the_report_profile(){
    global $post;
    $out = array();

    //写真
    $imgs = get_acf_images_html(array(
        'field' =>"report_profile_face_image",
        'size' => "report_profile_face_image",
        'width'=> "-1",
        'height'=> "-1",
        'srcset'=> true,
    ));
    $report_profile_face_image = (get_field('report_profile_face_image'))?$imgs[0]:get_dummy_img('report_profile_face_image','people');

    $name = get_field('report_profile_name');
    $info = get_field('report_profile_info');



    $out[] = <<<EOM
            <section class="modBox01">
                <h2 class="modTitle02 modTitle02_report">取材を受けてくださったお施主さまプロフィール</h2>
                <div class="modListProfile">
                    <div class="item">
                        <figure class="image">
                            {$report_profile_face_image}
                        </figure>
                        <div class="detail">
                            <p class="modTitle03">{$name}</p>
                            <p class="info">{$info}</p>
                        </div>
                    </div>
                </div>
            </section>
EOM;

    if($name)
    echo implode("\n",$out);
}

//-----------------------------------------------------
// お宅拝見レポート spec
//-----------------------------------------------------
function the_report_spec(){
    global $post;
    $out = array();
    $tr = array();

    $contents = get_field('report_spec_contents');
    if($contents){
        foreach($contents as $content) {
            $th = get_html_wrap('wrap=th', $content['head']);
            $td = get_html_wrap('wrap=td', $content['body']);
            $tr[] = get_html_wrap('wrap=tr', $th . $td);
        }
        $tr = implode("\n", $tr);

        $out[] = <<<EOM
                    <section class="modBox01">
                        <h2 class="modTitle02 modTitle02_report">DATA</h2>
                        <table class="modTbl modTbl_responsive02">
                            <tbody>
                            {$tr}
                            </tbody>
                        </table>
                    </section>

EOM;

        echo implode("\n",$out);
    }
}

//-----------------------------------------------------
// 企業ストーリー contents
//-----------------------------------------------------
function the_story_contents()
{
    global $post;
    $out = array();
    $story_image = '';
    $contents = array();

    if (get_field('story_main_image')) {

        //写真
        $imgs = get_acf_images_html(array(
            'field' => "story_main_image",
            'size' => "story_main_image",
            'width' => "-1",
            'height' => "-1",
            'caption' => true
        ));
        $story_image = $imgs[0];
    }
    if (have_posts()) {
        while (have_posts()) {
            the_post();

            $contents[] = get_the_content();

        }
        $contents = implode("\n", $contents);
    }

    $out[] = <<<EOM
                <figure class="modPartsImage">
                    {$story_image}
                </figure>
                {$contents}


EOM;
    echo implode("\n", $out);
}


//-----------------------------------------------------
// モデルハウス名
//-----------------------------------------------------
function get_modelhouse_name()
{
    //会社名
    $company_id = get_company_id();
    $campany_name = get_the_title($company_id);

    //会場名
    $modelhouse_name = get_the_title();

    return $campany_name . ' ' . $modelhouse_name;
}
function the_modelhouse_name(){
    echo get_modelhouse_name();
}
//-----------------------------------------------------
// モデルハウス header
//-----------------------------------------------------
function the_modelhouse_header()
{
    global $post;
    $out = array();

    //会場名
    $modelhouse_name = get_modelhouse_name();

    //キャッチコピー
    $catch =get_field('modelhouse_catch');

    $out[] = <<<EOM
			<header class="modTitlePage02">
				<h2 class="title">{$catch}</h2>
				<p class="info">{$modelhouse_name}</p>
			</header>


EOM;
    echo implode("\n", $out);
}


//-----------------------------------------------------
// モデルハウス lead
//-----------------------------------------------------
function the_modelhouse_lead()
{
    global $post;
    $out = array();
    $slide_image = $slide_thumb = array();

    //画像
    $images = get_field('modelhouse_image');
    $size = 'modelhouse_image';
    $thumb_size = 'modelhouse_thumb';
    if($images){
        $count = 0;
        foreach($images as $image){
            $slide_image[] = get_html_wrap("wrap=div&class=item",wp_get_attachment_image( $image['ID'], $size ));
            $slide_thumb_btn = sprintf('<button data-href="" %stype="button" class="btn">%s</button>',$count,wp_get_attachment_image( $image['ID'], $thumb_size ));
            $slide_thumb[] = get_html_wrap("wrap=div&class=slide",$slide_thumb_btn);
            $count++;
        }
    }
    $slide_image = implode("\n",$slide_image);
    $slide_thumb = implode("\n",$slide_thumb);

    //紹介文
    $txt = get_field('modelhouse_txt');


    $out[] = <<<EOM
                <div class="myBlockLead">
                    <div class="myJsSlider slider">
                        {$slide_image}
                    </div>
                    <div class="thumbWrap">
                        <div class="thumb myJsSliderThumb">
                            {$slide_thumb}
                        </div>
                    </div>
                    <p class="txt">
                        {$txt}
                    </p>
                    <!-- p class="btnReservation"><a href="#" class="modBtn01 modBtn01_color04">このモデルハウスを見学予約する</a></p -->
                </div>



EOM;
    echo implode("\n", $out);
}

//-----------------------------------------------------
// モデルハウス check
// [モデルハウスのココをチェック]
//-----------------------------------------------------
function the_modelhouse_check(){
    global $post;
    $out = array();

    $contents = get_field('modelhouse_check_contents');
    foreach($contents as $content){

        //写真
        $size = 'modelhouse_check_image';
        $expert_ex_image = wp_get_attachment_image( $content['image']['ID'], $size );
        $layout_class = ($content['image_layout'] == 'left')?'modPartsMediaText_mediaLeft':'';
        $el[] = <<<EOM
		<div class="modPartsMediaText {$layout_class}">
			<figure class="image">{$expert_ex_image}</figure>
			<div class="detail">
				<h3 class="modTitle03">{$content['title']}</h3>
			    <p>{$content['txt']}</p>
			</div>
		</div>

EOM;


    }
    $el =  implode("\n",$el);



    $out[] = <<<EOM
        <section class="modBox01">
			<h2 class="modTitle02 modTitle02_check">モデルハウスの<br class="sp">ココをチェック！</h2>
				<div class="modPartsWysiwyg">
    				{$el}
				</div>
		</section>

EOM;


    echo implode("\n",$out);
}


//-----------------------------------------------------
// お宅拝見レポート spec
//-----------------------------------------------------
function the_modelhouse_info(){
    global $post;
    $out = array();
    $tr = array();

    $contents = get_field('modelhouse_info_contents');
    if($contents){
        foreach($contents as $content) {
            $th = get_html_wrap('wrap=th', $content['head']);
            $td = get_html_wrap('wrap=td', $content['body']);
            $tr[] = get_html_wrap('wrap=tr', $th . $td);
        }
        $tr = implode("\n", $tr);

        $out[] = <<<EOM
                <section class="modBox01">
                    <h2 class="modTitle02 modTitle02_event">モデルハウス情報</h2>
                    <table class="modTbl modTbl_responsive01">
                        <tbody>
                        {$tr}
                        </tbody>
                    </table>
                </section>

EOM;

        echo implode("\n",$out);
    }
}

//-----------------------------------------------------
// 地図
//-----------------------------------------------------
function get_map(){
    global $post;
    $out = array();

    $key = 'AIzaSyDnAPSvcmkoXUNju-zzsAqiznw48TAjN_Y';

    if(get_field('map')){
        // ACFの入力を取得
        $fields = get_field('map');
        $q = $fields['address'];
    }else{
        $company_id = get_company_id();
        $q = get_the_title($company_id);
    }

    $out[] = <<<EOM
    <iframe
     src="https://www.google.com/maps/embed/v1/place?key={$key}&q={$q}"
     width="850" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
EOM;
    return implode("\n",$out);

}

function the_map()
{
    echo get_map();
}

function get_side_ex(){

    global $post, $post_type, $company_id;
    $out = array();

    $company_id = get_company_id();

    //住まいのエキスパートの取得　カスタムフィールドの値を取得して表示。
    $args = array(
        // 取得したい投稿の条件
        'post_type' => 'expert',
        'posts_per_page' => -1,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
        'meta_query' => array(
            array(
                'key'     => 'relation_company',
                'value'   => '"' . $company_id . '"',
                'compare' => 'LIKE',
            ),
        ),

    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        while( $the_query->have_posts() ) {
            $the_query->the_post();

            //URL
            $url = get_permalink();

            //名前
            $name = get_the_title();

            //写真
            $size = 'expert_face_image_thum';
            $imgs = get_acf_images_html(array(
                'field' =>"expert_face_image",
                'size' => $size,
                'width'=> "-1",
                'height'=> "-1",
                'srcset'=> true,
            ));
            $expert_face_image = (get_field('expert_face_image'))?$imgs[0]:get_dummy_img($size,'people');

            //キャッチコピー
            $expert_catch = get_field('expert_catch');

            //職種
            $expert_job = get_field('expert_job')->name;


            //コンテンツ生成
            $expert_contents[] = <<<EOM

               <a href="{$url}" class="item">
                   <figure class="image">
                       {$expert_face_image}
                   </figure>
                   <div class="detail">
                       <p class="job">{$expert_job}</p>
                       <p class="name">{$name}</p>
                       <p class="txt">{$expert_catch}</p>
                   </div>
               </a>

EOM;

        }
        $expert_contents = implode("\n",$expert_contents);
        wp_reset_postdata();

        $out[] = <<<EOM
                    <section class="modBox01 modBox01_small">
                        <h2 class="modTitle02 modTitle02_small modTitle02_ex">住まいのエキスパート</h2>
                        <div class="modBlockBody modBlockBody_small">
                            <div class="modListEx">
                                {$expert_contents}
                            </div>
                        </div>
                    </section>
EOM;
        return implode("\n",$out);
    }
}

function the_side_ex(){
    echo get_side_ex();
}

//-----------------------------------------------------
// ダミー画像
//-----------------------------------------------------
function get_dummy_img($size='admin_image_rectangle',$type='image'){
    //ダミー画像の取得をサイズに合わせて取得する。
    $dummy_img = '';
    $type = 'dummy_'.$type;
    $img = get_field($type,'option');
    if($img){
        $dummy_img = wp_get_attachment_image( $img['ID'], $size );
    }
    return $dummy_img;
}
//-----------------------------------------------------
// ページャー
//-----------------------------------------------------
function get_pager(){
	global $wp_rewrite,$wp_query,$the_query,$paged;
	/****************************************************************************************
	 * コンテンツ整形
	 ****************************************************************************************/
	$paginate_base = get_pagenum_link(1);
	if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
		$paginate_format = '';
		$paginate_base = add_query_arg('paged','%#%');
	}
	else{
		$paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
			user_trailingslashit('page/%#%/','paged');;
		$paginate_base .= '%_%';
	}
	$pages = paginate_links(array(
		'base' => $paginate_base,
		'format' => $paginate_format,
		'total' => $the_query->max_num_pages,
		'mid_size' => 1,
		'current' => ($paged ? $paged : 1),
		'prev_text' => '前へ',
		'next_text' => '次へ',
		'type' => 'array',
	));
	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		$list = array();
		foreach ( $pages as $page ) {
			//タグ整形
//			preg_match('/class=(\'|")(.*?)(\'|")/', $page , $match);
//			$class = preg_replace('/page-numbers/','',$match[2]);
            if(preg_match('/prev|next/',$page)){
                $page = preg_replace('/prev/','previouspostslink',$page);
                $page = preg_replace('/next/','nextpostslink',$page);
                $page = preg_replace('/page-numbers/','',$page);
            }elseif(preg_match('/current/',$page)){
                $page = preg_replace('/page-numbers/','',$page);
            }else{
                $page = preg_replace('/page-numbers/','page larger',$page);
            }


//            $li_class = trim($class);



            $list[] = $page;
		}
		$list = get_html_wrap('wrap=div&class=inner',implode("\n",$list));
	}
	/****************************************************************************************
	 * ラッピング
	 ****************************************************************************************/
	return get_html_wrap('wrap=div&class=modPager',$list);
}

function the_pager(){
    echo get_pager();
}

function get_form_select($term_name,$default_txt,$default=''){
    $terms        =  get_terms($term_name,array('hide_empty'=>false));
    if($default_txt){
        $options[] = sprintf('<option value="%s"">%s</option>','',$default_txt);
    }
    foreach($terms as $term){
        if($default == $term->term_id){
            $options[] = sprintf('<option value="%s" selected="selected">%s</option>',$term->term_id,$term->name);
        }else{
            $options[] = sprintf('<option value="%s">%s</option>',$term->term_id,$term->name);
        }
    }
    $options = implode("\n",$options);
    $out[] = <<<EOM
                        <select name="{$term_name}" id="">
                            {$options}
                        </select>
EOM;


    return implode("\n",$out);
}
function the_form_select($term_name,$default_txt ,$default=''){
    echo get_form_select($term_name,$default_txt,$default);
}
function get_form_radio($term_name,$wrap=''){
    $count = 1;
    $terms        =  get_terms($term_name,array('hide_empty'=>false));

    $radios[] = get_html_wrap(
                    'wrap='.$wrap,
                    sprintf(
                        '<input type="radio" id="%s-%s" name="%s" value="all" %s><label for="%s-%s">全て</label>',
                        $term_name,$count,
                        $term_name,
                        get_form_checked($term_name,'all'),
                        $term_name,$count
                    )
                );
    foreach($terms as $term){
        $count++;
        $radios[] = get_html_wrap(
            'wrap='.$wrap,
            sprintf(
                '<input type="radio" id="%s-%s" name="%s" value="%s" %s><label for="%s-%s">%s</label>',
                $term_name,$count,
                $term_name,
                $term->term_id,
                get_form_checked($term_name,$term->term_id),
                $term_name,$count,
                $term->name
            )
        );
    }
    $radios = implode("\n",$radios);
    $out[] = $radios;


    return implode("\n",$out);
}
function the_form_radio($term_name,$default_txt ,$default='',$wrap=''){
    echo get_form_radio($term_name,$default_txt,$default,$wrap);
}

function get_form_checked($name,$default=''){
    $checked    = '';
    $query_value    = get_query_var( $name );
    if($query_value == $default){
        $checked = 'checked="checked"';
    }
    return $checked;
}

//-----------------------------------------------------
// 地図
//-----------------------------------------------------
function get_event($event){
    $url = $event['url'] . (strpos($event['url'], '?') ? '&' : '?') . 'kc_source=' . 'www.ok-expo.jp' . '&utm_store_kc=true';
    $image_url = $event['image_url'];
    $event_type = $event['event_type'];
    $event_format_string = $event['event_format_string'];
    $event_open_date_from_to_string = $event['event_open_date_from_to_string'];
    $name = $event['name'];
    $event_rough_address = $event['event_rough_address'];

    $out[] = <<<EOM
    <li class="modListEvent__item">
        <a href="$url" class="box">
            <div class="box__photo">
                <img src="$image_url" alt="" >
            </div>
            <div class="box__body">
                <ul class="box__category">
                    <li class="box__category-item -category01">$event_type</li>
                    <li class="box__category-item">$event_format_string</li>
                </ul>
                <p class="box__ttl">$name</p>
                <ul class="box__info">
                    <li class="box__info-item -item01">$event_rough_address</li>
                    <li class="box__info-item -item02">$event_open_date_from_to_string</li>
                </ul>
            </div>
        </a>
    </li>
EOM;
    echo implode("\n",$out);

}

?>