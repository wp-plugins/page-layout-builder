<?php

$cols = isset($cols)?$cols:2;

$grid = (int)(12/$cols);

$rem = 12%$cols;       

for($i=1; $i<=$cols;  $i++){
    if($i==$cols) $grid +=$rem;
    if($gs[$id]) $grid = $gs[$id]['grid_'.$i];
?> 

        <div class="span<?php echo $grid; ?> minimax_column" id="column_<?php echo $i; ?>_<?php echo $id; ?>">
         <?php minimax_render_mobules("column_{$i}_{$id}"); ?>         
        </div>
	
    
<?php } ?>	 
 

 