<?php
/*
Plugin Name: LC Branding
Plugin URI: http://www.limecavas.com/wordpress-plugins/
Description: Lime Canvas Branding demo for WorcCamp Brisbane 2015
Version: 1.0.0
Author: Wil Brown
Author URI: http://www.limecanvas.com/author/wil
Author Email: hello@limecanvas.com
License:

  Copyright 2015 Lime Canvas Ltd. (hello@limecanvas.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    echo '<p>Activate this plugin from the dashboard.</p>';
   die;
}

/**
 * Define a version
 */
if(!defined('LCBRAND_VERSION'))
    define('LCBRAND_VERSION', '1.0.0');

/**
 * The plugin directory
 */
if (!defined('LCBRAND_PLUGIN_DIR')) {
    define('LCBRAND_PLUGIN_DIR', WP_PLUGIN_DIR . '/lc-branding/');
}

/**
 * The plugin URL
 */
if (!defined('LCBRAND_PLUGIN_URL')) {
    define('LCBRAND_PLUGIN_URL', WP_PLUGIN_URL . '/lc-branding/');
}

/**
 * The plugin slug
 */
if (!defined('LCBRAND_PLUGIN_NAME')) {
    define('LCBRAND_PLUGIN_NAME', 'lc-branding/' . basename(__FILE__));
}

/**
 * ============================================================================================================
 * ================================================== DEMO 1 ==================================================
 * ============================================================================================================
 */

/**
 * Stop helpful info being displayed on login screen
 *
 * @return string
 * @since 1.0.0
 */
function lcbrand_login_errors(){
    return( 'Login failed. Check your credentials.' );
}
//add_filter( 'login_errors', 'lcbrand_login_errors' );


/**
 * ============================================================================================================
 * ================================================== DEMO 2 ==================================================
 * ============================================================================================================
 */

/**
 *
 * Add Lime Canvas custom login logo
 *
 * @since   1.0
 */
function lcbrand_login_logo() {
    $logo_url = LCBRAND_PLUGIN_URL . 'img/lime-canvas-login-logo.png';
    echo "
	<style>
	body.login #login h1 a {
		background: url('" . $logo_url . "') no-repeat scroll center top transparent !important;
		height: 143px;
		width: 100%;
	}
	</style>
	";
}
//add_action( 'login_head', 'lcbrand_login_logo' );

/**
 * ============================================================================================================
 * ================================================== DEMO 3 ==================================================
 * ============================================================================================================
 */

/**
 * Add custom dashboard footer text
 *
 * @since 1.0.0
 */
function lcbrand_footer_admin () {
            echo 'Powered by <a href="http://www.limecanvas.com/services/web-design" target="_blank" title="Tots Amazeballs WordPress Experts" >Lime Canvas Awesomeness</a> using WordPress.';
}
add_filter( 'admin_footer_text', 'lcbrand_footer_admin' );

/**
 * ============================================================================================================
 * ================================================== DEMO 4 ==================================================
 * ============================================================================================================
 */

function lcbrand_admin_dashboard_customise() {
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );                // Quick Draft
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );                    // WordPress News
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );                 // Activity
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );                // At A Glance

    /**
     * To remove dashboard widgets created by other plugins, search that plugin folder for "wp_add_dashboard_widget"
     * The meta box ID will be the first parameter.
     */
    remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );                 // Gravity Forms
    remove_meta_box( 'wordfence_activity_report_widget', 'dashboard', 'normal' );   // WordFence
}
add_action('wp_dashboard_setup', 'lcbrand_admin_dashboard_customise' );

/**
 * ============================================================================================================
 * ================================================== DEMO 5 ==================================================
 * ============================================================================================================
 */

/**
 * Removes WordPress Logo from Admin Bar
 *
 * @since 1.0.0
 *
 */
function lcbrand_remove_wp_logo() {
    global $wp_admin_bar;

    /* Remove their stuff */
    $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'lcbrand_remove_wp_logo', 11 );


/**
 * ============================================================================================================
 * ================================================== DEMO 6 ==================================================
 * ============================================================================================================
 */

/**
 * Supporting function to get RSS feed and echo out widget HTML
 *
 * @since 1.0.0
 */
function lcbrand_dashboard_lc_rssfeed_output() {
    echo '<div class="rss-widget limecanvas">';
    wp_widget_rss_output(array(
        'url' => 'http://feeds.feedburner.com/LimeCanvas',
        'title' => 'Latest news from Lime Canvas',
        'items' => 3,
        'show_summary' => 1,
        'show_author' => 0,
        'show_date' => 1
    ));
    echo "</div>";
}

/**
 * Add Lime Canvas RSS news feed dashboard widget
 *
 * @since 1.0.0
 */
function lcbrand_dasboard_add_news_feed_widget(){
    wp_add_dashboard_widget('dashboard_lcsup_feed', 'News from Lime Canvas', 'lcbrand_dashboard_lc_rssfeed_output');
}
add_action('wp_dashboard_setup', 'lcbrand_dasboard_add_news_feed_widget' );



