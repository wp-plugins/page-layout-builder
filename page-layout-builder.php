<?php
/*
Plugin Name: MiniMax - Page Layout Builder
Description: MiniMax - Drag and Drop Page Builder / Layout Builder / Content Builder for WordPress
Plugin URI: http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/
Author: Shaon
Version: 1.5.4
Author URI: http://wpeden.com
*/


define("MX_THEME_DIR", dirname(__FILE__));
define("MX_PLUG_DIR", dirname(__FILE__));
define("MX_CACHE_DIR", dirname(__FILE__) . '/cache/');
define("MX_THEME_URL", plugins_url('/page-layout-builder/'));
if (!defined('MX_THEME'))
    define('MX_THEME', 'minimax_root');

global $minimax_layout_holder;

$minimax_layout_holder = array(
    'header' => 'Header Layout',
    'footer' => 'Footer Layout'
);


include(MX_PLUG_DIR . "/includes/core.php");
include(MX_PLUG_DIR . "/modules/richtext/richtext.php");
include(MX_PLUG_DIR . "/modules/image/image.php");
include(MX_PLUG_DIR . "/modules/csstabs/csstabs.php");

function minimax_opt_menu()
{
    add_menu_page("MiniMax - Page Layout Builder Settings", "MiniMax", 'administrator', 'minimax', 'minimax_options', plugins_url('/page-layout-builder/images/modules.png'));
}

function minimax_options()
{
    global $minimax_options;
    require_once("includes/theme-options.php");

}


function minimax_squeeze_page_canvas()
{
    if (get_post_meta(get_the_ID(), 'squeeze_page', true) == 1):
        $template = get_post_meta(get_the_ID(), 'sptemplate', true);
        include("canvas/{$template}/index.php");
        die();
    endif;
}


function minimax__module_status_change()
{
    if (isset($_POST['module']) && $_POST['module']) {
        $modules = get_option("minimax_allowed_modules");
        if ($_POST['status'] == "power_off") {
            $modules[$_POST['module']] = $_POST['module'];
            $stats_return = "power_on";
        } else {
            unset($modules[$_POST['module']]);
            $stats_return = "power_off";
        }
        //then update the settings
        update_option("minimax_allowed_modules", $modules);
        die($stats_return);
    }
}

function minimax_init() {

    register_post_type("minimax_tabs", array(
            'labels' => array(
                'name' => __('Tabs'),
                'singular_name' => __('Tabs'),
                'add_new' => __('Add Tab'),
                'add_new_item' => __('Add New Tab'),
                'edit_item' => __('Edit Tab'),
                'new_item' => __('New Tab'),
                'view_item' => __('View Tab'),
                'search_items' => __('Search Tab'),
                'not_found' => __('No Tab found'),
                'not_found_in_trash' => __('No Tab found in Trash'),
                'parent_item_colon' => ''
            ),
            'public' => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'minimax-tabs', 'with_front' => true),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => plugins_url() . '/page-layout-builder/images/tab.png',
            'supports' => array('title', 'editor')
            //'taxonomies' => array('ptype')
        )
    );
    register_post_type("minimax_accordion", array(
            'labels' => array(
                'name' => __('Accordion'),
                'singular_name' => __('Accordion'),
                'add_new' => __('Add Accordion'),
                'add_new_item' => __('Add New Accordion'),
                'edit_item' => __('Edit Accordion'),
                'new_item' => __('New Accordion'),
                'view_item' => __('View Accordion'),
                'search_items' => __('Search Accordion'),
                'not_found' => __('No Accordion found'),
                'not_found_in_trash' => __('No Accordion found in Trash'),
                'parent_item_colon' => ''
            ),
            'public' => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'minimax-accordion', 'with_front' => true),
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => plugins_url() . '/page-layout-builder/images/accordion.png',
            'supports' => array('title', 'editor')
            //'taxonomies' => array('ptype')
        )
    );

}


add_action('admin_menu', 'minimax_opt_menu');
add_action('template_redirect', 'minimax_squeeze_page_canvas');
add_action('wp_ajax_module_status_change', 'minimax__module_status_change');
add_action('init', 'minimax_init');


