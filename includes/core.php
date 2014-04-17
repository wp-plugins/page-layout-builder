<?php

global $mxwidgets, $minimax_layout_data, $minimax_modules, $wp_widget_factory, $minimax_modules_settings, $minimax_options, $minimax_layout_settings;
define("base_theme_url",plugins_url('page-layout-builder'));
error_reporting(0);
ini_set('display_errors',0);
include("template-tags.php");
include("metabox.php");

//Load minimax active theme option data
function minimax_load_theme_option_data(){
    global $minimax_layout_data, $minimax_modules, $minimax_modules_settings, $minimax_options;
    $minimax_options = get_option("wpeden_admin");
    $minimax_layout_data = get_option('minimax_layout',array());    
    $minimax_layout_settings = get_option('minimax_layout_settings',array());        
    $minimax_modules = get_option('minimax_modules',array());        
    $minimax_modules_settings = get_option('minimax_modules_settings',array());        
    if(isset($_GET['post'])&&$_GET['post']!=''){           
    $minimax_layout_settings = get_post_meta($_GET['post'],'minimax_layout_settings',true);                     
    $minimax_layout_data = get_post_meta($_GET['post'],'minimax_layout',true);     
    $minimax_modules = get_post_meta($_GET['post'],'minimax_modules',true);        
    $minimax_modules_settings = get_post_meta($_GET['post'],'minimax_modules_settings',true);        
    }
}
 
//Load active wp widgets
function minimax_wp_widgets(){
    global $mxwidgets, $wp_widget_factory;    
    $mxwidgets = $wp_widget_factory->widgets;
}

//Layout holder (site)
function minimax_layout_holder($name){
    global $minimax_layout_holder, $minimax_layout_data, $minimax_modules;     
    if(is_array($minimax_layout_data[$name])){
    foreach($minimax_layout_data[$name] as $id=>$layout):
    minimax_render_layout($layout, $id, $name);
    endforeach;
    }
    
}

//Page layout renderer (site)
function minimax_page_layout($content){    
    $pid = get_the_ID();        
    //if(get_post_type($pid)!='page') return $content;
    if(file_exists(MX_CACHE_DIR.$pid) && get_option('minimax_cahce_status',0)==1 && get_option('minimax_frontend_editing',0)==0) return $content.file_get_contents(MX_CACHE_DIR.$pid);
    ob_start();   
    $minimax_layout_data = get_post_meta($pid,'minimax_layout',true);     
    $minimax_modules = get_post_meta($pid,'minimax_modules',true);        
    $minimax_modules_settings = get_post_meta($pid,'minimax_modules_settings',true);  
    if(is_array($minimax_layout_data[get_post_type()])):

    echo "<div class='w3eden' id='layout_".get_post_type()."'>";
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1)
        echo "<ul class='layout-data mxrows'>";
    foreach($minimax_layout_data[get_post_type()] as $id=>$layout):
    minimax_render_layout($layout, $id, get_post_type());
    endforeach;
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1)
    echo "</ul>";
    echo "</div>";
    endif;
    $data = ob_get_clean();
    if(get_option('minimax_cahce_status',0)==1 && get_option('minimax_frontend_editing',0)==0)
    file_put_contents(MX_CACHE_DIR.$pid, $data);

    $dialog = "";
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single()))
    $dialog = '<div id="dialog" title="Basic dialog">Dialog</div><input type="hidden" name="frontend_minimax" value="1" class="mx-input" />
    <input type="hidden" name="post_id" value="'.$pid.'" class="mx-input" />
    <div id="mx-toolbar" class="w3eden">
    <div class="panel panel-default">
    <div class="panel-heading">Insert Row <a class="pull-right btn btn-xs btn-danger" title="Disable Front-end Editing"  href="'.home_url('/?mxfrontend=0').'"><i class="fa fa-times"></i></a></div>
    <div class="panel-body">
    <a href="#" rel="col-1" holder="#layout_'.get_post_type().'" class="insert-layout  btn btn-sm btn-default btn-block">1 Col Row <i class="fa fa-plus-circle"></i></a>
    <a href="#" rel="col-2" holder="#layout_'.get_post_type().'" class="insert-layout  btn btn-sm btn-default btn-block ">2 Cols Row <i class="fa fa-plus-circle"></i></a>
    <a href="#" rel="col-3" holder="#layout_'.get_post_type().'" class="insert-layout  btn btn-sm btn-default btn-block ">3 Cols Row <i class="fa fa-plus-circle"></i></a>
    <a href="#" rel="col-4" holder="#layout_'.get_post_type().'" class="insert-layout  btn btn-sm btn-default btn-block ">4 Cols Row <i class="fa fa-plus-circle"></i></a>
    <a href="#" rel="col-5" holder="#layout_'.get_post_type().'" class="insert-layout  btn btn-sm btn-default btn-block ">5 Cols Row <i class="fa fa-plus-circle"></i></a>
    <a href="#" rel="col-6" holder="#layout_'.get_post_type().'" class="insert-layout  btn btn-sm btn-default btn-block ">6 Cols Row <i class="fa fa-plus-circle"></i></a>
    </div>
    <div class="panel-footer">
    <button class="btn btn-primary btn-block" id="scng"><i class="fa fa-save"></i> Save Changes</button>
    </div></div></div>';
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==0 && (is_page()||is_single()))
    $dialog = '<div id="mx-toolbar" style="position:fixed;left:10px;top:80px;" class="w3eden"><a title="Enable Front-end Editing" style="height: 50px;border-radius: 3px !important;" class="btn btn-lg btn-primary ttip" href="'.home_url('/?mxfrontend=1').'"><i class="fa fa-pencil"></i></a></div>';

    return $content.$data.$dialog;
}

