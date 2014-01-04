<?php
/*
Plugin Name: Page Layout Builder
Description: Drag and Drop Page Builder / Layout Builder / Content Builder for WordPress
Plugin URI: http://wpeden.com
Author: Shaon
Version: 1.3.6
Author URI: http://wpeden.com
*/
 

define("MX_THEME_DIR",dirname(__FILE__));
define("MX_PLUG_DIR",dirname(__FILE__));
define("MX_CACHE_DIR",dirname(__FILE__).'/cache/');
define("MX_THEME_URL",plugins_url('/page-layout-builder/'));
if(!defined('MX_THEME'))
define('MX_THEME','minimax_root');

global $minimax_layout_holder;

$minimax_layout_holder = array(
            'header'=>'Header Layout',             
            'footer'=>'Footer Layout'
);
 
  
include(MX_PLUG_DIR."/includes/core.php"); 
include(MX_PLUG_DIR."/modules/richtext/richtext.php"); 
include(MX_PLUG_DIR."/modules/image/image.php"); 
     
function minimax_opt_menu(){                                                                                              
      add_menu_page( "Page Layout Builder Settings", "Builder Settings", 'administrator', 'minimax', 'minimax_options', plugins_url('/page-layout-builder/images/modules_clr.png'));  
    }
    
function minimax_options(){                                                                                                   
        global $minimax_options;
        require_once("includes/theme-options.php");
        
}
    
 
function minimax_squeeze_page_canvas(){  
         if(get_post_meta(get_the_ID(),'squeeze_page',true)==1):
         $template = get_post_meta(get_the_ID(),'sptemplate',true);
         include("canvas/{$template}/index.php");
         die();
         endif;
    }   
 
 
    
 function minimax__module_status_change(){
     if(isset($_POST['module'])&&$_POST['module']){
         $modules = get_option("minimax_allowed_modules");
         if($_POST['status']=="power_off"){
            $modules[$_POST['module']] = $_POST['module'];
            $stats_return = "power_on";
         }else{
            unset($modules[$_POST['module']]);
            $stats_return = "power_off";
         }
            //then update the settings
         update_option("minimax_allowed_modules",$modules);
         die($stats_return);
     }
 }   
 
 
 
 
 
add_action('admin_menu', 'minimax_opt_menu');
add_action('template_redirect', 'minimax_squeeze_page_canvas');
add_action('wp_ajax_module_status_change', 'minimax__module_status_change');
  

