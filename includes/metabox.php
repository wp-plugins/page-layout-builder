<?php

//Layout builder metabox
function minimax_layout_builder_meta_box() {
    add_meta_box( get_post_type().'-minimax-layout-builder', 'MiniMax Layout Builder  <a style="float:right;font-weight:bold;text-decoration:none" href="#" rel="#layout_page" class="insert-layout ghbutton big">+ Insert Layout</a>', 'minimax_content_layout_builder', get_post_type(), 'normal','high' );   
    add_meta_box( get_post_type().'-minimax-squeeze-page', 'Blank Canvas', 'minimax_squeeze_page', get_post_type(), 'side','core' );     
}

function minimax_squeeze_page($post){     
    ?>
    <input type="checkbox" value="1" id="bco" name="squeeze_page" <?php echo get_post_meta(isset($_GET['post'])?$_GET['post']:'','squeeze_page',true)=='1'?'checked=checked':''; ?> > <strong>Use Blank Canvas Template</strong>
    <br/>
    Check this option if you want to build a page layout from ground on a blank canvas (will skip current theme header, footer, sidebars)
    
    <br/>
    <br/>
    <div id="bc" <?php echo get_post_meta(isset($_GET['post'])?$_GET['post']:'','squeeze_page',true)!='1'?'style="display:none;"':''; ?> >
    <strong>Select Squeeze Page Theme:</strong><br />
    <select name="sptemplate">
    <?php 
    $allthemes = scandir(MX_PLUG_DIR.'/canvas/');
   
    foreach($allthemes as $theme){
        if($theme == '.' || $theme == '..') continue;
        $themeinfo = wp_get_theme( $theme, MX_PLUG_DIR.'/canvas/' );
        echo "<option ".(get_post_meta($_GET['post'],'sptemplate',true)==$theme?'selected=selected':'')." value='{$theme}'>{$themeinfo->Name}</option>";
        
    } ?>
    </select><br />
    <strong>Body Background Color:</strong><br />
    <input size="28" type="text" name="bodybgcolor" class="miniColors" value="<?php echo get_post_meta(isset($_GET['post'])?$_GET['post']:'','bodybgcolor',true); ?>" /><br/>
    <strong>Body Background Image:</strong><br />
    <input size="28" type="text" id="bodybgimage" name="bodybgimage" value="<?php echo get_post_meta(isset($_GET['post'])?$_GET['post']:'','bodybgimage',true); ?>" /> <input type="button" style="font-size: 10px;" value="Browse" onclick="mediaupload('bodybgimage')" />
    </div>
    <script language="JavaScript">
    <!--
      jQuery('#bco').click(function(){
          if(this.checked) jQuery('#bc').slideDown();
          else jQuery('#bc').slideUp();
      });
    //-->
    </script>
    <?php
}

//Layout builder metabox callback
function minimax_content_layout_builder( $post ) {
    global $pt_plugin;     
    ?>
    <style type="text/css">
    #<?php echo get_post_type(); ?>-minimax-layout-builder {
        display: none;
    }
    #<?php echo get_post_type(); ?>-minimax-layout-builder h3{
        line-height: 30px !important;
        height:30px !important;
        font-size:14pt !important;
    }
    .row-container{
        width: 95%;         
    }
    #TB_ajaxContent{
        width: 95% !important;
        height: 90% !important;
        overflow: auto;
    }
    #widgets li{
        width: 183px !important;
    }
    .layout-data li{
        margin-bottom: 0px;
    }
    .window-title{
    -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
height: 35px;
background: #efefef;
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2VmZWZlZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmOWY5ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  #efefef 0%, #f9f9f9 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#efefef), color-stop(100%,#f9f9f9));
background: -webkit-linear-gradient(top,  #efefef 0%,#f9f9f9 100%);
background: -o-linear-gradient(top,  #efefef 0%,#f9f9f9 100%);
background: -ms-linear-gradient(top,  #efefef 0%,#f9f9f9 100%);
background: linear-gradient(top,  #efefef 0%,#f9f9f9 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#efefef', endColorstr='#f9f9f9',GradientType=0 );
border-bottom:1px inset #dddddd;
    }
.window-content{
    border-top:1px solid #ffffff;
}
    .window{
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        border:1px solid #dddddd;
    }
    </style>
    
  <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('/page-layout-builder/css/tipTip.css');?>" /> 
  <script language="JavaScript" src="<?php echo plugins_url('/page-layout-builder/js/jquery.tipTip.minified.js');?>"></script>
    
    <div id="alll">
    <div id="layout_<?php echo get_post_type(); ?>">
                <?php 
                    global $minimax_layout_settings;
                    if(isset($_GET['post']))
                    $minimax_layout_settings = get_post_meta($_GET['post'],'minimax_layout_settings',true);                                         
                    else 
                    $minimax_layout_settings = array();
                ?>
                <ul class="layout-data">                
                <?php
                    minimax_render_layout_frames(get_post_type()); 
                ?>                
                </ul>
    </div>
    </div>
     
    <div style="clear: both;"></div>
    
    <div class="clear"></div> 
    <div id="dialog" title="MiniMax"><p>Loading...</p></div>
    <div id="childdialog" title="MiniMax"><p>Loading...</p></div>
    
    <div class="w3eden">  
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
            <div id="modalcontentarea"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
    </div>
    </div>
    
    <script type="text/javascript">
     
    jQuery(function() {
        jQuery( "#dialog" ).dialog({ zIndex: 100, position: 'top' , closeOnEscape: true, autoOpen: false,modal:true,width:'640px' });
        jQuery( ".dialog" ).dialog({ zIndex: 100, position: 'top' , closeOnEscape: true, autoOpen: false,modal:true,width:'640px' });
        jQuery( "#childdialog" ).dialog({ zIndex: 101, position: 'top' , closeOnEscape: true, autoOpen: false,width:'640px' });
        jQuery('.ui-dialog').css('margin-top','28px');
        jQuery(".tooltip,.mx-tooltip,.stooltip").tipTip({defaultPosition:'top'});

    });
    </script>
 
    <?php
    
}

//Metabox action 
add_action( 'add_meta_boxes', 'minimax_layout_builder_meta_box');