function minimax_enable_frontend(){
    if(current_user_can('manage_options') && isset($_GET['mxfrontend'])){
        update_option('minimax_frontend_editing',$_GET['mxfrontend']);
        wp_redirect($_SERVER['HTTP_REFERER']);
        die();
    }
}
add_action("init", "minimax_enable_frontend");

//Select Layout (admin)
function minimax_select_layout(){
    if(!isset($_GET['task'])||$_GET['task']!='select_layout') return;
    include("layout-selector.php");
    die();
}

//Insert Layout (admin)
function minimax_insert_layout(){
    $id = uniqid();              
    $holder = $_REQUEST['holder'];
    echo '<li id="row_li_'.$id.'"><input id="row_settings_'.$id.'" type="hidden" name="layout_settings['.$holder.']['.$_GET['layout'].']['.$id.']" value="" /><div class="row-handler"><div class="sort"></div><div rel="row_li_'.$id.'" class="rdel delete"></div><div class="rsettings" rel="row_settings_'.$id.'"></div></div><div class="row-container"><div class="container_12 clearfix wrapper row" id="row_'.$id.'"><input type="hidden" name="layouts['.$holder.']['.$id.']" value="'.(isset($_REQUEST['layout'])?$_REQUEST['layout']:'').'" />';
    //include(MX_THEME_DIR."/frames/{$_REQUEST['layout']}.frame.php");
    $cols = (int)str_replace("col-","", $_GET['layout']);
    include(MX_THEME_DIR."/frames/dynamic.frame.php");
    echo "</div></div><div class='clear'></div></li>";
    die(); 
}

//Insert Layout (front)
function minimax_insert_layout_front(){
    $id = uniqid();
    $holder = $_REQUEST['holder'];
    $layout = $_REQUEST['layout'];
    $rid = isset($ls['css_id'])?$ls['css_id']:"row_{$id}";
    $init = 1;
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1){
        echo '<li id="row_li_'.$id.'"><input class="mx-input" id="row_settings_'.$id.'" type="hidden" name="layout_settings['.$holder.']['.$layout.']['.$id.']" value="" /><div class="row-handler"><div class="sort"></div><div rel="row_li_'.$id.'" class="rdel delete"></div><div  rel="row_settings_'.$id.'" class="rsettings"></div></div><div class="row-container"><input  class="mx-input" type="hidden" name="layouts['.$holder.']['.$id.']" value="'.$layout.'" />';
    echo '<div class="minimax_content_area borderfocus minimax-row '.$ls['css_class'].' '.$ls['css_class_pd'].'" id="'.$rid.'" style="'.$ls['css_txt'].'" >';

        $cols = (int)str_replace("col-","", $_GET['layout']);
        include(MX_THEME_DIR."/layouts/bootstrap/dynamic.layout.php");

    echo "<div style='clear: both;'></div></div>";

        echo "</div><div class='clear'></div></li>";
    }
    die();
}

