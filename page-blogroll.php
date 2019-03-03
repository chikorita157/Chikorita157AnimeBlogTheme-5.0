<?php
 
// Template Name: Blog-roll Template
 
add_action('genesis_entry_content', 'add_blogroll');
function add_blogroll() {
$args = array(
'category_before'  => '<li id=%id class=%class style="list-style-type:none;">',
    'category_after'   => '</li>');
 wp_list_bookmarks($args);
}


 genesis(); // <- everything important: make sure to include this. 
 
 ?>