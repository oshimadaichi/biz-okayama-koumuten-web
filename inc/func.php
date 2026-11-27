<?php


/*----------------------------------------------------
    title
----------------------------------------------------*/
function getLanguageTitle($obj){
    return $obj->label;
}
function theTitle( $separateText ='｜' ){
	global $wp_query,$post_type;

	$out = array();

	$front_page_text = 'トップ'; //If you have not set the front-page, then describe your text here.
	$front_page_ID = get_option('page_on_front') ;

	$obj = get_post_type_object($post_type);

	if ( $front_page_ID != 0 ) {
		$front_page_title = get_the_title( $front_page_ID );
	} else {
		$front_page_title = $front_page_text;
	}




    if ( is_single() )
	{
        $before_title = '';
        if($post_type == 'modelhouse'){
            $company_id = get_company_id();
            $before_title = get_the_title($company_id) . ' ';
        }
        $out[] =  the_title($before_title,'', FALSE);
		$out[] =  getLanguageTitle($obj);
	}
	elseif ( is_page() )
	{
		$post = $wp_query->get_queried_object();
		if ( $post->post_parent == 0 ){
			$out[] =  the_title('','', FALSE);
		} else {
			$title = the_title('','', FALSE);
			$ancestors = get_post_ancestors( $post->ID );
			array_unshift($ancestors, $post->ID);
			foreach ( $ancestors as $ancestor ){
				$out[] = get_the_title( $ancestor );
			}
		}
	}
	elseif ( is_category() )
	{
		$catTitle = single_cat_title( "", false );
		$out[] =  __('Category') . ": " . $catTitle;
	}
	elseif ( is_tag() )
	{
		$out[] =  __('Tag') . ": ";
		single_tag_title();
	}
	elseif ( is_archive() && !is_category() )
	{
		$out[] =  getLanguageTitle($obj);
	}
	elseif ( is_search() ) {
		$out[] =  __('Search Results');
	}
	elseif ( is_404() )
	{
		$out[] =  __('Page not found').'aa';
	}
	$out[] = get_bloginfo( 'name' );
	echo implode($separateText,$out);
}

add_action( 'pre_get_posts', function( $q )
{
    if( $title = $q->get( '_meta_or_title' ) )
    {
        add_filter( 'get_meta_sql', function( $sql ) use ( $title )
        {
            global $wpdb;

            // Only run once:
            static $nr = 0;
            if( 0 != $nr++ ) return $sql;


            //ジャンルの検索をORに追加
            //////////////////////////////////////////////////////////////////
            $termIds = get_terms([
                'name__like' => $title,
                'fields' => 'ids'
            ]);
            $tax_query = array(
                array(
                    'taxonomy' => 'company_genre',
                    'field'    => 'term_id',
                    'terms'    => $termIds,
                    )
            );
            global $wpdb;


            //SQL文を取得
            $tax_sql = get_tax_sql( $tax_query, $wpdb->posts, 'ID' );

            if($tax_sql['join']){
                //JOINを結合
                $sql['join'] .= $tax_sql['join'];

                //whereを整形
                $tax_sql['where'] = preg_replace("/\n/","", $tax_sql['where'] );
                $tax_sql['where'] = preg_replace("/AND/","OR\n", $tax_sql['where'],1 );
            }

            //タイトルの検索をORに追加
            //////////////////////////////////////////////////////////////////
            $title_sql = sprintf(
                "OR\n ( %s )  ",
                $wpdb->prepare(
                    "{$wpdb->posts}.post_title like '%s'",
                    '%'.$title.'%'
                )
            );

            //whereにカスタムSQLを置換して追加
            //////////////////////////////////////////////////////////////////
            $custom_sql =implode(array($title_sql,$tax_sql['where']),"\n");
            $sql['where'] = preg_replace("/OR/",   $custom_sql . "\nOR" , $sql['where'],1);


            //リピーターフィールドを置換
            //company_shops_contents
            //////////////////////////////////////////////////////////////////
            $sql['where']  = str_replace(
                "meta_key = 'company_shops_contents_$",
                "meta_key LIKE 'company_shops_contents_%",
                $sql['where']
            );

            return $sql;
        });
    }
});
/*----------------------------------------------------
   ニュースの日時を取得
----------------------------------------------------*/
function get_news_date($separate = ' - '){
	global $post;

	$date = '';
	$start_date = get_field('news_date_start',$post->ID);
	$end_date   = get_field('news_date_end',$post->ID);
	;
	if(!empty($start_date)) $date = sprintf('<span class="start">%s</span>',$start_date);
	if(!empty($start_date) && !empty($end_date)) $date = sprintf($date.$separate.'<span class="end">%s</span>',$end_date);
	return $date;
}