//Generate custom layout (admin)
/*
function minimax_generate_custom_layout(){

    extract($_POST['layoutopt']);

    $id = uniqid();
    $admin_html = $front_html = "";
    $phpid = '<?php echo $id; ?>';
    for($i=1;$i<=$cols;$i++){
        $grd = $colgrid[$i-1];
        $phpcallback = '<?php minimax_render_module_frames("column_'.$i.'_{$id}"); ?>';
        $admin_html .=<<<CLY
                <div class="grid_{$grd}">
    <div class="column" id="column_{$i}_{$phpid}">
    <ul class="module">
             {$phpcallback}
            </ul>
            <a class="btnAddMoudule" rel="column_{$i}_{$phpid}" href="#">Add Module</a>
    </div>
    </div>
CLY;
        $phpfcb = '<?php minimax_render_modules("column_'.$i.'_{$id}"); ?>';
        $front_html .=<<<CLY
            <div class="minimax_grid_{$grd}">
    <div class="minimax_column" id="column_{$i}_{$phpid}">

    {$phpfcb}

    </div>

    </div>
CLY;

    }

    file_put_contents(MX_THEME_DIR.'/frames/'.$id.'.frame.php',$admin_html);
    file_put_contents(MX_THEME_DIR.'/layouts/'.$id.'.layout.php',$front_html);
    echo $id;
    die();

}
*/


//Layout Settings (admin)
function minimax_layout_settings(){
    $ls  = unserialize(base64_decode($_REQUEST['layout_settings_data']));
    include("layout-settings.php"); 
    die();
}

//Format Layout Settings Data (admin)
function minimax_layout_settings_data(){
    echo base64_encode(serialize($_POST['ls']));
    die();
}

//Render saved layout frames (admin)
function minimax_render_layout_frames($holder){     
    global $minimax_layout_data, $minimax_layout_settings;          
    $gs = get_post_meta($_GET['post'],'minimax_grid_settings',true);
    $gs = $gs[$holder."_rows"];  
    if(is_array($minimax_layout_data)&&isset($minimax_layout_data[$holder])&&is_array($minimax_layout_data[$holder])):    
    foreach($minimax_layout_data[$holder] as $id=>$layout):
    echo '<li id="row_li_'.$id.'"><input id="row_settings_'.$id.'" type="hidden" name="layout_settings['.$holder.']['.$layout.']['.$id.']" value="'.$minimax_layout_settings[$holder][$layout][$id].'" /><div class="row-handler"><div class="sort"></div><div rel="row_li_'.$id.'" class="rdel delete"></div><div  rel="row_settings_'.$id.'" class="rsettings"></div></div><div class="row-container"><div class="container_12 clearfix wrapper row" id="row_'.$id.'"><input type="hidden" name="layouts['.$holder.']['.$id.']" value="'.$layout.'" />';    
    if(!isset($gs[$id]))
    include(MX_THEME_DIR."/frames/{$layout}.frame.php");
    else  {
        $cols = count($gs[$id]);
        include(MX_THEME_DIR."/frames/dynamic.frame.php");

    }
    echo "</div></div><div class='clear'></div></li>";    
    endforeach;
    endif;
} 

//Render layout (site)
function minimax_render_layout($layout, $id, $holder = '') {
    $minimax_options = get_option("wpeden_admin");
    $gs = get_post_meta(get_the_ID(),'minimax_grid_settings',true);
    //print_r($gs);
    $gs = $gs[$holder."_rows"];  


    $container_css = "row" ;
    $layout_folder = "bootstrap";

    global $minimax_layout_data, $minimax_layout_settings;  
    if(!$minimax_layout_settings) $minimax_layout_settings = get_option('minimax_layout_settings',array());    
    if(in_array($holder, get_post_types())){
    $minimax_page_layout_settings = get_post_meta(get_the_ID(),'minimax_layout_settings',true);
    $ls  = unserialize(base64_decode($minimax_page_layout_settings[$holder][$layout][$id]));

    } else {
    $ls  = unserialize(base64_decode($minimax_layout_settings[$holder][$layout][$id]));

    }

    if(count($minimax_layout_settings)==0 || !is_array($minimax_layout_settings)) $mls = "";
    else $mls =  $minimax_layout_settings[$holder][$layout][$id];
    $rid = $ls['css_id']?$ls['css_id']:"row_{$id}";

    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single()))
    echo '<li id="row_li_'.$id.'"><input class="mx-input" id="row_settings_'.$id.'" type="hidden" name="layout_settings['.$holder.']['.$layout.']['.$id.']" value="'.$mls.'" /><div class="row-handler"><div class="sort"></div><div rel="row_li_'.$id.'" class="rdel delete"></div><div  rel="row_settings_'.$id.'" class="rsettings"></div></div><div class="row-container"><input  class="mx-input" type="hidden" name="layouts['.$holder.']['.$id.']" value="'.$layout.'" />';
    echo '<div class="minimax_content_area minimax-row '.$ls['css_class'].' '.$ls['css_class_pd'].'" id="'.$rid.'" style="'.$ls['css_txt'].'" >';

    if(!isset($gs[$id]))
    include(MX_THEME_DIR."/layouts/{$layout_folder}/{$layout}.layout.php");
    else  {
        $cols = count($gs[$id]);
        include(MX_THEME_DIR."/layouts/{$layout_folder}/dynamic.layout.php"); 
    }
    echo "<div style='clear: both;'></div></div>";
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single()))
    echo "</div><div class='clear'></div></li>";


}


