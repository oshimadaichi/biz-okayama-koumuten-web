<?php
/**
 * Created by PhpStorm.
 * User: ISHIDA
 * Date: 2015/01/14
 * Time: 17:59
 */

/*----------------------------------------------------
    管理画面用にCSSを読み込み
    管理画面用CSS
----------------------------------------------------*/
function admin_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo("template_directory").'/css/admin.css">';
}
add_action('admin_head', 'admin_css');

/*----------------------------------------------------
    管理画面用JavaScript
----------------------------------------------------*/
function admin_js() {
	echo '<script type="text/javascript" src="'.get_bloginfo("template_directory").'/js/admin.js"></script>';
}
add_action('admin_head', 'admin_js');


/*----------------------------------------------------
    アイキャッチ画像を全ページに適応
----------------------------------------------------*/
//add_theme_support( 'post-thumbnails' );


/*----------------------------------------------------
    画像サイズ
----------------------------------------------------*/
//イメージサイズの追加
function add_custom_image_sizes() {
	global $my_custom_image_sizes;
	$my_custom_image_sizes = array(
		'baseImg' => array(
			'name'	   => 'イメージ', // 「メディアを挿入」での名称
			'width'	  => 660,	// 画像の最大幅
			'height'	 => 250,	// 画像の最大高
			'crop'	   => true,  // 切り抜き
			'selectable' => false   // 「メディアを挿入」での選択可否
		),
	);
	foreach ( $my_custom_image_sizes as $slug => $size ) {
		add_image_size( $slug, $size['width'], $size['height'], $size['crop'] );
	}
}
//add_action( 'after_setup_theme', 'add_custom_image_sizes' );

function add_custom_image_size_select( $size_names ) {
	global $my_custom_image_sizes;
	$custom_sizes = get_intermediate_image_sizes();
	foreach ( $custom_sizes as $custom_size ) {
		if ( isset( $my_custom_image_sizes[$custom_size]['selectable'] ) && $my_custom_image_sizes[$custom_size]['selectable'] ) {
			$size_names[$custom_size] = $my_custom_image_sizes[$custom_size]['name'];
		}
	}
	return $size_names;
}
add_filter( 'image_size_names_choose', 'add_custom_image_size_select' );



/*----------------------------------------------------
   バージョンアップ通知を非表示
----------------------------------------------------*/

function update_nag_hide() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}
if (!current_user_can('administrator')) {
	add_action( 'admin_init', 'update_nag_hide' );
}


/*----------------------------------------------------
 * ダッシュボードウィジェットを削除します。
----------------------------------------------------*/
function remove_dashboard_widget() {
//	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
//	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPressニュース
}
add_action('wp_dashboard_setup', 'remove_dashboard_widget' );

/*----------------------------------------------------
   コメントを停止
----------------------------------------------------*/
add_filter( 'comments_open', '__return_false');
/*----------------------------------------------------
   adminbar（管理バー）項目の削除
----------------------------------------------------*/
function remove_bar_menus( $wp_admin_bar ) {
//	$wp_admin_bar->remove_menu('wp-logo'); // W ロゴ
//	$wp_admin_bar->remove_menu('site-name'); // サイト名
//	$wp_admin_bar->remove_menu('view-site'); // サイト名 -> サイトを表示
	$wp_admin_bar->remove_menu('comments'); // コメント
//	$wp_admin_bar->remove_menu('new-content'); // 新規
	$wp_admin_bar->remove_menu('new-post'); // 新規 -> 投稿
	$wp_admin_bar->remove_menu('new-media'); // 新規 -> メディア
	$wp_admin_bar->remove_menu('new-link'); // 新規 -> リンク
	$wp_admin_bar->remove_menu('new-page'); // 新規 -> 固定ページ
//	$wp_admin_bar->remove_menu('new-user'); // 新規 -> ユーザー
//	$wp_admin_bar->remove_menu('updates'); // 更新
//	$wp_admin_bar->remove_menu('my-account'); // マイアカウント
//	$wp_admin_bar->remove_menu('user-info'); // マイアカウント -> プロフィール
//	$wp_admin_bar->remove_menu('edit-profile'); // マイアカウント -> プロフィール編集
//	$wp_admin_bar->remove_menu('logout'); // マイアカウント -> ログアウト
}
add_action('admin_bar_menu', 'remove_bar_menus', 201);



