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
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $aid;?>" href="#collapse<?php echo ++$cnt;?>" ><?php echo $pimg->post_title;?></a>
    </div>
    <div id="collapse<?php echo $cnt;?>" class="accordion-body collapse ">
        <div class="accordion-inner">
            <?php echo wpautop(htmlspecialchars_decode(stripcslashes($pimg->post_content)));?>
        </div>
    </div>
</div>
 <?php
            }
        }
    }
?>
   

</div>