//Render Module Frames (admin)
function minimax_render_module_frames($id){
    global $mxwidgets, $minimax_modules, $minimax_modules_settings;
    $base_theme_url = base_theme_url;
    $minimax_modules_settings = get_option('minimax_modules_settings',array());    
    if(!is_array($minimax_modules_settings)) $minimax_modules_settings = array();
    $post_modules_settings = get_post_meta($_GET['post'],'minimax_modules_settings',true);
    if(!is_array($post_modules_settings)) $post_modules_settings = array();
    $minimax_modules_settings += $post_modules_settings;
    //echo "<div class='modules' id='$id' >";
    $module_frames = '';
    if(isset($minimax_modules[$id])&&is_array($minimax_modules[$id])):
    $z = 0;
    foreach($minimax_modules[$id] as $mid=>$module):
    $mod = $mxwidgets[$module];    
    $z++;
    $ms = $z-1;

    //generate module preview

        $instance = @unserialize(base64_decode($minimax_modules_settings[$id][$mid]));
        //echo "<pre>";
        //print_r($minimax_modules_settings);
        //echo $id."<br/>";
        $instance = @array_shift(array_shift($instance));
        if($instance):
            foreach($instance as $k=>$v):
                $ins[$k] = is_array($v)?$v:stripslashes($v);
            endforeach; endif;

        $prevw  = "";

    if(get_option('minimax_module_preview',0)==1){
    ob_start();

    if(method_exists($pmod = new $module(),'preview'))
        $pmod->preview($ins);
    else
        $pmod->widget(array(), $ins);
        //the_widget($module, $ins);*/
    $prevw = ob_get_contents();
    ob_clean();

        $prevw = "<div class='module-preview w3eden'>
        {$prevw}
        </div>";

    }
    //end preview
    $cls = (!is_admin())?' class="mx-input"':'';

    $module_frames .=<<<MOD

    <li id='module_{$id}_{$z}' rel='{$id}'>

        <input $cls type="hidden" id="modid_module_{$id}_{$z}" name="modules[{$id}][]" value="{$module}" />
        <input $cls id="modset_module_{$id}_{$z}" type="hidden" name="modules_settings[{$id}][]" value="{$minimax_modules_settings[$id][$mid]}" />
        <h3><nobr class="title">{$mod->name}</nobr><nobr class="ctl"><span class="handle"></span><img src="{$base_theme_url}/images/delete.png" class='delete_module' rel='#module_{$id}_{$z}' />&nbsp;<img class="insert" id="modset_module_{$id}_{$z}_icon" rel="$module" data="{$id}|{$mid}" datafield="modset_module_{$id}_{$z}" src="{$base_theme_url}/images/settings.png" /></nobr></h3>
        {$prevw}
        <div class="clear"</div></li>
MOD;

    endforeach;
    endif;
    echo $module_frames;
    
}

function minimax_get_module_preview(){
    //global $mxwidgets, $minimax_modules, $minimax_modules_settings;
    if(get_option('minimax_module_preview',0)==0 && !isset($_REQUEST['front'])) die("");
    $instance = @unserialize(base64_decode($_POST['modinfo']));
    $instance = @array_shift(array_shift($instance));
    if($instance):
        foreach($instance as $k=>$v):
            $ins[$k] = is_array($v)?$v:stripslashes($v);
        endforeach; endif;
    $module = $_POST['mod'];

    if(method_exists($pmod = new $module(),'preview') && !isset($_REQUEST['front']))
        $pmod->preview($ins);
    else
        the_widget($module, $ins);

    die();
}

