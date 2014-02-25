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

            <br/>
            Module Preview: <select name="plb_modpreview">
                <option value="1">Enabled</option>
                <option value="2" <?php selected(get_option('plb_modpreview'),2); ?> >Disabled</option>

            </select> <br/>
            Module Caching: <select name="plb_modcache">
                <option value="1">Enabled</option>
                <option value="2" <?php selected(get_option('plb_modcache'),2); ?> >Disabled</option>

            </select>
<br/><br/>
         
         <b>Get MiniMax Pro</b>
         <div class="sap"></div>
            20+ Amazing Modules with lots of variations<br/><br/>
         <a href="http://wpeden.com/minimax-wordpress-page-layout-builder-plugin/" target="_blank" class="button button-primary">Check minimax pro here</a>
       
        </div>
        
       
        
        
        </div>
    </div>

</form>    
</div>
 