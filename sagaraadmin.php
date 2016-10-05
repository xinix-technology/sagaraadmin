<?php
/*
Plugin Name: Sagara Theme
Plugin URI: http://sagara.id/sagaraadmin
Description: Custom made Sagara's Wordpress Admin Theme.
Author: Sagara
Version: 1.0
Author URI: http://sagara.id
*/

/* Replace CSS */
function sagara_theme_style() {
    wp_enqueue_style('sagara-theme', plugins_url('sagaraadmin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'sagara_theme_style');
add_action('login_enqueue_scripts', 'sagara_theme_style');

/* Replace Editor CSS */
add_filter('mce_css', 'sagara_editor_theme_style');
function sagara_editor_theme_style($url) {
    if ( !empty($url) ) $url .= ',';

    // Retrieves the plugin directory URL and adds editor stylesheet
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/sagaraadmin-editor.css';

    return $url;
}

/* Remove WP Link in toolbar */
function remove_wp_menu( $wp_admin_bar ) {
	$wp_admin_bar->remove_node('wp-logo-default');
	$wp_admin_bar->remove_node('wp-logo-external');
}
add_action('admin_bar_menu', 'remove_wp_menu', 999);

// Add Toolbar Menus
function add_sagara_toolbar() {
	global $wp_admin_bar;

	$args = array(
		'id'     => 'about-menu',
		'parent' => 'wp-logo',
		'title'  => __( 'About Sagara', 'text_domain' ),
		'href'   => 'http://sagara.id',
		'meta'   => array(
			'class'    => 'about',
			'target'   => 'BLANK'
		),
	);
	$wp_admin_bar->add_menu( $args );

	$args = array(
		'id'     => 'dashboard-menu',
		'parent' => 'wp-logo',
		'title'  => __( 'Contact Sagara', 'text_domain' ),
		'href'   => 'http://sagara.id/p/contact-us',
		'meta'   => array(
			'class'    => 'contact',
			'target'   => 'BLANK'
		),
	);
	$wp_admin_bar->add_menu( $args );
}
add_action('wp_before_admin_bar_render', 'add_sagara_toolbar', 0);

// Register User Contact Methods
function sagara_contacts( $user_contact_method ) {
	$user_contact_method['address'] = __( 'Address', 'text_domain' );
	$user_contact_method['city'] = __( 'City', 'text_domain' );
	$user_contact_method['country'] = __( 'Country', 'text_domain' );
	$user_contact_method['tel'] = __( 'Tel', 'text_domain' );
	$user_contact_method['fax'] = __( 'Fax', 'text_domain' );

	$user_contact_method['facebook'] = __( 'Facebook Username', 'text_domain' );
	$user_contact_method['twitter'] = __( 'Twitter Username', 'text_domain' );
	$user_contact_method['gplus'] = __( 'Google Plus', 'text_domain' );
	$user_contact_method['skype'] = __( 'Skype Username', 'text_domain' );

	return $user_contact_method;
}
add_filter('user_contactmethods', 'sagara_contacts');

/* Replace the left footer */
add_filter('admin_footer_text', 'left_admin_footer_text_output');
function left_admin_footer_text_output($text) {
    $text = 'Theme by <a href="http://sagara.id" target="BLANK">Sagara</a> &copy; ' . date("Y");
    return $text;
}
/* Replace the right footer */
add_filter('update_footer', 'right_admin_footer_text_output', 11);
function right_admin_footer_text_output($text) {
    $text = 'v 1.0';
    return $text;
}
?>