//Render Modules (site)
function minimax_render_modules($id){
    global $minimax_modules, $mxwidgets, $wp_widget_factory, $minimax_modules_settings, $minimax_layout_data;
    //if(is_page()&&get_post_meta(get_the_ID(),'minimax_modules',true)){           
    if(get_post_meta(get_the_ID(),'minimax_modules',true)){           
    $minimax_layout_data_page = get_post_meta(get_the_ID(),'minimax_layout',true);
    $postmod = get_post_meta(get_the_ID(),'minimax_modules',true);
    $postmodset = get_post_meta(get_the_ID(),'minimax_modules_settings',true);    
    if(!is_array($minimax_modules)) $minimax_modules = array();
    if(!is_array($minimax_modules_settings)) $minimax_modules_settings = array();
    if(!is_array($postmod)) $postmod = array();
    if(!is_array($postmodset)) $postmodset = array();
    $minimax_modules += $postmod;              
    $minimax_modules_settings += $postmodset;
    }
    $base_theme_url = base_theme_url;
    if($minimax_modules[$id]):
    $mcount = 0;
    $z = 0;
    foreach($minimax_modules[$id] as $index=>$module):
        $z++;
        $mod = $mxwidgets[$module];
        $instance = @unserialize(base64_decode($minimax_modules_settings[$id][$index]));
    $instance = @array_shift(array_shift($instance));     
    if($instance):
    foreach($instance as $k=>$v):
    $ins[$k] = is_array($v)?$v:stripslashes($v);
    endforeach; endif;
    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single())){
    echo "<li id='module_{$id}_{$z}' class='minimax_module $module'  rel='{$id}'>";
    echo <<<HFL
        <input class="mx-input" type="hidden" id="modid_module_{$id}_{$z}" name="modules[{$id}][]" value="{$module}" />
        <input class="mx-input" id="modset_module_{$id}_{$z}" type="hidden" name="modules_settings[{$id}][]" value="{$minimax_modules_settings[$id][$index]}" />
        <div class="mod-ctrl">{$mod->name}<nobr class="ctl"><i class="handle fa fa-arrows"></i><i class='delete_module fa fa-trash-o' rel='#module_{$id}_{$z}'></i><i class="insert fa fa-cog" id="modset_module_{$id}_{$z}_icon" rel="$module" data="{$id}|{$mid}" datafield="modset_module_{$id}_{$z}"></i></nobr></div>
        <div class='module-content $module'>

HFL;
    } else
        echo "<div class='minimax_module $module'>";

    the_widget($module,$ins);
    echo (current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single()))?"</div></li>":"</div>";
    $mcount++;
    endforeach;
    endif;
    
}


//Insert Module (admin)
function minimax_insert_module(){    
    require_once("insert-module.php");
    die();
}
//Import Layout (admin)
function minimax_import_layout(){    
    require_once("import-layout.php");
    die();
}


//Module Settings Form (admin)
function minimax_module_settings(){
    global $mxwidgets, $minimax_modules_settings;        
    $ins = isset($_REQUEST['instance'])?explode('|',$_REQUEST['instance']):array();
    if(is_array($minimax_modules_settings) && @is_array($minimax_modules_settings[$ins[0]]))
    $instance = @unserialize(@base64_decode($minimax_modules_settings[$ins[0]][$ins[1]]));    
    //echo "<pre>";
    //print_r(unserialize(base64_decode($_POST['data_inst'])));
    $form_prefix = "";
    if(isset($_REQUEST['instance'])) { $form_prefix = "update-"; }
    $datafield = isset($_REQUEST['datafield'])?$_REQUEST['datafield']:"";
    $mod = $mxwidgets[$_GET['module']];
    //print_r($mod);
    $instance = @array_shift($instance["widget-".$mod->id_base]); //[$mod->number];    
    $data_inst = @unserialize(@base64_decode($_POST['data_inst']));
    //$data_inst = $data_inst["widget-".$mod->id_base][$mod->number];
    $data_inst = @array_pop($data_inst["widget-".$mod->id_base]);
    /*<input type='hidden' name='datafile' value='{$datafield}' />*/
    echo "<form class='ui-form' datafield='{$datafield}' method='post' id='{$form_prefix}module-settings-form'>";
    if($instance):
    foreach($instance as $k=>$c){
        $iinstance[$k] = is_array($c)?$c:stripcslashes($c);
    }
    endif;
    if($data_inst):
    foreach($data_inst as $k=>$c){
        $data_inst[$k] = is_array($c)?$c:stripcslashes($c);
    }
    endif;

    $iinstance = array();
    if(is_array($data_inst)) $iinstance = $data_inst;
 
    $mxwidgets[$_GET['module']]->form($iinstance);     
    echo "
    <input type='submit' class='ui-button' value='Save Settings' />        
    <input type='button' class='ui-button' onclick='jQuery(\"#dialog\").dialog(\"close\");jQuery(\"#dialog\").html(\"Loading...\");' value='Cancel' />
    </form><script>jQuery('#ui-dialog-title-dialog').html('".$mxwidgets[$_GET['module']]->name." Options');jQuery('.ui-button,.ui-form input[type=button]').button();</script>";
    die();
}

//Format module instance data (admin)
function minimax_module_settings_data(){    
    $data = base64_encode(serialize($_POST));    
    echo $data;
    die();
}

//Raw JS Code
function minimax_header_js(){
    ?>
    
    <script language="JavaScript">
    <!--
      var base_theme_url = "<?php echo base_theme_url; ?>",pageid="<?php echo isset($_GET['post'])?$_GET['post']:''; ?>",post_type="<?php echo get_post_type(); ?>";
      <?php if(!is_admin()) echo "var adminurl='".admin_url('/')."', ajaxurl = adminurl+'admin-ajax.php';"; ?>
    //-->
    </script>
    
    <?php
}

