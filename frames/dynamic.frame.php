<?php

$cols = $cols?$cols:2;

$grid = (int)(12/$cols);

$rem = 12%$cols;       

for($i=1; $i<=$cols;  $i++){
    if($i==$cols) $grid +=$rem;
    if(isset($gs) && isset($gs[$id])) $grid = $gs[$id]['grid_'.$i];
    ?> 

	<div id="grid_<?php echo $i; ?>_<?php echo $id; ?>" class="gridt grid_<?php echo $grid; ?>">
        <input type="hidden" id="<?php echo $id; ?>_<?php echo $i; ?>" name="layout_grids[<?php echo $holder; ?>_rows][<?php echo $id; ?>][grid_<?php echo $i; ?>]" value="<?php echo $grid; ?>">
    	<div class="column" id="column_<?php echo $i; ?>_<?php echo $id; ?>">
        
            <ul class="module" rel='column_<?php echo $i; ?>_<?php echo $id; ?>'>
            <?php minimax_render_module_frames("column_{$i}_{$id}"); ?>
            </ul>
            
            <a class="fbtn" rel="column_<?php echo $i; ?>_<?php echo $id; ?>" href="#" onclick="return false" style="font-weight: bold;">&nbsp;</a>

            <?php if($cols>1){ ?>
            <a title="Increase Width" href="#" rel="inc" id="inc_<?php echo $id; ?>_<?php echo $i; ?>" cols="<?php echo $cols; ?>" class="fbtn mwdth tooltip" style="z-index:10px;width:24px;right:0px;border-left:1px solid #ddd"><img style="margin-top: 6px;" src="http://cdn4.iconfinder.com/data/icons/Sizicons/12x12/plus.png" /></a>
            <a title="Decrease Width" href="#" rel="dsc" id="dsc_<?php echo $id; ?>_<?php echo $i; ?>" cols="<?php echo $cols; ?>" class="fbtn mwdth tooltip" style="z-index:10px;width:24px;right:25px;border-left:1px solid #ddd"><img style="margin-top: 6px;" src="http://cdn4.iconfinder.com/data/icons/Sizicons/12x12/minus.png" /></a>
            <?php } ?>
            <a class="fbtn btnAddMoudule tooltip" rel="column_<?php echo $i; ?>_<?php echo $id; ?>" href="#"  style="z-index:10px;width:24px;right:50px;border-left:1px solid #ddd" title="Add Module"><img style="margin-top: 4px;" src='http://cdn2.iconfinder.com/data/icons/splashyIcons/box_add.png' /></a>
        </div>
        
     </div>
<?php } ?>	 
 

 