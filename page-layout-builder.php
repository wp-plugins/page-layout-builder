<?php
/*
Plugin Name: MiniMax - Page Layout Builder
Description: MiniMax - Drag and Drop Page Builder / Layout Builder / Content Builder for WordPress
Plugin URI: http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/
Author: Shaon
Version: 1.8.6
Author URI: http://wpeden.com
*/

define("MX_THEME_DIR", dirname(__FILE__));
define("MX_PLUG_DIR", dirname(__FILE__));
define("MX_CACHE_DIR", dirname(__FILE__) . '/cache/');
define("MX_THEME_URL", get_stylesheet_directory_uri());

if (!defined('MX_THEME'))
    define('MX_THEME', 'minimax_root');

global $minimax_layout_holder;

$minimax_layout_holder = array(
    'header' => 'Header Layout',
    'footer' => 'Footer Layout'
);

if (!isset($content_width))
    $content_width = 960;

include("includes/core.php");

/* Theme Option Menu */

function minimax_opt_menu() {
    $iconurl = plugins_url() . '/page-layout-builder/images/menuicon.png';
    add_menu_page("MiniMax", "MiniMax", 'administrator', 'minimax', 'minimax_options', $iconurl);
}

/* Theme Option Function */

function minimax_options() { 
    global $minimax_options;
    require_once("includes/theme-options.php");
}

function minimax_squeeze_page_canvas() {
    if (get_post_meta(get_the_ID(), 'squeeze_page', true) == 1):
        $template = get_post_meta(get_the_ID(), 'sptemplate', true);
        include("canvas/{$template}/index.php");
        die();
    endif;
}
 

function minimax_module_status_change() {
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

function custom_init() {

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

function minimax_add_custom_box() {
    add_meta_box('minimax_slider_link', __('Slider Link', 'wp'), 'minimax_slider_link', 'minimax_slider', 'side', 'core');
}

function minimax_slider_link($post) {
    global $pt_plugin;
    ?>
<input type="text" width="100%" name="minimax_slider_link" value="<?php echo get_post_meta($post->ID, "minimax_slider_link", true); ?>">
    <?php
}

function minimax_save_link($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!current_user_can('edit_post', $post_id))
        return;
    if (!isset($_POST['minimax_slider_link']))
        return;

    update_post_meta($post_id, 'minimax_slider_link', $_POST['minimax_slider_link']);
}

function minimax_module_update_checker() {

    $module = $_POST['module'];
    $modinfo = get_plugin_data(dirname(__FILE__) . '/modules/' . $module . '/' . $module . '.php');
    $version = $modinfo['Version'];
    $data = array('task' => 'updatecheck', 'module' => $module, 'version' => $version);
    $res = wp_remote_post("http://localhost/minimax-server/index.php", array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => $data,
        'cookies' => array()
    ));
    if ($res['body'] == 0)
        $data = 0;
    else
        $data = array("version" => $res['body'], "module" => $_POST['module'] . ".v." . $res['body']);
    echo json_encode($data);
    die();
}

function minimax_update_module() {

    wp_filesystem();
    global $wp_filesystem;
    $module = $_POST['module'] . '.zip';
    $dirname = explode(".v.", $_POST['module']);
    $dirname = $dirname[0];
    $res = wp_remote_post("http://localhost/minimax-server/index.php", array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array('task' => 'updatenow', 'module' => $module),
        'cookies' => array()
    ));

    $tmpfile = str_replace("\\", "/", dirname(__FILE__)) . '/cache/' . $module;
    file_put_contents($tmpfile, wp_remote_retrieve_body($res));
    rename(dirname(__FILE__) . '/modules/' . $dirname, dirname(__FILE__) . '/archive/' . $dirname . "_old");
    $ret = unzip_file($tmpfile, dirname(__FILE__) . '/modules');

    die();
}

add_action('add_meta_boxes', 'minimax_add_custom_box');
add_action('save_post', 'minimax_save_link');
 
add_action('init', 'custom_init');

add_action('admin_menu', 'minimax_opt_menu');
add_action('template_redirect', 'minimax_squeeze_page_canvas');
add_action('wp_ajax_module_status_change', 'minimax_module_status_change');
add_action('wp_ajax_check_module_update', 'minimax_module_update_checker');
add_action('wp_ajax_update_module', 'minimax_update_module');
