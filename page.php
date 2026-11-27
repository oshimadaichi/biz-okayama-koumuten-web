<?php get_header();?>

<?php get_template_part_layout('content');?>


<?php
$page = get_post( get_the_ID() );
$slug = $page->post_name;
$parent = ($post->post_parent) ? implode("_",get_recursive_parent_name($post->post_parent))."_" : "";

?>
<?php get_template_part_layout($parent.$slug);?>
<?php get_footer();?>