//Save minimax theme option
function minimax_save_theme_options(){

    //Save Layouts
    update_option("wpeden_admin",$_POST['wpeden_admin']);
    update_option("minimax_layout",$_POST['layouts']);
    update_option("minimax_layout_settings",$_POST['layout_settings']);
    update_option("minimax_modules",$_POST['modules']);
    update_option("minimax_modules_settings",$_POST['modules_settings']);       
    die();
}


//Register minimax modules
function minimax_register_modules(){      
    $modules = get_option("minimax_allowed_modules");
    $module_dir = MX_THEME_DIR.'/modules/';
    //$modules = scandir($module_dir);
    //foreach($modules as $module){     
    if(is_array($modules)){
        foreach($modules as $module){             
            if(file_exists("$module_dir/$module/$module.php"))
            include("$module_dir/$module/$module.php");
        }
    }
    
}


//Register front-end script
function minimax_enqueue_scripts(){
    $minimax_options = get_option("wpeden_admin");
    wp_enqueue_script("jquery"); 

        wp_enqueue_style("bootstrap",base_theme_url.'/bootstrap/css/bootstrap.css');
        wp_enqueue_style("module-styles",base_theme_url.'/css/module-styles.css');
        wp_enqueue_script("bootstrap-js",base_theme_url.'/bootstrap/js/bootstrap.min.js');
        wp_enqueue_style("row-styles",base_theme_url.'/css/row-styles.css');

    if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single())){
        wp_enqueue_script("jquery-cookie",base_theme_url.'/js/jquery.cookie.js',array('jquery'));
        wp_enqueue_style("jquery-ui-m",MX_THEME_URL.'css/jqui/theme/jquery-ui.css');
        wp_enqueue_style("jquery-ui-new",plugins_url('/page-layout-builder/css/jqui/css/custom.css'));
        wp_enqueue_style("admin-theme-style",base_theme_url.'/css/front-style.css');
        wp_enqueue_script("jqueryuiall", "//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js");
        wp_enqueue_script("thickbox");
        wp_enqueue_script("jquery-form", array('jquery'));
        wp_enqueue_script("operations-js",base_theme_url.'/js/operations-front.js');
    }
    wp_enqueue_style("fa", "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css");


}


function minimax_save_page_layout( $post_id ) {
     
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if(!$_POST||!isset($_POST['layout_settings'])) return;
    
    //print_r($_POST['modules_settings']); die();
    $squeeze_page = $_POST['squeeze_page']=='1'?1:0;
    update_post_meta($post_id, "squeeze_page",$squeeze_page);
    update_post_meta($post_id, "sptemplate",$_POST['sptemplate']);
    update_post_meta($post_id, "bodybgcolor",$_POST['bodybgcolor']);
    update_post_meta($post_id, "bodybgimage",$_POST['bodybgimage']);
    update_post_meta($post_id, "minimax_layout",$_POST['layouts']);
    update_post_meta($post_id, "minimax_layout_settings",$_POST['layout_settings']); 
    update_post_meta($post_id,"minimax_grid_settings",$_POST['layout_grids']);
    update_post_meta($post_id, "minimax_modules",$_POST['modules']);
    update_post_meta($post_id, "minimax_modules_settings",$_POST['modules_settings']);
    
    @unlink(MX_CACHE_DIR.$post_id);
                                                                  
}

function minimax_save_frontend_page_layout( ) {


    if(!isset($_POST['frontend_minimax'])) return;
//print_r($_POST); die();
    $post_id = $_REQUEST['post_id'];

    //print_r($_POST['modules_settings']); die();
    $squeeze_page = $_POST['squeeze_page']=='1'?1:0;


    update_post_meta($post_id, "minimax_layout",$_POST['layouts']);
    update_post_meta($post_id, "minimax_layout_settings",$_POST['layout_settings']);
    update_post_meta($post_id,"minimax_grid_settings",$_POST['layout_grids']);
    update_post_meta($post_id, "minimax_modules",$_POST['modules']);
    update_post_meta($post_id, "minimax_modules_settings",$_POST['modules_settings']);

    @unlink(MX_CACHE_DIR.$post_id);

}

