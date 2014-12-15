<?php
$aid = uniqid();
?>
<div class="panel-group <?php if($accordion_style)echo $accordion_style;?>" id="accordion<?php echo $aid;?>">
    <?php
    if($pid){
        $cnt = uniqid(); 
        $zi = $xi = 0;
        foreach($pid as $key=>$val){
            if($val!='')  {
                $pimg = get_post($val);
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="accordion-toggle <?php if($xi++>0) echo "collapsed"; ?>" data-toggle="collapse" data-parent="#accordion<?php echo $aid;?>" href="#collapse<?php echo ++$cnt;?>" ><?php echo $pimg->post_title;?></a>
                    </div>
                    <div id="collapse<?php echo $cnt;?>" class="panel-body collapse">

                        <?php echo wpautop(htmlspecialchars_decode(stripcslashes($pimg->post_content)));?>

                    </div>
                </div>
            <?php
            }
        }
    }
    ?>
</div>
