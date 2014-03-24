<style type="text/css">
.btn5x{
    -webkit-border-radius: 5px !important;
    -moz-border-radius: 5px !important;
    border-radius: 5px !important;
}
</style>
<form method="post" action="admin-ajax.php" id="layout-settings-form" rel="<?php echo $_GET['layout_settings_id']; ?>" >
<p>
<label>Row Class Name (CSS):</label>
<input class="widefat" type="text" name="ls[css_class]" value="<?php echo $ls['css_class']; ?>">
</p>
<p> 
<label>Row ID:</label>
<input class="widefat" type="text" name="ls[css_id]" value="<?php echo $ls['css_id']; ?>">
</p>
<p> 
<label>Row CSS Text:</label>
<input class="widefat" type="text" name="ls[css_txt]" value="<?php echo $ls['css_txt']; ?>">
</p>
<p> 
<label>Pre Defined Style:</label>
<select class="widefat" name="ls[css_class_pd]">
<?php $rowstyles = parse_ini_file(ABSPATH.'/'.PLUGINDIR.'/page-layout-builder/theme-data/row-styles.ini',true);
foreach($rowstyles as $class => $name): ?>
<option value="<?php echo $class; ?>" <?php echo $ls['css_class_pd']==$class?'selected=selected':''; ?> ><?php echo $name; ?></option>
<?php endforeach; ?>
</select>
</p>
<p>
<input type="submit" class="ui-button ui-widget ui-state-default ui-corner-all btn5x" value="Save Settings" />
<input type="button" onclick='jQuery("#dialog").dialog("close");jQuery("#dialog").html("Loading...");' class="ui-button ui-widget ui-state-default ui-corner-all" value="Cancel" />
</p>
</form>