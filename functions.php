<?php
/**
 * functions and definitions
 *
 * @package
 */
if( isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR']) ) {
	$_SERVER['HTTPS'] = 'on';
	$_ENV['HTTPS'] = 'on';
}
if( class_exists('sde') && class_exists('acf') ) {

	global $sde;

	//テンプレート読み込み時 レスポンシブモード
	$sde->responsive = true;

	/*
	 * ディレクトリ 隠し
	 * .htaccess設定の上利用すること
	 * sample
	 * RewriteRule !^files/ - [S=1]
	 * RewriteRule ^files\/(.*)$ /wp/wp-content/uploads/$1 [L]
	 * RewriteRule !^asset/ - [S=1]
	 * RewriteRule ^(.*)$ /wp/wp-content/themes/jinja/_$1 [L]
	 */
	$sde->hidden = false;

	//WPデフォルト機能削除
	$sde->delete = true;

	//プラグイン更新停止
	$sde->update_plugins = true;

	//OGPの利用
	$sde->ogp = false;
}
include('inc/func.php');
include('inc/init.php');
include('inc/output.php');