function minimax_export_page_layout() {
     
    if ( !is_admin()|| !isset($_REQUEST['minimaxexport']) ) return;
    $post_id = $_REQUEST['minimaxexport'];
    $minimax_page['squeeze_page'] = get_post_meta($post_id, "squeeze_page", true);
    $minimax_page['bodybgcolor'] = get_post_meta($post_id, "bodybgcolor",true);
    $minimax_page['bodybgimage'] = get_post_meta($post_id, "bodybgimage",true);
    $minimax_page['minimax_layout'] = get_post_meta($post_id, "minimax_layout",true);
    $minimax_page['minimax_layout_settings'] = get_post_meta($post_id, "minimax_layout_settings", true);
    $minimax_page['minimax_grid_settings'] = get_post_meta($post_id, "minimax_grid_settings", true);
    $minimax_page['minimax_modules'] = get_post_meta($post_id, "minimax_modules",true);
    $minimax_page['minimax_modules_settings'] = get_post_meta($post_id, "minimax_modules_settings",true);

    $data = serialize($minimax_page);    
    header("Content-Description: File Transfer");
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=\"minimax-page-{$post_id}.txt\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . strlen($data));
    echo $data; 
    die();        
                                                                  
} 

function minimax_clone_page(){
    $post_id = isset($_REQUEST['minimaxclone'])?$_REQUEST['minimaxclone']:''; 
    if(is_admin()&&$post_id!=''){
      $post_data = get_post($post_id, ARRAY_A);
      unset($post_data['ID']);
      $post_data['post_title'] = "Clone: ".$post_data['post_title'];
      $post = wp_insert_post($post_data);  
      add_post_meta($post, "squeeze_page",get_post_meta($post_id, "squeeze_page", true));
      add_post_meta($post, "bodybgcolor",get_post_meta($post_id, "bodybgcolor",true));
      add_post_meta($post, "bodybgimage",get_post_meta($post_id, "bodybgimage",true));
      add_post_meta($post, "minimax_layout",get_post_meta($post_id, "minimax_layout",true));
      add_post_meta($post, "minimax_layout_settings",get_post_meta($post_id, "minimax_layout_settings", true));
      add_post_meta($post, "minimax_grid_settings",get_post_meta($post_id,'minimax_grid_settings', true));
      add_post_meta($post, "minimax_modules",get_post_meta($post_id, "minimax_modules",true));
      add_post_meta($post, "minimax_modules_settings",get_post_meta($post_id, "minimax_modules_settings",true));
      header("location: post.php?post={$post}&action=edit");
      die();
    }
}

function minimax_import_layout_data(){    
    if(is_admin()&&isset($_FILES['importlayout'])&&is_uploaded_file($_FILES['importlayout']['tmp_name'])){
    $post_id = $_GET['post'];    
    
    $data = file_get_contents($_FILES['importlayout']['tmp_name']);
    @unlink($_FILES['importlayout']['tmp_name']);
    $minimax_layout = unserialize($data);
     
    update_post_meta($post_id, "squeeze_page",$minimax_layout['squeeze_page']);
    update_post_meta($post_id, "bodybgcolor",$minimax_layout['bodybgcolor']);
    update_post_meta($post_id, "bodybgimage",$minimax_layout['bodybgimage']);
    update_post_meta($post_id, "minimax_layout",$minimax_layout['minimax_layout']);
    update_post_meta($post_id, "minimax_layout_settings",$minimax_layout['minimax_layout_settings']);
    update_post_meta($post_id,"minimax_grid_settings",$minimax_layout['minimax_grid_settings']);
    update_post_meta($post_id, "minimax_modules",$minimax_layout['minimax_modules']);
    update_post_meta($post_id, "minimax_modules_settings",$minimax_layout['minimax_modules_settings']);
    header("location: ".$_SERVER['REQUEST_URI']);            
    die();
    }   
}

function minimax_new_meida_buttons(){
    $post_type = get_post_type();
    $pageid = isset($_GET['post'])?$_GET['post']:'';
    if($pageid!='')
        $mxnb = "<a class='button export' href='".admin_url()."?minimaxexport=".$pageid."' ><span>Export Layout</span></a><a class='button import-layout import' rel='".$pageid."' href='#' ><span>Import Layout</span></a><a class='button clone' href='".admin_url()."?minimaxclone=".$pageid."' ><span>Clone</span></a>";
    else
        $mxnb = "<a class='button export' href='#' onclick='alert(\"".$post_type." is not published or saved yet!\");return false;' ><span>Export Layout</span></a><a class='button import' href='#' onclick='alert(\"".$post_type." is not published or saved yet!\");return false;' ><span>Import Layout</span></a><a class='button clone' href='#' onclick='alert(\"".$post_type." is not published or saved yet!\");return false;' ><span>Clone</span></a>";
            
   echo $mxnb;
}
 
add_action('media_buttons','minimax_new_meida_buttons',99);

 


