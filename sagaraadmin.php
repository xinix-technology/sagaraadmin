<?php
/*
Plugin Name: Sagara Theme
Plugin URI: http://sagara.id/sagaraadmin
Description: Custom made Sagara's Wordpress Admin Theme.
Author: Sagara
Version: 1.0
Author URI: http://sagara.id
*/

function sagara_theme_style() {
    wp_enqueue_style('sagara-theme', plugins_url('wp-admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'sagara_theme_style');
add_action('login_enqueue_scripts', 'sagara_theme_style');

add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = 'Theme by <a href="http://sagara.id">Sagara</a> &copy; ' . date("Y");
    return $text;
}

add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = 'v 1.0';
    return $text;
}
?>