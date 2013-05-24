<?php

//Layout builder metabox
function minimax_layout_builder_meta_box() {
    add_meta_box( get_post_type().'-minimax-layout-builder', 'MiniMax Layout Builder  <a style="float:right;font-weight:bold;text-decoration:none" href="#" rel="#layout_page" class="insert-layout ghbutton big">+ Insert Layout</a>', 'minimax_content_layout_builder', get_post_type(), 'normal','high' );   
    //add_meta_box( get_post_type().'-minimax-squeeze-page', 'Blank Canvas', 'minimax_squeeze_page', get_post_type(), 'side','core' );   
    //add_meta_box( 'page-minimax-widgets', 'Widgets', 'minimax_all_widgets', 'page', 'side','core' );   
}
 

function minimax_all_widgets(){
    ?>
    
    <div id="allmods" style="display: block;clear: both;">
    </div>
    <script language="JavaScript">
    <!--
     // jQuery('#allmods').load('admin-ajax.php?page=minimax&action=insert_module');
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
    <script type="text/javascript">
     
    jQuery(function() {
        jQuery( "#dialog" ).dialog({ zIndex: 100, position: 'top' , closeOnEscape: true, autoOpen: false,modal:true,width:'640px' });
        jQuery( ".dialog" ).dialog({ zIndex: 100, position: 'top' , closeOnEscape: true, autoOpen: false,modal:true,width:'640px' });
        jQuery( "#childdialog" ).dialog({ zIndex: 101, position: 'top' , closeOnEscape: true, autoOpen: false,width:'640px' });
        jQuery('.ui-dialog').css('margin-top','28px');
        jQuery(".tooltip").tipTip({defaultPosition:'top'});
    });
    </script>


    
   <?php /*  
   <script language="JavaScript">
<!--
  jQuery(function(){
      jQuery('.admin-cont').css('min-height',(jQuery('body').height()-120)+'px');
      jQuery('#theme-admin-menu a').click(function(){
          
          jQuery('.settings').hide();
          jQuery(jQuery(this).attr('href')).show();
          jQuery('#theme-admin-menu li a').removeClass('active');
          jQuery(this).addClass('active');
          var sn = jQuery(this).attr('href').replace('#','').replace('-',' ');
          jQuery('#admin-title span').html(sn).css('text-transform','capitalize');
          return false;
      });
      
      //Insert Layout
      jQuery('.insert-layout').click(function(){
          holder = this.rel+" .layout-data";
          holder_id = this.rel.replace("#layout_","");
          tb_show("Insert Layout","themes.php?page=minimax&task=select_layout&TB_iframe=1");
          return false;
      });
      
      //Layout Settings
      var layout_settings_id = "",layout_settings_data="";
      jQuery('.rsettings').live('click',function(){
          layout_settings_id = jQuery(this).attr('rel');          
          layout_settings_data = jQuery('#'+layout_settings_id).val();
          tb_show("Layout Settings","admin-ajax.php?page=minimax&action=layout_settings&layout_settings_id="+layout_settings_id+"&layout_settings_data="+layout_settings_data+"&modal=1");                    
          return false;
      });
      
      //Delete Layout
      jQuery('.rdel').live('click',function(){
          if(!confirm('Are you sure?')) return;
          jQuery('#'+jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});
      });
      
      
      
      //Select Module
      var insertto = "", module_index = "", msf_mid = "", msf_title = "";
      jQuery('.btnAddMoudule').live('click',function(){
          insertto = '#'+this.rel+' .module';          
          module_index = this.rel;
          tb_show("Insert Module","admin-ajax.php?page=minimax&action=insert_module&modal=1")
          return false;
      });
      
      //Insert Module
      jQuery('.insert').live('click',function(){
          //tb_remove();
          msf_mid = jQuery(this).attr('rel');
          msf_title = this.title;
          var data = jQuery(this).attr('data')==undefined?"":"&instance="+jQuery(this).attr('data');          
          var datafield = jQuery(this).attr('datafield')==undefined?"":"&datafield="+jQuery(this).attr('datafield');          
          tb_show("Module Settins","admin-ajax.php?page=minimax&action=module_settings&modal=1&width=510&height=500&module="+msf_mid+data+datafield);          
      });
      
      
      //Delete Module
      jQuery('.delete_module').live('click',function(){
          jQuery(jQuery(this).attr('rel')).slideUp(function(){jQuery(this).remove();});
      });
      
      
      // Form Submit
      jQuery('#minimax-form').submit(function(){
          jQuery('#mxinfo').html('Please Wait...')
          jQuery('#mxinfo').slideDown();
          jQuery(this).ajaxSubmit({              
              url:ajaxurl,
              success:function(res){
                   jQuery('#mxinfo').html('Setting Saved Successfully!')
                   setTimeout("jQuery('#mxinfo').slideUp();",2000);
              }   
          });
          
          return false;
          
      });            
      
      jQuery('#module-settings-form').live('submit',function(){
          jQuery(this).ajaxSubmit({              
              url:ajaxurl+'?page=minimax&action=module_settings_data',
              success:function(res){
                  var d = new Date();
                  var z = d.getTime();
                  jQuery(insertto).append('<li id="module_'+module_index+'_'+z+'"><span class="handle"></span><input type="hidden" name="modules['+module_index+'][]" value="'+msf_mid+'" /><input type="hidden" name="modules_settings['+module_index+'][]" value="'+res+'" /><nobr class="title">'+msf_title+'</nobr><nobr class="ctl"><img src="<?php echo base_theme_url; ?>/images/delete.png"  class="delete_module" rel="#module_'+module_index+'" />&nbsp;<img src="<?php echo base_theme_url; ?>/images/settings.png" /></nobr><div class="clear"</div></li>');          
                  jQuery( insertto ).sortable({handle : '.handle'});
                  jQuery( insertto ).disableSelection({handle : '.handle'});
                  tb_remove();
                  
                 
              }   
          });
          
          return false;
      });
      
      jQuery('#layout-settings-form').live('submit',function(){
          var layout_settings_id = jQuery(this).attr('rel');      
          jQuery(this).ajaxSubmit({                        
              url:ajaxurl+'?page=minimax&action=layout_settings_data',
              success:function(res){
                  jQuery('#'+layout_settings_id).val(res);                   
                  tb_remove();
              }   
          });
          
          return false;
      });
      
      jQuery('#update-module-settings-form').live('submit',function(){
          var datafield = jQuery(this).attr('datafield');
          jQuery(this).ajaxSubmit({              
              url:ajaxurl+'?page=minimax&action=module_settings_data',
              success:function(res){
                  //alert('#'+datafield);
                  jQuery('#'+datafield).val(res);
                  jQuery('#'+datafield+"_icon").attr('data',res);
                  tb_remove();                  
              }   
          });
          
          return false;
      });
      
      jQuery('.module').sortable({handle : '.handle'});
      
      jQuery( '.layout-data' ).sortable({handle : '.row-handler'});
      jQuery( '.layout-data' ).disableSelection();
  });
  
  var holder = "", holder_id = "";
  function load_layout(layout){           
     jQuery.get("admin-ajax.php?page=minimax&action=insert_layout&holder="+holder_id+"&layout="+layout,function(res){
         jQuery(holder).append(res);         
         jQuery( '.layout-data' ).sortable({handle : '.row-handler'});
         jQuery( '.layout-data' ).disableSelection();
     });        
  }
  
  function mediaupload(id){
      var id = '#'+id;
      tb_show('Upload Image','<?php echo admin_url("media-upload.php?TB_iframe=1&width=640&height=624"); ?>');
      window.send_to_editor = function(html) {           
              var imgurl = jQuery('img',"<p>"+html+"</p>").attr('src');                                    
              jQuery(id).val(imgurl);
              tb_remove();
              }
      
  }
  
//-->
</script> 
       */ ?>  
    <?php
    
}




//Metabox action 
add_action( 'add_meta_boxes', 'minimax_layout_builder_meta_box');
