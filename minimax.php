<?php
/*
Plugin Name: Page Layout Builder
Description: Drag and Drop Page Builder / Layout Builder / Content Builder for WordPress
Plugin URI: http://wpeden.com
Author: Shaon
Version: 1.1.1
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
 
 
include("includes/core.php"); 
include("richtext/richtext.php"); 
 
function minimax_opt_menu(){                                                                                             /*Theme Option Menu*/
      add_menu_page( "Page Layout Builder Settings", "Page Layout Builder Settings", 'administrator', 'minimax', 'minimax_options', plugins_url('/page-layout-builder/images/modules_clr.png'));  
    }
    
function minimax_options(){                                                                                                  /*Theme Option Function*/
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
 
 function upload_logo(){
        if(isset($_GET['task'])&&$_GET['task']=='uploadlogo'){
           if(is_uploaded_file($_FILES['Filedata']['tmp_name'])){                                                                       /*File Uploaded function*/
            move_uploaded_file($_FILES['Filedata']['tmp_name'],dirname(__FILE__).'/images/'.$_FILES['Filedata']['name']);
            update_option("thm_logo",$_FILES['Filedata']['name']);
            die("<img src='".get_bloginfo('template_url').'/images/'.get_option('thm_logo')."' />");   
        }
        die();    
        }
        
    }
                       
 function upload_favicon(){
        if(isset($_GET['task'])&&$_GET['task']=='upload_favicon'){
           if(is_uploaded_file($_FILES['Filedata']['tmp_name'])){                                                                       /*File Uploaded function*/
            move_uploaded_file($_FILES['Filedata']['tmp_name'],dirname(__FILE__).'/images/'.$_FILES['Filedata']['name']);
            update_option("thm_favicon",$_FILES['Filedata']['name']);
            die("<img src='".get_bloginfo('template_url').'/images/'.get_option('thm_favicon')."' />");   
        }
        die();    
        }
        
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
 
 
 
 function  custom_init(){
         
 }


 function minimax_add_custom_box() {
    add_meta_box( 'minimax_slider_link', __( 'Link', 'wp' ), 'minimax_slider_link', 'minimax_slider', 'side','core' );
   
}

function minimax_slider_link( $post ) {
    global $pt_plugin;  
    ?>
    <input type="text" size="46" name="minimax_slider_link" value="<?php echo get_post_meta($post->ID,"minimax_slider_link",true);?>">
    <?php   
    
}

function minimax_save_link( $post_id ) {
     
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( !current_user_can( 'edit_post', $post_id ) ) return;
    if(!isset($_POST['minimax_slider_link'])) return;
   
    update_post_meta($post_id,'minimax_slider_link',$_POST['minimax_slider_link']);
}

 
add_action( 'add_meta_boxes', 'minimax_add_custom_box');
add_action( 'save_post', 'minimax_save_link' ); 

 
add_action( 'init', 'upload_logo', 0 );
add_action( 'init', 'upload_favicon', 0 ); 
add_action( 'init', 'custom_init' ); 
 
add_action('admin_menu', 'minimax_opt_menu');
add_action('template_redirect', 'minimax_squeeze_page_canvas');
add_action('wp_ajax_module_status_change', 'minimax__module_status_change');



