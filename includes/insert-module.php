<ul id="modules">
<?php
global $mxwidgets;

foreach($mxwidgets as $id=>$widget){
if($id)    {
?>
<li class="widget mxwdgt" id="<?php echo $id; ?>">
<a href="#" class="insert" rel="<?php echo $id; ?>" title="<?php echo $widget->name; ?>">
<h3 style="margin: 0px" class="widget-title"><?php echo ucfirst($widget->name); ?></h3>
 
<em><small><?php echo $widget->widget_options['description'] ?></small></em>
<div style="clear: both;"></div>
 
</a>
</li>
<?php    
}}
?>
</ul>