/*----------------------------------------------------
    wysiwygエディタ ツールバーカスタマイズ
----------------------------------------------------*/
function _tinyMCESettings( $init ) {
	//書式プルダウンメニューのカスタマイズ
	$init['block_formats'] = '段落=p;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6';
	//自作クラスをプルダウンメニューで追加
	$style_formats = array (
		array(
			'title' => '見出し',
			'items' => array(
				array( 'title' => '大見出し', 'block' => 'h3', 'classes' => 'hdTypeD' ),
				array( 'title' => '中見出し', 'block' => 'h4', 'classes' => 'hdTypeF' ),
				array( 'title' => '小見出し', 'block' => 'h5', 'classes' => 'hdTypeG' ),
			)
		),
		array(
			'title' => 'テキスト',
			'items' => array(
				array( 'title' => '強調（赤文字）', 'inline' => 'span', 'classes' => 'notesTypeC' ),
			)
		),
		array(
			'title' => 'リンク',
			'items' => array(
				array( 'title' => 'PDF', 'selector' => 'a', 'classes' => 'linkTypeC' ),
				array( 'title' => 'Excel', 'selector' => 'a', 'classes' => 'linkTypeG' ),
				array( 'title' => 'Word', 'selector' => 'a', 'classes' => 'linkTypeE' ),
				array( 'title' => 'メール', 'selector' => 'a', 'classes' => 'linkTypeF' ),
			)
		),
		array(
			'title' => 'リスト',
			'items' => array(
				array( 'title' => '通常リスト01', 'selector' => 'ul', 'classes' => 'listTypeA' ),
				array( 'title' => '矢印リスト01', 'selector' => 'ul', 'classes' => 'secLinkTypeB' ),
			)
		),
		array(
			'title' => '表組み',
			'items' => array(
				array( 'title' => '表組み01（青）', 'selector' => 'table', 'classes' => 'tableTypeA' ),
				array( 'title' => '表組み02（グレー）', 'selector' => 'table', 'classes' => 'tableTypeB' ),
			)
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
//add_filter( 'tiny_mce_before_init', '_tinyMCESettings',1000 );

/*----------------------------------------------------
   コメントアウトのみpタグで囲わない
----------------------------------------------------*/
function remove_p_on_commentout($content){
//コメントアウトのみpタグで囲わない
	return preg_replace('/<p>(\s*)(<\!\-\- .* \-\->)(\s*)<\/p>/iU', '\2', $content);
}
add_filter('the_content', 'remove_p_on_commentout');

/*----------------------------------------------------
   エディター用のCSSの読み込み
----------------------------------------------------*/
add_editor_style( '../../../../css/base.css');//公開用CSSの読み込み
add_editor_style( 'css/cms.css');             //エディタ用のCSS 公開用CSSの打ち消し処理も記載

/*----------------------------------------------------
   エディターの高さ指定
----------------------------------------------------*/
function content_textarea_height() {
	echo'
    <style type="text/css">
            #content_ifr{
            height:auto !important;
            min-height: 100px;
            overflow: scroll
            }
    </style>
    ';
}
//add_action('admin_head', 'content_textarea_height');

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
    オプションページ
----------------------------------------------------*/
/*
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'オプション',
		'menu_title'	=> 'オプション',
		'menu_slug' 	=> 'option-settings',
		'capability'	=> 'edit_posts',
		'icon_url' => 'dashicons-admin-post',
		'redirect'		=> true,
		'update_button' => '更新'

	));
	acf_add_options_sub_page(array(
								'page_title' 	=> 'スライド設定',
								'menu_title'	=> 'スライド設定',
								'menu_slug'	=> 'config_slide',
								'parent_slug'	=> 'option-settings',
								'update_button' => '更新'

							));
	acf_add_options_sub_page(array(
								'page_title' 	=> 'お知らせ設定',
								'menu_title'	=> 'お知らせ設定',
								'menu_slug'	=> 'config_news',
								'parent_slug'	=> 'edit.php?post_type=news',
								'update_button' => '更新'
							));
}
*/
/*----------------------------------------------------
    カスタム分類のリライトルール定義
----------------------------------------------------*/
//add_rewrite_rule('カスタム投稿タイプ名/([^/]+)/?$', 'index.php?タクソノミー名=$matches[1]', 'top');
// 参考：http://doshiroutonike.com/web/wordpress/wp-custom/868/
//add_rewrite_rule('event/([^/0-9]+)/?$', 'index.php?event_type=$matches[1]', 'top');
//add_rewrite_rule('gourmet/([^/0-9]+)/?$', 'index.php?gourmet_type=$matches[1]', 'top');
//add_rewrite_rule('event/([^/]+)/page/([0-9]+)/?$', 'index.php?event_type=$matches[1]&paged=$matches[2]', 'top');


?>
