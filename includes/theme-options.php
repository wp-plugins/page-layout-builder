<div class="container_4 clearfix minimax" id="minimax">
<form action="" method="post" id="minimax-form">
<input type="hidden" name="action" value="minimax_save_theme_options">
    <div class="grid_1">

    <div class="logo">
        <img src="<?php echo base_theme_url; ?>/images/logo.png"  />
    </div>
     
    </div>

    
    <div class="grid_3 admin-cont">
        <div class="header"><h2 id="admin-title"><span>General</span> Settings</h2><input type="submit" class="button button-large button-primary" value="Save Settings" /></div>
        <div class="info" id="mxinfo" style="display:none;background: #444444;text-align:center;line-height: 40px;color:#fff">Saving...</div>
        <div  style="padding:0px 10px 10px 10px;">
        <div id="general" class="general settings">
        <label for="logo">CSS Layout Framework:</label> 
        <div class="sap"></div>
        <label><input type="radio" name="wpeden_admin[general][css_layout]" disabled="disabled" value="960" <?php if($minimax_options['general']['css_layout']=="960")echo 'checked="checked"';else echo '';?>> 960 Grid System </label>
        <label><input type="radio" name="wpeden_admin[general][css_layout]" value="bootstrap" <?php if($minimax_options['general']['css_layout']=="bootstrap")echo 'checked="checked"';else echo '';?>> Bootstrap </label>
                 
         
       
        
        
        <label for="logo">CSS UI Framework:</label> 
        <div class="sap"></div>
        <label><input type="radio" name="wpeden_admin[general][ui]" disabled="disabled" value="jquery" <?php if($minimax_options['general']['ui']=="jquery")echo 'checked="checked"';else echo '';?> disabled="disabled" > Jquery UI </label>
        <label><input type="radio" name="wpeden_admin[general][ui]" value="bootstrap" <?php if($minimax_options['general']['ui']=="bootstrap")echo 'checked="checked"';else echo '';?>> Bootstrap UI </label>
        <label><input type="radio" name="wpeden_admin[general][ui]" disabled="disabled" value="none" <?php if($minimax_options['general']['ui']=="none"||$minimax_options['general']['ui']=="")echo 'checked="checked"';else echo '';?>> None </label>
                <br><br><br>
         <div class="sap"></div>
         
         <b>Get MiniMax Pro</b>
         <div class="sap"></div>
         <a href="http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/" target="_blank" class="button">Check minimax pro here</a>
       
        </div>
        
       
        
        
        </div>
    </div>

</form>    
</div>
 