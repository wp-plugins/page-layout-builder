
<style type="text/css">
#dialog *{
    font-family: 'Lucida Sans Unicode';
    overflow: hidden;
}

.layouts .insert-layout{
    display: block;
    background: url('<?php echo home_url('/wp-admin/images/loading.gif'); ?>') 18px center no-repeat;
}


.ccl{     
    border-top:1px solid #cccccc;
    border-right:1px solid #cccccc;
}
.ccl th{
    background: #eeeeee;
    border-left:1px solid #cccccc;
    border-bottom:1px solid #cccccc;
    padding: 5px;
}
.ccl td{     
    border-left:1px solid #cccccc;
    border-bottom:1px solid #cccccc;
    padding: 5px;
}
.button{
    -webkit-border-radius: 4px !important;
-moz-border-radius: 4px !important;
border-radius: 4px !important;
}
</style>

<strong>Predefined Layout:</strong>
<hr size="1" noshade="noshade" />
<div class="container_12 clearfix wrapper layouts">
   
    <div style="width:280px;float:left;margin: 5px;">
      <a href="#" class="insert-layout" rel="col-1">
      <img class="col-1-img" align="left" style="float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;width:50px" src="<?php echo base_theme_url; ?>/images/col-1.png" />
      <h2>Single Column</h2>
      </a>
    </div>
    <div style="margin: 5px;width:280px;float:left">
      <a href="#" class="insert-layout" rel="col-2">
      <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-2.png" />
      <h2>[1:1] 2 Column</h2>
      </a>
    </div>
    <div style="margin: 5px;width:280px;float:left">
    <a href="#" class="insert-layout" rel="col-3">
     <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-3.png" />
     <h2>[1:1:1] 3 Column</h2>
     </a>
    </div>
    
    <div style="margin: 5px;width:280px;float:left">
    <a href="#" class="insert-layout" rel="col-1-2">
     <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-1-2.png" />
     <h2>[1:2] 2 Column</h2>
     </a>
    </div>
    <div style="margin: 5px;width:280px;float:left">
    <a href="#" class="insert-layout" rel="col-2-1">
     <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-2-1.png" />
     <h2>[2:1] 2 Column</h2>
     </a>
    </div>
     <div style="margin: 5px;width:280px;float:left">
    <a href="#" class="insert-layout" rel="col-4">
     <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-4.png" />
     <h2>[1:1:1:1] 4 Column</h2>
     </a>
    </div>
     <div style="margin: 5px;width:280px;float:left">
    <a href="#" class="insert-layout" rel="col-1-3">
     <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-1-3.png" />
     <h2>[1:3] 2 Column</h2>
     </a>
    </div>
     <div style="margin: 5px;width:280px;float:left">
    <a href="#" class="insert-layout" rel="col-3-1">
     <img align="left" style="width:50px;float:left;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"  src="<?php echo base_theme_url; ?>/images/col-3-1.png" />
     <h2>[3:1] 2 Column</h2>
     </a>
    </div>     
     
</div>
<br/>
<form id="conlf" action="" method="post" class="ui-form">
<strong>Configure Layout:</strong>
<hr size="1" noshade="noshade" />
Columns: 
<select name="layoutopt[cols]" id="ccs">
<option value="">Select</option> 
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
</select>
 
 <br/>
 <br/>
<div id="clst">

</div>
<br/>
<br/>
<input type="hidden" name="action" value="minimax_generate_layout" />
<input type="submit" id="conl" value="Generate Layout" class="zbutton">
<span id="w8" style="display: none;padding-left: 10px;">Saving...</span>
</form>

 <script language="JavaScript">
 <!--
   jQuery(function(){
       jQuery('.insert-layout img').fadeTo('fast',1.0);
       jQuery('.zbutton').button();        
       
       jQuery('#ccs').change(function(){
           var n = this.value;
           var dta = "",cta = "";
           for(i=0;i<n;i++){           
               cta += "<th>Col# "+(i+1)+"</th>";           
               dta += "<td align='center'>Grid:<input type='text' placeholder='Grid' name='layoutopt[colgrid][]' size='5' /></td>";           
           }
           jQuery('#clst').html("<table cellpadding=0 cellspacing=0 width='100%' class='ccl'><tr>"+cta+"</tr><tr>"+dta+"</tr></table>"+'<span style="background: #FFEED6;padding: 5px;margin-top: 10px;color:#000;display: block;">Sum of column grids must be equal to <strong>12</strong> (<strong>12</strong> grids in total) </span>');
       });
       
       jQuery('#conlf').submit(function(){
           
         jQuery(this).ajaxSubmit({
             beforeSubmit:function(formData, jqForm, options){
               jQuery('#w8').fadeIn();
             },
             success:function(responseText, statusText, xhr, $form){
                 load_layout(responseText);
             },
             url: ajaxurl
         });
           
        return false;   
       });
       
   });
 //--> 
 </script>

