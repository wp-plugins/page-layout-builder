<?php
$aid=uniqid();
?>
<div class="accordion <?php if($accordion_style)echo $accordion_style;?>" id="accordion<?php echo $aid;?>">
        <?php
    if($pid){
        $cnt=uniqid();
        foreach($pid as $key=>$val){ 
            if($val!='')  {
                $pimg = get_post($val);
?>
<div class="accordion-group" style="margin-bottom: 2px !important;">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-parent="#accordion<?php echo $aid;?>" href="#" onclick="return false;" ><?php echo $pimg->post_title;?></a>
    </div>

</div>
 <?php
            }
        }
    }
?>
   

</div>
