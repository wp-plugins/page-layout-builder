if("undefined" == typeof post_type) var post_type = ""; 
if("undefined" == typeof pageid) var pageid = ""; 

jQuery(function(){
            jQuery("#content-tmce").after('<a onclick="switchtominimax();" class="hide-if-no-js wp-switch-editor switch-minimax" id="content-minimax">MiniMax</a>');
            var mxnb = '';
            jQuery("#wp-content-wrap").append("<div id='minimax-builder' class='wp-editor-container' style='display:none'><div class='quicktags-toolbar minimax-toolbar'><div class='ghbutton-group'><a class='insert-layout ghbutton ' holder='#layout_"+post_type+"' rel='col-1' href='#' >1 Col</a><a class='insert-layout ghbutton ' holder='#layout_"+post_type+"' rel='col-2' href='#' >2 Cols</a><a class='insert-layout ghbutton ' holder='#layout_"+post_type+"' rel='col-3' href='#' >3 Cols</a><a class='insert-layout ghbutton ' holder='#layout_"+post_type+"' rel='col-4' href='#' >4 Cols</a><a class='insert-layout ghbutton ' holder='#layout_"+post_type+"' rel='col-5' href='#' >5 Cols</a><a class='insert-layout ghbutton ' holder='#layout_"+post_type+"' rel='col-6' href='#' >6 Cols</a></div>"+mxnb+"</div><div id='lbrd'></div></div>");            
            jQuery('#lbrd').html(jQuery('#'+post_type+'-minimax-layout-builder .inside').html());
            jQuery('#'+post_type+'-minimax-layout-builder .inside').html('');            
            jQuery('#content-html,#content-tmce').click(function(){             
            jQuery('.wp-switch-editor').removeClass('tactive');     
            if(this.id=='content-tmce') {jQuery('#ed_toolbar').hide(); jQuery('#content-tmce').addClass('tactive');   }
            if(this.id=='content-html') jQuery('#ed_toolbar').show();   
            jQuery('#post-status-info').show();     
            jQuery('#wp-content-editor-container').show();
            jQuery('#minimax-builder').hide();            
            jQuery('.export,.import,.clone').css('visibility','hidden');
            jQuery('#content-minimax').removeClass('tactive');
            jQuery.cookie('active_mx_'+pageid,'0');
            });
            
            jQuery(window).resize(function(){
                reset_layout_width();                
            });
    
      jQuery('.module-preview.w3eden *').live('click',function(e){
          e.preventDefault();
      });
      
      jQuery('.mwdth').live('click',function(){
              var prts = this.id.split("_");
              var grid = jQuery('#'+prts[1]+'_'+prts[2]).val();
              var tgrid = grid;
              var col = prts[2];
              var rowid = prts[1];
              var cols = jQuery(this).attr('cols');
              grid = parseInt(grid);
              col = parseInt(col);
              cols = parseInt(cols);
              if(cols>col) var nxtc = col+1;
              else if(cols==col&&cols!=1) var nxtc = col-1;
              var ngrid = parseInt(jQuery('#'+rowid+'_'+nxtc).val());
              if(this.rel=='inc') {
                  if(ngrid==1) return false;
                  jQuery('#'+rowid+'_'+col).val(grid+1);
                  jQuery('#grid_'+col+'_'+rowid).attr('class','grid_'+(grid+1));
                  jQuery('#'+rowid+'_'+nxtc).val(ngrid-1);
                  jQuery('#grid_'+nxtc+'_'+rowid).attr('class','grid_'+(ngrid-1));
                  
                  
              }   else   {
                  if(grid==1) return false;
                  jQuery('#'+rowid+'_'+col).val(grid-1);
                  jQuery('#grid_'+col+'_'+rowid).attr('class','grid_'+(grid-1));
                  jQuery('#'+rowid+'_'+nxtc).val(ngrid+1);
                  jQuery('#grid_'+nxtc+'_'+rowid).attr('class','grid_'+(ngrid+1));
                  
              }
              
              return false;
               
              
      });
      
      jQuery('.admin-cont').css('min-height',(jQuery('body').height()-120)+'px');
      
      jQuery('.insert-layout').live('click',function(){       
       //jQuery(this).find('img').fadeTo('slow',0.3);       
       if(holder=='') { 
           holder = jQuery(this).attr('holder')+" .layout-data";           
           holder_id = jQuery(this).attr('holder').replace("#layout_","");                       
       }       
       load_layout(this.rel);       
       return false;
       });
      
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
      jQuery('.select-layout').live('click',function(){
          holder = this.rel+" .layout-data";
          holder_id = this.rel.replace("#layout_","");           
          //tb_show("Insert Layout","themes.php?page=minimax&task=select_layout&TB_iframe=1&width=400&height=270");
          //jQuery('#ui-dialog-title-dialog').html('Available Modules');
          jQuery('#ui-dialog-title-dialog').html('Select Layout');
          jQuery( "#dialog" ).dialog( "open" ).load("themes.php?page=minimax&task=select_layout&width=400&height=270");
          return false;
      });
      
      //Layout Settings
      var layout_settings_id = "",layout_settings_data="";
      jQuery('.rsettings').live('click',function(){
          layout_settings_id = jQuery(this).attr('rel');          
          layout_settings_data = jQuery('#'+layout_settings_id).val();
          jQuery( "#dialog" ).dialog( 'option', 'title','Row Settings');
          jQuery( "#dialog" ).dialog( 'option', 'width',660);
          jQuery( "#dialog" ).dialog( "open" ).load("admin-ajax.php?page=minimax&action=layout_settings&layout_settings_id="+layout_settings_id+"&layout_settings_data="+layout_settings_data+"&modal=1&width=400&height=200");
          return false;
      });
      
      //Delete Layout
      jQuery('.rdel').live('click',function(){           
          jQuery(this).after("<div class='besure' style='display:none;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;z-index:99999999;position:absolute;color:#000;border:5px solid rgba(0,0,0,0.4);'><div style='padding:10px;background:#fff;font-family:verdana;font-size:10px'>Are you sure? <a style='-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;background:#800;padding:4px 8px 6px 8px;color:#fff;text-decoration:none;' href='#' onclick='jQuery(\".besure\").fadeOut(function(){jQuery(this).remove();jQuery(\"#"+jQuery(this).attr("rel")+"\").slideUp(function(){jQuery(this).remove();});});return false;'>y</a> <a href='' style='-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;background:#080;padding:4px 8px 6px 8px;color:#fff;text-decoration:none;' onclick='jQuery(\".besure\").fadeOut(function(){jQuery(this).remove();mxdm=null;});return false;'>n</a></div></div>");
          jQuery('.besure').fadeIn();                     
      });
      
      
      
      //Select Module
      var insertto = "", module_index = "", msf_mid = "", msf_title = "";
      jQuery('.btnAddMoudule').live('click',function(){
          insertto = '#'+this.rel+' .module';          
          module_index = this.rel;
          
          jQuery( "#dialog" ).dialog( 'option', 'width',940);
          //jQuery( "#dialog" ).dialog( 'option', 'height',600);
          jQuery( "#dialog" ).dialog( 'option', 'title','Modules');
          jQuery( "#dialog" ).dialog( "open" ).load("admin-ajax.php?page=minimax&action=insert_module&modal=1&width=770&height=600");
          return false;
      });
      
      //Import Layout
      var insertto = "", module_index = "", msf_mid = "", msf_title = "";
      jQuery('.import-layout').live('click',function(){
          jQuery( "#dialog" ).dialog( 'option', 'title','Import Layout');
          jQuery( "#dialog" ).dialog( 'option', 'width',540);
          jQuery( "#dialog" ).dialog( "open" ).load("admin-ajax.php?page=minimax&action=import_layout&modal=1&width=370&height=300");
          return false;
      });
      
      //Insert Module
      jQuery('.insert').live('click',function(){
          
          msf_mid = jQuery(this).attr('rel');          
          msf_title = jQuery(this).attr('wname');
          var data = jQuery(this).attr('data') == undefined ? "" : "&instance="+jQuery(this).attr('data');
          var datafield = jQuery(this).attr('datafield')==undefined?"":"&datafield="+jQuery(this).attr('datafield');          
          //var post = typenow=='page'?"&post="+pageid:"";
          var post = "&post="+pageid;
          var data_inst = jQuery('#'+jQuery(this).attr('datafield')).val();
                              
          jQuery( "#dialog" ).dialog( 'option', 'title', msf_title);
          jQuery( "#dialog" ).html( 'Loading...');
          jQuery( "#dialog" ).dialog( 'option', 'width',700);
          jQuery( "#dialog" ).dialog('open').load("admin-ajax.php?page=minimax&action=module_settings&modal=1&width=510&height=500&module="+msf_mid+data+datafield+post,{data_inst:data_inst});

          return false;
      });
      
      
      //Delete Module              
      jQuery('.delete_module').live('click',function(){
          //var modid = jQuery(this).parent().parent().parent().attr('id');
          jQuery(this).after("<div class='besure' style='display:none;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;z-index:99999999;position:absolute;color:#000;border:5px solid rgba(0,0,0,0.4);'><div style='padding:10px;background:#fff;font-family:verdana;font-size:10px'>Are you sure? <a style='-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;background:#800;padding:4px 8px 6px 8px;color:#fff;text-decoration:none;' href='#' onclick='jQuery(\".besure\").fadeOut(function(){jQuery(this).remove();jQuery(\""+jQuery(this).attr("rel")+"\").slideUp(function(){jQuery(this).remove();});});return false;'>y</a> <a href='' style='-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;background:#080;padding:4px 8px 6px 8px;color:#fff;text-decoration:none;' onclick='jQuery(\".besure\").fadeOut(function(){jQuery(this).remove();mxdm=null;});return false;'>n</a></div></div>");
          jQuery('.besure').fadeIn();
          
      });
      
      
      // Form Submit
      jQuery('#minimax-form').submit(function(){
          jQuery('#mxinfo').html('Please Wait...');
          jQuery('#mxinfo').slideDown();
          jQuery(this).ajaxSubmit({              
              url:ajaxurl,
              success:function(res){
                   jQuery('#mxinfo').html('Setting Saved Successfully!');
                   setTimeout("jQuery('#mxinfo').slideUp();",2000);
              }   
          });
          
          return false;
          
      });            
      
      jQuery('#module-settings-form').live('submit',function(){
          jQuery(this).append('<img src="images/loading.gif" /> Saving...');
          jQuery(this).ajaxSubmit({              
              url:ajaxurl+'?page=minimax&action=module_settings_data',
              success:function(res){
                  var d = new Date();
                  var z = d.getTime();
                  jQuery(insertto).append('<li id="module_'+module_index+'_'+z+'" rel="'+module_index+'"><input type="hidden" id="modid_module_'+module_index+'_'+z+'" name="modules['+module_index+'][]" value="'+msf_mid+'" /><input type="hidden" name="modules_settings['+module_index+'][]" id="modset_module_'+module_index+'_'+z+'" value="'+res+'" /><h3><nobr class="title">'+msf_title+'</nobr><nobr class="ctl"><span class="handle"></span> <img src="'+base_theme_url+'/images/delete.png"  class="delete_module" rel="#module_'+module_index+'_'+z+'" />&nbsp;<img class="insert" rel="'+msf_mid+'" datafield="modset_module_'+module_index+'_'+z+'" data="'+module_index+'|0" src="'+base_theme_url+'/images/settings.png" /></nobr></h3><div class="module-preview w3eden"><img src="images/loading.gif" /> Loading Preview...</div><div class="clear"</div></li>');
                  jQuery( insertto ).sortable({handle : '.handle', connectWith: "ul.module"});
                  jQuery( insertto ).disableSelection({handle : '.handle'});   
                  jQuery("#dialog").html("Loading...");                
                  jQuery('#dialog').dialog('close');
                  jQuery('#module_'+module_index+'_'+z+' .module-preview').load(ajaxurl+'?page=minimax&action=get_module_preview',{mod:msf_mid, modinfo:res});
                 
              }   
          });
          
          return false;
      });
      
     // Clone a module 
     jQuery('.module-clone').live('click',function(){
          var col_id = jQuery(this).attr('col_id');
          var res = jQuery(this).attr('mod_set');
          var msf_mid = jQuery(this).attr('mod_id');
          var msf_title = jQuery(this).attr('mod_name');
          var d = new Date();
          var z = d.getTime();
          //Load Module Frame
          jQuery("#"+col_id + " .module").append('<li id="module_'+col_id+'_'+z+'" rel="'+col_id+'"><input type="hidden" id="modid_module_'+col_id+'_'+z+'" name="modules['+col_id+'][]" value="'+msf_mid+'" /><input type="hidden" name="modules_settings['+col_id+'][]" id="modset_module_'+col_id+'_'+z+'" value="'+res+'" /><h3><nobr class="title">'+msf_title+'</nobr><nobr class="ctl"><span class="handle"></span> <img src="'+base_theme_url+'/images/delete.png"  class="delete_module" rel="#module_'+col_id+'_'+z+'" />&nbsp;<img class="insert" rel="'+msf_mid+'" datafield="modset_module_'+col_id+'_'+z+'" data="'+col_id+'|0" src="'+base_theme_url+'/images/settings.png" />&nbsp;<img class="module-clone dtooltip" title="Clone this module" col_id = '+col_id+' mod_name="'+msf_title+'" mod_id='+msf_mid+' mod_set= '+res+' src="'+base_theme_url+'/images/copy.png" /></nobr></h3><div class="module-preview w3eden"><img src="images/loading.gif" /> Loading Preview...</div><div class="clear"</div></li>');
          //Load Module Preview
          jQuery('#module_'+col_id+'_'+z+' .module-preview').load(ajaxurl+'?page=minimax&action=get_module_preview',{mod:msf_mid, modinfo:res});
          return false;
      });
      
      jQuery('#layout-settings-form').live('submit',function(){
          var layout_settings_id = jQuery(this).attr('rel');
          jQuery(this).append('<div style="position: absolute;margin-top: -5px"><img src="images/loading.gif" /> Saving...</div>');
          jQuery(this).ajaxSubmit({                        
              url:ajaxurl+'?page=minimax&action=layout_settings_data',
              success:function(res){
                  jQuery('#'+layout_settings_id).val(res);
                  jQuery("#dialog").dialog("close");
              }   
          });
          
          return false;
      });
      
      jQuery('#update-module-settings-form').live('submit',function(){
          var datafield = jQuery(this).attr('datafield');
          jQuery(this).append('<img src="images/loading.gif" /> Saving...');
          jQuery(this).ajaxSubmit({              
              url:ajaxurl+'?page=minimax&action=module_settings_data',
              success:function(res){
                  //alert('#'+datafield);
                  jQuery('#'+datafield).val(res);
                  //jQuery('#'+datafield+"_icon").attr('data',res);
                  jQuery("#dialog").html("Loading...");
                  jQuery('#dialog').dialog('close');
                  var mod = datafield.replace("modset_","");
                  var msf_mid =   datafield.replace("modset_","modid_");
                  msf_mid = jQuery('#'+msf_mid).val();
                  jQuery('#'+mod+' .module-preview').html('<img src="images/loading.gif" /> Updating Preview...');
                  jQuery('#'+mod+' .module-preview').load(ajaxurl+'?page=minimax&action=get_module_preview',{mod:msf_mid, modinfo:res});
              }   
          });
          
          return false;
      });
      
      jQuery('.module').sortable({handle : '.handle', connectWith: "ul.module"});
      
      jQuery( '.layout-data' ).sortable({handle : '.row-handler'});
      jQuery( '.layout-data' ).disableSelection();      
      if(jQuery.cookie('active_mx_'+pageid)==1) switchtominimax();
      jQuery('.module').bind('sortupdate',function(event, ui){
          //console.log(event);
          //console.log(ui);
          //console.log(jQuery(ui.item).parent().attr(''));
          var d = new Date();
          var z = d.getTime();
          var id = jQuery(jQuery(ui.item).parent()).attr('rel')+'_'+z;
          var rplc = jQuery(ui.item).attr('rel');
          var rplcw = jQuery(jQuery(ui.item).parent()).attr('rel');
          jQuery(ui.item).attr('id',id).attr('rel',jQuery(jQuery(ui.item).parent()).attr('rel'));          
          jQuery(ui.item).html(jQuery(ui.item).html().replace(new RegExp(rplc,"g"),rplcw));
          jQuery(ui.item).html(jQuery(ui.item).html().replace(new RegExp(rplc+'_([\d]*)',"g"),rplcw+'_'+z));
           
      });
      //jQuery('.ghbutton').addClass('button button-small button-secondary').removeClass('ghbutton').css('border-radius','0px').css('padding','4px');
  });
  
  var holder = "", holder_id = "";
  function load_layout(layout){           
     jQuery.get("admin-ajax.php?page=minimax&action=insert_layout&holder="+holder_id+"&layout="+layout,function(res){          
         jQuery(holder).append(res);         
         jQuery( '.layout-data' ).sortable({handle : '.row-handler'});
         jQuery( '.layout-data' ).disableSelection();
         jQuery("#dialog").html("Loading...");
         jQuery('#dialog').dialog('close');
         reset_layout_width();
     });        
  }
  
  function mediaupload(id){
      var id = '#'+id;
      tb_show('Upload Image','media-upload.php?TB_iframe=1&width=640&height=624');
      window.send_to_editor = function(html) {           
              var imgurl = jQuery('img',"<p>"+html+"</p>").attr('src');                                    
              jQuery(id).val(imgurl);
              tb_remove();
              }
      
  }
  
  function switchtominimax(){          
            jQuery('.wp-switch-editor').removeClass('tactive'); 
            jQuery('#wp-content-wrap').removeClass('tmce-active').removeClass('html-active');
            jQuery('#wp-content-editor-container').hide();
            jQuery('#post-status-info').hide();
            jQuery('#minimax-builder').show();
            jQuery('.export,.import,.clone').css('visibility','visible');
            jQuery('.minimax-toolbar').show();
            jQuery('#content-minimax').addClass('tactive');
            reset_layout_width();
            jQuery.cookie('active_mx_'+pageid,'1');            
        }
        
  function reset_layout_width(){
            var mw = jQuery('.layout-data li').width()-35;
            if(mw>0);                
            jQuery('.row-container').css('width',mw+'px');
        }
        
 //function for the module activate/deactivate
 jQuery('.mod_name').live("click",function(){
     //alert("");
     var obj = this;
     jQuery(this).html('<i class="icon-spinner icon-spin"></i>');
     jQuery('.mod_'+jQuery(obj).attr("rel")).removeClass(jQuery('.mod_'+jQuery(obj).attr("rel")).attr("rel")); 
     jQuery('.mod_'+jQuery(obj).attr("rel")).addClass( "loading");    
     jQuery.post(ajaxurl,{
        action:"module_status_change" ,
        status:jQuery(this).attr("status"),
        module: jQuery(this).attr("rel")
     },function(res){         
         //alert(jQuery(_obj).attr("rel"));
          
         jQuery('.mod_'+jQuery(obj).attr("rel")).removeClass(jQuery('.mod_'+jQuery(obj).attr("rel")).attr("rel"));           
         jQuery('.mod_'+jQuery(obj).attr("rel")).addClass( res); 
         jQuery('.mod_'+jQuery(obj).attr("rel")).attr("rel",res);
         //Change the status
         //alert(jQuery('#st_'+jQuery(this).attr("rel")).text());
         if(res=="power_on"){
             //alert(jQuery(obj).find('.icon').attr('class'));
             jQuery(obj).html('Deactivate');
             jQuery(obj).attr('status','power_on');
             jQuery('#st_'+jQuery(obj).attr("rel")).removeClass("mod_status_Inactive").removeClass("label-danger");
             jQuery('#st_'+jQuery(obj).attr("rel")).addClass("mod_status_Active").addClass('label-success');
             jQuery('#st_'+jQuery(obj).attr("rel")).html("Active");
         }else{
             //alert(jQuery(obj).find('.icon').attr('class'));
             jQuery(obj).attr('status','power_off');
             jQuery(obj).html('Activate');
             jQuery('#st_'+jQuery(obj).attr("rel")).removeClass("mod_status_Active").removeClass("label-success");
             jQuery('#st_'+jQuery(obj).attr("rel")).addClass("mod_status_Inactive").addClass('label-danger');
             jQuery('#st_'+jQuery(obj).attr("rel")).html("Inactive");
         }
     });
 });        