/*----------------------------------------------------
   Wordpressのアイコンdashiconを利用可能に
----------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
    wp_enqueue_style( 'dashicons' );
}

/*----------------------------------------------------
   adminbar（管理バー）を画面の下へ移動
----------------------------------------------------*/
function fb_move_admin_bar() {
	echo '
    <style type="text/css">
    html {
    margin-top: 0 !important
    }
    body.admin-bar #wphead {
       padding-top: 0;
    }
    body.admin-bar #footer {
       padding-bottom: 32px;
    }

    #wpadminbar {
        top: auto !important;
        bottom: 0;
    }
    #wpadminbar .quicklinks .menupop ul {
        bottom: 32px;
    }
    #wpadminbar .menupop .ab-sub-wrapper{
    	bottom: 32px;
    }
    </style>';
}
// on frontend area
add_action( 'wp_head', 'fb_move_admin_bar' ,100);


/*----------------------------------------------------
    バージョンアップ通知を管理者のみ表示
----------------------------------------------------*/
function update_nag_admin_only() {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_action( 'admin_notices', 'update_nag', 3 );
	}
}
add_action( 'admin_init', 'update_nag_admin_only' );

/*----------------------------------------------------
    デバッグ用
----------------------------------------------------*/
function pr($obj,$tit="")
{
	if($tit)
		echo '<p style="font-weight: bold; margin: 0;">'.$tit.'</p>';
	echo '<pre style="text-align:left; margin: 0 0 20px 0;">';
	print_r($obj);
	echo '</pre>';
}
function vd($obj,$tit="")
{
	if($tit)
		echo '<p style="font-weight: bold; margin: 0;">'.$tit.'</p>';
	echo '<pre style="text-align:left; margin: 0 0 20px 0;">';
	var_dump($obj);
	echo '</pre>';
}


// ----------------------------------------------------
// Contact Form 7 英語スパム対策（motive_s 用）
// 日本語(ひら/カナ/漢字)が1文字も無い入力を弾く
// 任意: 空は通す / 必須: 空もCF7標準が弾く
// ----------------------------------------------------
foreach (['wpcf7_validate_textarea','wpcf7_validate_textarea*','wpcf7_validate_text','wpcf7_validate_text*'] as $hook) {
  add_filter($hook, 'require_japanese_in_motive_s', 99, 2);
}

function require_japanese_in_motive_s( $result, $tag ) {
  // CF7バージョン差異に対応
  $name = method_exists($tag, 'name') ? $tag->name() : $tag->name;
  if ($name !== 'motive_s') return $result;

  // 値を安定取得（Multi-Step等でもOK）
  $posted = class_exists('WPCF7_Submission') && ($sub = WPCF7_Submission::get_instance())
    ? $sub->get_posted_data($name)
    : (isset($_POST[$name]) ? $_POST[$name] : '');
  $value = trim((string)$posted);

  // 空は通す（※必須ならCF7側の必須チェックが働く）
  if ($value !== '' && !preg_match('/[\p{Hiragana}\p{Katakana}\p{Han}]/u', $value)) {
    $result->invalidate($tag, '日本語でのメッセージをご記入ください。');
  }
  return $result;
}
