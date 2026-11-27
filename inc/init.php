<?php

//-----------------------------------------------------
// 管理画面 tinymce スタイル追加
//-----------------------------------------------------
add_action('admin_head', function (){
	global $current_screen;

	// 共通
	add_editor_style(get_css_dir().'_gutenberg.css');
	add_editor_style(get_css_dir().'common.css');
	add_editor_style(get_admin_dir().'tinymce.css');

	add_filter( 'tiny_mce_before_init', function ( $init ) {
		global $current_screen;
		$init['body_class'] = 'editor_' . $current_screen->post_type . ' modPartsWysiwyg';
		return $init;
	});



});

/*----------------------------------------------------
   コメントアウトのみpタグで囲わない
----------------------------------------------------*/
function remove_p_on_commentout($content){
//コメントアウトのみpタグで囲わない
	return preg_replace('/<p>(\s*)(<\!\-\- .* \-\->)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'remove_p_on_commentout');

/*----------------------------------------------------
    wysiwygエディタ ツールバーカスタマイズ
----------------------------------------------------*/
function _tinyMCESettings( $init ) {
	//書式プルダウンメニューのカスタマイズ
	$init['block_formats'] = '段落=p;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6';
	//自作クラスをプルダウンメニューで追加
	$style_formats = array (
		array(
            'title' => '見出しA', 'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 'classes' => 'modTitle03'
        ),
		array(
            'title' => '見出しB', 'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', 'classes' => 'modTitle04'
        ),
		array(
            'title' => '画像横並び', 'selector' => 'div,p', 'classes' => 'modPartsImageList'
        ),
	);
	$init['style_formats'] = json_encode( $style_formats );
	$init['style_formats_merge'] = false;

	// styleや、divの中のdiv,span、spanの中のspanを消させない
	$init['valid_children'] = '+body[style],+div[div|span],+span[span]';
	// 空タグや、属性なしのタグとか消そうとしたりするのを停止。
	$init['verify_html'] = false;

	return $init;
}
add_filter( 'tiny_mce_before_init', '_tinyMCESettings',1000 );
//-----------------------------------------------------
// ポストタイプ追加
//-----------------------------------------------------
add_action( 'init', function () {
	/*
	* ポストタイプ設定
	*/
	$pt = array(
		array("post_type" => "company",		"label" => "住宅会社紹介" ,	"arg" => array('single' => true,'rewrite' => array('slug' => 'company'))),
		array("post_type" => "expert",		"label" => "住まいのエキスパート" ,	"arg" => array('single' => true,'rewrite' => array('slug' => 'expert'))),
		array("post_type" => "story",		"label" => "企業ストーリー" ,	     	"arg" => array('single' => true,'rewrite' => array('slug' => 'story'),'supports' => array( 'title','editor','revisions' ))),
        array("post_type" => "report",		"label" => "お宅拝見レポート" ,		"arg" => array('single' => true,'rewrite' => array('slug' => 'report'))),
//        array("post_type" => "report",		"label" => "お宅拝見レポート" ,		"arg" => array('single' => true,'rewrite' => array('slug' => 'report'),'supports'			 => array( 'title','editor','revisions' ),'show_in_rest' => true)),
		array("post_type" => "modelhouse",	"label" => "モデルハウス",			"arg" => array('single' => true,'rewrite' => array('slug' => 'modelhouse'))),
		array("post_type" => "event",	    "label" => "イベント",				"arg" => array('single' => true,'rewrite' => array('slug' => 'event'))),
	);

	$labels = array(
		'name'               => 'label',
		'singular_name'      => 'label',
		'menu_name'          => 'label',
		'name_admin_bar'     => 'label',
		'add_new_item'       => '新しくlabelを登録する',
		'new_item'           => '新しいlabel',
		'edit_item'          => 'labelを編集',
		'view_item'          => 'labelを見る',
		'all_items'          => '全てのlabel',
		'search_items'       => 'labelを検索',
		'parent_item_colon'  => '親のlabel:',
		'not_found'          => 'labelが見つかりませんでした。',
		'not_found_in_trash' => 'ゴミ箱にlabelはありません。'
	);

	/*
	* 登録処理
	*/
	foreach($pt as $value){

		$args = array(
			'labels'			 => $labels,
			'public'			 => true,
			'publicly_queryable' => true,
			'show_ui'			 => true,
			'show_in_menu'		 => true,
			'query_var'			 => true,
			'capability_type'	 => 'post',
			'has_archive'		 => true,
			'hierarchical'		 => false,
			'menu_position'		 => null,
			'rewrite'			 => true,
			'supports'			 => array( 'title','revisions' ),
			'single'			 => false,
		);

		$args = wp_parse_args( $value["arg"], $args );

		$args['labels'] = str_replace("label",$value["label"],$labels);
		register_post_type( $value["post_type"], $args);

		if($args["single"]){
			//ルール追加
			if(is_array($args["rewrite"])){
				add_rewrite_rule($args["rewrite"]["slug"].'/([0-9]+)?$', 'index.php?post_type='.$value["post_type"].'&p=$matches[1]', 'top');
			}else{
				add_rewrite_rule($value["post_type"].'/([0-9]+)?$', 'index.php?post_type='.$value["post_type"].'&p=$matches[1]', 'top');
			}
		}
	}

},5);
//-----------------------------------------------------
// カスタム投稿パーマリンク 修正
//-----------------------------------------------------
add_filter( 'post_type_link', function ( $link, $post ){
	if ( 'company' === $post->post_type ) $link =  home_url( '/company/' . $post->ID );
	if ( 'expert' === $post->post_type ) $link =  home_url( '/expert/' . $post->ID );
	if ( 'story' === $post->post_type ) $link =  home_url( '/story/' . $post->ID );
	if ( 'report' === $post->post_type ) $link =  home_url( '/report/' . $post->ID );
	if ( 'modelhouse' === $post->post_type ) $link =  home_url( '/modelhouse/' . $post->ID );
	if ( 'event' === $post->post_type ) $link =  home_url( '/event/' . $post->ID );

	return $link;
}, 1, 2 );


//-----------------------------------------------------
// オプションページ追加
//-----------------------------------------------------
add_action( 'init', function () {
    if( function_exists('acf_add_options_page') && is_admin()) {
        /*
        サイト設定
        ----------------------------------------------------*/
        acf_add_options_page(array(
            'page_title' 	=> 'サイト設定',
            'menu_title'	=> 'サイト設定',
            'menu_slug' 	=> 'site-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));
    }
} );

//-----------------------------------------------------
// タクソノミー追加
//-----------------------------------------------------
add_action( 'init', function () {

	$pt_tax = array(
        "company" => array(
            'company_genre' => array(
                'label'		 => 'ジャンル',
                'arg'		 => array(
                    'hierarchical' =>false,
                ),
            ),
            'company_tag' => array(
                'label'		 => '会社紹介タグ',
                'arg'		 => array(
                    'hierarchical' =>false,
                    'show_tagcloud'		 => true,
                ),
            ),
            'company_area' => array(
                'label'		 => '施工予定エリア',
                'arg'		 => array(
                    'hierarchical' =>false,
                ),
            ),
            'company_tsubo' => array(
                'label'		 => '坪単価',
                'arg'		 => array(
                    'hierarchical' =>false,
                ),
            ),
            'company_kodawari' => array(
                'label'		 => 'こだわり',
                'arg'		 => array(
                    'hierarchical' =>false,
                ),
            ),
        ),
        "expert" => array(
            'expert_job' => array(
                'label'		 => '職種',
                'arg'		 => array(
                    'hierarchical' =>false,
                ),
            ),

        )
        );

	$args = array(
		'hierarchical'		 => true,
		'show_tagcloud'		 => false,
		'query_var'			 => false,
		'rewrite'			 => false,
		"rules"				 => false
	);
	$labels = array(
		'name'				 => 'label',
		'singular_name'		 => 'label',
		'search_items'		 => 'labelを検索',
		'all_items'			 => '全てのlabel',
		'parent_item'		 => 'labelの親',
		'parent_item_colon'	 => 'labelの親:',
		'edit_item'			 => 'labelを作成',
		'update_item'		 => 'labelを更新',
		'add_new_item'		 => '新しくlabelを作成する',
		'new_item_name'		 => '新しいlabel',
		'menu_name'			 => 'label',
		"no_terms"			 => 'labelなし',
		'not_found'			 => 'labelが見つかりませんでした。'
	);

	foreach ( $pt_tax as $pt => $taxs ) {

		foreach ( $taxs as $tax => $param ) {
			//ラベル修正
			$args['labels'] = str_replace("label",$param["label"],$labels);
			//パラメータ結合
			if(isset($param["arg"])) $args = wp_parse_args( $param["arg"], $args );
			//タクソノミー登録
			register_taxonomy($tax,$pt,$args);

			//リライトルール追加
			if($args['rules']){

				$tax_rewrite = $tax;
				if($args['rewrite']) $tax_rewrite = $args['rewrite']['slug'];

				//アーカイブトップ
				add_rewrite_rule($pt.'/'.$tax_rewrite.'/(.+?)/?$', 'index.php?post_type='.$pt.'&'.$param["slug"].'=$matches[1]', 'top');
				//アーカイブページング
				add_rewrite_rule($pt.'/'.$tax_rewrite.'/(.+?)/page/([0-9]{1,})/?$', 'index.php?post_type='.$pt.'&'.$param["slug"].'=$matches[1]&paged=$matches[2]', 'top');
			}
		}
	}

},5);


//-----------------------------------------------------
// 画像サイズ追加
//-----------------------------------------------------
add_action( 'after_setup_theme', function () {
	$image_sizes = array(
		// ACFプレビュー用
		'preview' => array(
			'width'	  => 200,
			'height'	 => 0,
			'crop'	   => false
		),
		// 会社紹介ロゴ
		'logo' => array(
			'width'	  => 140,
			'height'	 => 140,
			'crop'	   => true
		),
		// 会社紹介ロゴ＠2x
		'logo@2x' => array(
			'width'	  => 280,
			'height'	 => 280,
			'crop'	   => true
		),
		// TOP お宅拝見レポート
		'top_report' => array(
			'width'	  => 286,
			'height'	 => 190,
			'crop'	   => true
		),
        // TOP お宅拝見レポート＠2x
        'top_report@2x' => array(
            'width'	  => 572,
            'height'	 => 380,
            'crop'	   => true
        ),
		// TOP 住まいのエキスパート
		'top_expert_face_image' => array(
			'width'	  => 460,
			'height'	 => 600,
			'crop'	   => true
		),
        // TOP 住まいのエキスパート＠2x
        'top_expert_face_image@2x' => array(
            'width'	  => 230,
            'height'	 => 300,
            'crop'	   => true
        ),
        // 一覧 住まいのエキスパート
        'result_expert_face_image' => array(
            'width'	  => 420,
            'height'	 => 466,
            'crop'	   => true
        ),
		// ストーリーイメージ
		'img_story' => array(
			'width'	  => 230,
			'height'	 => 230,
			'crop'	   => true
		),
		// ストーリーイメージ＠2x
		'img_story@2x' => array(
			'width'	  => 460,
			'height'	 => 460,
			'crop'	   => true
		),
		// ストーリーメインイメージ
		'story_main_image' => array(
			'width'	  => 760,
			'height'	 => 0,
			'crop'	   => false
		),
		// 会社紹介イメージ
		'company_image' => array(
			'width'	  => 555,
			'height'	 => 390,
			'crop'	   => true
		),
		// 代表メッセージイメージ
		'message_image' => array(
			'width'	  => 260,
			'height'	 => 0,
			'crop'	   => false
		),

		// 住まいのエキスパート顔写真
		'expert_face_image' => array(
			'width'	  => 420,
			'height'	 => 0,
			'crop'	   => false
		),

		// 住まいのエキスパート顔写真 サムネイル
		'expert_face_image_thum' => array(
			'width'	  => 120,
			'height'	 => 120,
			'crop'	   => true
		),

		// 住まいのエキスパート顔写真 サムネイル@2x
		'expert_face_image_thum@2x' => array(
			'width'	  => 240,
			'height'	 => 240,
			'crop'	   => true
		),
		// 住まいのエキスパート イメージ写真
		'expert_ex_image' => array(
			'width'	  => 520,
			'height'	 => 0,
			'crop'	   => false
		),
		// 住まいのエキスパート イメージ写真@2x
		'expert_ex_image@2x' => array(
			'width'	  => 1040,
			'height'	 => 0,
			'crop'	   => false
		),

		// 住まいのエキスパート 施主様や社内スタッフからの評判 写真
		'expert_message_image' => array(
			'width'	  => 240,
			'height'	 => 240,
			'crop'	   => true
		),
		// 住まいのエキスパート 施主様や社内スタッフからの評判 写真@2x
		'expert_message_image@2x' => array(
			'width'	  => 480,
			'height'	 => 480,
			'crop'	   => true
		),

		// お宅拝見レポート メインイメージ
		'report_main_image' => array(
            'width'	  => 850,
            'height'	 => 0,
            'crop'	   => false
		),

        // お宅拝見レポート サムネイル
        'report_profile_face_image' => array(
            'width'	  => 120,
            'height'	 => 120,
            'crop'	   => true
        ),

        // お宅拝見レポート サムネイル@2x
        'report_profile_face_image@2x' => array(
            'width'	  => 240,
            'height'	 => 240,
            'crop'	   => true
        ),
        // モデルハウス
        'modelhouse_image' => array(
            'width'	  => 850,
            'height'	 => 577,
            'crop'	   => true
        ),
        // モデルハウス
        'modelhouse_thumb' => array(
            'width'	  => 84,
            'height'	 => 82,
            'crop'	   => true
        ),
        // 住まいのエキスパート イメージ写真
        'modelhouse_CHE_image' => array(
            'width'	  => 520,
            'height'	 => 0,
            'crop'	   => false
        ),
        // 住まいのエキスパート イメージ写真@2x
        'expert_ex_image@2x' => array(
            'width'	  => 1040,
            'height'	 => 0,
            'crop'	   => false
        ),

		// 管理画面用サムネイル 正方形
		'admin_image_square' => array(
			'width'	  => 70,
			'height'	 => 70,
			'crop'	   => true
		),
		// 管理画面用サムネイル 長方形
		'admin_image_rectangle' => array(
			'width'	  => 200,
			'height'	 => 0,
			'crop'	   => false
		),

	);
	foreach ( $image_sizes as $slug => $size ) {
		add_image_size( $slug, $size['width'], $size['height'], $size['crop'] );
	}
});

//-----------------------------------------------------
// ページクラス 追加
//-----------------------------------------------------
add_filter('add_body_class', function ($classes) {
	global $wp_query,$post;
	$post_type = $wp_query->query_vars["post_type"];
	$uri = $_SERVER["REQUEST_URI"];

    if(is_front_page()){
        $classes[] = 'page_top';
    }

    if($post_type){
      $classes[] = 'page_'.$post_type;
    }

	if(is_page()){
		$classes[] = 'page_'.$post->post_name;
	}
	if ( $post->post_parent ) {
		$page = get_post( $post->post_parent );
		$classes[] = 'page_' . $page->post_name;
	}

	return  $classes;
});

//-----------------------------------------------------
// クエリ 修正
//-----------------------------------------------------
add_action( 'pre_get_posts', function ($query) {
	//管理画面,メインクエリに干渉しないために必須
	if ( is_admin() || ! $query->is_main_query() ) return;

	//トップページ　NEWS クエリ修正
	if ( $query->is_home() ) {
		$query->set( 'posts_per_page', 3 );

		$query->set( 'meta_query' , array(

			array(	'key'=>'front_page',
				'value' => 1,
				'compare' => '='
			)

		) );
	}
});

//-----------------------------------------------------
// ダッシュボードウィジェット削除(管理者以外)
//-----------------------------------------------------
add_action('wp_dashboard_setup', function() {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPressニュース
	}
});



//-----------------------------------------------------
// 管理サイドメニュー削除(管理者以外)
// ※プロフィールの権限は活かしてサイドメニューから非表示
// ※その他の機能はAdmin Menu Editorで実装
//-----------------------------------------------------
add_action('admin_menu', function () {
	if ( ! current_user_can( 'administrator' ) ) {
	global $menu;
		// unset($menu[2]);  // ダッシュボード
		// unset($menu[4]);  // メニューの線1
		// unset($menu[5]);  // 投稿
		// unset($menu[10]); // メディア
		// unset($menu[15]); // リンク
		// unset($menu[20]); // ページ
		// unset($menu[25]); // コメント
		// unset($menu[59]); // メニューの線2
		// unset($menu[60]); // テーマ
		// unset($menu[65]); // プラグイン
		 unset($menu[70]); // プロフィール
		// unset($menu[75]); // ツール
		// unset($menu[80]); // 設定
		// unset($menu[90]); // メニューの線3
	}
});

//-----------------------------------------------------
// 管理バーの項目を削除(管理者以外)
//-----------------------------------------------------
add_action('admin_bar_menu', function ( $wp_admin_bar ) {
	if ( ! current_user_can( 'administrator' ) ) {
//		$wp_admin_bar->remove_menu('wp-logo');      // ロゴ
//		$wp_admin_bar->remove_menu('site-name');    // サイト名
//		$wp_admin_bar->remove_menu('view-site');    // サイト名 -> サイトを表示
//		$wp_admin_bar->remove_menu('dashboard');    // サイト名 -> ダッシュボード (公開側)
//		$wp_admin_bar->remove_menu('themes');       // サイト名 -> テーマ (公開側)
//		$wp_admin_bar->remove_menu('customize');    // サイト名 -> カスタマイズ (公開側)
		$wp_admin_bar->remove_menu('comments');     // コメント
//		$wp_admin_bar->remove_menu('updates');      // 更新
//		$wp_admin_bar->remove_menu('view');         // 投稿を表示
//		$wp_admin_bar->remove_menu('new-content');  // 新規
		$wp_admin_bar->remove_menu('new-post');     // 新規 -> 投稿
//		$wp_admin_bar->remove_menu('new-media');    // 新規 -> メディア
		$wp_admin_bar->remove_menu('new-link');     // 新規 -> リンク
		$wp_admin_bar->remove_menu('new-page');     // 新規 -> 固定ページ
//		$wp_admin_bar->remove_menu('new-user');     // 新規 -> ユーザー
//		$wp_admin_bar->remove_menu('my-account');   // マイアカウント
//		$wp_admin_bar->remove_menu('user-info');    // マイアカウント -> プロフィール
//		$wp_admin_bar->remove_menu('edit-profile'); // マイアカウント -> プロフィール編集
//		$wp_admin_bar->remove_menu('logout');       // マイアカウント -> ログアウト
//		$wp_admin_bar->remove_menu('search');       // 検索 (公開側)
	}
}, 201);


/*-----------------------------------------------------------------------------------------
    ACF GoogleMap設定
-----------------------------------------------------------------------------------------*/
// ACF Google Maps: Add API key
add_filter( 'acf/fields/google_map/api', 'google_maps_api' );
//Google Maps
function google_maps_api($apiKey) {
    $a = 'AIzaSyDnAPSvcmkoXUNju-zzsAqiznw48TAjN_Y';
    $apiKey['key'] = $a;
    return $apiKey;
}
/*-----------------------------------------------------------------------------------------
    検索クエリを追加
-----------------------------------------------------------------------------------------*/
add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'company_area';
    $query_vars[] = 'company_tsubo';
    $query_vars[] = 'company_kodawari';
    $query_vars[] = 'company_keyword';
    $query_vars[] = 'expert_gender';
    $query_vars[] = 'expert_job';
    return $query_vars;
});

