<?php

$cols = $cols?$cols:2;

$grid = (int)(12/$cols);

$rem = 12%$cols;       

for($i=1; $i<=$cols;  $i++){
    if($i==$cols) $grid +=$rem;
    if($gs[$id]) $grid = $gs[$id]['grid_'.$i];
?> 

        <div class="gridt col-md-<?php echo $grid; ?> minimax_column" id="column_<?php echo $i; ?>_<?php echo $id; ?>">
    <?php if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1): ?>
        <input class="mx-input" type="hidden" id="<?php echo $id; ?>_<?php echo $i; ?>" name="layout_grids[<?php echo $holder; ?>_rows][<?php echo $id; ?>][grid_<?php echo $i; ?>]" value="<?php echo $grid; ?>">

            <ul class="module" rel='column_<?php echo $i; ?>_<?php echo $id; ?>'>
   <?php endif; ?>
            <?php minimax_render_modules("column_{$i}_{$id}"); ?>

            <?php if(current_user_can('manage_options') && get_option('minimax_frontend_editing',0)==1 && (is_page()||is_single()||$init==1)): ?>
            </ul>
            <div class="col-ctrl">
                <b style="color: #ffffff;font-size: 9pt;padding-left: 7px">Column Settings</b>
                <div class="pull-right" style="margin-right: 5px">
            <?php if($cols>1){ ?>
                <a title="Increase Width" href="#" rel="inc" id="inc_<?php echo $id; ?>_<?php echo $i; ?>" cols="<?php echo $cols; ?>" class="fbtn mwdth dtooltip btn btn-default btn-xs"><i class="fa fa-plus"></i></a>
                <a title="Decrease Width" href="#" rel="dsc" id="dsc_<?php echo $id; ?>_<?php echo $i; ?>" cols="<?php echo $cols; ?>" class="fbtn mwdth dtooltip btn btn-default btn-xs"><i class="fa fa-minus"></i></a>
            <?php } ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
	
    
<?php } ?>	 
 

 