//Common Actions (required for front and back)
add_action('init','minimax_load_theme_option_data');

function minimax_admin_enqueue_scripts(){      
    
    wp_enqueue_script("jquery");
     
    if((isset($_GET['page'])&&$_GET['page']=='minimax')||(isset($_GET['post_type'])&&$_GET['post_type']!='')||(isset($_GET['post'])&&in_array(get_post_type($_GET['post']),get_post_types()))||in_array(get_post_type(),get_post_types())){      
    //Styles
    if(isset($_GET['page'])&&$_GET['page']=='minimax')
    wp_enqueue_style("admin-reset",base_theme_url.'/css/reset.css');
    wp_enqueue_style("admin-grid",base_theme_url.'/css/grid.css');
    wp_enqueue_style("admin-bootstrap",base_theme_url.'/bootstrap/css/bootstrap.css');
    wp_enqueue_style("admin-theme-style",base_theme_url.'/css/admin-style.css');
    wp_enqueue_style("frame-style",base_theme_url.'/frames/css/style.css');
    wp_enqueue_style("frame-grid",base_theme_url.'/frames/css/grid.css');
    wp_enqueue_style("gh-buttons",base_theme_url.'/css/gh-buttons.css');        
    wp_enqueue_style("thickbox");  
    //wp_enqueue_style("jquery-ui-new",plugins_url('/page-layout-builder/css/aristo.css'));
    wp_enqueue_style("jquery-ui-m",plugins_url('/page-layout-builder/css/jqui/theme/jquery-ui.css'));
    wp_enqueue_style("jquery-ui-new",plugins_url('/page-layout-builder/css/jqui/css/custom.css'));
    
    //Scripts    
    wp_enqueue_script("jquery-ui-all");
    wp_enqueue_script("jquery-ui-sortable");
    wp_enqueue_script("jquery-ui-dialog");
    wp_enqueue_script("jquery-form");
    wp_enqueue_script("thickbox");    
    wp_enqueue_script("jquery-cookie",base_theme_url.'/js/jquery.cookie.js',array('jquery'));
    wp_enqueue_script("minimax-opr",base_theme_url.'/js/operations.js',array('jquery'));      
    }
}

function minimax_cache_status(){
    update_option('minimax_cache_status', $_POST['cache_status']);
    die("OK");
}
function minimax_module_preview(){
    update_option('minimax_module_preview', $_POST['module_preview']);
    die("OK");
}


//Ajax Actions
    add_action("wp_ajax_insert_layout","minimax_insert_layout");
    add_action("wp_ajax_insert_layout_front","minimax_insert_layout_front");
    add_action("wp_ajax_import_layout","minimax_import_layout");
    add_action("wp_ajax_insert_module","minimax_insert_module");
    add_action("wp_ajax_module_settings","minimax_module_settings");
    add_action("wp_ajax_module_settings_data","minimax_module_settings_data");
    add_action("wp_ajax_layout_settings","minimax_layout_settings");
    add_action("wp_ajax_layout_settings_data","minimax_layout_settings_data");
    //add_action("wp_ajax_minimax_generate_layout","minimax_generate_custom_layout");
    add_action("wp_ajax_get_module_preview","minimax_get_module_preview");

    add_action( 'save_post', 'minimax_save_page_layout' );  
    add_action( 'admin_init', 'minimax_export_page_layout' );  
    add_action( 'admin_init', 'minimax_import_layout_data' );  
    add_action( 'admin_init', 'minimax_clone_page' );  


//Launch minimax modules
//if((is_admin()&&($_GET['page']=='minimax'||$_GET['post_type']=='page'||$_GET['post']!=''))||!is_admin())
//if($_GET['page']=='minimax'||$_GET['post_type']!=''||in_array(get_post_type($_GET['post']),get_post_types())||in_array(get_post_type(),get_post_types())||!is_admin())

minimax_register_modules();

add_action('admin_head','minimax_header_js');
add_action('wp_head','minimax_header_js');

add_action("admin_enqueue_scripts","minimax_admin_enqueue_scripts");
add_action("wp_enqueue_scripts","minimax_enqueue_scripts");
//add_shortcode("minimax_page_layout","minimax_page_layout");
add_filter("the_content","minimax_page_layout");

//Actions    
    add_action('init',"minimax_wp_widgets");
    add_action('init',"minimax_select_layout");    
    add_action('wp_ajax_save_frontend_layout',"minimax_save_frontend_page_layout");
    add_action('wp_ajax_minimax_cache',"minimax_cache_status");
    add_action('wp_ajax_minimax_module_preview',"minimax_module_preview");

 
//Save all settings
add_action("wp_ajax_minimax_save_theme_options","minimax_save_theme_options");
        