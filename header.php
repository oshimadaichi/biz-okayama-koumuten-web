<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package
 */
?><!DOCTYPE html>
<html lang="ja">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53951598-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-53951598-1');
</script>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="6lDkTmw-o1n-68cobmJLzPI2-x3zRYlHYGlarqWzEEw">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="岡山県内で家づくりを検討中の方におすすめしたい地元の工務店をご紹介。憧れの暮らしが叶うマイホーム、妥協も後悔もしたくない“一生に一度の大きな買い物”だからこそパートナー選びが大切です。理想の住まいを叶えてくれるベストパートナーを探しましょう。">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:title" content="【岡山工務店WEB】岡山・倉敷の工務店で家を建てよう">
    <meta property="og:site_name" content="【岡山工務店WEB】岡山・倉敷の工務店で家を建てよう">
    <meta property="og:url" content="https://www.ok-expo.jp">
    <meta property="og:image" content="https://www.ok-expo.jp/wp/wp-content/themes/ok-web/assets/ogp/ogp.jpg">
    <meta property="og:description" content="岡山県内で家づくりを検討中の方におすすめしたい地元の工務店をご紹介。憧れの暮らしが叶うマイホーム、妥協も後悔もしたくない“一生に一度の大きな買い物”だからこそパートナー選びが大切です。理想の住まいを叶えてくれるベストパートナーを探しましょう。">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php theTitle(); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php the_css_dir(); ?>/_gutenberg.css">
    <link rel="stylesheet" type="text/css" href="<?php the_css_dir(); ?>/common.css">
<?php if ( is_home() || is_front_page() || is_post_type_archive('event')): ?>
    <link rel="stylesheet" type="text/css" href="<?php the_css_dir(); ?>iemiru.css?20220528">
<?php endif; ?>
<?php if ( is_singular('event')): ?>
  <link rel="stylesheet" type="text/css" href="<?php the_css_dir(); ?>event.css?20220528">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php the_body_id(); body_class(); ?>>
<div id="wrapper">

<?php get_template_part('parts/header'); ?>

